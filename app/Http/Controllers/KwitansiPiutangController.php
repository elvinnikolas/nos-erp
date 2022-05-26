<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

class KwitansiPiutangController extends Controller
{
    public function index()
    {
        $kwitansipiutangs = DB::select(
            "SELECT kp.*, pl.NamaPelanggan 
            FROM kwitansipiutangs kp
            INNER JOIN pelanggans pl on kp.KodePelanggan = pl.KodePelanggan
            WHERE kp.Status = 'OPN'
            GROUP BY kp.KodeKwitansi
            ORDER BY kp.id DESC"
        );
        return view('piutang.kwitansi.index', compact('kwitansipiutangs'));
    }

    public function filter(Request $request)
    {
        $search = $request->get('name');
        $start = $request->get('start');
        $end = $request->get('end');
        $kwitansipiutangs = DB::table('kwitansipiutangs')->join('pelanggans', 'pelanggans.KodePelanggan', '=', 'kwitansipiutangs.KodePelanggan')
            ->Where('kwitansipiutangs.Status', 'OPN')
            ->Where(function ($query) use ($search) {
                $query->Where('pelanggans.NamaPelanggan', 'LIKE', "%$search%")
                    ->orWhere('kwitansipiutangs.KodeKwitansi', 'LIKE', "%$search%");
            })->get();
        if ($start && $end) {
            $kwitansipiutangs = $kwitansipiutangs->whereBetween('Tanggal', [$start . ' 00:00:01', $end . ' 23:59:59']);
        } else {
            $kwitansipiutangs->all();
        }
        return view('piutang.kwitansi.index', compact('kwitansipiutangs', 'start', 'end'));
    }

    public function view($id)
    {
        $kwitansipiutang = DB::table('kwitansipiutangs')->where('KodeKwitansi', $id)->first();
        $pelanggan = DB::table('pelanggans')->where('KodePelanggan', $kwitansipiutang->KodePelanggan)->first();
        $invoices = DB::select(
            "SELECT * FROM kwitansipiutangdetails k
            where k.KodeKwitansi='" . $id . "' 
            group by k.id"
        );

        return view('piutang.kwitansi.view', compact('id', 'kwitansipiutang', 'pelanggan', 'invoices'));
    }

    public function create()
    {
        $pelanggans = DB::select(
            "SELECT p.*
            FROM invoicepiutangs i
            inner join invoicepiutangdetails d on i.KodeInvoicePiutang = d.KodeInvoicePiutang
            inner join pelanggans p on p.KodePelanggan = i.KodePelanggan
            inner join suratjalans sj on sj.KodeSuratJalan = d.KodeSuratJalan
            where p.Status = 'OPN' and sj.PPN = 'ya'
            GROUP by p.KodePelanggan"
        );
        // $pelanggans = DB::table('pelanggans')->where('Status', 'OPN')->get();
        return view('piutang.kwitansi.select', compact('pelanggans'));
    }

    public function createKwitansi(Request $request)
    {
        $invoice = DB::select(
            "SELECT i.KodeInvoicePiutangShow as KodeInvoice, i.Tanggal, i.NoFaktur, sj.Subtotal as Total, sj.NilaiPPN as PPN, sj.NilaiDiskon as Diskon, sj.Subtotal+sj.NilaiDiskon-sj.NilaiPPN as DPP,
            sjr.NilaiDiskon as DiskonReturn, sjr.NilaiPPN as PPNReturn, sjr.Total as DPPReturn, d.TotalReturn
            FROM invoicepiutangs i
            inner join invoicepiutangdetails d on i.KodeInvoicePiutang = d.KodeInvoicePiutang
            inner join pelanggans p on p.KodePelanggan = i.KodePelanggan
            inner join suratjalans sj on sj.KodeSuratJalan = d.KodeSuratJalan
            left join suratjalanreturns sjr on sj.KodeSuratJalan = sjr.KodeSuratJalan
            where p.KodePelanggan = '" . $request->pelanggan . "' and sj.PPN = 'ya'
            GROUP by i.KodeInvoicePiutang"
        );
        $alamat = DB::select(
            "SELECT sj.AlamatInvoice, sj.KotaInvoice
            FROM invoicepiutangs i
            inner join invoicepiutangdetails d on i.KodeInvoicePiutang = d.KodeInvoicePiutang
            inner join pelanggans p on p.KodePelanggan = i.KodePelanggan
            inner join suratjalans sj on sj.KodeSuratJalan = d.KodeSuratJalan
            left join suratjalanreturns sjr on sj.KodeSuratJalan = sjr.KodeSuratJalan
            where p.KodePelanggan = '" . $request->pelanggan . "' and sj.PPN = 'ya'
            GROUP by sj.AlamatInvoice"
        );
        foreach ($invoice as $inv) {
            $inv->TanggalFormat = \Carbon\Carbon::parse($inv->Tanggal)->format('d-m-Y');
        }
        $pelanggan = $request->pelanggan;
        return view('piutang.kwitansi.create', compact('invoice', 'pelanggan', 'alamat'));
    }

    public function store(Request $request)
    {
        $last_id = DB::select('SELECT * FROM kwitansipiutangs ORDER BY id DESC LIMIT 1');

        $year_now = date('y');
        $month_now = date('m');
        $date_now = date('d');
        $pref = "KWT-";
        if ($last_id == null) {
            $newID = $pref . $year_now . $month_now . "0001";
        } else {
            $string = $last_id[0]->KodeKwitansi;
            $ids = substr($string, -4, 4);
            $month = substr($string, -6, 2);
            $year = substr($string, -8, 2);

            if ((int) $year_now > (int) $year) {
                $newID = "0001";
            } else if ((int) $month_now > (int) $month) {
                $newID = "0001";
            } else {
                $newID = $ids + 1;
                $newID = str_pad($newID, 4, '0', STR_PAD_LEFT);
            }
            $newID = $pref . $year_now . $month_now . $newID;
        }

        DB::table('kwitansipiutangs')->insert([
            'KodeKwitansi' => $newID,
            'KodePelanggan' => $request->KodePelanggan,
            'Tanggal' => $request->Tanggal,
            'Alamat' => $request->Alamat,
            'Kota' => $request->Kota,
            'NamaTtd' => $request->NamaTtd,
            'KotaTtd' => $request->KotaTtd,
            'DPP' => $request->DPP,
            'PPN' => $request->PPN,
            'Diskon' => $request->Diskon,
            'Total' => $request->Total,
            'Status' => 'OPN',
            'KodeUser' => \Auth::user()->name,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $invoices = $request->invoice;
        $tanggals = $request->tanggal;
        $nofakturs = $request->nofaktur;
        $dpps = $request->dpp;
        $ppns = $request->ppn;
        $diskons = $request->diskon;
        $totals = $request->total;
        foreach ($invoices as $key => $value) {
            DB::table('kwitansipiutangdetails')->insert([
                'KodeKwitansi' => $newID,
                'KodeInvoice' => $invoices[$key],
                'Tanggal' => $tanggals[$key],
                'NoFaktur' => $nofakturs[$key],
                'DPP' => $dpps[$key],
                'PPN' => $ppns[$key],
                'Diskon' => $diskons[$key],
                'Total' => $totals[$key],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Tambah kwitansi ' . $newID,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $pesan = 'Kwitansi ' . $newID . ' berhasil ditambahkan';
        return redirect('/kwitansipiutang')->with(['created' => $pesan]);
    }

    public function edit($id)
    {
        $kwitansi = DB::table('kwitansipiutangs')->where('KodeKwitansi', $id)->first();
        $datainvoice = DB::table('kwitansipiutangdetails')->where('KodeKwitansi', $kwitansi->KodeKwitansi)->get();
        $datapelanggan = DB::table('pelanggans')->where('KodePelanggan', $kwitansi->KodePelanggan)->first();

        $invoice = DB::select(
            "SELECT i.KodeInvoicePiutangShow as KodeInvoice, i.Tanggal, i.NoFaktur, sj.Subtotal as Total, sj.NilaiPPN as PPN, sj.NilaiDiskon as Diskon, sj.Subtotal+sj.NilaiDiskon-sj.NilaiPPN as DPP,
            sjr.NilaiDiskon as DiskonReturn, sjr.NilaiPPN as PPNReturn, sjr.Total as DPPReturn, d.TotalReturn
            FROM invoicepiutangs i
            inner join invoicepiutangdetails d on i.KodeInvoicePiutang = d.KodeInvoicePiutang
            inner join pelanggans p on p.KodePelanggan = i.KodePelanggan
            inner join suratjalans sj on sj.KodeSuratJalan = d.KodeSuratJalan
            left join suratjalanreturns sjr on sj.KodeSuratJalan = sjr.KodeSuratJalan
            where p.KodePelanggan = '" . $datapelanggan->KodePelanggan . "' and sj.PPN = 'ya'
            GROUP by i.KodeInvoicePiutang"
        );
        $alamat = DB::select(
            "SELECT sj.KodeSuratJalanID, sj.AlamatInvoice, sj.KotaInvoice
            FROM invoicepiutangs i
            inner join invoicepiutangdetails d on i.KodeInvoicePiutang = d.KodeInvoicePiutang
            inner join pelanggans p on p.KodePelanggan = i.KodePelanggan
            inner join suratjalans sj on sj.KodeSuratJalan = d.KodeSuratJalan
            left join suratjalanreturns sjr on sj.KodeSuratJalan = sjr.KodeSuratJalan
            where p.KodePelanggan = '" . $datapelanggan->KodePelanggan . "' and sj.PPN = 'ya'
            GROUP by sj.AlamatInvoice"
        );
        foreach ($invoice as $inv) {
            $inv->TanggalFormat = \Carbon\Carbon::parse($inv->Tanggal)->format('d-m-Y');
        }
        $pelanggan = $datapelanggan->KodePelanggan;
        return view('piutang.kwitansi.edit', compact('id', 'invoice', 'kwitansi', 'pelanggan', 'alamat', 'datapelanggan', 'datainvoice'));
    }

    public function update(Request $request)
    {
        DB::table('kwitansipiutangs')->where('KodeKwitansi', $request->KodeKwitansi)
            ->update([
                'Tanggal' => $request->Tanggal,
                'Alamat' => $request->AlamatPelanggan,
                'Kota' => $request->KotaPelanggan,
                'NamaTtd' => $request->NamaTtd,
                'KotaTtd' => $request->KotaTtd,
                'KodeUser' => \Auth::user()->name,
                'updated_at' => \Carbon\Carbon::now()
            ]);

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Update kwitansi ' . $request->KodeKwitansi,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $pesan = 'Kwitansi ' . $request->KodeKwitansi . ' berhasil diubah';
        return redirect('/kwitansipiutang')->with(['edited' => $pesan]);
    }

    public function destroy($id)
    {
        DB::table('kwitansipiutangs')->where('KodeKwitansi', $id)->update([
            'Status' => 'DEL'
        ]);

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Hapus kwitansi ' . $id,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $pesan = 'Kwitansi ' . $id . ' berhasil dihapus';
        return redirect('/kwitansipiutang')->with(['deleted' => $pesan]);
    }

    public function print($id)
    {
        $kwitansipiutang = DB::table('kwitansipiutangs')->where('KodeKwitansi', $id)->first();
        $invoices = DB::table('kwitansipiutangdetails')->where('KodeKwitansi', $id)->get();
        $pelanggan = DB::table('pelanggans')->where('KodePelanggan', $kwitansipiutang->KodePelanggan)->first();

        $max_date = '';
        $min_date = '';
        $max_faktur = '';
        $min_faktur = '';

        foreach ($invoices as $inv) {
            if ($max_date == '' && $min_date == '') {
                $max_date = $inv->Tanggal;
                $max_faktur = $inv->NoFaktur;
                $min_date = $inv->Tanggal;
                $min_faktur = $inv->NoFaktur;
            } else {
                if ($inv->Tanggal < $min_date) {
                    $min_date = $inv->Tanggal;
                    $min_faktur = $inv->NoFaktur;
                }
                if ($inv->Tanggal > $max_date) {
                    $max_date = $inv->Tanggal;
                    $max_faktur = $inv->NoFaktur;
                }
            }
        }

        function penyebut($nilai)
        {
            $nilai = abs($nilai);
            $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
            $temp = "";
            if ($nilai < 12) {
                $temp = " " . $huruf[$nilai];
            } else if ($nilai < 20) {
                $temp = penyebut($nilai - 10) . " belas";
            } else if ($nilai < 100) {
                $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
            } else if ($nilai < 200) {
                $temp = " seratus" . penyebut($nilai - 100);
            } else if ($nilai < 1000) {
                $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
            } else if ($nilai < 2000) {
                $temp = " seribu" . penyebut($nilai - 1000);
            } else if ($nilai < 1000000) {
                $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
            } else if ($nilai < 1000000000) {
                $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
            } else if ($nilai < 1000000000000) {
                $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
            } else if ($nilai < 1000000000000000) {
                $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
            }
            return $temp;
        }

        function terbilang($nilai)
        {
            if ($nilai < 0) {
                $hasil = "minus " . trim(penyebut($nilai));
            } else {
                $hasil = trim(penyebut($nilai));
            }
            return $hasil;
        }

        function terbilang_tanggal($tanggal)
        {
            $date = substr($tanggal, -2, 2);
            $month = substr($tanggal, -5, 2);
            $year = substr($tanggal, -10, 4);
            $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

            $arr_bulan = abs($month);
            $temp = $date . " " . $bulan[$arr_bulan] . " " . $year;

            return $temp;
        }

        $max_date = \Carbon\Carbon::parse($max_date)->format('d-m-Y');;
        $min_date = \Carbon\Carbon::parse($min_date)->format('d-m-Y');;
        $terbilang = terbilang($kwitansipiutang->Total);
        $terbilang_tanggal = terbilang_tanggal($kwitansipiutang->Tanggal);

        $pdf = PDF::loadview('piutang.kwitansi.print', compact('kwitansipiutang', 'pelanggan', 'terbilang', 'terbilang_tanggal', 'min_date', 'max_date', 'min_faktur', 'max_faktur'));

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Print kwitansi ' . $kwitansipiutang->KodeKwitansi,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return $pdf->download('Kwitansi_' . $kwitansipiutang->KodeKwitansi . '.pdf');
    }
}
