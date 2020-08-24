<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\pengeluarantambahan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;

class PengeluaranTambahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengeluarantambahan = DB::table('pengeluarantambahans')
            ->join('lokasis', 'pengeluarantambahans.KodeLokasi', '=', 'lokasis.KodeLokasi')
            ->orderBy('pengeluarantambahans.id', 'desc')
            ->where('pengeluarantambahans.Status', 'OPN')
            ->get();
        return view('stok.pengeluaranTambahan.index', compact('pengeluarantambahan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $matauang = DB::table('matauangs')->where('Status', 'OPN')->get();
        $lokasi = DB::table('lokasis')->where('Status', 'OPN')->get();

        return view('stok.pengeluaranTambahan.buat', [
            'matauang' => $matauang,
            'lokasi' => $lokasi
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
        $last_id = DB::select('SELECT * FROM pengeluarantambahans ORDER BY id DESC LIMIT 1');
        $year_now = date('y');
        $month_now = date('m');
        $date_now = date('d');
        $pref = "BO";
        if ($last_id == null) {
            $newID_bo = $pref . "-" . $year_now . $month_now . "0001";
        } else {
            $string = $last_id[0]->KodePengeluaran;
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

            $newID_bo = $pref . "-" . $year_now . $month_now . $newID;
        }

        DB::table('pengeluarantambahans')->insert([
            'KodePengeluaran' => $newID_bo,
            'Nama' => $request->Nama,
            'Karyawan' => $request->Karyawan,
            'Tanggal' => $request->Tanggal,
            'KodeLokasi' => $request->KodeLokasi,
            'KodeMataUang' => $request->KodeMataUang,
            'Keterangan' => $request->Keterangan,
            'Metode' => $request->Metode,
            'Status' => 'OPN',
            'KodeUser' => \Auth::user()->name,
            'Total' => $request->Total,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $last_id = DB::select('SELECT * FROM kasbanks ORDER BY KodeKasBankID DESC LIMIT 1');
        $year_now = date('y');
        $month_now = date('m');
        $date_now = date('d');
        $pref = "KK";
        if ($last_id == null) {
            $newID = $pref . "-" . $year_now . $month_now . "0001";
        } else {
            $string = $last_id[0]->KodeKasBank;
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

        DB::table('kasbanks')->insert([
            'KodeKasBank' => $newID,
            'Tanggal' => $request->Tanggal,
            'TanggalCheque' => $request->Tanggal,
            'KodeBayar' => $request->Metode,
            'TipeBayar' => '',
            'NoLink' => '',
            'KodeInvoice' => $newID_bo,
            'BayarDari' => '',
            'Untuk' => $request->Karyawan,
            'Keterangan' => $request->Keterangan,
            'Tipe' => 'BO',
            'Status' => 'CFM',
            'KodeUser' => \Auth::user()->name,
            'Total' => $request->Total,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Tambah biaya operasional ' . $request->Nama,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $pesan = 'Biaya operasional ' . $request->Name . ' berhasil ditambahkan';
        return redirect('/pengeluarantambahan')->with(['created' => $pesan]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('pengeluarantambahans')->where('id', $id)->update([
            'Status' => 'DEL'
        ]);

        $pt = DB::table('pengeluarantambahans')->where('id', $id)->first();

        DB::table('kasbanks')->where('KodeInvoice', $pt->KodePengeluaran)->update([
            'Status' => 'DEL'
        ]);

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Hapus biaya operasional ' . $pt->Nama,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect('/pengeluarantambahan');
    }
}
