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
use Carbon\Carbon;
use App\Model\suratjalanreturn;
use App\Model\invoicepiutangdetail;
use PDF;

class ReturnSuratJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function add($id)
    {
        $sj = DB::select("SELECT DISTINCT a.KodeSuratJalan, a.KodeSuratJalanID from (
            SELECT sj.KodeSuratJalanID,a.KodeSuratJalan,a.KodeItem, 
            COALESCE(SUM(a.qty))-COALESCE(SUM(sjrd.Qty),0) as jml
            FROM suratjalandetails a 
            inner join items i on a.KodeItem = i.KodeItem
            inner join itemkonversis k on i.KodeItem = k.KodeItem
            inner join satuans s on s.KodeSatuan = k.KodeSatuan
            inner join suratjalans sj on sj.KodeSuratJalan = a.KodeSuratJalan and sj.Status='CFM'
            left join suratjalanreturns sjr on sjr.KodeSuratJalanID = sj.KodeSuratJalanID
            left join suratjalanreturndetails sjrd on sjrd.KodeSuratJalanReturn = sjr.KodeSuratJalanReturn and sjrd.KodeItem = a.KodeItem and sjrd.KodeSatuan = k.KodeSatuan
            where sj.Status = 'CFM' and a.KodeSatuan = k.KodeSatuan
            group by a.KodeItem, a.KodeSatuan, a.KodeSuratJalan
            having jml > 0) as a");
        if ($id == "0") {
            if (count($sj) <= 0) {
                return redirect('/suratJalan/create/0');
            }
            $id = $sj[0]->KodeSuratJalanID;
        }

        $items = DB::select("SELECT a.KodeItem, i.NamaItem, i.Keterangan, s.KodeSatuan, s.NamaSatuan, k.HargaJual,
            COALESCE(SUM(a.qty))-COALESCE(SUM(sjrd.Qty),0) as jml
            FROM suratjalandetails a inner join items i on a.KodeItem = i.KodeItem 
            inner join itemkonversis k on i.KodeItem = k.KodeItem 
            inner join satuans s on s.KodeSatuan = k.KodeSatuan
            left join suratjalans sj on sj.KodeSuratJalan = a.KodeSuratJalan
            left join suratjalanreturns sjr on sjr.KodeSuratJalanID = sj.KodeSuratJalanID
            left join suratjalanreturndetails sjrd on sjrd.KodeSuratJalanReturn = sjr.KodeSuratJalanReturn and sjrd.KodeItem = a.KodeItem and sjrd.KodeSatuan = k.KodeSatuan
            where sj.KodeSuratJalanID='" . $id . "' and a.KodeSatuan = k.KodeSatuan
            group by a.KodeItem, s.KodeSatuan
            having jml > 0");
        $so = DB::select("select so.* from suratjalans sj inner join pemesananpenjualans so on so.KodeSO 
            = sj.KodeSO where sj.KodeSuratJalanID='" . $id . "'")[0];
        $sjDet = suratjalan::where('KodeSuratJalanID', $id)->first();
        $sopir = karyawan::where('KodeKaryawan', $sjDet->KodeSopir)->first();
        return view('penjualan.returnSuratJalan.add', compact('sj', 'id', 'items', 'so', 'sopir', 'sjDet'));
    }

    public function store(Request $request, $id)
    {

        $last_id = DB::select('SELECT * FROM suratjalanreturns ORDER BY KodeSuratJalanReturnID DESC LIMIT 1');

        $year_now = date('y');
        $month_now = date('m');
        $date_now = date('d');
        $pref = "RSJ";
        if ($request->ppn == 'ya') {
            $pref = "RSJT";
        }
        if ($last_id == null) {
            $newID = $pref . "-" . $year_now . $month_now . "0001";
        } else {
            $string = $last_id[0]->KodeSuratJalanReturn;
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

        $sj = suratjalan::where('KodeSuratJalanID', $request->KodeSJ)->first();

        DB::table('suratjalanreturns')->insert([
            'KodeSuratJalanReturn' => $newID,
            'Tanggal' => $request->Tanggal,
            'Status' => 'OPN',
            'KodeUser' => \Auth::user()->name,
            'Total' => $request->total,
            'PPN' => $request->ppn,
            'NilaiPPN' => $request->ppnval,
            'Printed' => 0,
            'Diskon' => $request->diskon,
            'NilaiDiskon' => $request->diskonval,
            'Subtotal' => $request->subtotal,
            'KodeSuratJalanID' => $request->KodeSJ,
            'KodeSuratJalan' => $sj->KodeSuratJalan,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $last_idreturn = DB::select('SELECT * FROM suratjalanreturns ORDER BY KodeSuratJalanReturnID DESC LIMIT 1');
        $items = $request->item;
        $qtys = $request->qty;
        $satuans = $request->satuan;
        $keterangans = $request->keterangan;
        $nomer = 0;
        foreach ($items as $key => $value) {
            if ($qtys[$key] != 0) {
                $nomer++;
                DB::table('suratjalanreturndetails')->insert([
                    'KodeSuratJalanReturn' => $newID,
                    'KodeItem' => $items[$key],
                    'Qty' => $qtys[$key],
                    'NoUrut' => $nomer,
                    'KodeSuratJalan' => $request->KodeSJ,
                    'KodeSatuan' => $satuans[$key],
                    'Keterangan' => $keterangans[$key],
                    'KodeSuratJalanReturnID' => $last_idreturn[0]->KodeSuratJalanReturnID,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
        }

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Tambah return surat jalan ' . $newID,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect('/returnSuratJalan');
    }

    public function index()
    {
        $suratjalanreturns = suratjalanreturn::where('Status', 'OPN')->get();
        return view('penjualan.returnSuratJalan.index', compact('suratjalanreturns'));
    }

    public function filterData(Request $request)
    {
        $start = $request->get('start');
        $end = $request->get('end');
        $suratjalanreturns = suratjalanreturn::where('Status', 'OPN')->get();
        if ($start && $end) {
            $suratjalanreturns = $suratjalanreturns->whereBetween('Tanggal', [$start . ' 00:00:01', $end . ' 23:59:59']);
        } else {
            $suratjalanreturns->all();
        }
        return view('penjualan.returnSuratJalan.index', compact('suratjalanreturns', 'start', 'end'));
    }

    public function show($id)
    {
        $suratjalanreturn = suratjalanreturn::where('KodeSuratJalanReturnID', $id)->first();
        $suratjalan = suratjalan::where('KodeSuratJalanID', $suratjalanreturn->KodeSuratJalanID)->first();
        $driver = karyawan::where('KodeKaryawan', $suratjalan->KodeSopir)->first();
        $matauang = matauang::where('KodeMataUang', $suratjalan->KodeMataUang)->first();
        $lokasi = lokasi::where('KodeLokasi', $suratjalan->KodeLokasi)->first();
        $pelanggan = pelanggan::where('KodePelanggan', $suratjalan->KodePelanggan)->first();
        $items = DB::select("SELECT a.KodeItem,i.NamaItem, SUM(a.Qty) as jml, i.Keterangan, s.NamaSatuan, k.HargaJual
            FROM suratjalanreturndetails a
            inner join suratjalanreturns b on a.KodeSuratJalanReturn = b.KodeSuratJalanReturn
            inner join items i on a.KodeItem = i.KodeItem 
            inner join itemkonversis k on i.KodeItem = k.KodeItem and a.KodeSatuan = k.KodeSatuan
            inner join satuans s on s.KodeSatuan = k.KodeSatuan 
            where b.KodeSuratJalanReturnID='" . $id . "' 
            group by a.KodeItem, s.NamaSatuan");
        return view('penjualan.returnSuratJalan.show', compact('id', 'suratjalanreturn', 'driver', 'matauang', 'lokasi', 'pelanggan', 'items', 'suratjalan'));
    }

    public function confirm(Request $request, $id)
    {
        $suratjalanreturn = suratjalanreturn::where('KodeSuratJalanReturnID', $id)->first();
        $totalreturn = $suratjalanreturn->Total;

        $suratjalanreturn->Status = "CFM";
        $suratjalanreturn->save();

        $suratjalan = suratjalan::where('KodeSuratJalanID', $suratjalanreturn->KodeSuratJalanID)->first();
        $invoice = invoicepiutangdetail::where('KodeSuratJalan', $suratjalanreturn->KodeSuratJalan)->first();
        if (!empty($invoice)) {
            $now = $invoice->Subtotal;
            $invoice->Subtotal = $now - $totalreturn;
            $invoice->save();
        }

        $items = DB::select("SELECT a.KodeItem,i.NamaItem, SUM(a.Qty) as jml, i.Keterangan, s.NamaSatuan, k.HargaJual 
        FROM suratjalanreturndetails a 
        inner join suratjalanreturns sj on a.KodeSuratJalanReturn = sj.KodeSuratJalanReturn 
        inner join items i on a.KodeItem = i.KodeItem 
        inner join itemkonversis k on i.KodeItem = k.KodeItem and a.KodeSatuan = k.KodeSatuan
        inner join satuans s on s.KodeSatuan = k.KodeSatuan
        where sj.KodeSuratJalanReturnID='" . $id . "'
        group by a.KodeItem, s.NamaSatuan");
        $last_id = DB::select('SELECT * FROM stokkeluars ORDER BY KodeStokKeluar DESC LIMIT 1');

        $year_now = date('y');
        $month_now = date('m');
        $date_now = date('d');

        if ($last_id == null) {
            $newID = "SLM-" . $year_now . $month_now . "0001";
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

            $newID = "SLM-" . $year_now . $month_now . $newID;
        }
        $tot = 0;

        foreach ($items as $key => $value) {
            $tot += $value->jml;
        }
        $nomer = 0;

        foreach ($items as $key => $value) {
            $nomer++;
            DB::table('keluarmasukbarangs')->insert([
                'Tanggal' => $suratjalanreturn->Tanggal,
                'KodeLokasi' => $suratjalan->KodeLokasi,
                'KodeItem' => $value->KodeItem,
                'JenisTransaksi' => 'SJB',
                'KodeTransaksi' => $suratjalanreturn->KodeSuratJalanReturn,
                'Qty' => $value->jml,
                'HargaRata' => 0,
                'KodeUser' => 'Admin',
                'idx' => $nomer,
                'indexmov' => 2,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Konfirmasi return surat jalan ' . $suratjalanreturn->KodeSuratJalanReturn,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect('/konfirmasiReturnSuratJalan');
    }

    public function konfirmasiSuratJalanReturn()
    {
        $suratjalanreturns = suratjalanreturn::where('Status', 'CFM')->get();
        return view('penjualan.returnSuratJalan.listkonfirmasi', compact('suratjalanreturns'));
    }

    public function filterKonfirmasiSuratJalanReturn(Request $request)
    {
        $start = $request->get('start');
        $end = $request->get('end');
        $suratjalanreturns = suratjalanreturn::where('Status', 'CFM')->get();
        if ($start && $end) {
            $suratjalanreturns = $suratjalanreturns->whereBetween('Tanggal', [$start . ' 00:00:01', $end . ' 23:59:59']);
        } else {
            $suratjalanreturns->all();
        }
        return view('penjualan.returnSuratJalan.listkonfirmasi', compact('suratjalanreturns', 'start', 'end'));
    }

    public function view($id)
    {
        $suratjalanreturn = suratjalanreturn::where('KodeSuratJalanReturnID', $id)->first();
        $suratjalan = suratjalan::where('KodeSuratJalanID', $suratjalanreturn->KodeSuratJalanID)->first();
        $driver = karyawan::where('KodeKaryawan', $suratjalan->KodeSopir)->first();
        $matauang = matauang::where('KodeMataUang', $suratjalan->KodeMataUang)->first();
        $lokasi = lokasi::where('KodeLokasi', $suratjalan->KodeLokasi)->first();
        $pelanggan = pelanggan::where('KodePelanggan', $suratjalan->KodePelanggan)->first();
        $items = DB::select("sELECT a.KodeItem,i.NamaItem, SUM(a.Qty) as jml, i.Keterangan, s.NamaSatuan, k.HargaJual
            FROM suratjalanreturndetails a
            inner join suratjalanreturns b on a.KodeSuratJalanReturn = b.KodeSuratJalanReturn
            inner join items i on a.KodeItem = i.KodeItem inner join itemkonversis k on i.KodeItem = k.KodeItem inner join satuans s on s.KodeSatuan = k.KodeSatuan where b.KodeSuratJalanReturnID='" . $id . "' group by a.KodeItem, i.Keterangan, s.NamaSatuan, k.HargaJual, i.NamaItem ");
        return view('penjualan.returnSuratJalan.view', compact('id', 'suratjalanreturn', 'driver', 'matauang', 'lokasi', 'pelanggan', 'items', 'suratjalan'));
    }

    public function print($id)
    {
        $returnsuratjalan = suratjalanreturn::where('KodeSuratJalanReturnID', $id)->first();
        $suratjalan = suratjalan::where('KodeSuratJalan', $returnsuratjalan->KodeSuratJalan)->first();
        $driver = karyawan::where('KodeKaryawan', $suratjalan->KodeSopir)->first();
        $matauang = matauang::where('KodeMataUang', $suratjalan->KodeMataUang)->first();
        $lokasi = lokasi::where('KodeLokasi', $suratjalan->KodeLokasi)->first();
        $pelanggan = pelanggan::where('KodePelanggan', $suratjalan->KodePelanggan)->first();

        $items = DB::select(
            "SELECT a.KodeItem,i.NamaItem, a.Qty, i.Keterangan, s.NamaSatuan, k.HargaJual 
        FROM suratjalanreturndetails a 
        inner join items i on a.KodeItem = i.KodeItem 
        inner join itemkonversis k on i.KodeItem = k.KodeItem and a.KodeSatuan = k.KodeSatuan 
        inner join satuans s on s.KodeSatuan = k.KodeSatuan
        where a.KodeSuratJalanReturnID='" . $id . "' group by a.KodeItem, s.NamaSatuan"
        );

        $jml = 0;
        foreach ($items as $value) {
            $jml += $value->Qty;
        }
        $suratjalan->Tanggal = \Carbon\Carbon::parse($suratjalan->Tanggal)->format('d/m/Y');

        $pdf = PDF::loadview('penjualan.returnSuratJalan.print', compact('returnsuratjalan', 'suratjalan', 'driver', 'matauang', 'lokasi', 'pelanggan', 'items', 'jml'));

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Print surat jalan ' . $id,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return $pdf->download('penjualan.suratJalan.pdf');
    }

    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('suratjalanreturns')->where('KodeSuratJalanReturnID', $id)->update([
            'Status' => 'DEL'
        ]);

        $sjr = DB::table('suratjalanreturns')->where('KodeSuratJalanReturnID', $id)->first();

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Hapus return surat jalan ' . $sjr->KodeSuratJalanReturn,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect('/suratJalan');
    }
}
