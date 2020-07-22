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
            ->orderBy('pengeluarantambahans.id', 'desc')->get();
        $pengeluarantambahan = $pengeluarantambahan->where('Status', 'OPN')->all();
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
        try {
            DB::table('pengeluarantambahans')->insert([
                'Nama' => $request->Nama,
                'Tanggal' => $request->Tanggal,
                'KodeLokasi' => $request->KodeLokasi,
                'KodeMataUang' => $request->KodeMataUang,
                'Keterangan' => $request->Keterangan,
                'Status' => 'OPN',
                'KodeUser' => \Auth::user()->name,
                'Total' => $request->Total,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::table('eventlogs')->insert([
                'KodeUser' => \Auth::user()->name,
                'Tanggal' => \Carbon\Carbon::now(),
                'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
                'Keterangan' => 'Tambah pengeluaran tambahan ' . $request->Nama,
                'Tipe' => 'OPN',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            $pesan = 'Pengeluaran tambahan ' . $request->Name . ' berhasil ditambahkan';
            return redirect('/pengeluarantambahan')->with(['created' => $pesan]);
            //
        } catch (Exception $e) {
            console . log($e->getMessage());
            $pesan = 'Terjadi kesalahan';
            return redirect('/pengeluarantambahan')->with(['error' => $pesan]);
        }
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

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Hapus pengeluaran tambahan ' . $pt->Nama,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect('/pengeluarantambahan');
    }
}
