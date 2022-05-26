<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\penggajian;
use App\Model\golongan;

use DB;

class PenggajianKaryawanController extends Controller
{
    public function index()
    {
        $karyawan = DB::table('karyawans')
            ->where('Status', 'OPN')
            ->select('KodeKaryawan', 'Nama')
            ->orderBy('Nama', 'asc')
            ->get();

        $golongan = golongan::getGolongan();
        $dataGolongan = penggajian::getDataGolongan();
        /*$golonganBorongan = penggajian::getDataGolongan('borongan');
        $golonganNonBorongan = penggajian::getDataGolongan('non-borongan');*/

        return view('penggajian.index', compact('karyawan', 'golongan', 'dataGolongan'));
    }

    public function absen(Request $request)
    {
        $result = penggajian::setAbsen($request->all());
        return response()->json(['status' => $result]);
    }

    public function gaji(Request $request)
    {
        $result = penggajian::setGaji($request->all());
        return response()->json(['status' => $result]);
    }

    public function laporan()
    {
    }
}
