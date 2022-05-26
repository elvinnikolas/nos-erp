<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DataStokController extends Controller
{
    public function index()
    {
        $year_now = date('Y');
        $filter = false;
        $filterdate = false;
        return view('stok.datastok.index', compact('year_now', 'filter', 'filterdate'));
    }

    public function show(Request $request)
    {
        $year_now = date('Y');
        $filter = true;
        $filterdate = false;
        $satuanfil = $request->satuan;
        if ($satuanfil == "dus") {
            $stok = DB::select("SELECT i.NamaItem, s.NamaSatuan, s.KodeSatuan,
                SUM(CASE WHEN a.JenisTransaksi = 'RJB' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'RJB',
                SUM(CASE WHEN a.JenisTransaksi = 'SJB' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SJB',
                SUM(CASE WHEN a.JenisTransaksi = 'SLM' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SLM',
                SUM(CASE WHEN a.JenisTransaksi = 'SLK' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SLK'
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Dus'
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and YEAR(a.Tanggal) = '" . $year_now . "'
                group by a.KodeItem
                order by i.NamaItem
            ");

            $saldo_awal = DB::select("SELECT * from
                (SELECT i.NamaItem, i.KodeItem, s.NamaSatuan, s.KodeSatuan, round(((a.saldo-a.Qty)/c.Konversi),4) as saldo
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Dus'
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and YEAR(a.Tanggal) = '" . $year_now . "'
                order by i.NamaItem, a.Tanggal, a.id) sort
                group by sort.KodeItem
                order by sort.NamaItem
            ");

            $saldo_akhir = DB::select("SELECT i.NamaItem, i.KodeItem, s.NamaSatuan, s.KodeSatuan, round((a.saldo/c.Konversi),4) as saldo
                FROM keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Dus'
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE a.id in 
                    (SELECT max(a.id)
                    from keluarmasukbarangs a
                    inner join items i on a.KodeItem = i.KodeItem
                    inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Dus'
                    inner join satuans s on s.KodeSatuan = c.KodeSatuan
                    WHERE i.jenisitem = 'bahanjadi'
                    and YEAR(a.Tanggal) = '" . $year_now . "'
                    group by i.KodeItem)
                and i.jenisitem = 'bahanjadi'
                and YEAR(a.Tanggal) = '" . $year_now . "'
                GROUP BY i.KodeItem
                ORDER BY i.NamaItem
            ");
        } else if ($satuanfil == "zak") {
            $stok = DB::select("SELECT i.NamaItem, s.NamaSatuan, s.KodeSatuan,
                SUM(CASE WHEN a.JenisTransaksi = 'RJB' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'RJB',
                SUM(CASE WHEN a.JenisTransaksi = 'SJB' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SJB',
                SUM(CASE WHEN a.JenisTransaksi = 'SLM' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SLM',
                SUM(CASE WHEN a.JenisTransaksi = 'SLK' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SLK'
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Zak'
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and YEAR(a.Tanggal) = '" . $year_now . "'
                group by a.KodeItem
                order by i.NamaItem
            ");

            $saldo_awal = DB::select("SELECT * from
                (SELECT i.NamaItem, i.KodeItem, s.NamaSatuan, s.KodeSatuan, round(((a.saldo-a.Qty)/c.Konversi),4) as saldo
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Zak'
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and YEAR(a.Tanggal) = '" . $year_now . "'
                order by i.NamaItem, a.Tanggal, a.id) sort
                group by sort.KodeItem
                order by sort.NamaItem
            ");

            $saldo_akhir = DB::select("SELECT i.NamaItem, i.KodeItem, s.NamaSatuan, s.KodeSatuan, round((a.saldo/c.Konversi),4) as saldo
                FROM keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Zak'
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE a.id in 
                    (SELECT max(a.id)
                    from keluarmasukbarangs a
                    inner join items i on a.KodeItem = i.KodeItem
                    inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Zak'
                    inner join satuans s on s.KodeSatuan = c.KodeSatuan
                    WHERE i.jenisitem = 'bahanjadi'
                    and YEAR(a.Tanggal) = '" . $year_now . "'
                    group by i.KodeItem)
                and i.jenisitem = 'bahanjadi'
                and YEAR(a.Tanggal) = '" . $year_now . "'
                GROUP BY i.KodeItem
                ORDER BY i.NamaItem
            ");
        } else if ($satuanfil == "semua") {
            $stok = DB::select("SELECT i.NamaItem, s.NamaSatuan, s.KodeSatuan,
                SUM(CASE WHEN a.JenisTransaksi = 'RJB' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'RJB',
                SUM(CASE WHEN a.JenisTransaksi = 'SJB' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SJB',
                SUM(CASE WHEN a.JenisTransaksi = 'SLM' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SLM',
                SUM(CASE WHEN a.JenisTransaksi = 'SLK' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SLK'
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.Konversi = 1
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and YEAR(a.Tanggal) = '" . $year_now . "'
                group by a.KodeItem
                order by i.NamaItem
            ");

            $saldo_awal = DB::select("SELECT * from
                (SELECT i.NamaItem, i.KodeItem, s.NamaSatuan, s.KodeSatuan, round(((a.saldo-a.Qty)/c.Konversi),4) as saldo
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.Konversi = 1
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and YEAR(a.Tanggal) = '" . $year_now . "'
                order by i.NamaItem, a.Tanggal, a.id) sort
                group by sort.KodeItem
                order by sort.NamaItem
            ");

            $saldo_akhir = DB::select("SELECT i.NamaItem, i.KodeItem, s.NamaSatuan, s.KodeSatuan, round((a.saldo/c.Konversi),4) as saldo
                FROM keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.Konversi = 1
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE a.id in 
                    (SELECT max(a.id)
                    from keluarmasukbarangs a
                    inner join items i on a.KodeItem = i.KodeItem
                    inner join itemkonversis c on a.KodeItem = c.KodeItem and c.Konversi = 1
                    inner join satuans s on s.KodeSatuan = c.KodeSatuan
                    WHERE i.jenisitem = 'bahanjadi'
                    and YEAR(a.Tanggal) = '" . $year_now . "'
                    group by i.KodeItem)
                and i.jenisitem = 'bahanjadi'
                and YEAR(a.Tanggal) = '" . $year_now . "'
                GROUP BY i.KodeItem
                ORDER BY i.NamaItem
            ");
        }

        foreach ($stok as $key => $value) {
            $stok[$key]->SaldoAwal = $saldo_awal[$key]->saldo;
            $stok[$key]->SaldoAkhir = $saldo_akhir[$key]->saldo;
        }

        return view('stok.datastok.index', compact('year_now', 'stok', 'saldo_awal', 'filter', 'filterdate', 'satuanfil'));
    }

    public function filter(Request $request)
    {
        $year_now = date('Y');
        $filter = true;
        $filterdate = false;
        $satuanfil = $request->satuan;
        if ($satuanfil == "dus") {
            $stok = DB::select("SELECT i.NamaItem, s.NamaSatuan, s.KodeSatuan,
                SUM(CASE WHEN a.JenisTransaksi = 'RJB' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'RJB',
                SUM(CASE WHEN a.JenisTransaksi = 'SJB' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SJB',
                SUM(CASE WHEN a.JenisTransaksi = 'SLM' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SLM',
                SUM(CASE WHEN a.JenisTransaksi = 'SLK' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SLK'
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Dus'
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and MONTH(a.Tanggal) = '" . $request->month . "' and YEAR(a.Tanggal) = '" . $request->year . "'
                group by a.KodeItem
                order by i.NamaItem
            ");

            $saldo_awal = DB::select("SELECT * from
                (SELECT i.NamaItem, i.KodeItem, s.NamaSatuan, s.KodeSatuan, round(((a.saldo-a.Qty)/c.Konversi),4) as saldo
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Dus'
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and MONTH(a.Tanggal) = '" . $request->month . "' and YEAR(a.Tanggal) = '" . $request->year . "'
                order by i.NamaItem, a.Tanggal, a.id) sort
                group by sort.KodeItem
                order by sort.NamaItem
            ");

            $saldo_akhir = DB::select("SELECT i.NamaItem, i.KodeItem, s.NamaSatuan, s.KodeSatuan, round((a.saldo/c.Konversi),4) as saldo
                FROM keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Dus'
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE a.id in 
                    (SELECT max(a.id)
                    from keluarmasukbarangs a
                    inner join items i on a.KodeItem = i.KodeItem
                    inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Dus'
                    inner join satuans s on s.KodeSatuan = c.KodeSatuan
                    WHERE i.jenisitem = 'bahanjadi'
                    and MONTH(a.Tanggal) = '" . $request->month . "' and YEAR(a.Tanggal) = '" . $request->year . "'
                    group by i.KodeItem)
                and i.jenisitem = 'bahanjadi'
                and MONTH(a.Tanggal) = '" . $request->month . "' and YEAR(a.Tanggal) = '" . $request->year . "'
                GROUP BY i.KodeItem
                ORDER BY i.NamaItem
            ");
        } else if ($satuanfil == "zak") {
            $stok = DB::select("SELECT i.NamaItem, s.NamaSatuan, s.KodeSatuan,
                SUM(CASE WHEN a.JenisTransaksi = 'RJB' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'RJB',
                SUM(CASE WHEN a.JenisTransaksi = 'SJB' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SJB',
                SUM(CASE WHEN a.JenisTransaksi = 'SLM' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SLM',
                SUM(CASE WHEN a.JenisTransaksi = 'SLK' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SLK'
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Zak'
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and MONTH(a.Tanggal) = '" . $request->month . "' and YEAR(a.Tanggal) = '" . $request->year . "'
                group by a.KodeItem
                order by i.NamaItem
            ");

            $saldo_awal = DB::select("SELECT * from
                (SELECT i.NamaItem, i.KodeItem, s.NamaSatuan, s.KodeSatuan, round(((a.saldo-a.Qty)/c.Konversi),4) as saldo
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Zak'
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and MONTH(a.Tanggal) = '" . $request->month . "' and YEAR(a.Tanggal) = '" . $request->year . "'
                order by i.NamaItem, a.Tanggal, a.id) sort
                group by sort.KodeItem
                order by sort.NamaItem
            ");

            $saldo_akhir = DB::select("SELECT i.NamaItem, i.KodeItem, s.NamaSatuan, s.KodeSatuan, round((a.saldo/c.Konversi),4) as saldo
                FROM keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Zak'
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE a.id in 
                    (SELECT max(a.id)
                    from keluarmasukbarangs a
                    inner join items i on a.KodeItem = i.KodeItem
                    inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Zak'
                    inner join satuans s on s.KodeSatuan = c.KodeSatuan
                    WHERE i.jenisitem = 'bahanjadi'
                    and MONTH(a.Tanggal) = '" . $request->month . "' and YEAR(a.Tanggal) = '" . $request->year . "'
                    group by i.KodeItem)
                and i.jenisitem = 'bahanjadi'
                and MONTH(a.Tanggal) = '" . $request->month . "' and YEAR(a.Tanggal) = '" . $request->year . "'
                GROUP BY i.KodeItem
                ORDER BY i.NamaItem
            ");
        } else if ($satuanfil == "semua") {
            $stok = DB::select("SELECT i.NamaItem, s.NamaSatuan, s.KodeSatuan,
                SUM(CASE WHEN a.JenisTransaksi = 'RJB' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'RJB',
                SUM(CASE WHEN a.JenisTransaksi = 'SJB' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SJB',
                SUM(CASE WHEN a.JenisTransaksi = 'SLM' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SLM',
                SUM(CASE WHEN a.JenisTransaksi = 'SLK' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SLK'
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.Konversi = 1
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and MONTH(a.Tanggal) = '" . $request->month . "' and YEAR(a.Tanggal) = '" . $request->year . "'
                group by a.KodeItem
                order by i.NamaItem
            ");

            $saldo_awal = DB::select("SELECT * from
                (SELECT i.NamaItem, i.KodeItem, s.NamaSatuan, s.KodeSatuan, round(((a.saldo-a.Qty)/c.Konversi),4) as saldo
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.Konversi = 1
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and MONTH(a.Tanggal) = '" . $request->month . "' and YEAR(a.Tanggal) = '" . $request->year . "'
                order by i.NamaItem, a.Tanggal, a.id) sort
                group by sort.KodeItem
                order by sort.NamaItem
            ");

            $saldo_akhir = DB::select("SELECT i.NamaItem, i.KodeItem, s.NamaSatuan, s.KodeSatuan, round((a.saldo/c.Konversi),4) as saldo
                FROM keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.Konversi = 1
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE a.id in 
                    (SELECT max(a.id)
                    from keluarmasukbarangs a
                    inner join items i on a.KodeItem = i.KodeItem
                    inner join itemkonversis c on a.KodeItem = c.KodeItem and c.Konversi = 1
                    inner join satuans s on s.KodeSatuan = c.KodeSatuan
                    WHERE i.jenisitem = 'bahanjadi'
                    and MONTH(a.Tanggal) = '" . $request->month . "' and YEAR(a.Tanggal) = '" . $request->year . "'
                    group by i.KodeItem)
                and i.jenisitem = 'bahanjadi'
                and MONTH(a.Tanggal) = '" . $request->month . "' and YEAR(a.Tanggal) = '" . $request->year . "'
                GROUP BY i.KodeItem
                ORDER BY i.NamaItem
            ");
        }

        foreach ($stok as $key => $value) {
            $stok[$key]->SaldoAwal = $saldo_awal[$key]->saldo;
            $stok[$key]->SaldoAkhir = $saldo_akhir[$key]->saldo;
        }

        return view('stok.datastok.index', compact('year_now', 'stok', 'saldo_awal', 'filter', 'filterdate', 'satuanfil'));
    }

    public function filterdate(Request $request)
    {
        $year_now = date('Y');
        $filter = true;
        $filterdate = true;
        $satuanfil = $request->satuan;
        if ($satuanfil == "dus") {
            $stok = DB::select("SELECT i.NamaItem, s.NamaSatuan, s.KodeSatuan,
                SUM(CASE WHEN a.JenisTransaksi = 'RJB' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'RJB',
                SUM(CASE WHEN a.JenisTransaksi = 'SJB' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SJB',
                SUM(CASE WHEN a.JenisTransaksi = 'SLM' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SLM',
                SUM(CASE WHEN a.JenisTransaksi = 'SLK' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SLK'
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Dus'
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and a.Tanggal BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
                group by a.KodeItem
                order by i.NamaItem
            ");

            $saldo_awal = DB::select("SELECT * from
                (SELECT i.NamaItem, i.KodeItem, s.NamaSatuan, s.KodeSatuan, round(((a.saldo-a.Qty)/c.Konversi),4) as saldo
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Dus'
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and a.Tanggal BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
                order by i.NamaItem, a.Tanggal, a.id) sort
                group by sort.KodeItem
                order by sort.NamaItem
            ");

            $saldo_akhir = DB::select("SELECT i.NamaItem, i.KodeItem, s.NamaSatuan, s.KodeSatuan, round((a.saldo/c.Konversi),4) as saldo
                FROM keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Dus'
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE a.id in 
                    (SELECT max(a.id)
                    from keluarmasukbarangs a
                    inner join items i on a.KodeItem = i.KodeItem
                    inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Dus'
                    inner join satuans s on s.KodeSatuan = c.KodeSatuan
                    WHERE i.jenisitem = 'bahanjadi'
                    and a.Tanggal BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
                    group by i.KodeItem)
                and i.jenisitem = 'bahanjadi'
                and a.Tanggal BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
                GROUP BY i.KodeItem
                ORDER BY i.NamaItem
            ");
        } else if ($satuanfil == "zak") {
            $stok = DB::select("SELECT i.NamaItem, s.NamaSatuan, s.KodeSatuan,
                SUM(CASE WHEN a.JenisTransaksi = 'RJB' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'RJB',
                SUM(CASE WHEN a.JenisTransaksi = 'SJB' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SJB',
                SUM(CASE WHEN a.JenisTransaksi = 'SLM' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SLM',
                SUM(CASE WHEN a.JenisTransaksi = 'SLK' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SLK'
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Zak'
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and a.Tanggal BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
                group by a.KodeItem
                order by i.NamaItem
            ");

            $saldo_awal = DB::select("SELECT * from
                (SELECT i.NamaItem, i.KodeItem, s.NamaSatuan, s.KodeSatuan, round(((a.saldo-a.Qty)/c.Konversi),4) as saldo
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Zak'
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and a.Tanggal BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
                order by i.NamaItem, a.Tanggal, a.id) sort
                group by sort.KodeItem
                order by sort.NamaItem
            ");

            $saldo_akhir = DB::select("SELECT i.NamaItem, i.KodeItem, s.NamaSatuan, s.KodeSatuan, round((a.saldo/c.Konversi),4) as saldo
                FROM keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Zak'
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE a.id in 
                    (SELECT max(a.id)
                    from keluarmasukbarangs a
                    inner join items i on a.KodeItem = i.KodeItem
                    inner join itemkonversis c on a.KodeItem = c.KodeItem and c.KodeSatuan = 'Zak'
                    inner join satuans s on s.KodeSatuan = c.KodeSatuan
                    WHERE i.jenisitem = 'bahanjadi'
                    and a.Tanggal BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
                    group by i.KodeItem)
                and i.jenisitem = 'bahanjadi'
                and a.Tanggal BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
                GROUP BY i.KodeItem
                ORDER BY i.NamaItem
            ");
        } else if ($satuanfil == "semua") {
            $stok = DB::select("SELECT i.NamaItem, s.NamaSatuan, s.KodeSatuan,
                SUM(CASE WHEN a.JenisTransaksi = 'RJB' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'RJB',
                SUM(CASE WHEN a.JenisTransaksi = 'SJB' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SJB',
                SUM(CASE WHEN a.JenisTransaksi = 'SLM' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SLM',
                SUM(CASE WHEN a.JenisTransaksi = 'SLK' THEN round((a.Qty/c.Konversi),4) ELSE 0 END) AS 'SLK'
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.Konversi = 1
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and a.Tanggal BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
                group by a.KodeItem
                order by i.NamaItem
            ");

            $saldo_awal = DB::select("SELECT * from
                (SELECT i.NamaItem, i.KodeItem, s.NamaSatuan, s.KodeSatuan, round(((a.saldo-a.Qty)/c.Konversi),4) as saldo
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.Konversi = 1
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and a.Tanggal BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
                order by i.NamaItem, a.Tanggal, a.id) sort
                group by sort.KodeItem
                order by sort.NamaItem
            ");

            $saldo_akhir = DB::select("SELECT i.NamaItem, i.KodeItem, s.NamaSatuan, s.KodeSatuan, round((a.saldo/c.Konversi),4) as saldo
            FROM keluarmasukbarangs a
            inner join items i on a.KodeItem = i.KodeItem
            inner join itemkonversis c on a.KodeItem = c.KodeItem and c.Konversi = 1
            inner join satuans s on s.KodeSatuan = c.KodeSatuan
            WHERE a.id in 
                (SELECT max(a.id)
                from keluarmasukbarangs a
                inner join items i on a.KodeItem = i.KodeItem
                inner join itemkonversis c on a.KodeItem = c.KodeItem and c.Konversi = 1
                inner join satuans s on s.KodeSatuan = c.KodeSatuan
                WHERE i.jenisitem = 'bahanjadi'
                and a.Tanggal BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
                group by i.KodeItem)
            and i.jenisitem = 'bahanjadi'
            and a.Tanggal BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
            GROUP BY i.KodeItem
            ORDER BY i.NamaItem
        ");
        }

        $start = $request->start;
        $finish = $request->finish;

        foreach ($stok as $key => $value) {
            $stok[$key]->SaldoAwal = $saldo_awal[$key]->saldo;
            $stok[$key]->SaldoAkhir = $saldo_akhir[$key]->saldo;
        }

        return view('stok.datastok.index', compact('year_now', 'stok', 'saldo_awal', 'filter', 'filterdate', 'start', 'finish', 'satuanfil'));
    }
}
