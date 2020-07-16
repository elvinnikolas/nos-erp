<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\stokmasuk;
use App\Model\lokasi;

class StokMasukController extends Controller
{
    public function index()
    {
        $stokmasuks = DB::select("SELECT s.KodeStokMasuk, s.KodeLokasi, s.Tanggal, s.Status, s.TotalItem, l.NamaLokasi FROM stokmasuks s 
            inner join lokasis l on s.KodeLokasi = l.KodeLokasi");
        return view('stok.stokmasuk.stokmasuk', compact('stokmasuks'));
    }

    public function create()
    {
        $item = DB::select("SELECT s.KodeItem, s.NamaItem, s.Keterangan 
            FROM items s 
            where s.Status='OPN' 
            GROUP BY s.NamaItem 
        ");
        $satuan = DB::table('satuans')->where('Status', 'OPN')->get();
        $lokasi = DB::table('lokasis')->where('Status', 'OPN')->get();

        $last_id = DB::select('SELECT * FROM stokmasuks ORDER BY KodeStokMasuk DESC LIMIT 1');
        $year_now = date('y');
        $month_now = date('m');
        $date_now = date('d');

        if ($last_id == null) {
            $newID = "SLM-" . $year_now . $month_now . "0001";
        } else {
            $string = $last_id[0]->KodeStokMasuk;
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
        return view('stok.stokmasuk.create', compact('newID', 'lokasi', 'item', 'satuan'));
    }

    public function store(Request $request)
    {
        $last_id = DB::select('SELECT * FROM stokmasuks ORDER BY KodeStokMasuk DESC LIMIT 1');

        $year_now = date('y');
        $month_now = date('m');
        $date_now = date('d');

        if ($last_id == null) {
            $newID = "SLM-" . $year_now . $month_now . "0001";
        } else {
            $string = $last_id[0]->KodeStokMasuk;
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
        $items = $request->item;
        $satuans = $request->satuan;
        $keterangans = $request->keterangan;
        $qtys = $request->qty;

        foreach ($qtys as $key => $value) {
            $tot += $value;
        }

        DB::table('stokmasuks')->insert([
            'KodeStokMasuk' => $newID,
            'KodeLokasi' => $request->KodeLokasi,
            'Tanggal' => $request->Tanggal,
            'Status' => 'CFM',
            'Printed' => 0,
            'TotalItem' => $tot,
            'KodeUser' => \Auth::user()->name,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        foreach ($items as $key => $value) {
            DB::table('stokmasukdetails')->insert([
                'KodeStokMasuk' => $newID,
                'KodeItem' => $value,
                'Qty' => $qtys[$key],
                'KodeSatuan' => $satuans[$key],
                'Keterangan' => $keterangans[$key],
                'NoUrut' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }

        foreach ($items as $key => $value) {
            $last_saldo[$key] = DB::table('keluarmasukbarangs')->where('KodeItem', $value)->orderBy('id', 'desc')->limit(1)->pluck('saldo')->toArray();
        }

        $tot = 0;
        foreach ($items as $key => $value) {
            $satuan = $satuans[$key];
            $konversi = DB::table('itemkonversis')->where('KodeItem', $value)->where('KodeSatuan', $satuan)->first()->Konversi;
            if ($konversi > 1) {
                $qtys[$key] *= $konversi;
            };
            $tot += $qtys[$key];
        }

        foreach ($items as $key => $value) {
            if (isset($last_saldo[$key][0])) {
                $saldo = (int) $last_saldo[$key][0] + (int) $qtys[$key];
            } else {
                $saldo = 0 + (int) $qtys[$key];
            }
            DB::table('keluarmasukbarangs')->insert([
                'Tanggal' => $request->Tanggal,
                'KodeLokasi' => $request->KodeLokasi,
                'KodeItem' => $value,
                'JenisTransaksi' => 'SLM',
                'KodeTransaksi' => $newID,
                'Qty' => $qtys[$key],
                'HargaRata' => 0,
                'KodeUser' => \Auth::user()->name,
                'idx' => 0,
                'indexmov' => 0,
                'Saldo' => $saldo,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Tambah stok masuk ' . $newID,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect('/stokmasuk');
    }

    public function view($id)
    {
        $stokmasuks = DB::select("SELECT s.KodeStokMasuk, s.Tanggal, l.NamaLokasi 
            FROM stokmasuks s 
            inner join lokasis l on s.KodeLokasi = l.KodeLokasi
            where s.KodeStokMasuk ='" . $id . "' ");

        $items = DB::select("SELECT DISTINCT a.Qty, b.NamaItem, d.NamaSatuan, b.Keterangan 
            from stokmasukdetails a
            inner join items b on a.KodeItem = b.KodeItem
            inner join itemkonversis c on c.KodeItem=a.KodeItem
            inner join satuans  d on d.KodeSatuan=a.KodeSatuan
            where a.KodeStokMasuk ='" . $id . "' ");

        return view('stok.stokmasuk.view', compact('stokmasuks', 'items'));
    }
}
