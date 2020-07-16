<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\suratjalan;
use App\Model\karyawan;
use App\Model\invoicepiutangdetail;
use DB;
use PDF;

class InvoicePiutangController extends Controller
{
    public function piutang()
    {
        $invoice = DB::select('SELECT i.KodeInvoicePiutangShow, i.KodeInvoicePiutang, i.Term, p.NamaPelanggan, i.Tanggal, d.Subtotal,COALESCE(sum(pp.Jumlah),0) as bayar
                    FROM invoicepiutangs i
                    inner join invoicepiutangdetails d on i.KodeInvoicePiutang = d.KodeInvoicePiutang
                    inner join pelanggans p on p.KodePelanggan = i.KodePelanggan
                    left join pelunasanpiutangs pp on pp.KodeInvoice = i.KodeInvoicePiutang
                    GROUP by i.KodeInvoicePiutangShow, i.KodeInvoicePiutang, p.NamaPelanggan, i.Tanggal, d.Subtotal, i.Term');
        return view('piutang.invoice.index', compact('invoice'));
    }

    public function print($id)
    {
        $invoice = DB::select("SELECT i.KodeInvoicePiutangShow, i.KodeInvoicePiutang, i.Term, p.NamaPelanggan, i.Tanggal, d.Subtotal
        FROM invoicepiutangs i
        left join pelunasanpiutangs pp on pp.KodeInvoice = i.KodeInvoicePiutang
        inner join invoicepiutangdetails d on i.KodeInvoicePiutang = d.KodeInvoicePiutang
        inner join pelanggans p on p.KodePelanggan = i.KodePelanggan
        where i.KodeInvoicePiutangShow = '" . $id . "'
        group by i.KodeInvoicePiutangShow, i.KodeInvoicePiutang, p.NamaPelanggan, i.Tanggal, d.Subtotal, i.Term")[0];
        $inv = invoicepiutangdetail::where('KodePiutang', $id)->first();
        $suratjalan = suratjalan::where('KodeSuratJalan', $inv->KodeSuratJalan)->first();
        $driver = karyawan::where('KodeKaryawan', $suratjalan->KodeSopir)->first();
        $items = DB::select(
            "SELECT a.KodeItem,i.NamaItem, a.Qty, i.Keterangan, s.NamaSatuan, k.HargaJual 
            FROM suratjalandetails a 
            inner join items i on a.KodeItem = i.KodeItem 
            inner join itemkonversis k on i.KodeItem = k.KodeItem and a.KodeSatuan = k.KodeSatuan 
            inner join satuans s on s.KodeSatuan = k.KodeSatuan
            where a.KodeSuratJalan='" . $inv->KodeSuratJalan . "' group by a.KodeItem, s.NamaSatuan"
        );

        $jml = 0;
        foreach ($items as $value) {
            $jml += $value->Qty;
        }
        $invoice->Tanggal = \Carbon\Carbon::parse($invoice->Tanggal)->format('d/m/Y');

        $pdf = PDF::loadview('piutang.invoice.print', compact('invoice', 'id', 'items', 'jml', 'suratjalan', 'driver'));

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Print invoice piutang ' . $id,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return $pdf->download('piutang.invoice.pdf');
    }
}
