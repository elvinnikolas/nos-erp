<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use App\Model\penerimaanbarang;
use App\Model\karyawan;
use App\Model\invoicehutangdetail;
use Carbon\Carbon;

class InvoiceHutangController extends Controller
{
    public function hutang()
    {
        $invoice = DB::select('SELECT i.KodeInvoiceHutangShow, i.KodeInvoiceHutang, i.NoFaktur, i.Term, p.NamaSupplier, i.Tanggal, d.KodeLPB, d.Subtotal, d.TotalReturn, pb.PPN, COALESCE(sum(ph.Jumlah),0) as bayar
            FROM invoicehutangs i
            inner join invoicehutangdetails d on i.KodeInvoiceHutang = d.KodeInvoiceHutang
            inner join suppliers p on p.KodeSupplier = i.KodeSupplier
            left join pelunasanhutangs ph on ph.KodeInvoice = i.KodeInvoiceHutang
            left join penerimaanbarangs pb on pb.KodePenerimaanBarang = d.KodeLPB
            GROUP by i.KodeInvoiceHutangShow, i.KodeInvoiceHutang, p.NamaSupplier, i.Tanggal, d.Subtotal, i.Term');
        return view('hutang.invoice.index', compact('invoice'));
    }

    public function edit($id)
    {
        $invoice = DB::select("SELECT i.KodeInvoiceHutangShow, i.KodeInvoiceHutang, i.NoFaktur, i.Term, p.NamaSupplier, i.Tanggal, d.KodeLPB, d.Subtotal, d.TotalReturn, pb.PPN, COALESCE(sum(ph.Jumlah),0) as bayar
            FROM invoicehutangs i
            inner join invoicehutangdetails d on i.KodeInvoiceHutang = d.KodeInvoiceHutang
            inner join suppliers p on p.KodeSupplier = i.KodeSupplier
            left join pelunasanhutangs ph on ph.KodeInvoice = i.KodeInvoiceHutang
            left join penerimaanbarangs pb on pb.KodePenerimaanBarang = d.KodeLPB
            where i.KodeInvoiceHutangShow = '" . $id . "'
            GROUP by i.KodeInvoiceHutangShow, i.KodeInvoiceHutang, p.NamaSupplier, i.Tanggal, d.Subtotal, i.Term");
        return view('hutang.invoice.edit', compact('invoice'));
    }

    public function update(Request $request)
    {
        DB::table('invoicehutangs')->where('KodeInvoiceHutangShow', $request->KodeInvoice)
            ->update([
                'NoFaktur' => $request->NoFaktur,
                'KodeUser' => \Auth::user()->name,
                'updated_at' => \Carbon\Carbon::now()
            ]);

        $detail = DB::table('invoicehutangdetails')->where('KodeHutang', $request->KodeInvoice)->first();
        DB::table('penerimaanbarangs')->where('KodePenerimaanBarang', $detail->KodeLPB)
            ->update([
                'NoFaktur' => $request->NoFaktur,
                'KodeUser' => \Auth::user()->name,
                'updated_at' => \Carbon\Carbon::now()
            ]);

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Update invoice hutang ' . $request->KodeInvoice,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect('/invoicehutang');
    }

    public function print($id)
    {
        $invoice = DB::select("SELECT i.KodeInvoiceHutangShow, i.KodeInvoiceHutang, i.Term, p.NamaSupplier, i.Tanggal, d.Subtotal
        FROM invoicehutangs i
        left join pelunasanhutangs pp on pp.KodeInvoice = i.KodeInvoiceHutang
        inner join invoicehutangdetails d on i.KodeInvoiceHutang = d.KodeInvoiceHutang
        inner join suppliers p on p.KodeSupplier = i.KodeSupplier
        where i.KodeInvoiceHutangShow = '" . $id . "'
        group by i.KodeInvoiceHutangShow, i.KodeInvoiceHutang, p.NamaSupplier, i.Tanggal, d.Subtotal, i.Term")[0];
        $inv = invoicehutangdetail::where('KodeHutang', $id)->first();
        $penerimaanbarang = penerimaanbarang::where('KodePenerimaanBarang', $inv->KodeLPB)->first();
        $sales = karyawan::where('KodeKaryawan', $penerimaanbarang->KodeSales)->first();
        $items = DB::select(
            "SELECT a.KodeItem,i.NamaItem, a.Qty, i.Keterangan, s.NamaSatuan, a.Harga as HargaJual
            FROM penerimaanbarangdetails a 
            inner join items i on a.KodeItem = i.KodeItem 
            inner join itemkonversis k on i.KodeItem = k.KodeItem and a.KodeSatuan = k.KodeSatuan 
            inner join satuans s on s.KodeSatuan = k.KodeSatuan
            where a.KodePenerimaanBarang='" . $inv->KodeLPB . "' group by a.KodeItem, s.NamaSatuan"
        );

        $jml = 0;
        foreach ($items as $value) {
            $jml += $value->Qty;
        }
        $invoice->TanggalFormat = \Carbon\Carbon::parse($invoice->Tanggal)->format('d-m-Y');

        $pdf = PDF::loadview('hutang.invoice.print', compact('invoice', 'id', 'items', 'jml', 'penerimaanbarang', 'sales'));

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Print invoice hutang ' . $id,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return $pdf->download('hutang.invoice.pdf');
    }
}
