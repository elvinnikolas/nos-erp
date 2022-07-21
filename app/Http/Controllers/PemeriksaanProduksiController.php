<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use DB;

class PemeriksaanProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('produksi.pemeriksaan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produksi = DB::table('prod_hasilproduksiheader')
            ->where('prod_hasilproduksiheader.Status', 'OPN')
            ->get();

        return view('produksi.pemeriksaan.create', compact('produksi'));
    }

    public function select($id)
    {
        $produksi = DB::table('prod_hasilproduksiheader')
            ->where('prod_hasilproduksiheader.KodeProduksi', $id)
            ->first();

        $produksidetail = DB::table('prod_hasilproduksidetail')
            ->join('satuans', 'prod_hasilproduksidetail.KodeSatuan', '=', 'satuans.KodeSatuan')
            ->join('karyawans', 'prod_hasilproduksidetail.KodeKaryawan', '=', 'karyawans.KodeKaryawan')
            ->where('prod_hasilproduksidetail.KodeProduksi', $id)
            ->get();

        return view('produksi.pemeriksaan.createAjax', compact('produksi', 'produksidetail', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $karyawan = $request->karyawan;
        $qty = $request->qty;
        $qtycek = $request->qtycek;
        $satuan = $request->satuan;
        $keterangan = $request->keterangan;

        //cek apakah ada saldo bahan baku yang akan menjadi minus
        $total_qtycek = 0;
        $checksaldo = true;
        $pesantambahan = '';

        foreach ($qty as $key => $value) {
            $total_qtycek += $qtycek[$key];
        }

        $resep_bahanbaku = DB::table('prod_resepdetail')
            ->where('prod_resepdetail.KodeResep', $request->KodeResep)
            ->get();

        $hasil_produksi = DB::table('prod_hasilproduksiheader')
            ->where('prod_hasilproduksiheader.KodeProduksi', $request->KodeProduksi)
            ->first();

        if ($hasil_produksi->Jenis == 'Packing') {
            foreach ($resep_bahanbaku as $key => $value) {
                $item_bahanbaku = DB::table('items')
                    ->join('itemkonversis', 'itemkonversis.KodeItem', '=', 'items.KodeItem')
                    ->where('itemkonversis.KodeSatuan', $value->KodeSatuan)
                    ->where('items.KodeItem', $value->KodeItem)
                    ->first();

                $last_saldo[$key] = DB::table('keluarmasukbarangs')->where('KodeItem', $value->KodeItem)->orderBy('id', 'desc')->limit(1)->pluck('saldo')->toArray();

                if (!isset($last_saldo[$key][0])) {
                    $checksaldo = false;
                    $pesantambahan .= $item_bahanbaku->NamaItem . ', ';
                } else if ($last_saldo[$key][0] <= 0) {
                    $checksaldo = false;
                    $pesantambahan .= $item_bahanbaku->NamaItem . ', ';
                } else {
                    if ($item_bahanbaku->Konversi > 0) {
                        $qty_bahanbaku = $total_qtycek * $value->Qty * $item_bahanbaku->Konversi;
                    }

                    $saldo_bahanbaku = (float) $last_saldo[$key][0] - (float) $qty_bahanbaku;
                    if ($saldo_bahanbaku < 0) {
                        $checksaldo = false;
                        $pesantambahan .= $item_bahanbaku->NamaItem . ', ';
                    }
                }
            }

            if ($checksaldo == true) {
                //input db produksi
                DB::table('prod_produksiheader')
                    ->insert([
                        'KodeProduksi' => $request->KodeProduksi,
                        'KodeResep' => $request->KodeResep,
                        'KodeGolongan' => $hasil_produksi->KodeGolongan,
                        'Jenis' => $hasil_produksi->Jenis,
                        'Keterangan' => $request->Keterangan,
                        'Status' => 'CFM',
                        'KodeUser' => \Auth::user()->name,
                        'TanggalInput' => $request->TanggalInput,
                        'TanggalCek' => $request->TanggalCek,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ]);

                $no = 0;

                foreach ($karyawan as $key => $value) {
                    $no++;
                    DB::table('prod_produksidetail')
                        ->insert([
                            'KodeResep' => $request->KodeResep,
                            'KodeProduksi' => $request->KodeProduksi,
                            'KodeKaryawan' => $karyawan[$key],
                            'KodeSatuan' => $satuan[$key],
                            'Qty' => $qty[$key],
                            'QtyCek' => $qtycek[$key],
                            'Keterangan' => $keterangan[$key],
                            'NoUrut' => $no,
                            'created_at' => \Carbon\Carbon::now(),
                            'updated_at' => \Carbon\Carbon::now()
                        ]);
                }

                DB::table('prod_hasilproduksiheader')->where('KodeProduksi', $request->KodeProduksi)->update([
                    'Status' => 'CFM'
                ]);

                //keluarmasukbarang menambah stok bahan jadi
                $resep_bahanjadi = DB::table('prod_resepheader')
                    ->where('prod_resepheader.KodeResep', $request->KodeResep)
                    ->first();
                $item_bahanjadi = DB::table('items')
                    ->join('itemkonversis', 'itemkonversis.KodeItem', '=', 'items.KodeItem')
                    ->where('itemkonversis.KodeSatuan', $resep_bahanjadi->KodeSatuan)
                    ->where('items.KodeItem', $resep_bahanjadi->KodeItem)
                    ->first();

                $last_saldo_bahanjadi = DB::table('keluarmasukbarangs')->where('KodeItem', $item_bahanjadi->KodeItem)->orderBy('id', 'desc')->limit(1)->pluck('saldo')->first();

                if ($item_bahanjadi->Konversi > 0) {
                    $qty_bahanjadi = $total_qtycek * $item_bahanjadi->Konversi;
                }
                if (isset($last_saldo_bahanjadi)) {
                    $saldo_bahanjadi = (float) $last_saldo_bahanjadi + (float) $qty_bahanjadi;
                } else {
                    $saldo_bahanjadi = 0 + (float) $qty_bahanjadi;
                }

                DB::table('keluarmasukbarangs')->insert([
                    'Tanggal' => $request->TanggalInput,
                    'KodeLokasi' => 'GUD-001',
                    'KodeItem' => $resep_bahanjadi->KodeItem,
                    'JenisTransaksi' => 'PRD',
                    'KodeTransaksi' => $request->KodeProduksi,
                    'Qty' => $qty_bahanjadi,
                    'HargaRata' => 0,
                    'KodeUser' => \Auth::user()->name,
                    'idx' => 0,
                    'indexmov' => 0,
                    'saldo' => $saldo_bahanjadi,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);

                //keluarmasukbarang mengurangi stok bahan baku
                $resep_bahanbaku = DB::table('prod_resepdetail')
                    ->where('prod_resepdetail.KodeResep', $request->KodeResep)
                    ->get();

                $no = 0;

                foreach ($resep_bahanbaku as $key => $value) {
                    $item_bahanbaku = DB::table('items')
                        ->join('itemkonversis', 'itemkonversis.KodeItem', '=', 'items.KodeItem')
                        ->where('itemkonversis.KodeSatuan', $value->KodeSatuan)
                        ->where('items.KodeItem', $value->KodeItem)
                        ->first();

                    $last_saldo_bahanbaku[$key] = DB::table('keluarmasukbarangs')->where('KodeItem', $value->KodeItem)->orderBy('id', 'desc')->limit(1)->pluck('saldo')->toArray();

                    if ($item_bahanbaku->Konversi > 0) {
                        $qty_bahanbaku = $total_qtycek * $value->Qty * $item_bahanbaku->Konversi;
                    }
                    if (isset($last_saldo_bahanbaku[$key][0])) {
                        $saldo_bahanbaku = (float) $last_saldo_bahanbaku[$key][0] - (float) $qty_bahanbaku;
                    }
                    $no++;
                    DB::table('keluarmasukbarangs')->insert([
                        'Tanggal' => $request->TanggalInput,
                        'KodeLokasi' => 'GUD-001',
                        'KodeItem' => $value->KodeItem,
                        'JenisTransaksi' => 'PRD',
                        'KodeTransaksi' => $request->KodeProduksi,
                        'Qty' => $qty_bahanbaku,
                        'HargaRata' => 0,
                        'KodeUser' => \Auth::user()->name,
                        'idx' => $no,
                        'indexmov' => $no,
                        'saldo' => $saldo_bahanbaku,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ]);
                }

                DB::table('eventlogs')->insert([
                    'KodeUser' => \Auth::user()->name,
                    'Tanggal' => \Carbon\Carbon::now(),
                    'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
                    'Keterangan' => 'Konfirmasi pemeriksaan produksi ' . $request->KodeProduksi,
                    'Tipe' => 'OPN',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);

                return redirect('/pemeriksaanproduksi')->with(['created' => 'Pemeriksaan produksi dengan kode ' . $request->KodeProduksi . ' berhasil dikonfirmasi']);
            } else {
                $pesan = 'Pemeriksaan produksi tidak dikonfirmasi karena stok item tidak cukup, mohon menambah stok item terlebih dahulu untuk: ' . $pesantambahan;
                $pesan = substr(trim($pesan), 0, -1);
                return redirect('/pemeriksaanproduksi')->with(['error' => $pesan]);
            }
        } else {
            DB::table('prod_produksiheader')
                ->insert([
                    'KodeProduksi' => $request->KodeProduksi,
                    'KodeResep' => $request->KodeResep,
                    'KodeGolongan' => $hasil_produksi->KodeGolongan,
                    'Jenis' => $hasil_produksi->Jenis,
                    'Keterangan' => $request->Keterangan,
                    'Status' => 'CFM',
                    'KodeUser' => \Auth::user()->name,
                    'TanggalInput' => $request->TanggalInput,
                    'TanggalCek' => $request->TanggalCek,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);

            $no = 0;

            foreach ($karyawan as $key => $value) {
                $no++;
                DB::table('prod_produksidetail')
                    ->insert([
                        'KodeResep' => $request->KodeResep,
                        'KodeProduksi' => $request->KodeProduksi,
                        'KodeKaryawan' => $karyawan[$key],
                        'KodeSatuan' => $satuan[$key],
                        'Qty' => $qty[$key],
                        'QtyCek' => $qtycek[$key],
                        'Keterangan' => $keterangan[$key],
                        'NoUrut' => $no,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ]);
            }

            DB::table('prod_hasilproduksiheader')->where('KodeProduksi', $request->KodeProduksi)->update([
                'Status' => 'CFM'
            ]);

            DB::table('eventlogs')->insert([
                'KodeUser' => \Auth::user()->name,
                'Tanggal' => \Carbon\Carbon::now(),
                'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
                'Keterangan' => 'Konfirmasi pemeriksaan produksi ' . $request->KodeProduksi,
                'Tipe' => 'OPN',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            return redirect('/pemeriksaanproduksi')->with(['created' => 'Pemeriksaan produksi dengan kode ' . $request->KodeProduksi . ' berhasil dikonfirmasi']);
        }
    }

    public function dataPemeriksaan()
    {
        $produksi = DB::table('prod_produksiheader')
            ->join('prod_resepheader', 'prod_produksiheader.KodeResep', '=', 'prod_resepheader.KodeResep')
            ->join('items', 'prod_resepheader.KodeItem', '=', 'items.KodeItem')
            ->orderBy('prod_produksiheader.created_at', 'desc')
            ->select(
                'prod_produksiheader.IDProduksi',
                'prod_produksiheader.TanggalCek',
                'prod_produksiheader.KodeProduksi',
                'prod_produksiheader.Jenis',
                'items.NamaItem',
                'prod_produksiheader.Keterangan'
            )
            ->get();

        return Datatables::of($produksi)
            ->addColumn('action', function ($produksi) {
                return
                    '<form style="display:inline-block;">' .
                    '<button type="button" class="btn btn-primary btn-xs" onclick="detailPemeriksaan(\'' . $produksi->KodeProduksi . '\')"><i class="fa fa-eye"></i>&nbsp;Lihat Rincian</button></form>';
            })
            ->make(true);
    }

    public function dataPemeriksaanDetail(Request $request)
    {
        $kode_produksi = $request->kode;

        $produksi = DB::table('prod_produksiheader')
            ->join('prod_produksidetail', 'prod_produksiheader.KodeProduksi', '=', 'prod_produksidetail.KodeProduksi')
            ->join('karyawans', 'prod_produksidetail.KodeKaryawan', '=', 'karyawans.KodeKaryawan')
            ->join('satuans', 'prod_produksidetail.KodeSatuan', '=', 'satuans.KodeSatuan')
            ->where('prod_produksiheader.KodeProduksi', $kode_produksi)
            ->select(
                'karyawans.Nama',
                'prod_produksidetail.Qty',
                'prod_produksidetail.QtyCek',
                'satuans.NamaSatuan',
                'prod_produksidetail.Keterangan'
            )
            ->get();

        return Datatables::of($produksi)->make(true);
    }
}
