<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\kasbank;
use PDF;

class BukuKasBesarController extends Controller
{
    public function index()
    {
        $year_now = date('Y');
        $kas = DB::select("SELECT k.*
            from kasbanks k
            WHERE YEAR(k.Tanggal) = '" . $year_now . "'
            order by k.Tanggal ");
        $filter = false;
        return view('stok.bukukasbesar.index', compact('kas', 'filter', 'year_now'));
    }

    public function show(Request $request)
    {
        $year_now = date('Y');
        $kas = DB::select("SELECT k.*
            from kasbanks k
            WHERE YEAR(k.Tanggal) = '" . $year_now . "'
            order by k.Tanggal ");
        // $kas = DB::select("SELECT k.*, ip.Tanggal as tanggal_piutang, ih.Tanggal as tanggal_hutang
        //     from kasbanks k
        //     left join invoicepiutangs ip on ip.KodeInvoicePiutangShow = k.KodeInvoice
        //     left join invoicehutangs ih on ih.KodeInvoiceHutangShow = k.KodeInvoice
        //     WHERE YEAR(k.Tanggal) = '" . $year_now . "'
        //     order by k.Tanggal ");
        $hutang = DB::table('kasbanks')->where('Tipe', 'AP')->whereYear('Tanggal', $year_now)->select(DB::raw('SUM(Total) as total_hutang'))->first()->total_hutang;
        $piutang = DB::table('kasbanks')->where('Tipe', 'AR')->whereYear('Tanggal', $year_now)->select(DB::raw('SUM(Total) as total_piutang'))->first()->total_piutang;
        $filter = true;
        $no = 1;
        return view('stok.bukukasbesar.index', compact('kas', 'filter', 'year_now', 'no', 'hutang', 'piutang'));
    }

    public function filter(Request $request)
    {
        $year_now = date('Y');
        $kas = DB::select("SELECT k.*
            from kasbanks k
            WHERE MONTH(k.Tanggal) = '" . $request->month . "' AND YEAR(k.Tanggal) = '" . $request->year . "'
            order by k.Tanggal ");
        $hutang = DB::table('kasbanks')->where('Tipe', 'AP')->whereMonth('Tanggal', $request->month)->whereYear('Tanggal', $request->year)->select(DB::raw('SUM(Total) as total_hutang'))->first()->total_hutang;
        $piutang = DB::table('kasbanks')->where('Tipe', 'AR')->whereMonth('Tanggal', $request->month)->whereYear('Tanggal', $request->year)->select(DB::raw('SUM(Total) as total_piutang'))->first()->total_piutang;
        $filter = true;
        $no = 1;
        return view('stok.bukukasbesar.index', compact('kas', 'filter', 'year_now', 'no', 'hutang', 'piutang'));
    }
}
