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
        $year_now = date('Y');
        $filter = false;
        $jenis = "kode";
        $stokmasuks = DB::select("SELECT s.KodeStokMasuk, s.KodeLokasi, s.Tanggal, s.Keterangan, s.Status, s.TotalItem, l.NamaLokasi FROM stokmasuks s 
            inner join lokasis l on s.KodeLokasi = l.KodeLokasi
            order by s.Tanggal desc
        ");
        return view('stok.stokmasuk.stokmasuk', compact('stokmasuks', 'year_now', 'filter', 'jenis'));
    }

    public function filter(Request $request)
    {
        $year_now = date('Y');
        $filter = true;
        $jenis = $request->jenis;
        $bahan = $request->bahan;
        if ($bahan == "semua") {
            if ($jenis == "kode") {
                $stokmasuks = DB::select("SELECT s.Tanggal, s.KodeStokMasuk, i.NamaItem, sum(d.Qty) as total, d.KodeSatuan 
                    FROM stokmasukdetails d
                    INNER JOIN stokmasuks s ON s.KodeStokMasuk = d.KodeStokMasuk
                    INNER JOIN items i ON i.KodeItem = d.KodeItem
                    WHERE MONTH(s.Tanggal) = '" . $request->month . "' AND YEAR(s.Tanggal) = '" . $request->year . "'
                    GROUP BY s.KodeStokMasuk, d.KodeItem, d.KodeSatuan  
                    ORDER BY d.KodeItem DESC
                ");
            } else if ($jenis == "item") {
                $stokmasuks = DB::select("SELECT i.NamaItem, sum(d.Qty) as total, d.KodeSatuan 
                    FROM stokmasukdetails d
                    INNER JOIN stokmasuks s ON s.KodeStokMasuk = d.KodeStokMasuk
                    INNER JOIN items i ON i.KodeItem = d.KodeItem
                    WHERE MONTH(s.Tanggal) = '" . $request->month . "' AND YEAR(s.Tanggal) = '" . $request->year . "'
                    GROUP BY d.KodeItem, d.KodeSatuan  
                    ORDER BY i.NamaItem ASC
                ");
            }
        } else {
            if ($jenis == "kode") {
                $stokmasuks = DB::select("SELECT s.Tanggal, s.KodeStokMasuk, i.NamaItem, sum(d.Qty) as total, d.KodeSatuan 
                    FROM stokmasukdetails d
                    INNER JOIN stokmasuks s ON s.KodeStokMasuk = d.KodeStokMasuk
                    INNER JOIN items i ON i.KodeItem = d.KodeItem
                    WHERE MONTH(s.Tanggal) = '" . $request->month . "' 
                    AND YEAR(s.Tanggal) = '" . $request->year . "'
                    AND i.jenisitem = '" . $bahan . "'
                    GROUP BY s.KodeStokMasuk, d.KodeItem, d.KodeSatuan  
                    ORDER BY d.KodeItem DESC
                ");
            } else if ($jenis == "item") {
                $stokmasuks = DB::select("SELECT i.NamaItem, sum(d.Qty) as total, d.KodeSatuan 
                    FROM stokmasukdetails d
                    INNER JOIN stokmasuks s ON s.KodeStokMasuk = d.KodeStokMasuk
                    INNER JOIN items i ON i.KodeItem = d.KodeItem
                    WHERE MONTH(s.Tanggal) = '" . $request->month . "' 
                    AND YEAR(s.Tanggal) = '" . $request->year . "'
                    AND i.jenisitem = '" . $bahan . "'
                    GROUP BY d.KodeItem, d.KodeSatuan  
                    ORDER BY i.NamaItem ASC
                ");
            }
        }
        return view('stok.stokmasuk.stokmasuk', compact('stokmasuks', 'year_now', 'filter', 'jenis'));
    }

    public function filterdate(Request $request)
    {
        $year_now = date('Y');
        $filter = true;
        $jenis = $request->jenis;
        $start = $request->get('mulai');
        $end = $request->get('sampai');
        $mulai = $request->get('mulai');
        $sampai = $request->get('sampai');
        $bahan = $request->bahan;
        if ($bahan == "semua") {
            if ($jenis == "kode") {
                $stokmasuks = DB::select("SELECT s.Tanggal, s.KodeStokMasuk, i.NamaItem, sum(d.Qty) as total, d.KodeSatuan 
                    FROM stokmasukdetails d
                    INNER JOIN stokmasuks s ON s.KodeStokMasuk = d.KodeStokMasuk
                    INNER JOIN items i ON i.KodeItem = d.KodeItem
                    WHERE s.Tanggal BETWEEN '" . $request->start . "' AND '" . $request->end . "'
                    GROUP BY s.KodeStokMasuk, d.KodeItem, d.KodeSatuan  
                    ORDER BY s.Tanggal DESC
                ");
            } else if ($jenis == "item") {
                $stokmasuks = DB::select("SELECT i.NamaItem, sum(d.Qty) as total, d.KodeSatuan 
                    FROM stokmasukdetails d
                    INNER JOIN stokmasuks s ON s.KodeStokMasuk = d.KodeStokMasuk
                    INNER JOIN items i ON i.KodeItem = d.KodeItem
                    WHERE s.Tanggal BETWEEN '" . $request->start . "' AND '" . $request->end . "'
                    GROUP BY d.KodeItem, d.KodeSatuan  
                    ORDER BY i.NamaItem ASC
                ");
            }
        } else {
            if ($jenis == "kode") {
                $stokmasuks = DB::select("SELECT s.Tanggal, s.KodeStokMasuk, i.NamaItem, sum(d.Qty) as total, d.KodeSatuan 
                    FROM stokmasukdetails d
                    INNER JOIN stokmasuks s ON s.KodeStokMasuk = d.KodeStokMasuk
                    INNER JOIN items i ON i.KodeItem = d.KodeItem
                    WHERE s.Tanggal BETWEEN '" . $request->start . "' AND '" . $request->end . "'
                    AND i.jenisitem = '" . $bahan . "'
                    GROUP BY s.KodeStokMasuk, d.KodeItem, d.KodeSatuan  
                    ORDER BY s.Tanggal DESC
                ");
            } else if ($jenis == "item") {
                $stokmasuks = DB::select("SELECT i.NamaItem, sum(d.Qty) as total, d.KodeSatuan 
                    FROM stokmasukdetails d
                    INNER JOIN stokmasuks s ON s.KodeStokMasuk = d.KodeStokMasuk
                    INNER JOIN items i ON i.KodeItem = d.KodeItem
                    WHERE s.Tanggal BETWEEN '" . $request->start . "' AND '" . $request->end . "'
                    AND i.jenisitem = '" . $bahan . "'
                    GROUP BY d.KodeItem, d.KodeSatuan  
                    ORDER BY i.NamaItem ASC
                ");
            }
        }
        return view('stok.stokmasuk.stokmasuk', compact('stokmasuks', 'year_now', 'mulai', 'sampai', 'filter', 'jenis'));
    }

    public function create()
    {
        $item = DB::select("SELECT s.KodeItem, s.NamaItem, s.Keterangan 
            FROM items s 
            where s.Status='OPN'
            ORDER BY s.NamaItem
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
        $items = $request->item;
        $satuans = $request->satuan;
        $satuanvalid = true;
        $pesantambahan = '';
        foreach ($items as $key => $value) {
            $satuan = $satuans[$key];
            $checkkonversi = DB::table('itemkonversis')->where('KodeItem', $value)->where('KodeSatuan', $satuan)->first();
            if (empty($checkkonversi)) {
                $satuanvalid = false;
                $namasatuan = DB::table('items')->where('KodeItem', $value)->first();
                $pesantambahan .= $namasatuan->NamaItem . ', ';
            }
        }

        if ($satuanvalid == true) {
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
                'Keterangan' => $request->Keterangan,
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

            foreach ($items as $key => $value) {
                $satuan = $satuans[$key];
                $konversi = DB::table('itemkonversis')->where('KodeItem', $value)->where('KodeSatuan', $satuan)->first()->Konversi;
                if ($konversi > 1) {
                    $qtys[$key] *= $konversi;
                };
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

            $pesan = 'Stok Masuk  ' . $newID . ' berhasil ditambahkan';
            return redirect('/stokmasuk')->with(['created' => $pesan]);
        } else {
            $pesan = 'Stok Masuk tidak disimpan karena terdapat satuan yang tidak sesuai, mohon periksa kembali (input satuan ' . $pesantambahan;
            $pesan = substr(trim($pesan), 0, -1);
            $pesan .= ' harus sesuai dengan master item)';
            return redirect('/stokmasuk')->with(['error' => $pesan]);
        }
    }

    public function view($id)
    {
        $stokmasuks = DB::select("SELECT s.KodeStokMasuk, s.Tanggal, s.Keterangan, l.NamaLokasi 
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
