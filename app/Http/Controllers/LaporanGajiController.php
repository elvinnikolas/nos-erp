<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LaporanGajiController extends Controller
{
    public function index()
    {
        $filter = false;
        return view('laporan.gaji.index', compact('filter'));
    }

    public function show(Request $request)
    {
        $filter = true;
        $gajian = DB::select(
            "SELECT COALESCE(SUM(gaji.TotalGaji),0) as Total, gol.NamaGolongan as Golongan
            FROM new_golongan gol
            LEFT JOIN new_gajian gaji
            ON gaji.NoGolongan = gol.NoGolongan AND gaji.TanggalGaji = '" . $request->Tanggal . "'
            WHERE gol.Status = 'OPN'
            GROUP BY gol.NoGolongan"
        );

        $cashbon = DB::table('new_gajiancashbon')
            ->where('Tanggal', $request->Tanggal)
            ->where('Status', 'OPN')
            ->first();

        $total_gaji = 0;
        foreach ($gajian as $gaji) {
            $total_gaji += $gaji->Total;
        }

        return view('laporan.gaji.index', compact('filter', 'gajian', 'cashbon', 'total_gaji'));
    }
}
