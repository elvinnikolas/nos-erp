<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\pemesananpenjualan;
use App\Model\lokasi;
use App\Model\matauang;
use App\Model\pelanggan;
use App\Model\item;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;
use Exception;

class PemesananPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemesananpenjualan = pemesananpenjualan::join('lokasis', 'lokasis.KodeLokasi', '=', 'pemesananpenjualans.KodeLokasi')
            ->join('matauangs', 'matauangs.KodeMataUang', '=', 'pemesananpenjualans.KodeMataUang')
            ->join('pelanggans', 'pelanggans.KodePelanggan', '=', 'pemesananpenjualans.KodePelanggan')
            ->select('pemesananpenjualans.*', 'lokasis.NamaLokasi', 'matauangs.NamaMataUang', 'pelanggans.NamaPelanggan')
            ->orderBy('pemesananpenjualans.KodeSO', 'desc')
            ->get();
        $pemesananpenjualan = $pemesananpenjualan->where('Status', 'OPN');
        $pemesananpenjualan->all();
        return view('penjualan.pemesananPenjualan.index', compact('pemesananpenjualan'));
    }

    public function filterData(Request $request)
    {
        $search = $request->get('name');
        $start = $request->get('mulai');
        $end = $request->get('sampai');
        $mulai = $request->get('mulai');
        $sampai = $request->get('sampai');
        $pemesananpenjualan = pemesananpenjualan::join('lokasis', 'lokasis.KodeLokasi', '=', 'pemesananpenjualans.KodeLokasi')
            ->join('matauangs', 'matauangs.KodeMataUang', '=', 'pemesananpenjualans.KodeMataUang')
            ->join('pelanggans', 'pelanggans.KodePelanggan', '=', 'pemesananpenjualans.KodePelanggan')
            ->where('pemesananpenjualans.Status', 'OPN')
            ->where(function ($query) use ($search) {
                $query->Where('pelanggans.NamaPelanggan', 'LIKE', "%$search%")
                    ->orWhere('pemesananpenjualans.KodeSO', 'LIKE', "%$search%");
            })->get();
        if ($start && $end) {
            $pemesananpenjualan = $pemesananpenjualan->whereBetween('Tanggal', [$start . ' 00:00:00', $end . ' 23:59:59']);
        } else {
            $pemesananpenjualan->all();
        }
        return view('penjualan.pemesananPenjualan.index', compact('pemesananpenjualan', 'mulai', 'sampai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pemesananpembelian = DB::table('pemesananpembelians')->get();
        $matauang = DB::table('matauangs')->get();
        $lokasi = DB::table('lokasis')->get();
        $pelanggan = DB::table('pelanggans')->get();
        $item = DB::select("SELECT i.KodeItem, i.NamaItem, i.Keterangan 
            FROM items i
            where i.jenisitem = 'bahanjadi'
            GROUP BY i.NamaItem
            ");
        $satuan = DB::table('satuans')->get();
        $sales = DB::table('karyawans')->where('jabatan', 'Sales')->get();

        $last_id = DB::select('SELECT * FROM pemesananpenjualans ORDER BY KodeSO DESC LIMIT 1');
        $year_now = date('y');
        $month_now = date('m');
        $date_now = date('d');

        if ($last_id == null) {
            $newID = "SO-" . $year_now . $month_now . "0001";
            $newIDP = "SOT-" . $year_now . $month_now . "0001";
        } else {
            $string = $last_id[0]->KodeSO;
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
            $newIDP = "SOT-" . $year_now . $month_now . $newID;
            $newID = "SO-" . $year_now . $month_now . $newID;
        }

        foreach ($item as $key => $value) {
            $array_satuan = DB::table('itemkonversis')->where('KodeItem', $value->KodeItem)->pluck('KodeSatuan')->toArray();
            $datasatuan[$value->KodeItem] = $array_satuan;
            foreach ($array_satuan as $sat) {
                $array_harga = DB::table('itemkonversis')->where('KodeItem', $value->KodeItem)->where('KodeSatuan', $sat)->pluck('HargaJual')->toArray();
                $dataharga[$value->KodeItem][$sat] = $array_harga[0];
            }
        }

        return view('penjualan.pemesananPenjualan.buat', [
            'newID' => $newID,
            'newIDP' => $newIDP,
            'pemesananpembelian' => $pemesananpembelian,
            'matauang' => $matauang,
            'lokasi' => $lokasi,
            'pelanggan' => $pelanggan,
            'item' => $item,
            'satuan' => $satuan,
            'sales' => $sales,
            'datasatuan' => $datasatuan,
            'dataharga' => $dataharga,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::table('pemesananpenjualans')->insert([
                'KodeSO' => $request->KodeSO,
                'Tanggal' => $request->Tanggal,
                'tgl_kirim' => $request->TanggalKirim,
                'Expired' => $request->Expired,
                'KodeLokasi' => $request->KodeLokasi,
                'KodeMataUang' => $request->KodeMataUang,
                'KodePelanggan' => $request->KodePelanggan,
                'Term' => $request->Term,
                'Keterangan' => $request->Keterangan,
                'Status' => 'OPN',
                'KodeUser' => \Auth::user()->name,
                'Total' => $request->subtotal,
                'PPN' => $request->ppn,
                'NilaiPPN' => $request->ppnval,
                'Printed' => 0,
                'Diskon' => $request->diskon,
                'NilaiDiskon' => $request->diskonval,
                'Subtotal' => $request->subtotal - $request->ppnval,
                'KodeSales' => 0,
                'POPelanggan' => 'PO',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            $items = $request->item;
            $qtys = $request->qty;
            $prices = $request->price;
            $totals = $request->total;
            $satuans = $request->satuan;
            $nomer = 0;
            foreach ($items as $key => $value) {
                $nomer++;
                DB::table('pemesanan_penjualan_detail')->insert([
                    'KodeSO' => $request->KodeSO,
                    'KodeItem' => $items[$key],
                    'Qty' => $qtys[$key],
                    'Harga' => $prices[$key],
                    'KodeSatuan' => $satuans[$key],
                    'NoUrut' => $nomer,
                    'Subtotal' => $totals[$key],
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }

            DB::table('eventlogs')->insert([
                'KodeUser' => \Auth::user()->name,
                'Tanggal' => \Carbon\Carbon::now(),
                'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
                'Keterangan' => 'Tambah pemesanan penjualan ' . $request->KodeSO,
                'Tipe' => 'OPN',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            $pesan = 'SO ' . $request->KodeSO . ' berhasil ditambahkan';
            return redirect('/sopenjualan')->with(['created' => $pesan]);
            //
        } catch (Exception $e) {
            console . log($e->getMessage());
            $pesan = 'Terjadi kesalahan. SO gagal ditambahkan';
            return redirect('/sopenjualan')->with(['error' => $pesan]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::select("SELECT a.KodeSo, a.Tanggal, a.tgl_kirim,a.Expired,a.term, a.POPelanggan, b.NamaMataUang, c.NamaLokasi, d.NamaPelanggan, a.Keterangan, a.Diskon, a.NilaiDiskon, a.PPN, a.Subtotal, a.Total, a.NilaiPPN from pemesananpenjualans a
            inner join matauangs b on b.KodeMataUang = a.KodeMataUang
            inner join lokasis c on c.KodeLokasi = a.KodeLokasi
            inner join pelanggans d on d.KodePelanggan = a.KodePelanggan
            where a.KodeSO ='" . $id . "' limit 1")[0];

        $items = DB::select("SELECT DISTINCT a.Qty,b.NamaItem,d.NamaSatuan,
            a.Harga, a.Subtotal, b.Keterangan  from pemesanan_penjualan_detail a
            inner join items b on a.KodeItem = b.KodeItem
            inner join itemkonversis c on c.KodeItem=a.KodeItem
            inner join satuans  d on d.KodeSatuan=a.KodeSatuan
            where a.KodeSO ='" . $id . "' ");

        $OPN = true;
        $data->Tanggal = Carbon::parse($data->Tanggal)->format('d-m-Y');
        $data->tgl_kirim = Carbon::parse($data->tgl_kirim)->format('d-m-Y');
        return view('penjualan.pemesananpenjualan.lihat', compact('data', 'id', 'items', 'OPN'));
    }

    public function lihat($id)
    {
        $data = DB::select("SELECT a.KodeSo, a.Tanggal, a.tgl_kirim,a.Expired,a.term, a.POPelanggan, b.NamaMataUang, c.NamaLokasi, d.NamaPelanggan, a.Keterangan, a.Diskon, a.NilaiDiskon, a.PPN, a.Subtotal, a.Total, a.NilaiPPN from pemesananpenjualans a
            inner join matauangs b on b.KodeMataUang = a.KodeMataUang
            inner join lokasis c on c.KodeLokasi = a.KodeLokasi
            inner join pelanggans d on d.KodePelanggan = a.KodePelanggan
            where a.KodeSO ='" . $id . "' limit 1")[0];

        $items = DB::select("SELECT DISTINCT a.Qty,b.NamaItem,d.NamaSatuan,
            a.Harga, a.Subtotal, b.Keterangan  from pemesanan_penjualan_detail a
            inner join items b on a.KodeItem = b.KodeItem
            inner join itemkonversis c on c.KodeItem=a.KodeItem
            inner join satuans  d on d.KodeSatuan=a.KodeSatuan
            where a.KodeSO ='" . $id . "' ");

        $OPN = false;
        $data->Tanggal = Carbon::parse($data->Tanggal)->format('d-m-Y');
        $data->tgl_kirim = Carbon::parse($data->tgl_kirim)->format('d-m-Y');
        return view('penjualan.pemesananpenjualan.lihat', compact('data', 'id', 'items', 'OPN'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $matauang = DB::table('matauangs')->get();
        $lokasi = DB::table('lokasis')->get();
        $data = DB::select("SELECT a.KodeSo, a.Tanggal, a.tgl_kirim,a.Expired,a.term, a.POPelanggan, 
            b.NamaMataUang, c.NamaLokasi, d.NamaPelanggan, a.Keterangan, a.Diskon, a.PPN, a.Subtotal, a.NilaiPPN, c.KodeLokasi, d.KodePelanggan, b.KodeMataUang from pemesananpenjualans a
            inner join matauangs b on b.KodeMataUang = a.KodeMataUang
            inner join lokasis c on c.KodeLokasi = a.KodeLokasi
            inner join pelanggans d on d.KodePelanggan = a.KodePelanggan
            where a.KodeSO ='" . $id . "' limit 1")[0];
        $items = DB::select("SELECT a.Qty,b.KodeItem,b.NamaItem,d.NamaSatuan, a.Harga, a.Subtotal, b.Keterangan 
            from pemesanan_penjualan_detail a
            inner join items b on a.KodeItem = b.KodeItem
            inner join itemkonversis c on c.KodeItem = a.KodeItem
            inner join satuans d on c.KodeSatuan = d.KodeSatuan
            where a.KodeSO ='" . $id . "' ");

        //exit();
        $itemSelect = DB::select("SELECT s.KodeItem, s.NamaItem, k.HargaJual, t.NamaSatuan, s.Keterangan FROM items s
            inner join itemkonversis k on k.KodeItem = s.KodeItem
            inner join satuans t on k.KodeSatuan = t.KodeSatuan where s.jenisitem like'%B%' ");
        // dd($items);
        $data->Tanggal = Carbon::parse($data->Tanggal)->format('Y-m-d');
        $data->tgl_kirim = Carbon::parse($data->tgl_kirim)->format('Y-m-d');
        $pelanggan = DB::table('pelanggans')->get();
        return view('penjualan.pemesananpenjualan.edit', compact('data', 'id', 'items', 'itemSelect', 'lokasi', 'pelanggan', 'matauang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::table('pemesanan_penjualan_detail')->where('KodeSO', '=', $request->KodeSO)->delete();
        $items = $request->item;
        $qtys = $request->qty;
        $prices = $request->price;
        $totals = $request->total;
        foreach ($items as $key => $value) {
            DB::table('pemesanan_penjualan_detail')->insert([
                'KodeSO' => $request->KodeSO,
                'KodeItem' => $items[$key],
                'Qty' => $qtys[$key],
                'Harga' => $prices[$key],
                'NoUrut' => 0,
                'Subtotal' => $totals[$key],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        DB::table('pemesananpenjualans')
            ->where('KodeSO', $request->KodeSO)->update([
                'Tanggal' => $request->Tanggal,
                'tgl_kirim' => $request->TanggalKirim,
                'Expired' => $request->Expired,
                'KodeLokasi' => $request->KodeLokasi,
                'KodeMataUang' => $request->KodeMataUang,
                'KodePelanggan' => $request->KodePelanggan,
                'Term' => $request->Term,
                'Keterangan' => $request->Keterangan,
                'Status' => 'OPN',
                'KodeUser' => \Auth::user()->name,
                'Total' => $request->subtotal,
                'PPN' => $request->ppn,
                'NilaiPPN' => $request->ppnval,
                'Printed' => 0,
                'Diskon' => $request->diskon,
                'NilaiDiskon' => $request->diskonval,
                'Subtotal' => $request->subtotal - $request->ppnval,
                'KodeSales' => 0,
                'POPelanggan' => $request->po,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        return redirect('/sopenjualan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('pemesananpenjualans')->where('KodeSO', $id)->update([
            'Status' => 'DEL'
        ]);

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Hapus pemesanan penjualan ' . $id,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect('/sopenjualan');
    }

    public function confirm(Request $request, $id)
    {
        $data = pemesananpenjualan::find($id);
        $data->Status = "CFM";
        $data->save();

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Konfirmasi pemesanan penjualan ' . $id,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect('/konfirmasiPenjualan');
    }

    public function cancel(Request $request, $id)
    {
        $data = pemesananpenjualan::find($id);
        $data->Status = "DEL";
        $data->save();

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Batal pemesanan penjualan ' . $id,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect('/batalPenjualan');
    }

    public function konfirmasiPenjualan()
    {
        $pemesananpenjualan = pemesananpenjualan::join('lokasis', 'lokasis.KodeLokasi', '=', 'pemesananpenjualans.KodeLokasi')
            ->join('matauangs', 'matauangs.KodeMataUang', '=', 'pemesananpenjualans.KodeMataUang')
            ->join('pelanggans', 'pelanggans.KodePelanggan', '=', 'pemesananpenjualans.KodePelanggan')
            ->select('pemesananpenjualans.*', 'lokasis.NamaLokasi', 'matauangs.NamaMataUang', 'pelanggans.NamaPelanggan')
            ->orderBy('pemesananpenjualans.KodeSO', 'desc')
            ->get();
        $pemesananpenjualan = $pemesananpenjualan->where('Status', 'CFM');
        $pemesananpenjualan->all();
        $filter = false;
        return view('penjualan.pemesananPenjualan.konfirmasi', compact('pemesananpenjualan', 'filter'));
    }

    public function dikirimPenjualan()
    {
        $pemesananpenjualan = pemesananpenjualan::join('lokasis', 'lokasis.KodeLokasi', '=', 'pemesananpenjualans.KodeLokasi')
            ->join('matauangs', 'matauangs.KodeMataUang', '=', 'pemesananpenjualans.KodeMataUang')
            ->join('pelanggans', 'pelanggans.KodePelanggan', '=', 'pemesananpenjualans.KodePelanggan')
            ->select('pemesananpenjualans.*', 'lokasis.NamaLokasi', 'matauangs.NamaMataUang', 'pelanggans.NamaPelanggan')
            ->orderBy('pemesananpenjualans.KodeSO', 'desc')
            ->get();
        $pemesananpenjualan = $pemesananpenjualan->where('Status', 'CLS');
        $pemesananpenjualan->all();
        $filter = false;
        return view('penjualan.pemesananPenjualan.dikirim', compact('pemesananpenjualan', 'filter'));
    }

    public function batalPenjualan()
    {
        $pemesananpenjualan = pemesananpenjualan::join('lokasis', 'lokasis.KodeLokasi', '=', 'pemesananpenjualans.KodeLokasi')
            ->join('matauangs', 'matauangs.KodeMataUang', '=', 'pemesananpenjualans.KodeMataUang')
            ->join('pelanggans', 'pelanggans.KodePelanggan', '=', 'pemesananpenjualans.KodePelanggan')
            ->select('pemesananpenjualans.*', 'lokasis.NamaLokasi', 'matauangs.NamaMataUang', 'pelanggans.NamaPelanggan')
            ->orderBy('pemesananpenjualans.KodeSO', 'desc')
            ->get();
        $pemesananpenjualan = $pemesananpenjualan->where('Status', 'DEL');
        $pemesananpenjualan->all();
        $filter = false;
        return view('penjualan.pemesananPenjualan.batal', compact('pemesananpenjualan', 'filter'));
    }

    public function dikirimPenjualanFilter(Request $request)
    {
        $so = pemesananpenjualan::join('lokasis', 'lokasis.KodeLokasi', '=', 'pemesananpenjualans.KodeLokasi')
            ->join('matauangs', 'matauangs.KodeMataUang', '=', 'pemesananpenjualans.KodeMataUang')
            ->join('pelanggans', 'pelanggans.KodePelanggan', '=', 'pemesananpenjualans.KodePelanggan')
            ->select('pemesananpenjualans.*', 'lokasis.NamaLokasi', 'matauangs.NamaMataUang', 'pelanggans.NamaPelanggan')
            ->get();
        $hasil1 = $so->where('Status', 'CLS');
        $hasil1->all();
        $start = $request->get('start');
        $end = $request->get('end');
        $pemesananpenjualan = $hasil1->whereBetween('Tanggal', [$start . ' 00:00:01', $end . ' 23:59:59']);
        $pemesananpenjualan->all();
        return view('penjualan.pemesananPenjualan.dikirim', compact('pemesananpenjualan', 'filter', 'start', 'finish'));
    }

    public function batalPenjualanFilter(Request $request)
    {
        $so = pemesananpenjualan::join('lokasis', 'lokasis.KodeLokasi', '=', 'pemesananpenjualans.KodeLokasi')
            ->join('matauangs', 'matauangs.KodeMataUang', '=', 'pemesananpenjualans.KodeMataUang')
            ->join('pelanggans', 'pelanggans.KodePelanggan', '=', 'pemesananpenjualans.KodePelanggan')
            ->select('pemesananpenjualans.*', 'lokasis.NamaLokasi', 'matauangs.NamaMataUang', 'pelanggans.NamaPelanggan')
            ->get();
        $hasil1 = $so->where('Status', 'DEL');
        $hasil1->all();
        $start = $request->get('start');
        $end = $request->get('end');
        $pemesananpenjualan = $hasil1->whereBetween('Tanggal', [$start . ' 00:00:01', $end . ' 23:59:59']);
        $pemesananpenjualan->all();
        return view('penjualan.pemesananPenjualan.batal', compact('pemesananpenjualan', 'filter', 'start', 'finish'));
    }

    public function konfirmasiPenjualanFilter(Request $request)
    {
        $so = pemesananpenjualan::join('lokasis', 'lokasis.KodeLokasi', '=', 'pemesananpenjualans.KodeLokasi')
            ->join('matauangs', 'matauangs.KodeMataUang', '=', 'pemesananpenjualans.KodeMataUang')
            ->join('pelanggans', 'pelanggans.KodePelanggan', '=', 'pemesananpenjualans.KodePelanggan')
            ->select('pemesananpenjualans.*', 'lokasis.NamaLokasi', 'matauangs.NamaMataUang', 'pelanggans.NamaPelanggan')
            ->get();
        $hasil1 = $so->where('Status', 'CFM');
        $hasil1->all();
        $start = $request->get('start');
        $end = $request->get('end');
        $pemesananpenjualan = $hasil1->whereBetween('Tanggal', [$start . ' 00:00:01', $end . ' 23:59:59']);
        $pemesananpenjualan->all();
        return view('penjualan.pemesananPenjualan.konfirmasi', compact('pemesananpenjualan', 'filter', 'start', 'finish'));
    }

    public function konfirmasiPenjualanPrint(Request $request)
    {
        if ($request->start != null) {
            $pemesananpenjualan = pemesananpenjualan::all()->where('Status', 'CFM')->where('Tanggal', '>=', $request->start)->where('Tanggal', '<=', $request->finish);
        } else {
            $pemesananpenjualan = pemesananpenjualan::all()->where('Status', 'CFM');
        }
        $pdf = PDF::loadview('penjualan.pemesananPenjualan.pdf', ['pemesananpenjualan' => $pemesananpenjualan]);

        return $pdf->download('penjualan.pemesananpenjualan.pdf');
    }

    // public function print($id)
    // {
    //     $data = DB::select("SELECT a.KodeSo, a.Tanggal, a.tgl_kirim,a.Expired,a.term, a.POPelanggan,d.KodePelanggan, 
    //         b.NamaMataUang, c.NamaLokasi, d.NamaPelanggan, a.Keterangan, a.Diskon, a.PPN, a.Subtotal, a.NilaiPPN
    //         from pemesananpenjualans a
    //         inner join matauangs b on b.KodeMataUang = a.KodeMataUang
    //         inner join lokasis c on c.KodeLokasi = a.KodeLokasi
    //         inner join pelanggans d on d.KodePelanggan = a.KodePelanggan
    //         where a.KodeSO ='" . $id . "' limit 1")[0];


    //     $items = DB::select("SELECT a.Qty,b.NamaItem,d.NamaSatuan, a.Harga, a.Subtotal, b.Keterangan  from pemesanan_penjualan_detail a
    //         inner join items b on a.KodeItem = b.KodeItem
    //         inner join itemkonversis c on c.KodeItem = a.KodeItem
    //         inner join satuans d on c.KodeSatuan = d.KodeSatuan
    //         where a.KodeSO ='" . $id . "' ");
    //     $jml = 0;

    //     $kotapelanggan = DB::table("alamatpelanggans")->where("KodePelanggan", $data->KodePelanggan)->get();
    //     if ($kotapelanggan->count() == 0) {
    //         return redirect('/datapelanggan');
    //     }

    //     $namakota = $kotapelanggan[0]->Kota;
    //     foreach ($items as $value) {
    //         $jml += $value->Qty;
    //     }
    //     $data->Tanggal = Carbon::parse($data->Tanggal)->format('d/m/Y');
    //     $data->tgl_kirim = Carbon::parse($data->tgl_kirim)->format('d/m/Y');

    //     $pdf = PDF::loadview('penjualan.pemesananPenjualan.pdfdetail', compact('data', 'id', 'items', 'jml', 'namakota'));
    //     return $pdf->stream();
    // }

    public function print($id)
    {
        $data = DB::select("SELECT a.KodeSO, a.Tanggal, a.tgl_kirim,a.Expired,a.term, a.POPelanggan, b.NamaMataUang, c.NamaLokasi, d.NamaPelanggan, a.Keterangan, a.Diskon, a.NilaiDiskon, a.PPN, a.NilaiPPN, a.Subtotal, a.Total, a.NilaiPPN from pemesananpenjualans a
            inner join matauangs b on b.KodeMataUang = a.KodeMataUang
            inner join lokasis c on c.KodeLokasi = a.KodeLokasi
            inner join pelanggans d on d.KodePelanggan = a.KodePelanggan
            where a.KodeSO ='" . $id . "' limit 1");

        $items = DB::select("SELECT DISTINCT a.Qty, b.KodeItem, c.HargaJual, b.NamaItem, d.NamaSatuan,
            a.Subtotal, b.Keterangan  from pemesanan_penjualan_detail a
            inner join items b on a.KodeItem = b.KodeItem
            inner join itemkonversis c on c.KodeItem=a.KodeItem
            inner join satuans d on d.KodeSatuan=a.KodeSatuan and d.KodeSatuan=c.KodeSatuan
            where a.KodeSO ='" . $id . "' ");

        $jml = 0;
        foreach ($items as $value) {
            $jml += $value->Qty;
        }
        $data[0]->Tanggal = Carbon::parse($data[0]->Tanggal)->format('d/m/Y');

        $pdf = PDF::loadview('penjualan.pemesananPenjualan.print', compact('data', 'id', 'items', 'jml'));

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Print pemesanan penjualan ' . $id,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return $pdf->download('penjualan.pemesananPenjualan.pdf');
    }
}
