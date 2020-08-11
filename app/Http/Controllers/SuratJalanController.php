<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\suratjalan;
use App\Model\karyawan;
use App\Model\pemesananpenjualan;
use App\Model\matauang;
use App\Model\lokasi;
use App\Model\pelanggan;
use PDF;
use App\Model\invoicepiutang;
use function Complex\add;

class SuratJalanController extends Controller
{

  public function index()
  {
    $suratjalans = suratjalan::join('lokasis', 'lokasis.KodeLokasi', '=', 'suratjalans.KodeLokasi')
      ->join('pelanggans', 'pelanggans.KodePelanggan', '=', 'suratjalans.KodePelanggan')
      ->select('suratjalans.*', 'lokasis.NamaLokasi', 'pelanggans.NamaPelanggan')
      ->orderBy('suratjalans.KodeSuratJalanID', 'desc')
      ->get();
    $suratjalans = $suratjalans->where('Status', 'OPN');
    $suratjalans->all();
    return view('penjualan.suratJalan.index', compact('suratjalans'));
  }

  public function filterData(Request $request)
  {
    $search = $request->get('name');
    $start = $request->get('start');
    $end = $request->get('end');
    $suratjalans = suratjalan::join('pelanggans', 'pelanggans.KodePelanggan', '=', 'suratjalans.KodePelanggan')
      ->Where('suratjalans.Status', 'OPN')
      ->Where(function ($query) use ($search) {
        $query->Where('pelanggans.NamaPelanggan', 'LIKE', "%$search%")
          ->orWhere('suratjalans.KodeSuratJalan', 'LIKE', "%$search%")
          ->orWhere('suratjalans.KodeSO', 'LIKE', "%$search%");
      })->get();
    if ($start && $end) {
      $suratjalans = $suratjalans->whereBetween('Tanggal', [$start . ' 00:00:01', $end . ' 23:59:59']);
    } else {
      $suratjalans->all();
    }
    return view('penjualan.suratJalan.index', compact('suratjalans', 'start', 'end'));
  }

  public function konfirmasiSuratJalan()
  {
    $suratjalans = suratjalan::join('pelanggans', 'pelanggans.KodePelanggan', '=', 'suratjalans.KodePelanggan')
      ->join('lokasis', 'lokasis.KodeLokasi', '=', 'suratjalans.KodeLokasi')
      ->where('suratjalans.Status', 'CFM')
      ->orderBy('suratjalans.KodeSuratJalanID', 'desc')
      ->get();
    return view('penjualan.suratJalan.konfirmasi', compact('suratjalans'));
  }

  public function filterKonfirmasiSuratJalan(Request $request)
  {
    $search = $request->get('name');
    $start = $request->get('start');
    $end = $request->get('end');
    $suratjalans = suratjalan::join('pelanggans', 'pelanggans.KodePelanggan', '=', 'suratjalans.KodePelanggan')
      ->Where('suratjalans.Status', 'OPN')
      ->Where(function ($query) use ($search) {
        $query->Where('pelanggans.NamaPelanggan', 'LIKE', "%$search%")
          ->orWhere('suratjalans.KodeSuratJalan', 'LIKE', "%$search%")
          ->orWhere('suratjalans.KodeSO', 'LIKE', "%$search%");
      })->get();
    if ($start && $end) {
      $suratjalans = $suratjalans->whereBetween('Tanggal', [$start . ' 00:00:01', $end . ' 23:59:59']);
    } else {
      $suratjalans->all();
    }
    return view('penjualan.suratJalan.index', compact('suratjalans', 'start', 'end'));
  }

  public function createByCust()
  {
    $customers = DB::table('pelanggans')->where('Status', 'OPN')->get();
    return view('penjualan.suratJalan.buat', compact('customers'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function createBasedSO($id)
  {
    $drivers = DB::table('karyawans')->where('Status', 'OPN')->where('Jabatan', 'driver')->get();
    $pemesananpenjualan = DB::select("SELECT DISTINCT a.KodeSO from (
            SELECT DISTINCT a.KodeSO,
            COALESCE(a.qty,0)-COALESCE(SUM(sjd.qty),0) as jml
            FROM pemesanan_penjualan_detail a 
            inner join items i on a.KodeItem = i.KodeItem
            inner join itemkonversis k on i.KodeItem = k.KodeItem
            inner join satuans s on s.KodeSatuan = k.KodeSatuan
            left join suratjalans sj on sj.KodeSO = a.KodeSO
            left join suratjalandetails sjd on sjd.KodeSuratJalan = sj.KodeSuratJalan and sjd.KodeItem = a.KodeItem and sjd.KodeSatuan = k.KodeSatuan
            inner join pemesananpenjualans p on p.KodeSO = a.KodeSO
            where p.Status = 'CFM' and a.KodeSatuan = k.KodeSatuan
            group by a.KodeItem, a.KodeSatuan, a.KodeSO
            having jml > 0) as a");
    if ($id == "0") {
      if (count($pemesananpenjualan) <= 0) {
        return redirect('/sopenjualan/create');
      }
      $id = $pemesananpenjualan[0]->KodeSO;
    }
    $pelanggans = DB::table('pelanggans')->where('Status', 'OPN')->get();
    $lokasis = DB::table('lokasis')->where('Status', 'OPN')->get();
    $items = DB::select("SELECT a.KodeItem, i.NamaItem, i.Keterangan, s.KodeSatuan, s.NamaSatuan, a.Harga,
            COALESCE(a.qty,0)-COALESCE(SUM(sjd.qty),0) as jml
            FROM pemesanan_penjualan_detail a 
            inner join items i on a.KodeItem = i.KodeItem
            inner join itemkonversis k on i.KodeItem = k.KodeItem
            inner join satuans s on s.KodeSatuan = k.KodeSatuan
            left join suratjalans sj on sj.KodeSO = a.KodeSO and sj.Status = 'CFM'
            left join suratjalandetails sjd on sjd.KodeSuratJalan = sj.KodeSuratJalan and sjd.KodeItem = a.KodeItem and sjd.KodeSatuan = k.KodeSatuan
            where a.KodeSO='" . $id . "' and a.KodeSatuan = k.KodeSatuan
            group by a.KodeItem, s.NamaSatuan
            having jml > 0");
    $so = pemesananpenjualan::where('KodeSO', $id)->first();
    $matauang = DB::table('matauangs')->where('Status', 'OPN')->get();
    $alamat = DB::table('alamatpelanggans')->where('KodePelanggan', $so->KodePelanggan)->get();

    return view('penjualan.suratJalan.buatAjax', compact(
      'pemesananpenjualan',
      'id',
      'pelanggans',
      'lokasis',
      'drivers',
      'items',
      'so',
      'matauang',
      'alamat'
    ));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $id)
  {
    $last_id = DB::select('SELECT * FROM suratjalans ORDER BY KodeSuratJalanID DESC LIMIT 1');

    $year_now = date('y');
    $month_now = date('m');
    $date_now = date('d');
    $pref = "SJ";
    if ($request->ppn == 'ya') {
      $pref = "SJT";
    }
    if ($last_id == null) {
      $newID = $pref . "-" . $year_now . $month_now . "0001";
    } else {
      $string = $last_id[0]->KodeSuratJalan;
      $ids = substr($string, -4, 4);
      $month = substr($string, -6, 2);
      $year = substr($string, -8, 2);

      if ((int) $year_now > (int) $year) {
        $newID = "0001";
      } else if ((int) $month_now > (int) $month) {
        $newID = "0001";
      } else {
        $newID = $ids + 1;
        $newID = str_pad($newID, 4, '0', STR_PAD_LEFT);
      }

      $newID = $pref . "-" . $year_now . $month_now . $newID;
    }
    DB::table('suratjalans')->insert([
      'KodeSuratJalan' => $newID,
      'KodeSO' => $request->KodeSO,
      'Tanggal' => $request->Tanggal,
      'KodeLokasi' => $request->KodeLokasi,
      'KodeMataUang' => $request->KodeMataUang,
      'Status' => 'OPN',
      'KodeUser' => \Auth::user()->name,
      'Total' => 0,
      'PPN' => $request->ppn,
      'NilaiPPN' => $request->ppnval,
      'KodePelanggan' => $request->KodePelanggan,
      'Printed' => 0,
      'Diskon' => $request->diskon,
      'NilaiDiskon' => $request->diskonval,
      'Subtotal' => $request->subtotal,
      'NoIndeks' => 0,
      'Nopol' => $request->nopol,
      'NoFaktur' => $request->NoFaktur,
      'KodeSopir' => $request->KodeSopir,
      'Alamat' => $request->AlamatPelanggan,
      'created_at' => \Carbon\Carbon::now(),
      'updated_at' => \Carbon\Carbon::now(),
    ]);

    $items = $request->item;
    $qtys = $request->qty;
    $prices = $request->price;
    $keterangans = $request->keterangan;
    $satuans = $request->satuan;
    $nomer = 0;
    foreach ($items as $key => $value) {
      if ($qtys[$key] != 0) {
        $nomer++;
        DB::table('suratjalandetails')->insert([
          'KodeSuratJalan' => $newID,
          'KodeItem' => $items[$key],
          'Qty' => $qtys[$key],
          'Harga' => $prices[$key],
          'Keterangan' => $keterangans[$key],
          'KodeSatuan' => $satuans[$key],
          'NoUrut' => $nomer,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now(),
        ]);
      }
    }

    DB::table('eventlogs')->insert([
      'KodeUser' => \Auth::user()->name,
      'Tanggal' => \Carbon\Carbon::now(),
      'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
      'Keterangan' => 'Tambah surat jalan ' . $newID,
      'Tipe' => 'OPN',
      'created_at' => \Carbon\Carbon::now(),
      'updated_at' => \Carbon\Carbon::now(),
    ]);

    $pesan = 'Surat Jalan ' . $newID . ' berhasil ditambahkan';
    return redirect('/suratJalan')->with(['created' => $pesan]);
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $suratjalan = suratjalan::where('KodeSuratJalanID', $id)->first();
    $driver = karyawan::where('KodeKaryawan', $suratjalan->KodeSopir)->first();
    $matauang = matauang::where('KodeMataUang', $suratjalan->KodeMataUang)->first();
    $lokasi = lokasi::where('KodeLokasi', $suratjalan->KodeLokasi)->first();
    $pelanggan = pelanggan::where('KodePelanggan', $suratjalan->KodePelanggan)->first();
    $items = DB::select(
      "SELECT a.KodeItem,i.NamaItem, a.Qty as jml, i.Keterangan, s.NamaSatuan, a.Harga 
        FROM suratjalandetails a 
        inner join items i on a.KodeItem = i.KodeItem 
        inner join itemkonversis k on i.KodeItem = k.KodeItem and a.KodeSatuan = k.KodeSatuan
        inner join satuans s on s.KodeSatuan = k.KodeSatuan 
        where a.KodeSuratJalan='" . $suratjalan->KodeSuratJalan . "' 
        group by a.KodeItem, s.NamaSatuan"
    );

    return view('penjualan.suratJalan.show', compact('id', 'suratjalan', 'driver', 'matauang', 'lokasi', 'pelanggan', 'items'));
  }

  public function searchSOByCustId($id)
  {
    $so = DB::table('pemesananpenjualans')->where('KodePelanggan', $id)->where('Status', 'CFM')->get();
    if ($so != null) {
      $kodeSo = array();
      foreach ($so as $soItem) {
        array_push($kodeSo, $soItem->KodeSO);
      }
      return response()->json($kodeSo);
    } else {
      return response()->json([]);
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $suratjalan = suratjalan::where('KodeSuratJalanID', $id)->first();
    $driver = DB::table('karyawans')->where('Status', 'OPN')->where('Jabatan', 'Driver')->get();
    $matauang = DB::table('matauangs')->where('Status', 'OPN')->get();
    $lokasi = DB::table('lokasis')->where('Status', 'OPN')->get();
    $pelanggan = pelanggan::where('KodePelanggan', $suratjalan->KodePelanggan)->first();
    $alamat = DB::table('alamatpelanggans')->where('KodePelanggan', $suratjalan->KodePelanggan)->get();
    // $items = DB::select(
    //     "SELECT a.KodeItem,i.NamaItem, a.Qty as jml, i.Keterangan, s.NamaSatuan, a.Harga 
    //     FROM suratjalandetails a 
    //     inner join items i on a.KodeItem = i.KodeItem 
    //     inner join itemkonversis k on i.KodeItem = k.KodeItem and a.KodeSatuan = k.KodeSatuan
    //     inner join satuans s on s.KodeSatuan = k.KodeSatuan 
    //     where a.KodeSuratJalan='" . $suratjalan->KodeSuratJalan . "' 
    //     group by a.KodeItem, s.NamaSatuan"
    // );
    $items = DB::select("SELECT a.KodeItem, i.NamaItem, i.Keterangan, s.KodeSatuan, s.NamaSatuan, a.Harga, sjd.Qty as jml,
        COALESCE(a.qty,0)-COALESCE(SUM(sjdt.qty),0) as max
        FROM pemesanan_penjualan_detail a 
        inner join items i on a.KodeItem = i.KodeItem
        inner join itemkonversis k on i.KodeItem = k.KodeItem
        inner join satuans s on s.KodeSatuan = k.KodeSatuan
        left join suratjalans sj on sj.KodeSO = a.KodeSO and sj.Status = 'CFM'
        left join suratjalandetails sjdt on sjdt.KodeSuratJalan = sj.KodeSuratJalan and sjdt.KodeItem = a.KodeItem and sjdt.KodeSatuan = k.KodeSatuan
        left join suratjalandetails sjd on sjd.KodeSuratJalan='" . $suratjalan->KodeSuratJalan . "' and sjd.KodeItem = a.KodeItem and sjd.KodeSatuan = k.KodeSatuan
        where a.KodeSO='" . $suratjalan->KodeSO . "' and a.KodeSatuan = k.KodeSatuan
        group by a.KodeItem, s.NamaSatuan
        having max > 0
    ");

    return view('penjualan.suratJalan.edit', compact('id', 'suratjalan', 'driver', 'matauang', 'lokasi', 'alamat', 'pelanggan', 'items'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    DB::table('suratjalans')
      ->where('KodeSuratJalan', $request->KodeSJ)
      ->update([
        'Tanggal' => $request->Tanggal,
        'KodeLokasi' => $request->KodeLokasi,
        'KodeMataUang' => $request->KodeMataUang,
        'KodeUser' => \Auth::user()->name,
        'PPN' => $request->ppn,
        'NilaiPPN' => $request->ppnval,
        'Diskon' => $request->diskon,
        'NilaiDiskon' => $request->diskonval,
        'Subtotal' => $request->subtotal,
        'Nopol' => $request->nopol,
        'NoFaktur' => $request->NoFaktur,
        'KodeSopir' => $request->KodeSopir,
        'Alamat' => $request->Alamat,
        'updated_at' => \Carbon\Carbon::now(),
      ]);

    $items = $request->item;
    $qtys = $request->qty;
    $prices = $request->price;
    $keterangans = $request->keterangan;
    $satuans = $request->satuan;
    $nomer = 0;
    foreach ($items as $key => $value) {
      $nomer++;
      DB::table('suratjalandetails')
        ->where('KodeSuratJalan', $request->KodeSJ)
        ->where('NoUrut', $nomer)
        ->update([
          'KodeItem' => $items[$key],
          'Qty' => $qtys[$key],
          'Harga' => $prices[$key],
          'Keterangan' => $keterangans[$key],
          'KodeSatuan' => $satuans[$key],
          'NoUrut' => $nomer,
          'updated_at' => \Carbon\Carbon::now(),
        ]);
    }

    DB::table('eventlogs')->insert([
      'KodeUser' => \Auth::user()->name,
      'Tanggal' => \Carbon\Carbon::now(),
      'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
      'Keterangan' => 'Update surat jalan ' . $request->KodeSJ,
      'Tipe' => 'OPN',
      'created_at' => \Carbon\Carbon::now(),
      'updated_at' => \Carbon\Carbon::now(),
    ]);

    $pesan = 'Surat Jalan ' . $request->KodeSJ . ' berhasil diupdate';
    return redirect('/suratJalan')->with(['edited' => $pesan]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    DB::table('suratjalans')->where('KodeSuratJalan', $id)->update([
      'Status' => 'DEL'
    ]);

    DB::table('eventlogs')->insert([
      'KodeUser' => \Auth::user()->name,
      'Tanggal' => \Carbon\Carbon::now(),
      'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
      'Keterangan' => 'Hapus surat jalan ' . $id,
      'Tipe' => 'OPN',
      'created_at' => \Carbon\Carbon::now(),
      'updated_at' => \Carbon\Carbon::now(),
    ]);

    $pesan = 'Surat Jalan ' . $id . ' berhasil dihapus';
    return redirect('/suratJalan')->with(['deleted' => $pesan]);
  }

  public function confirm($id)
  {
    $sj = suratjalan::where('KodeSuratJalanID', $id)->first();
    $checkresult = DB::select("SELECT (a.qty-COALESCE(SUM(sjd.qty),0)-COALESCE(sjdc.qty,0)) as jml
      FROM pemesanan_penjualan_detail a 
      inner join items i on a.KodeItem = i.KodeItem
      inner join itemkonversis k on i.KodeItem = k.KodeItem
      inner join satuans s on s.KodeSatuan = k.KodeSatuan
      left join suratjalans sj on sj.KodeSO = a.KodeSO and sj.Status = 'CFM'
      left join suratjalandetails sjd on sjd.KodeSuratJalan = sj.KodeSuratJalan and sjd.KodeItem = a.KodeItem and sjd.KodeSatuan = k.KodeSatuan
      left join suratjalandetails sjdc on sjdc.KodeItem = a.KodeItem and sjdc.KodeSatuan = k.KodeSatuan and sjdc.KodeSuratJalan ='" . $sj['KodeSuratJalan'] . "'
      where a.KodeSO='" . $sj['KodeSO'] . "' and a.KodeSatuan = k.KodeSatuan
      group by a.KodeItem, s.NamaSatuan
      having jml < 0");

    if (empty($checkresult)) {
      $data = suratjalan::where('KodeSuratJalanID', $id)->first();
      $data->Status = "CFM";
      $data->save();
      $so = pemesananpenjualan::find($data->KodeSO);
      $items = DB::select(
        "SELECT a.KodeItem,i.NamaItem, a.Qty as jml, i.Keterangan, s.NamaSatuan, a.Harga, k.Konversi
          FROM suratjalandetails a 
          inner join items i on a.KodeItem = i.KodeItem 
          inner join itemkonversis k on i.KodeItem = k.KodeItem and a.KodeSatuan = k.KodeSatuan 
          inner join satuans s on s.KodeSatuan = k.KodeSatuan
          where a.KodeSuratJalan='" . $data->KodeSuratJalan . "' group by a.KodeItem, s.NamaSatuan"
      );

      $checkitem = DB::select("SELECT (a.qty-COALESCE(SUM(sjd.qty),0)) as jml
        FROM pemesanan_penjualan_detail a 
        inner join items i on a.KodeItem = i.KodeItem
        inner join itemkonversis k on i.KodeItem = k.KodeItem
        inner join satuans s on s.KodeSatuan = k.KodeSatuan
        left join suratjalans sj on sj.KodeSO = a.KodeSO and sj.Status = 'CFM'
        left join suratjalandetails sjd on sjd.KodeSuratJalan = sj.KodeSuratJalan and sjd.KodeItem = a.KodeItem and sjd.KodeSatuan = k.KodeSatuan
        where a.KodeSO='" . $sj['KodeSO'] . "' and a.KodeSatuan = k.KodeSatuan
        group by a.KodeItem, s.NamaSatuan
        having jml > 0");

      if (empty($checkitem)) {
        $so->Status = "CLS";
        $so->save();
      }

      $last_id = DB::select('SELECT * FROM invoicepiutangs ORDER BY KodeInvoicePiutang DESC LIMIT 1');

      $year_now = date('y');
      $month_now = date('m');
      $date_now = date('d');
      $pref = "IVP";
      if ($last_id == null) {
        $newID = $pref . "-" . $year_now . $month_now . "0001";
      } else {
        $string = $last_id[0]->KodeInvoicePiutangShow;
        $ids = substr($string, -4, 4);
        $month = substr($string, -6, 2);
        $year = substr($string, -8, 2);

        if ((int) $year_now > (int) $year) {
          $newID = "0001";
        } else if ((int) $month_now > (int) $month) {
          $newID = "0001";
        } else {
          $newID = $ids + 1;
          $newID = str_pad($newID, 4, '0', STR_PAD_LEFT);
        }
        $newID = $pref . "-" . $year_now . $month_now . $newID;
      }

      DB::table('invoicepiutangs')->insert([
        'KodeInvoicePiutangShow' => $newID,
        'Tanggal' => $data->Tanggal,
        'KodePelanggan' => $data->KodePelanggan,
        'Status' => 'OPN',
        'Total' => $data->Subtotal,
        'Keterangan' => $so->Keterangan,
        'KodeMataUang' => $data->KodeMataUang,
        'NoFaktur' => $data->NoFaktur,
        'KodeUser' => \Auth::user()->name,
        'Term' => $so->term,
        'KodeLokasi' => $data->KodeLokasi,
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now()
      ]);

      $inv = DB::table('invoicepiutangs')->where('KodeInvoicePiutangShow', $newID)->first();

      DB::table('invoicepiutangdetails')->insert([
        'KodePiutang' => $newID,
        'KodeSuratJalan' => $data->KodeSuratJalan,
        'Subtotal' => $data->Subtotal,
        'KodeInvoicePiutang' => $inv->KodeInvoicePiutang,
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
      ]);

      $nomer = 0;
      foreach ($items as $key => $value) {
        if ($value->Konversi > 0) {
          $value->jml = $value->jml * $value->Konversi;
        }
        $nomer++;
        DB::table('keluarmasukbarangs')->insert([
          'Tanggal' => $data->Tanggal,
          'KodeLokasi' => $data->KodeLokasi,
          'KodeItem' => $value->KodeItem,
          'JenisTransaksi' => 'SJB',
          'KodeTransaksi' => $data->KodeSuratJalan,
          'Qty' => -$value->jml,
          'HargaRata' => 0,
          'KodeUser' => \Auth::user()->name,
          'idx' => 0,
          'indexmov' => $nomer,
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now()
        ]);
      }

      DB::table('eventlogs')->insert([
        'KodeUser' => \Auth::user()->name,
        'Tanggal' => \Carbon\Carbon::now(),
        'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
        'Keterangan' => 'Konfirmasi surat jalan ' . $data->KodeSuratJalan,
        'Tipe' => 'OPN',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
      ]);

      $pesan = 'Surat Jalan ' . $data->KodeSuratJalan . ' berhasil dikonfirmasi';
      return redirect('/konfirmasiSuratJalan')->with(['created' => $pesan]);
    } else {
      $pesan = 'Surat Jalan tidak dikonfirmasi karena hasil item menjadi minus, mohon periksa kembali jumlah item pada SO yang dapat dikirimkan';
      return redirect('/suratJalan')->with(['error' => $pesan]);
    }
  }

  public function view($id)
  {
    $suratjalan = suratjalan::where('KodeSuratJalanID', $id)->first();
    $driver = karyawan::where('KodeKaryawan', $suratjalan->KodeSopir)->first();
    $matauang = matauang::where('KodeMataUang', $suratjalan->KodeMataUang)->first();
    $lokasi = lokasi::where('KodeLokasi', $suratjalan->KodeLokasi)->first();
    $pelanggan = pelanggan::where('KodePelanggan', $suratjalan->KodePelanggan)->first();
    $items = DB::select(
      "SELECT a.KodeItem,i.NamaItem, a.Qty as jml, i.Keterangan, s.NamaSatuan, a.Harga 
        FROM suratjalandetails a 
        inner join items i on a.KodeItem = i.KodeItem 
        inner join itemkonversis k on i.KodeItem = k.KodeItem and a.KodeSatuan = k.KodeSatuan 
        inner join satuans s on s.KodeSatuan = k.KodeSatuan
        where a.KodeSuratJalan='" . $suratjalan->KodeSuratJalan . "' group by a.KodeItem, s.NamaSatuan"
    );
    return view('penjualan.suratJalan.view', compact('id', 'suratjalan', 'driver', 'matauang', 'lokasi', 'pelanggan', 'items'));
  }

  public function print($id)
  {
    $suratjalan = suratjalan::where('KodeSuratJalanID', $id)->first();
    $driver = karyawan::where('KodeKaryawan', $suratjalan->KodeSopir)->first();
    $matauang = matauang::where('KodeMataUang', $suratjalan->KodeMataUang)->first();
    $lokasi = lokasi::where('KodeLokasi', $suratjalan->KodeLokasi)->first();
    $pelanggan = pelanggan::where('KodePelanggan', $suratjalan->KodePelanggan)->first();

    $items = DB::select(
      "SELECT a.KodeItem,i.NamaItem, a.Qty, i.Keterangan, s.NamaSatuan, a.Harga
        FROM suratjalandetails a 
        inner join items i on a.KodeItem = i.KodeItem 
        inner join itemkonversis k on i.KodeItem = k.KodeItem and a.KodeSatuan = k.KodeSatuan 
        inner join satuans s on s.KodeSatuan = k.KodeSatuan
        where a.KodeSuratJalan='" . $suratjalan->KodeSuratJalan . "' group by a.KodeItem, s.NamaSatuan"
    );

    $jml = 0;
    foreach ($items as $value) {
      $jml += $value->Qty;
    }
    $suratjalan->Tanggal = \Carbon\Carbon::parse($suratjalan->Tanggal)->format('d-m-Y');

    $pdf = PDF::loadview('penjualan.suratJalan.print', compact('suratjalan', 'driver', 'matauang', 'lokasi', 'pelanggan', 'items', 'jml'));

    DB::table('eventlogs')->insert([
      'KodeUser' => \Auth::user()->name,
      'Tanggal' => \Carbon\Carbon::now(),
      'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
      'Keterangan' => 'Print surat jalan ' . $suratjalan->KodeSuratJalan,
      'Tipe' => 'OPN',
      'created_at' => \Carbon\Carbon::now(),
      'updated_at' => \Carbon\Carbon::now(),
    ]);

    return $pdf->download('SuratJalan_' . $suratjalan->KodeSuratJalan . '.pdf');
  }
}
