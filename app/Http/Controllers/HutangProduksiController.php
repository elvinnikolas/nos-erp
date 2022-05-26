<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HutangProduksiController extends Controller
{

    public function index()
    {
        $hutang = DB::table('prod_hutangheader')
            ->where('Status', '!=', 'DEL')
            ->orderBy('TanggalGajian', 'desc')
            ->get();

        return view('produksi.hutang.index', compact('hutang'));
    }

    public function select()
    {
        return view('produksi.hutang.select');
    }

    public function create(Request $request)
    {
        $start = $request->get('start');
        $finish = $request->get('finish');
        $gaji = $request->get('gaji');

        $data = DB::select("SELECT gaji.Nama as karyawan, gaji.KodeKaryawan as kodekaryawan,
                gaji.NamaGroupItem as golongan, gaji.NoGroupItem as kodegolongan,
                COALESCE(gaji.Total_gaji,0) as gaji, 
                COALESCE(produksi.Total_produksi,0) as produksi, 
                COALESCE(gaji.Total_gaji-produksi.Total_produksi,0) as hutang, 
                ngg.NominalGroupItem as packing, 
                COALESCE((gaji.Total_gaji-produksi.Total_produksi)*ngg.NominalGroupItem,0) as total
            FROM 
                (SELECT k.KodeKaryawan, k.Nama, ngp.KodeItem, COALESCE(SUM(ngp.JumlahProduksi),0) as Total_gaji, ngi.NoGroupItem, ngi.NamaGroupItem
                FROM new_gajiandetailkaryawan ngk
                JOIN new_gajian ng ON ngk.NoGajian = ng.NoGaji
                JOIN new_gajiandetailproduksi ngp ON ngp.NoGajianDetailKaryawan = ngk.NoGajianDetailKaryawan
                INNER JOIN karyawans k ON k.KodeKaryawan = ngk.KodeKaryawan
                INNER JOIN new_golongangroupitem ngi ON ngi.NoGroupItem = ngp.KodeItem
                WHERE ngk.Nutuk = 0
                AND ng.TanggalGaji = '" . $request->gaji . "'
                GROUP BY k.KodeKaryawan, ngp.KodeItem)
                AS gaji
            LEFT JOIN
                (SELECT k.KodeKaryawan, k.Nama, pph.KodeGolongan, COALESCE(SUM(ppd.QtyCek),0) as Total_produksi, ngi.NamaGroupItem
                FROM prod_produksiheader pph
                JOIN prod_produksidetail ppd ON pph.KodeProduksi = ppd.KodeProduksi
                INNER JOIN karyawans k ON k.KodeKaryawan = ppd.KodeKaryawan
                INNER JOIN new_golongangroupitem ngi ON ngi.NoGroupItem = pph.KodeGolongan
                WHERE pph.TanggalInput BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
                GROUP BY k.KodeKaryawan, pph.KodeGolongan)
                AS produksi
            ON gaji.KodeKaryawan = produksi.KodeKaryawan and gaji.KodeItem = produksi.KodeGolongan
            INNER JOIN new_golongangroupitem ngg ON ngg.NamaGroupItem = gaji.NamaGroupItem
            WHERE gaji.Total_gaji-produksi.Total_produksi > 0 OR gaji.Total_gaji-produksi.Total_produksi < 0
            GROUP BY gaji.KodeKaryawan, gaji.KodeItem
        ");

        $check_data = ($data !== []);

        return view('produksi.hutang.create', compact('data', 'start', 'finish', 'gaji', 'check_data'));
    }

    public function store(Request $request)
    {
        $id = DB::table('prod_hutangheader')->insertGetId([
            'TanggalAwal' => $request->TanggalAwal,
            'TanggalAkhir' => $request->TanggalAkhir,
            'TanggalGajian' => $request->TanggalGajian,
            'Status' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $karyawan = $request->karyawan;
        $golongan = $request->golongan;
        $gaji = $request->gaji;
        $produksi = $request->produksi;
        $hutang = $request->hutang;
        $packing = $request->packing;
        $total = $request->total;
        foreach ($karyawan as $key => $value) {
            DB::table('prod_hutangdetail')->insert([
                'IDHutang' => $id,
                'KodeKaryawan' => $karyawan[$key],
                'KodeGolongan' => $golongan[$key],
                'Qty' => $gaji[$key],
                'QtyCek' => $produksi[$key],
                'QtyHutang' => $hutang[$key],
                'Gaji' => $packing[$key],
                'Total' => $total[$key],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        $pesan = 'Data berhasil ditambahkan';
        return redirect('/hutangproduksi')->with(['created' => $pesan]);
    }

    public function show($id)
    {
        $hutang = DB::table('prod_hutangheader')
            ->where('id', $id)
            ->first();

        $detail = DB::table('prod_hutangdetail')
            ->select('prod_hutangdetail.*', 'karyawans.Nama', 'new_golongangroupitem.NamaGroupItem')
            ->join('karyawans', 'prod_hutangdetail.KodeKaryawan', '=', 'karyawans.KodeKaryawan')
            ->join('new_golongangroupitem', 'prod_hutangdetail.KodeGolongan', '=', 'new_golongangroupitem.NoGroupItem')
            ->where('IDHutang', $id)
            ->get();

        return view('produksi.hutang.show', compact('hutang', 'detail'));
    }

    public function confirm($id)
    {
        DB::table('prod_hutangheader')
            ->where('id', $id)
            ->update(['Status' => 'CFM']);

        $pesan = 'Data berhasil dikonfirmasi';
        return redirect('/hutangproduksi')->with(['edited' => $pesan]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        DB::table('prod_hutangheader')
            ->where('id', $id)
            ->update(['Status' => 'DEL']);

        $pesan = 'Data berhasil dihapus';
        return redirect('/hutangproduksi')->with(['deleted' => $pesan]);
    }
}
