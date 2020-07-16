<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\keluarmasukbarang;
use App\Model\lokasi;
use App\Model\satuan;
use PDF;

class KartuStokController extends Controller
{
    public function index()
    {
        $stok = DB::select("select a.Tanggal, a.KodeItem, a.KodeLokasi, a.JenisTransaksi, a.KodeTransaksi, a.Qty, a.HargaRata, a.KodeUser, a.idx, a.indexmov, SUM(b.Qty) as saldo, l.NamaLokasi, i.NamaItem from keluarmasukbarangs a 
            inner join lokasis l on a.KodeLokasi = l.KodeLokasi 
            inner join items i on a.KodeItem = i.KodeItem
            left JOIN keluarmasukbarangs b on a.KodeItem = b.KodeItem and b.created_at <= a.created_at 
            group by a.Tanggal, a.KodeItem, a.KodeLokasi, a.JenisTransaksi, a.KodeTransaksi, a.Qty, a.HargaRata, a.KodeUser, a.idx, a.indexmov, l.NamaLokasi, i.NamaItem
            order by a.created_at desc ");
        $store = lokasi::where('Status', 'OPN')->get();
        $item = DB::select("SELECT s.KodeItem, s.NamaItem, s.Keterangan 
            FROM items s
            GROUP BY s.NamaItem 
        ");
        $satuan = satuan::get();
        $filter = false;
        return view('stok.kartustok.index', compact('stok', 'store', 'item', 'satuan', 'filter'));
    }

    public function show(Request $request)
    {
        $stok = DB::select("select a.Tanggal, a.KodeItem, a.KodeLokasi, a.JenisTransaksi, a.KodeTransaksi, a.Qty, a.HargaRata, a.KodeUser, a.idx, a.indexmov, SUM(b.Qty) as saldo, l.NamaLokasi, i.NamaItem from keluarmasukbarangs a 
            inner join lokasis l on a.KodeLokasi = l.KodeLokasi 
            inner join items i on a.KodeItem = i.KodeItem
            left JOIN keluarmasukbarangs b on a.KodeItem = b.KodeItem and b.created_at <= a.created_at 
            group by a.Tanggal, a.KodeItem, a.KodeLokasi, a.JenisTransaksi, a.KodeTransaksi, a.Qty, a.HargaRata, a.KodeUser, a.idx, a.indexmov, l.NamaLokasi, i.NamaItem
            order by a.created_at desc ");
        $store = lokasi::where('Status', 'OPN')->get();
        $item = DB::select("SELECT s.KodeItem, s.NamaItem, s.Keterangan 
            FROM items s
            GROUP BY s.NamaItem 
        ");
        $satuan = satuan::get();
        $filter = true;
        $start = $request->start;
        $finish = $request->finish;
        $lokasifil = $request->lokasi;
        $itemfil = $request->item;
        $satuanfil = $request->satuan;
        return view('stok.kartustok.index', compact('stok', 'store', 'item', 'satuan', 'filter', 'start', 'finish', 'itemfil', 'satuanfil', 'lokasifil'));
    }

    public function filter(Request $request)
    {
        $stok = DB::select("select a.Tanggal, a.KodeItem, a.KodeLokasi, a.JenisTransaksi, a.KodeTransaksi, a.Qty, a.HargaRata, a.KodeUser, a.idx, a.indexmov, SUM(b.Qty) as saldo, l.NamaLokasi, i.NamaItem from keluarmasukbarangs a 
            inner join lokasis l on a.KodeLokasi = l.KodeLokasi 
            inner join items i on a.KodeItem = i.KodeItem    
            left JOIN keluarmasukbarangs b on a.KodeItem = b.KodeItem and b.created_at <= a.created_at
            left join itemkonversis c on a.KodeItem = c.KodeItem
            where a.Tanggal >='" . $request->start . "' and a.Tanggal <='" . $request->finish . "'
            and a.KodeLokasi='" . $request->lokasi . "' and a.KodeItem='" . $request->item . "'and c.KodeSatuan='" . $request->satuan . "' 
            group by a.Tanggal, a.KodeItem, a.KodeLokasi, a.JenisTransaksi, a.KodeTransaksi, a.Qty, a.HargaRata, a.KodeUser, a.idx, a.indexmov, l.NamaLokasi, i.NamaItem
            order by a.created_at desc");
        $store = lokasi::where('Status', 'OPN')->get();
        $item = DB::select("SELECT s.KodeItem, s.NamaItem, s.Keterangan 
            FROM items s
            GROUP BY s.NamaItem 
        ");
        $satuan = satuan::get();
        $filter = true;
        $start = $request->start;
        $finish = $request->finish;
        $lokasifil = $request->lokasi;
        $itemfil = $request->item;
        $satuanfil = $request->satuan;
        return view('stok.kartustok.index', compact('stok', 'store', 'item', 'satuan', 'filter', 'start', 'finish', 'itemfil', 'satuanfil', 'lokasifil'));
    }

    public function print(Request $request)
    {
        if ($request->start != null) {
            $stok = DB::select("select a.Tanggal, a.KodeItem, a.KodeLokasi, a.JenisTransaksi, a.KodeTransaksi, a.Qty, a.HargaRata, a.KodeUser, a.idx, a.indexmov, SUM(b.Qty) as saldo from keluarmasukbarangs a left JOIN keluarmasukbarangs b on a.KodeItem = b.KodeItem and b.created_at <= a.created_at
            left join itemkonversis c on a.KodeItem = c.KodeItem
            where a.Tanggal >='" . $request->start . "' and a.Tanggal <='" . $request->finish . "'
            and a.KodeLokasi='" . $request->lokasi . "' and a.KodeItem='" . $request->item . "'and c.KodeSatuan='" . $request->satuan . "' 
            group by a.Tanggal, a.KodeItem, a.KodeLokasi, a.JenisTransaksi, a.KodeTransaksi, a.Qty, a.HargaRata, a.KodeUser, a.idx, a.indexmov
            order by a.created_at desc");
        } else {
            $stok = DB::select("select a.Tanggal, a.KodeItem, a.KodeLokasi, a.JenisTransaksi, a.KodeTransaksi, a.Qty, a.HargaRata, a.KodeUser, a.idx, a.indexmov, SUM(b.Qty) as saldo from keluarmasukbarangs a left JOIN keluarmasukbarangs b on a.KodeItem = b.KodeItem and b.created_at <= a.created_at group by a.Tanggal, a.KodeItem, a.KodeLokasi, a.JenisTransaksi,a.KodeTransaksi,a.Qty, a.HargaRata, a.KodeUser, a.idx, a.indexmov order by a.created_at desc ");
        }
        $in = 0;
        $out = 0;
        foreach ($stok as $s) {
            if ($s->Qty > 0) {
                $in += $s->Qty;
            } else {
                $out += $s->Qty * -1;
            }
        }
        $pdf = PDF::loadview('stok.kartustok.pdf', ['stok' => $stok, 'in' => $in, 'out' => $out]);
        return $pdf->download('stok.kartustok.pdf');
    }
}
