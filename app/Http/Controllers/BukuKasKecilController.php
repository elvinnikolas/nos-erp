<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\kasbank;
use PDF;

class BukuKasKecilController extends Controller
{
    public function index()
    {
        $year_now = date('Y');
        $kas = DB::select("SELECT k.*
            from kasbanks k
            WHERE YEAR(k.Tanggal) = '" . $year_now . "'
            AND k.Status = 'CFM'
            AND k.Tipe = 'BO' 
            order by k.Tanggal ");
        $filter = false;
        return view('stok.bukukaskecil.index', compact('kas', 'filter', 'year_now'));
    }

    public function show(Request $request)
    {
        $year_now = date('Y');
        $kas = DB::select("SELECT k.*, pt.Nama
            from kasbanks k
            inner join pengeluarantambahans pt on pt.KodePengeluaran = k.KodeInvoice
            WHERE YEAR(k.Tanggal) = '" . $year_now . "'
            AND k.Status = 'CFM'
            AND k.Tipe = 'BO'
            order by k.Tanggal ");
        $total = DB::table('kasbanks')->where('Tipe', 'BO')->where('Status', 'CFM')->whereYear('Tanggal', $year_now)->select(DB::raw('SUM(Total) as total_biaya'))->first()->total_biaya;
        $filter = true;
        $no = 1;
        return view('stok.bukukaskecil.index', compact('kas', 'filter', 'year_now', 'no', 'total'));
    }

    public function filter(Request $request)
    {
        $year_now = date('Y');
        $kas = DB::select("SELECT k.*, pt.Nama
            from kasbanks k
            inner join pengeluarantambahans pt on pt.KodePengeluaran = k.KodeInvoice
            WHERE MONTH(k.Tanggal) = '" . $request->month . "' AND YEAR(k.Tanggal) = '" . $request->year . "'
            AND k.Status = 'CFM'
            AND k.Tipe = 'BO'
            order by k.Tanggal ");
        $total = DB::table('kasbanks')->where('Tipe', 'BO')->where('Status', 'CFM')->whereMonth('Tanggal', $request->month)->whereYear('Tanggal', $request->year)->select(DB::raw('SUM(Total) as total_biaya'))->first()->total_biaya;
        $filter = true;
        $no = 1;
        return view('stok.bukukaskecil.index', compact('kas', 'filter', 'year_now', 'no', 'total'));
    }
}
