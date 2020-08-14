<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\stokkeluar;
use App\Model\lokasi;

class StokKeluarController extends Controller
{
    public function index()
    {
        $stokkeluars = DB::select("SELECT s.KodeStokKeluar, s.KodeLokasi, s.Tanggal, s.Status, s.TotalItem, l.NamaLokasi FROM stokkeluars s 
            inner join lokasis l on s.KodeLokasi = l.KodeLokasi");
        return view('stok.stokkeluar.stokkeluar', compact('stokkeluars'));
    }

    public function create()
    {
        $item = DB::select("SELECT s.KodeItem, s.NamaItem, s.Keterangan 
            FROM items s 
            where s.Status='OPN'
            ORDER BY s.NamaItem 
        ");
        $satuan = DB::table('satuans')->where('Status', 'OPN')->get();
        $lokasi = DB::table('lokasis')->where('Status', 'OPN')->get();

        $last_id = DB::select('SELECT * FROM stokkeluars ORDER BY KodeStokKeluar DESC LIMIT 1');
        $year_now = date('y');
        $month_now = date('m');
        $date_now = date('d');

        if ($last_id == null) {
            $newID = "SLK-" . $year_now . $month_now . "0001";
        } else {
            $string = $last_id[0]->KodeStokKeluar;
            $id = substr($string, -4, 4);
            $month = substr($string, -6, 2);
            $year = substr($string, -8, 2);

            if ((int) $year_now > (int) $year) {
                $newID = "0001";
            } else if ((int) $month_now > (int) $month) {
                $newID = "0001";
            } else {
                $newID = $id + 1;
                $newID = str_pad($newID, 4, '0', STR_PAD_LEFT);
            }

            $newID = "SLK-" . $year_now . $month_now . $newID;
        }
        return view('stok.stokkeluar.create', compact('newID', 'lokasi', 'item', 'satuan'));
    }

    public function store(Request $request)
    {
        $items = $request->item;
        $satuans = $request->satuan;
        $keterangans = $request->keterangan;
        $qtys = $request->qty;
        $satuanvalid = true;
        foreach ($items as $key => $value) {
            $satuan = $satuans[$key];
            $last_saldo[$key] = DB::table('keluarmasukbarangs')->where('KodeItem', $value)->orderBy('id', 'desc')->limit(1)->pluck('saldo')->toArray();

            $checkkonversi = DB::table('itemkonversis')->where('KodeItem', $value)->where('KodeSatuan', $satuan)->first();
            if (empty($checkkonversi)) {
                $satuanvalid = false;
            }
        }

        if ($satuanvalid == true) {
            $checksaldo = true;
            foreach ($items as $key => $value) {
                $satuan = $satuans[$key];
                $konversi = DB::table('itemkonversis')->where('KodeItem', $value)->where('KodeSatuan', $satuan)->first()->Konversi;
                if ($konversi > 1) {
                    $qtys[$key] *= $konversi;
                };

                if (isset($last_saldo[$key][0])) {
                    $saldo = (float) $last_saldo[$key][0] - (float) $qtys[$key];
                    if ($saldo <= 0) {
                        $checksaldo = false;
                    }
                }

                if (!isset($last_saldo[$key][0])) {
                    $checksaldo = false;
                } else if ($last_saldo[$key][0] <= 0) {
                    $checksaldo = false;
                }
            }

            if ($checksaldo == true) {
                $last_id = DB::select('SELECT * FROM stokkeluars ORDER BY KodeStokKeluar DESC LIMIT 1');

                $year_now = date('y');
                $month_now = date('m');
                $date_now = date('d');

                if ($last_id == null) {
                    $newID = "SLK-" . $year_now . $month_now . "0001";
                } else {
                    $string = $last_id[0]->KodeStokKeluar;
                    $id = substr($string, -4, 4);
                    $month = substr($string, -6, 2);
                    $year = substr($string, -8, 2);

                    if ((int) $year_now > (int) $year) {
                        $newID = "0001";
                    } else if ((int) $month_now > (int) $month) {
                        $newID = "0001";
                    } else {
                        $newID = $id + 1;
                        $newID = str_pad($newID, 4, '0', STR_PAD_LEFT);
                    }

                    $newID = "SLK-" . $year_now . $month_now . $newID;
                }

                $tot = 0;
                $jml = $request->qty;
                foreach ($jml as $key => $value) {
                    $tot += $value;
                }

                DB::table('stokkeluars')->insert([
                    'KodeStokKeluar' => $newID,
                    'KodeLokasi' => $request->KodeLokasi,
                    'Tanggal' => $request->Tanggal,
                    'Status' => 'CFM',
                    'Printed' => 0,
                    'TotalItem' => $tot,
                    'KodeUser' => \Auth::user()->name,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);

                foreach ($items as $key => $value) {
                    DB::table('stokkeluardetails')->insert([
                        'KodeStokKeluar' => $newID,
                        'KodeItem' => $value,
                        'Qty' => $jml[$key],
                        'KodeSatuan' => $satuans[$key],
                        'Keterangan' => $keterangans[$key],
                        'NoUrut' => 0,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ]);
                }

                $nomer = 0;
                foreach ($items as $key => $value) {
                    $nomer++;
                    $saldo = (float) $last_saldo[$key][0] - (float) $qtys[$key];

                    DB::table('keluarmasukbarangs')->insert([
                        'Tanggal' => $request->Tanggal,
                        'KodeLokasi' => $request->KodeLokasi,
                        'KodeItem' => $value,
                        'JenisTransaksi' => 'SLK',
                        'KodeTransaksi' => $newID,
                        'Qty' => -$qtys[$key],
                        'HargaRata' => 0,
                        'KodeUser' => \Auth::user()->name,
                        'idx' => 0,
                        'indexmov' => $nomer,
                        'Saldo' => $saldo,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ]);
                }

                DB::table('eventlogs')->insert([
                    'KodeUser' => \Auth::user()->name,
                    'Tanggal' => \Carbon\Carbon::now(),
                    'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
                    'Keterangan' => 'Tambah stok keluar ' . $newID,
                    'Tipe' => 'OPN',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);

                $pesan = 'Stok Keluar  ' . $newID . ' berhasil ditambahkan';
                return redirect('/stokkeluar')->with(['created' => $pesan]);
                //
            } else {
                $pesan = 'Stok Keluar tidak disimpan karena stok item kosong atau tidak cukup, mohon menambah stok item terlebih dahulu';
                return redirect('/stokkeluar')->with(['error' => $pesan]);
            }
        } else {
            $pesan = 'Stok Keluar tidak disimpan karena terdapat satuan yang tidak sesuai, mohon periksa kembali (input satuan harus sesuai dengan master item)';
            return redirect('/stokkeluar')->with(['error' => $pesan]);
        }
    }

    public function view($id)
    {
        $stokkeluars = DB::select("SELECT s.KodeStokKeluar, s.Tanggal, l.NamaLokasi 
            FROM stokkeluars s 
            inner join lokasis l on s.KodeLokasi = l.KodeLokasi
            where s.KodeStokKeluar ='" . $id . "' ");

        $items = DB::select("SELECT DISTINCT a.Qty, b.NamaItem, d.NamaSatuan, b.Keterangan 
            from stokkeluardetails a
            inner join items b on a.KodeItem = b.KodeItem
            inner join itemkonversis c on c.KodeItem=a.KodeItem
            inner join satuans  d on d.KodeSatuan=a.KodeSatuan
            where a.KodeStokKeluar ='" . $id . "' ");

        return view('stok.stokkeluar.view', compact('stokkeluars', 'items'));
    }
}
