<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\keluarmasukbarang;
use App\Model\lokasi;
use App\Model\satuan;
use PDF;

class SisaStokController extends Controller
{
    public function index()
    {
        $items = DB::select("SELECT i.KodeItem, i.NamaItem, k.Konversi, k.Konversi as sisa, s.NamaSatuan, s.KodeSatuan 
            FROM items i
            left join itemkonversis k on k.KodeItem = i.KodeItem
            left join satuans s on s.KodeSatuan = k.KodeSatuan
            WHERE k.Konversi = 1 and s.Status = 'OPN'
            order by i.NamaItem
        ");
        $satuan = satuan::where('Status', 'OPN')->get();
        $filter = false;
        foreach ($items as $key => $value) {
            $last_saldo[$key] = DB::table('keluarmasukbarangs')->where('KodeItem', $value->KodeItem)->orderBy('id', 'desc')->limit(1)->pluck('saldo')->toArray();

            if (isset($last_saldo[$key][0])) {
                $saldo = (float) $last_saldo[$key][0] / (float) $value->Konversi;
                $value->sisa = $saldo;
            } else {
                $value->sisa = 0;
            }
        }
        return view('stok.sisastok.index', compact('items', 'satuan', 'filter'));
    }

    public function show(Request $request)
    {
        $items = DB::select("SELECT i.KodeItem, i.NamaItem, k.Konversi, k.Konversi as sisa, s.NamaSatuan, s.KodeSatuan 
            FROM items i
            left join itemkonversis k on k.KodeItem = i.KodeItem
            left join satuans s on s.KodeSatuan = k.KodeSatuan
            WHERE k.Konversi = 1 and s.Status = 'OPN'
            order by i.NamaItem
        ");
        $satuan = satuan::where('Status', 'OPN')->get();
        $filter = true;
        foreach ($items as $key => $value) {
            $last_saldo[$key] = DB::table('keluarmasukbarangs')->where('KodeItem', $value->KodeItem)->orderBy('id', 'desc')->limit(1)->pluck('saldo')->toArray();

            if (isset($last_saldo[$key][0])) {
                $saldo = (float) $last_saldo[$key][0] / (float) $value->Konversi;
                $value->sisa = $saldo;
            } else {
                $value->sisa = 0;
            }
        }
        $jenisfil = $request->jenis;
        $satuanfil = $request->satuan;
        return view('stok.sisastok.index', compact('items', 'satuan', 'filter', 'jenisfil', 'satuanfil'));
    }

    public function filter(Request $request)
    {
        $items = DB::select("SELECT i.KodeItem, i.NamaItem, k.Konversi, k.Konversi as sisa, s.NamaSatuan, s.KodeSatuan 
            FROM items i
            left join itemkonversis k on k.KodeItem = i.KodeItem
            left join satuans s on s.KodeSatuan = k.KodeSatuan
            WHERE s.KodeSatuan = '" . $request->satuanfil . "' and i.jenisitem = '" . $request->jenisfil . "' and s.Status = 'OPN'
            order by i.NamaItem
        ");
        $satuan = satuan::where('Status', 'OPN')->get();
        $filter = true;
        foreach ($items as $key => $value) {
            $last_saldo[$key] = DB::table('keluarmasukbarangs')->where('KodeItem', $value->KodeItem)->orderBy('id', 'desc')->limit(1)->pluck('saldo')->toArray();

            if (isset($last_saldo[$key][0])) {
                $saldo = (float) $last_saldo[$key][0] / (float) $value->Konversi;
                $value->sisa = $saldo;
            } else {
                $value->sisa = 0;
            }
        }
        $jenisfil = $request->jenis;
        $satuanfil = $request->satuan;
        return view('stok.sisastok.index', compact('items', 'satuan', 'filter', 'jenisfil', 'satuanfil'));
    }
}
