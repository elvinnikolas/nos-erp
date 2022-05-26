<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LaporanProduksiController extends Controller
{
    public function index()
    {
        $year_now = date('Y');
        $filter = false;
        $filtergolongan = false;
        $filteritem = false;

        $golongans = DB::table('new_golongan')->where('Status', 'OPN')->get();
        $items = DB::table('items')->where('Status', 'OPN')->where('jenisitem', 'bahanjadi')->get();

        return view('laporan.produksi.index', compact('year_now', 'filter', 'filtergolongan', 'filteritem', 'golongans', 'items'));
    }

    public function show(Request $request)
    {
        $year_now = date('Y');
        $filter = true;
        $filtergolongan = false;
        $filteritem = false;

        $start = $request->start;
        $finish = $request->finish;
        $jenis = $request->jenis;

        $golongans = DB::table('new_golongan')->where('Status', 'OPN')->get();
        $items = DB::table('items')->where('Status', 'OPN')->where('jenisitem', 'bahanjadi')->get();

        if ($jenis == "golongan") {
            $filtergolongan = true;
            $produksi = DB::select("SELECT k.Nama, SUM(ppd.Qty) as produksi, SUM(ppd.QtyCek) as cek, ngi.NamaGroupItem as golongan
                FROM prod_produksiheader pph
                INNER JOIN prod_produksidetail ppd ON pph.KodeProduksi = ppd.KodeProduksi
                INNER JOIN karyawans k ON k.KodeKaryawan = ppd.KodeKaryawan
                INNER JOIN new_golongangroupitem ngi ON ngi.NoGroupItem = pph.KodeGolongan
                WHERE pph.TanggalInput BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
                GROUP BY k.KodeKaryawan, pph.KodeGolongan
            ");
        } else if ($jenis == "item") {
            $filteritem = true;
            $produksi = DB::select("SELECT k.Nama, SUM(ppd.Qty) as produksi, SUM(ppd.QtyCek) as cek, i.NamaItem as item, prh.KodeSatuan as satuan
                FROM prod_produksiheader pph
                INNER JOIN prod_produksidetail ppd ON pph.KodeProduksi = ppd.KodeProduksi
                INNER JOIN karyawans k ON k.KodeKaryawan = ppd.KodeKaryawan
                INNER JOIN prod_resepheader prh ON prh.KodeResep = pph.KodeResep
                INNER JOIN items i ON i.KodeItem = prh.KodeItem
                WHERE pph.TanggalInput BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
                GROUP BY k.KodeKaryawan, prh.KodeResep
            ");
        }

        return view('laporan.produksi.index', compact('year_now', 'produksi', 'filter', 'filtergolongan', 'filteritem', 'start', 'finish', 'jenis', 'golongans', 'items'));
    }

    public function filtergolongan(Request $request)
    {
        $year_now = date('Y');
        $filter = true;
        $filtergolongan = true;
        $filteritem = false;

        $start = $request->start;
        $finish = $request->finish;

        $golongans = DB::table('new_golongan')->where('Status', 'OPN')->get();
        $items = DB::table('items')->where('Status', 'OPN')->where('jenisitem', 'bahanjadi')->get();

        $produksi = DB::select("SELECT k.Nama, SUM(ppd.Qty) as produksi, SUM(ppd.QtyCek) as cek, ngi.NamaGroupItem as golongan
            FROM prod_produksiheader pph
            INNER JOIN prod_produksidetail ppd ON pph.KodeProduksi = ppd.KodeProduksi
            INNER JOIN karyawans k ON k.KodeKaryawan = ppd.KodeKaryawan
            INNER JOIN new_golongangroupitem ngi ON ngi.NoGroupItem = pph.KodeGolongan
            INNER JOIN new_golongan ng ON ng.NoGolongan = ngi.NoGolongan
            WHERE pph.TanggalInput BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
            AND ng.KodeGolongan = '" . $request->golongan . "'
            GROUP BY k.KodeKaryawan, pph.KodeGolongan
        ");

        return view('laporan.produksi.index', compact('year_now', 'produksi', 'filter', 'filtergolongan', 'filteritem', 'start', 'finish', 'golongans', 'items'));
    }

    public function filteritem(Request $request)
    {
        $year_now = date('Y');
        $filter = true;
        $filtergolongan = false;
        $filteritem = true;

        $start = $request->start;
        $finish = $request->finish;

        $golongans = DB::table('new_golongan')->where('Status', 'OPN')->get();
        $items = DB::table('items')->where('Status', 'OPN')->where('jenisitem', 'bahanjadi')->get();

        $produksi = DB::select("SELECT k.Nama, SUM(ppd.Qty) as produksi, SUM(ppd.QtyCek) as cek, i.NamaItem as item, prh.KodeSatuan as satuan
            FROM prod_produksiheader pph
            INNER JOIN prod_produksidetail ppd ON pph.KodeProduksi = ppd.KodeProduksi
            INNER JOIN karyawans k ON k.KodeKaryawan = ppd.KodeKaryawan
            INNER JOIN prod_resepheader prh ON prh.KodeResep = pph.KodeResep
            INNER JOIN items i ON i.KodeItem = prh.KodeItem
            WHERE pph.TanggalInput BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
            AND prh.KodeItem = '" . $request->item . "'
            GROUP BY k.KodeKaryawan, prh.KodeResep
        ");

        return view('laporan.produksi.index', compact('year_now', 'produksi', 'filter', 'filtergolongan', 'filteritem', 'start', 'finish', 'golongans', 'items'));
    }
}
