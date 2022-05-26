<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Auth;

use App\Model\pindahgudang;
use App\Model\pindahgudangdetail;
use App\Model\lokasi;
use App\Model\item;
use App\Model\itemkonversi;
use App\Model\keluarmasukbarang;
use App\Model\eventlog;
use App\Model\penerimaanbarang;
use App\Model\stokkeluar;
use App\Model\stokkeluardetail;
use App\Model\stokmasuk;
use App\Model\stokmasukdetail;

class PindahGudangController extends Controller
{
    //
    public function index()
    {
        $sekarang = date('Y-m-d');
        $mulai = $sekarang;
        $sampai = $sekarang;
        $keyword = '';
        $nodataopn = '';
        $nodatacfm = '';
        $pindahgudangs = pindahgudang::where('Status', 'OPN')->get();
        $pindahgudangconfirmed = pindahgudang::where('Status', 'CFM')
        ->addSelect([
            'ceklpb' => penerimaanbarang::whereColumn('KodePO', 'pindahgudangs.KodePindah')
                        ->select('penerimaanbarangs.Status')
                        ->limit(1)
        ])
        ->get();
        if (empty($pindahgudangs)) {
            $nodataopn = "Tidak ada data";
        }
        if (empty($pindahgudangconfirmed)) {
            $nodatacfm = "Tidak ada data";
        }
        return view('operasional.pindahGudang.index', compact('pindahgudangs', 'pindahgudangconfirmed', 'sekarang', 'mulai', 'sampai', 'keyword', 'nodataopn', 'nodatacfm'));
    }

    public function search(Request $request)
    {
        $sekarang = date('Y-m-d');

        $this->validate($request, [
            'mulai' => "required",
            'sampai' => "required",
            'keyword' => "required"
        ]);
        
        $nodataopn = '';
        $nodatacfm = '';

        $pindahgudangs = pindahgudang::where('Keterangan', 'like', '%'.$request->keyword.'%')
            ->where('Status', 'OPN')
            ->whereRaw('Tanggal BETWEEN '.$request->mulai.' AND '.$request->sampai)
            ->get();
        $pindahgudangconfirmed = pindahgudang::where('Keterangan', 'like', '%'.$request->keyword.'%')
            ->where('Status', 'CFM')
            ->whereRaw('Tanggal BETWEEN '.$request->mulai.' AND '.$request->sampai)
            ->get();
        
        if (empty($pindahgudangs)) {
            $nodataopn = "Tidak ada data";
        }
        if (empty($pindahgudangconfirmed)) {
            $nodatacfm = "Tidak ada data";
        }
        return view('operasional.pindahGudang.index', compact('pindahgudangs', 'pindahgudangconfirmed', 'sekarang', 'mulai', 'sampai', 'keyword', 'nodataopn', 'nodatacfm'));
    }

    public function create()
    {
        $base_pg = 'MTS-' . date('y') . date('m');
        $urut = pindahgudang::where('KodePindah', 'like', '%'.$base_pg.'%')->orderBy('KodePindah', 'desc')->value('KodePindah');
        $c = empty($urut) ? ($base_pg.'0000') : $urut;
        $pieces = explode("-", $c);
        $kode = $pieces[1]; // piece1
        $new_kode = $kode + 1;
        $sekarang = date('d-m-Y');
        $code = 'MTS-' . $new_kode;

        $item = item::select(
            'items.KodeItem',
            'items.NamaItem',
            'items.Keterangan',
        )
        ->join('itemkonversis', 'items.KodeItem', '=', 'itemkonversis.KodeItem')
        ->where('items.jenisitem', 'bahanbaku')
        ->where('items.Status', 'OPN')
        ->orderBy('items.NamaItem', 'asc')
        ->get();

        return view('operasional.pindahGudang.create', [
            'code' => $code,
            'sekarang' => $sekarang,
            'item' => $item
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            // 'kodePindah' => "required",
            // 'kodeUser' => "required",
            'dariLokasi' => "required",
            'keLokasi' => "required",
            'tanggal' => "required",
            'keterangan' => "required",
        ]);

        pindahgudang::insert([
            "KodePindah" => $request->kodePindah,
            "KodeUser" => Auth::user()->name,
            "Status" => 'OPN',
            "DariLokasi" => $request->dariLokasi,
            "KeLokasi" => $request->keLokasi,
            "Tanggal" => date_format(date_create($request->tanggal), 'Y-m-d'),
            "Keterangan" => $request->keterangan,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);

        $items = $request->item;
        $qtys = $request->qty;
        $kets = $request->ket;
        foreach ($items as $key => $value) {
            pindahgudangdetail::insert([
                "KodePindah" => $request->kodePindah,
                "KodeItem" => $value,
                "KodeSatuan" => 'Kg',
                "Qty" => $qtys[$key],
                "Keterangan" => $kets[$key],
                "NoUrut" => $key + 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ]);
        }

        eventlog::insert([
            "KodeUser" => Auth::user()->name,
            "Tanggal" => \Carbon\Carbon::now()->format('Y-m-d'),
            "Jam" => \Carbon\Carbon::now()->format('H:i:s'),
            "Keterangan" => 'Dokumen mutasi dibuat | kode : '.$request->kodePindah,
            "Tipe" => 'OPN',
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);

        return redirect('/pindahgudang');
    }

    /*public function confirm(Request $request, $id)
    {
        $detail = pindahgudangdetail::where('KodePindah', $id)->select('KodeItem', 'KodeSatuan', 'Qty')->get();

        $total = pindahgudangdetail::where('KodePindah', $id)->count();

        $lastSLK = stokkeluar::where('KodeStokKeluar', 'like', 'SLK-'.date('y').date('m').'%')->count();

        $newSLK = empty($lastSLK) ? 1 : ($lastSLK + 1);
        $kodeNewSLK = 'SLK-'.date('y').date('m').str_pad($newSLK, 4, '0', STR_PAD_LEFT);

        pindahgudang::where('KodePindah', $id)->update([ "Status" => 'CFM' ]);

        stokkeluar::insert([
            "KodeStokKeluar" => $kodeNewSLK,
            "KodeLokasi" => 'GUD-001',
            "Tanggal" => \Carbon\Carbon::now(),
            "Keterangan" => 'Kirim ke BEDALI',
            "Status" => 'CFM',
            "KodeUser" => Auth::user()->name,
            "TotalItem" => $total,
            "Printed" => 0,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);

        $noUrut = 0;
        foreach ($detail as $key => $value) {
            $noUrut++;
            $sisaStok = keluarmasukbarang::where('KodeItem', $value->KodeItem)
            ->orderBy('id', 'desc')
            ->value('saldo');

            $konversi = itemkonversi::where('KodeItem', $value->KodeItem)
            ->where('KodeSatuan', $value->KodeSatuan)
            ->value('Konversi');

            keluarmasukbarang::insert([
                "Tanggal" => date('Y-m-d'),
                "KodeLokasi" => 'GUD-001',
                "KodeItem" => $value->KodeItem,
                "JenisTransaksi" => 'MTS',
                "KodeTransaksi" => $id,
                "Qty" => -1 * ($value->Qty * $konversi),
                "saldo" => $sisaStok - ($value->Qty * $konversi),
                "KodeUser" => Auth::user()->name,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
                "HargaRata" => '0',
                "idx" => 0,
                "indexmov" => 0
            ]);

            stokkeluardetail::insert([
                "KodeStokKeluar" => $kodeNewSLK,
                "KodeItem" => $value->KodeItem,
                "KodeSatuan" => $value->KodeSatuan,
                "Qty" => $value->Qty,
                "Keterangan" => 'Kirim ke BEDALI',
                "NoUrut" => $noUrut,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ]);
        }

        eventlog::insert([
            "KodeUser" => Auth::user()->name,
            "Tanggal" => \Carbon\Carbon::now()->format('Y-m-d'),
            "Jam" => \Carbon\Carbon::now()->format('H:i:s'),
            "Keterangan" => 'Pindah gudang dikonfirmasi | kode : '.$id,
            "Tipe" => 'OPN',
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);

        return redirect('/pindahgudang');
    }*/


    public function edit($id)
    {
        $pindahgudang = pindahgudang::where('KodePindah', $id)->first();
        $pindahgudang->Tanggal = date_format(date_create($pindahgudang->Tanggal), 'd-m-Y');
        $pindahgudangdetail = pindahgudangdetail::where('KodePindah', $id)->get();

        $item = item::select(
            'items.KodeItem',
            'items.NamaItem',
            'items.Keterangan',
        )
        ->join('itemkonversis', 'items.KodeItem', '=', 'itemkonversis.KodeItem')
        ->where('items.jenisitem', 'bahanbaku')
        ->where('items.Status', 'OPN')
        ->orderBy('items.NamaItem', 'asc')
        ->get();

        return view('operasional.pindahGudang.edit', compact('id','pindahgudang', 'item', 'pindahgudangdetail'));
    }

    public function confirmation($id)
    {
        /*$pindahgudangdetails = pindahgudangdetail::where('KodePindah', $id)
            ->join('items', 'pindahgudangdetails.KodeItem', '=', 'items.KodeItem')
            ->select('pindahgudangdetails.*', 'items.NamaItem')
            ->get();

        $pindahgudang = pindahgudang::where('KodePindah', $id)->get();

        return view('operasional.pindahGudang.confirm', compact('pindahgudang', 'pindahgudangdetails'));*/

        $total = pindahgudangdetail::where('KodePindah', $id)->count();

        $lastSLK = stokkeluar::where('KodeStokKeluar', 'like', 'SLK-'.date('y').date('m').'%')->count();
        $newSLK = empty($lastSLK) ? 1 : ($lastSLK + 1);
        $kodeNewSLK = 'SLK-'.date('y').date('m').str_pad($newSLK, 4, '0', STR_PAD_LEFT);

        pindahgudang::where('KodePindah', $id)->update([ "Status" => 'CFM' ]);

        stokkeluar::insert([
            "KodeStokKeluar" => $kodeNewSLK,
            "KodeLokasi" => 'GUD-001',
            "Tanggal" => \Carbon\Carbon::now(),
            "Keterangan" => 'Kirim ke BEDALI',
            "Status" => 'CFM',
            "KodeUser" => Auth::user()->name,
            "TotalItem" => $total,
            "Printed" => 0,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);

        $pindahgudangdetails = pindahgudangdetail::where('KodePindah', $id)
            ->join('items', 'pindahgudangdetails.KodeItem', '=', 'items.KodeItem')
            ->select('pindahgudangdetails.*', 'items.NamaItem')
            ->get();

        $pindahgudang = pindahgudang::where('KodePindah', $id)->first();

        $noUrut = 0;
        foreach ($pindahgudangdetails as $key => $value) {
            $noUrut++;
            $sisaStok = keluarmasukbarang::where('KodeItem', $value->KodeItem)
            ->orderBy('id', 'desc')
            ->value('saldo');

            $konversi = itemkonversi::where('KodeItem', $value->KodeItem)
            ->where('KodeSatuan', $value->KodeSatuan)
            ->value('Konversi');

            keluarmasukbarang::insert([
                "Tanggal" => date('Y-m-d'),
                "KodeLokasi" => 'GUD-001',
                "KodeItem" => $value->KodeItem,
                "JenisTransaksi" => 'MTS',
                "KodeTransaksi" => $id,
                "Qty" => -1 * ($value->Qty * $konversi),
                "saldo" => $sisaStok - ($value->Qty * $konversi),
                "KodeUser" => Auth::user()->name,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
                "HargaRata" => '0',
                "idx" => 0,
                "indexmov" => 0
            ]);

            stokkeluardetail::insert([
                "KodeStokKeluar" => $kodeNewSLK,
                "KodeItem" => $value->KodeItem,
                "KodeSatuan" => $value->KodeSatuan,
                "Qty" => $value->Qty,
                "Keterangan" => 'Kirim ke BEDALI',
                "NoUrut" => $noUrut,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ]);
        }

        eventlog::insert([
            "KodeUser" => Auth::user()->name,
            "Tanggal" => \Carbon\Carbon::now()->format('Y-m-d'),
            "Jam" => \Carbon\Carbon::now()->format('H:i:s'),
            "Keterangan" => 'Dokumen mutasi dikonfirmasi | kode : '.$id,
            "Tipe" => 'OPN',
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);

        $pdf = PDF::loadView('operasional.pindahGudang.pdf', [
            'pindahgudangdetails' => $pindahgudangdetails,
            'pindahgudang' => $pindahgudang
        ])->setPaper('a5', 'landscape');;

        return $pdf->stream('Mutasi '.$id.'.pdf');
    }

    public function look($id)
    {
        $pindahgudangdetails = pindahgudangdetail::where('KodePindah', $id)
            ->join('items', 'pindahgudangdetails.KodeItem', '=', 'items.KodeItem')
            ->join('itemkonversis', 'items.KodeItem', '=', 'itemkonversis.KodeItem')
            ->join('satuans', 'itemkonversis.KodeSatuan', '=', 'satuans.KodeSatuan')
            ->select('pindahgudangdetails.*', 'items.NamaItem', 'itemkonversis.KodeSatuan')
            ->get();

        $pindahgudang = pindahgudang::where('KodePindah', $id)->first();
        $ceklpb = penerimaanbarang::where('KodePO', $id)->value('Status');
        return view('operasional.pindahGudang.look', compact('pindahgudang', 'pindahgudangdetails', 'ceklpb'));
    }

    public function update(Request $request, $id)
    {
        pindahgudang::where('KodePindah', $id)->update([
            "KodeUser" => Auth::user()->name,
            "Tanggal" => date_format(date_create($request->tanggal), 'Y-m-d'),
            "Keterangan" => $request->keterangan,
            "updated_at" => \Carbon\Carbon::now()
        ]);

        pindahgudangdetail::where('KodePindah', $id)->delete();

        $items = $request->item;
        $qtys = $request->qty;
        $kets = $request->ket;
        foreach ($items as $key => $value) {
            pindahgudangdetail::insert([
                "KodePindah" => $id,
                "KodeItem" => $value,
                "KodeSatuan" => 'Kg',
                "Qty" => $qtys[$key],
                "Keterangan" => $kets[$key],
                "NoUrut" => $key + 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ]);
        }

        eventlog::insert([
            "KodeUser" => Auth::user()->name,
            "Tanggal" => \Carbon\Carbon::now()->format('Y-m-d'),
            "Jam" => \Carbon\Carbon::now()->format('H:i:s'),
            "Keterangan" => 'Pindah gudang diupdate | kode : '.$id,
            "Tipe" => 'OPN',
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);

        return redirect('/pindahgudang');
    }

    public function destroy($id)
    {
        pindahgudang::where('KodePindah', $id)->update([ "Status" => 'DEL' ]);
        eventlog::insert([
            "KodeUser" => Auth::user()->name,
            "Tanggal" => \Carbon\Carbon::now()->format('Y-m-d'),
            "Jam" => \Carbon\Carbon::now()->format('H:i:s'),
            "Keterangan" => 'Pindah gudang dihapus | kode : '.$id,
            "Tipe" => 'OPN',
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);

        return redirect('/pindahgudang');
    }

    public function print(Request $request, $id)
    {
        $pindahgudangdetails = pindahgudangdetail::where('KodePindah', $id)
            ->join('items', 'pindahgudangdetails.KodeItem', '=', 'items.KodeItem')
            ->join('itemkonversis', 'items.KodeItem', '=', 'itemkonversis.KodeItem')
            ->join('satuans', 'itemkonversis.KodeSatuan', '=', 'satuans.KodeSatuan')
            ->select('pindahgudangdetails.*', 'items.NamaItem', 'itemkonversis.KodeSatuan')
            ->get();
        $pindahgudang = pindahgudang::where('KodePindah', $id)->first();
        $lokasi = lokasi::where('Status', 'OPN')->get();
        $pdf = PDF::loadView('operasional.pindahGudang.pdf', [
            'pindahgudangdetails' => $pindahgudangdetails,
            'pindahgudang' => $pindahgudang
        ])->setPaper('a5', 'landscape');;

        return $pdf->stream($id.'.pdf');
    }

    public function createlpb($id)
    {
        $pindahgudang = pindahgudang::where('KodePindah', $id)->first();

        $bahansetengahjadi = item::where('jenisitem', 'bahansetengahjadi')
        ->where('Status', 'OPN')
        ->get();

        $sekarang = date('Y-m-d');

        return view('operasional.pindahGudang.createlpb', compact(
            'pindahgudang',
            'bahansetengahjadi',
            'sekarang',
            'id'
        ));
    }

    public function storelpb(Request $request, $id)
    {
        $items = $request->item;
        $qtys = $request->qty;
        $satuans = $request->satuan;

        $ceklpb = penerimaanbarang::where('KodePenerimaanBarang', 'like', '%LPB-0'.date('y').date('m').'%')->count();
        $nolpb = empty($ceklpb) ? 1 : ($ceklpb + 1);
        $kodelpb = 'LPB-0'.date('y').date('m').str_pad($nolpb, 4, '0', STR_PAD_LEFT);

        penerimaanbarang::insert([
            "KodePenerimaanBarang" => $kodelpb,
            "Tanggal" => $request->tanggal,
            "KodeLokasi" => 'GUD-001',
            "Status" => 'CFM',
            "KodeUser" => Auth::user()->name,
            "Total" => 0,
            "PPN" => 'tidak',
            "NilaiPPN" => 0,
            "Printed" => 0,
            "Diskon" => 0,
            "NilaiDiskon" => 0,
            "Subtotal" => 0,
            "KodeSupplier" => 'BEDALI',
            "TotalItem" => count($items),
            "Keterangan" => $request->keterangan,
            "KodePO" => $id,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);

        $lastSLM = stokmasuk::where('KodeStokMasuk', 'like', 'SLM-'.date('y').date('m').'%')->count();
        $newSLM = empty($lastSLM) ? 1 : ($lastSLM + 1);
        $kodeNewSLM = 'SLM-'.date('y').date('m').str_pad($newSLM, 4, '0', STR_PAD_LEFT);

        stokmasuk::insert([
            "KodeStokMasuk" => $kodeNewSLM,
            "KodeLokasi" => 'GUD-001',
            "Tanggal" => \Carbon\Carbon::now()->format('Y-m-d'),
            "Keterangan" => 'Terima dari BEDALI',
            "Status" => 'CFM',
            "KodeUser" => Auth::user()->name,
            "TotalItem" => count($items),
            "Printed" => 0,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);

        $no = 0;
        foreach ($items as $key => $value) {
            $no++;

            $saldo = keluarmasukbarang::where('KodeItem', $value)
            ->orderBy('id', 'desc')
            ->value('saldo');

            $konversi = itemkonversi::where('KodeItem', $value)
            ->where('KodeSatuan', $satuans[$key])
            ->value('Konversi');
            $nilaiKonversi = empty($konversi) ? 1 : $konversi;

            DB::table('penerimaanbarangdetails')->insert([
                "KodePenerimaanBarang" => $kodelpb,
                "KodeItem" => $value,
                "KodeSatuan" => empty($konversi) ? 'Pcs' : $satuans[$key],
                "Qty" => $qtys[$key],
                "NoUrut" => $no,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ]);

            keluarmasukbarang::insert([
                "Tanggal" => $request->tanggal,
                "KodeLokasi" => 'GUD-001',
                "KodeItem" => $value,
                "JenisTransaksi" => 'LPB',
                "KodeTransaksi" => $kodelpb,
                "Qty" => $qtys[$key] * $nilaiKonversi,
                "HargaRata" => 0,
                "KodeUser" => Auth::user()->name,
                "idx" => 0,
                "indexmov" => $no,
                "saldo" => $saldo + ($qtys[$key] * $nilaiKonversi),
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ]);

            stokmasukdetail::insert([
                "KodeStokMasuk" => $kodeNewSLM,
                "KodeItem" => $value,
                "KodeSatuan" => empty($konversi) ? 'Pcs' : $satuans[$key],
                "Qty" => $qtys[$key],
                "Keterangan" => 'Terima dari BEDALI',
                "NoUrut" => $no,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ]);
        }

        eventlog::insert([
            "KodeUser" => Auth::user()->name,
            "Tanggal" => \Carbon\Carbon::now()->format('Y-m-d'),
            "Jam" => \Carbon\Carbon::now()->format('H:i:s'),
            "Keterangan" => 'Terima barang dari BEDALI | kode : '.$id. ' | lpb : '.$kodelpb,
            "Tipe" => 'OPN',
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);

        return redirect('/pindahgudang');
    }
}
