<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Carbon\Carbon;

class InvoiceHutangController extends Controller
{
    public function hutang()
    {
        $invoice = DB::select('SELECT i.KodeInvoiceHutangShow, i.KodeInvoiceHutang, s.NamaSupplier, i.Tanggal, d.Subtotal, COALESCE(sum(ph.Jumlah),0) as bayar FROM invoicehutangs i inner join invoicehutangdetails d on i.KodeInvoiceHutangShow = d.KodeInvoiceHutang inner join suppliers s on s.KodeSupplier = i.KodeSupplier
            left join pelunasanhutangs ph on ph.KodeInvoice = i.KodeInvoiceHutang
            GROUP by i.KodeInvoiceHutangShow, i.KodeInvoiceHutang, s.NamaSupplier, i.Tanggal, d.Subtotal');
        return view('hutang.invoice.index', compact('invoice'));
    }

    public function printhutang($id)
    {
        $invoice = DB::select("SELECT i.KodeInvoiceHutangShow, i.KodeInvoiceHutang, i.Keterangan, s.NamaSupplier, s.Alamat, i.Tanggal, d.Subtotal, d.KodeLPB, l.NamaLokasi, COALESCE(sum(ph.Jumlah),0) as bayar FROM invoicehutangs i inner join invoicehutangdetails d on i.KodeInvoiceHutangShow = d.KodeInvoiceHutang inner join suppliers s on s.KodeSupplier = i.KodeSupplier
            left join pelunasanhutangs ph on ph.KodeInvoice = i.KodeInvoiceHutang
            left join lokasis l on l.KodeLokasi = i.KodeLokasi
            where i.KodeInvoiceHutangShow = '" . $id . "'
            GROUP by i.KodeInvoiceHutangShow, i.KodeInvoiceHutang, i.Keterangan, s.NamaSupplier, s.Alamat, i.Tanggal, d.Subtotal, d.KodeLPB, l.NamaLokasi");
        $penerimaanbarang = DB::table('penerimaanbarangs')->where('KodePenerimaanBarang', $invoice[0]->KodeLPB)->first();
        $items = DB::select("SELECT a.KodeItem,i.NamaItem, SUM(a.Qty) as jml, i.Keterangan, s.NamaSatuan, k.HargaBeli 
            FROM penerimaanbarangdetails a 
            inner join items i on a.KodeItem = i.KodeItem 
            inner join itemkonversis k on i.KodeItem = k.KodeItem 
            inner join satuans s on s.KodeSatuan = k.KodeSatuan 
            where a.KodePenerimaanBarang='" . $invoice[0]->KodeLPB . "' 
            group by a.KodeItem, i.Keterangan, s.NamaSatuan, k.HargaBeli, i.NamaItem ");
        $invoice[0]->Tanggal = Carbon::parse($invoice[0]->Tanggal)->format('d/m/Y');

        $jml = 0;
        foreach ($items as $value) {
            $jml += $value->jml;
        }

        $pdf = PDF::loadview('hutang.invoice.print', compact('invoice', 'id', 'jml', 'penerimaanbarang', 'items'));

        DB::table('eventlogs')->insert([
            'KodeUser' => 'admin',
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Print invoice hutang ' . $id,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return $pdf->download('invoice_hutang.pdf');
    }
}
