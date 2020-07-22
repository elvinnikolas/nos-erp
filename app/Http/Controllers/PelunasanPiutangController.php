<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\invoicepiutang;
use App\Model\invoicepiutangdetail;
use App\Model\lokasi;
use App\Model\pelanggan;
use App\Model\pelunasanpiutang;
use App\Model\kasbank;
use App\Model\matauang;

class PelunasanPiutangController extends Controller
{
    public function index()
    {
        $pelanggans = DB::select('SELECT DISTINCT p.NamaPelanggan, p.KodePelanggan FROM invoicepiutangs i inner join pelanggans p on p.KodePelanggan = i.KodePelanggan');
        return view('piutang.pelunasan.index', compact('pelanggans'));
    }

    public function invoice($id)
    {
        $invoice = DB::select("SELECT i.KodeInvoicePiutangShow, i.KodeInvoicePiutang, p.NamaPelanggan, i.Tanggal, i.Term, d.KodeSuratJalan, d.Subtotal, COALESCE(sum(pp.Jumlah),0) as bayar 
            FROM invoicepiutangs i 
            inner join invoicepiutangdetails d on i.KodeInvoicePiutang = d.KodeInvoicePiutang
            inner join pelanggans p on p.KodePelanggan = i.KodePelanggan
            left join pelunasanpiutangs pp on pp.KodeInvoice = i.KodeInvoicePiutang
            where p.KodePelanggan ='" . $id . "'
            GROUP by i.KodeInvoicePiutangShow, i.KodeInvoicePiutang, p.NamaPelanggan, i.Tanggal, d.Subtotal");
        return view('piutang.pelunasan.invoice', compact('invoice'));
    }

    public function payment($id)
    {
        $invoice = invoicepiutang::where('KodeInvoicePiutang', $id)->first();
        $pelanggan = pelanggan::where('KodePelanggan', $invoice->KodePelanggan)->first();
        $payments = pelunasanpiutang::where('KodeInvoice', $id)->get();
        $detail = invoicepiutangdetail::where('KodeInvoicePiutang', $id)->first();
        $tot = 0;

        foreach ($payments as $bill) {
            $tot += $bill->Jumlah;
        }

        $sub = $detail->Subtotal;
        $sisa = $sub - $tot;
        return view('piutang.pelunasan.paymentlist', compact('invoice', 'payments', 'sisa', 'pelanggan'));
    }

    public function addpayment($id)
    {
        $invoice = invoicepiutang::where('KodeInvoicePiutang', $id)->first();
        $payments = pelunasanpiutang::where('KodeInvoice', $id)->get();
        $detail = invoicepiutangdetail::where('KodeInvoicePiutang', $id)->first();
        $matauang = matauang::all();

        $tot = 0;
        foreach ($payments as $bill) {
            $tot += $bill->Jumlah;
        }
        $sub = $detail->Subtotal;
        $sisa = $sub - $tot;

        return view('piutang.pelunasan.paymentadd', compact('invoice', 'payments', 'matauang', 'sub', 'sisa'));
    }

    public function addpaymentpost($id, Request $request)
    {
        $jml = $request->jml;
        $keterangan = $request->keterangan;
        $metode = $request->metode;
        $matauang = $request->matauang;
        $status = $request->status;
        $invoice = invoicepiutang::where('KodeInvoicePiutang', $id)->first();
        $last_id = DB::select('SELECT * FROM kasbanks ORDER BY KodeKasBankID DESC LIMIT 1');

        $year_now = date('y');
        $month_now = date('m');
        $date_now = date('d');
        $pref = "KM";
        if ($last_id == null) {
            $newID = $pref . "-" . $year_now . $month_now . "0001";
        } else {
            $string = $last_id[0]->KodeKasBank;
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

            $newID = $pref . "-" . $year_now . $month_now . $newID;
        }

        $kas = new kasbank();
        $kas->KodeKasBank = $newID;
        $kas->Tanggal = $request->Tanggal;
        $kas->Status = 'CFM';
        $kas->TanggalCheque = $request->Tanggal;
        $kas->KodeBayar = $metode;
        $kas->TipeBayar = '';
        $kas->NoLink = '';
        $kas->BayarDari = '';
        $kas->Untuk = $invoice->KodeInvoicePiutangShow;
        $kas->Keterangan = $keterangan;
        $kas->KodeUser = \Auth::user()->name;
        $kas->Tipe = $status;
        $kas->created_at = \Carbon\Carbon::now();
        $kas->updated_at = \Carbon\Carbon::now();
        $kas->Total = $request->jml;
        $kas->save();

        $last_id = DB::select('SELECT * FROM pelunasanpiutangs ORDER BY KodePelunasanPiutangID DESC LIMIT 1');

        $year_now = date('y');
        $month_now = date('m');
        $date_now = date('d');
        $pref = "PL";
        if ($last_id == null) {
            $newID = $pref . "-" . $year_now . $month_now . "0001";
        } else {
            $string = $last_id[0]->KodePelunasanPiutang;
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

            $newID = $pref . "-" . $year_now . $month_now . $newID;
        }

        $pp = new pelunasanpiutang();
        $pp->KodePelunasanPiutang = $newID;
        $pp->Tanggal = $request->Tanggal;
        $pp->Status = 'CFM';
        $pp->KodePiutang = '';
        $pp->KodeInvoice = $invoice->KodeInvoicePiutang;
        $pp->KodeBayar = $metode;
        $pp->TipeBayar = $metode;
        $pp->Jumlah = $request->jml;
        $pp->Keterangan = $keterangan;
        $pp->KodeMataUang = $matauang;
        $pp->KodeUser = \Auth::user()->name;
        $pp->KodeSupplier = 'SUP';
        $pp->KodeKasBank = $kas->KodeKasBankID;
        $pp->created_at = \Carbon\Carbon::now();
        $pp->updated_at = \Carbon\Carbon::now();
        $pp->save();

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Tambah pelunasan piutang ' . $invoice->KodeInvoicePiutangShow,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect('/pelunasanpiutang/payment/' . $id);
    }
}
