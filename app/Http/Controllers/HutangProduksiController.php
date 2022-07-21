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

        // $data = DB::select("SELECT gaji.Nama as karyawan, gaji.KodeKaryawan as kodekaryawan,
        //         gaji.NamaGroupItem as golongan, gaji.NoGroupItem as kodegolongan,
        //         COALESCE(gaji.Total_gaji,0) as gaji, 
        //         COALESCE(produksi.Total_produksi,0) as produksi, 
        //         COALESCE(gaji.Total_gaji-produksi.Total_produksi,0) as hutang, 
        //         ngg.NominalGroupItem as packing, 
        //         COALESCE((gaji.Total_gaji-produksi.Total_produksi)*ngg.NominalGroupItem,0) as total
        //     FROM 
        //         (SELECT k.KodeKaryawan, k.Nama, ngp.KodeItem, COALESCE(SUM(ngp.JumlahProduksi),0) as Total_gaji, ngi.NoGroupItem, ngi.NamaGroupItem
        //         FROM new_gajiandetailkaryawan ngk
        //         JOIN new_gajian ng ON ngk.NoGajian = ng.NoGaji
        //         JOIN new_gajiandetailproduksi ngp ON ngp.NoGajianDetailKaryawan = ngk.NoGajianDetailKaryawan
        //         INNER JOIN karyawans k ON k.KodeKaryawan = ngk.KodeKaryawan
        //         INNER JOIN new_golongangroupitem ngi ON ngi.NoGroupItem = ngp.KodeItem
        //         WHERE ngk.Nutuk = 0
        //         AND ng.TanggalGaji = '" . $request->gaji . "'
        //         GROUP BY k.KodeKaryawan, ngp.KodeItem)
        //         AS gaji
        //     LEFT JOIN
        //         (SELECT k.KodeKaryawan, k.Nama, pph.KodeGolongan, COALESCE(SUM(ppd.QtyCek),0) as Total_produksi, ngi.NamaGroupItem
        //         FROM prod_produksiheader pph
        //         JOIN prod_produksidetail ppd ON pph.KodeProduksi = ppd.KodeProduksi
        //         INNER JOIN karyawans k ON k.KodeKaryawan = ppd.KodeKaryawan
        //         INNER JOIN new_golongangroupitem ngi ON ngi.NoGroupItem = pph.KodeGolongan
        //         WHERE pph.TanggalInput BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
        //         GROUP BY k.KodeKaryawan, pph.KodeGolongan)
        //         AS produksi
        //     ON gaji.KodeKaryawan = produksi.KodeKaryawan and gaji.KodeItem = produksi.KodeGolongan
        //     INNER JOIN new_golongangroupitem ngg ON ngg.NamaGroupItem = gaji.NamaGroupItem
        //     WHERE gaji.Total_gaji-produksi.Total_produksi > 0 OR gaji.Total_gaji-produksi.Total_produksi < 0
        //     GROUP BY gaji.KodeKaryawan, gaji.KodeItem
        // ");

        $data = DB::select(
            "SELECT COALESCE(packing.karyawan, nutuk.karyawan) as karyawan, COALESCE(packing.kodekaryawan, nutuk.kodekaryawan) as kodekaryawan, COALESCE(packing.golongan, nutuk.golongan) as golongan, COALESCE(packing.kodegolongan, nutuk.kodegolongan) as kodegolongan,
            COALESCE(packing.buku_packing,0) as buku_packing, COALESCE(packing.cek_packing,0) as cek_packing, COALESCE(packing.hutang_packing,0) as hutang_packing, COALESCE(packing.gaji_packing,0) as gaji_packing, COALESCE(packing.total_packing,0) as total_packing,
            COALESCE(nutuk.buku_nutuk,0) as buku_nutuk, COALESCE(nutuk.cek_nutuk,0) as cek_nutuk, COALESCE(nutuk.hutang_nutuk,0) as hutang_nutuk, COALESCE(nutuk.gaji_nutuk,0) as gaji_nutuk, COALESCE(nutuk.total_nutuk,0) as total_nutuk,
            packing.Jenis as packing, nutuk.Jenis as nutuk
            FROM
            (SELECT gaji.Nama as karyawan, gaji.KodeKaryawan as kodekaryawan,
                    gaji.NamaGroupItem as golongan, gaji.NoGroupItem as kodegolongan,
                    produksi.Jenis as jenis,
                    COALESCE(gaji.Total_gaji,0) as buku_packing, 
                    COALESCE(produksi.Total_produksi,0) as cek_packing, 
                    COALESCE(gaji.Total_gaji-produksi.Total_produksi,0) as hutang_packing, 
                    ngg.NominalGroupItem as gaji_packing, 
                    COALESCE((gaji.Total_gaji-produksi.Total_produksi)*ngg.NominalGroupItem,0) as total_packing
                FROM 
                    (SELECT k.KodeKaryawan, k.Nama, ngp.KodeGolongan, COALESCE(SUM(ngp.JumlahProduksi),0) as Total_gaji, ngi.NoGroupItem, ngi.NamaGroupItem
                    FROM new_gajiandetailkaryawan ngk
                    JOIN new_gajian ng ON ngk.NoGajian = ng.NoGaji
                    JOIN new_gajiandetailproduksi ngp ON ngp.NoGajianDetailKaryawan = ngk.NoGajianDetailKaryawan
                    INNER JOIN karyawans k ON k.KodeKaryawan = ngk.KodeKaryawan
                    INNER JOIN new_golongangroupitem ngi ON ngi.NoGroupItem = ngp.KodeGolongan
                    WHERE ngp.Jenis = 'Packing'
                    AND ng.TanggalGaji = '" . $request->gaji . "'
                    GROUP BY k.KodeKaryawan, ngp.KodeGolongan)
                    AS gaji
                LEFT JOIN
                    (SELECT k.KodeKaryawan, k.Nama, pph.KodeGolongan, pph.Jenis, COALESCE(SUM(ppd.QtyCek),0) as Total_produksi, ngi.NamaGroupItem
                    FROM prod_produksiheader pph
                    JOIN prod_produksidetail ppd ON pph.KodeProduksi = ppd.KodeProduksi
                    INNER JOIN karyawans k ON k.KodeKaryawan = ppd.KodeKaryawan
                    INNER JOIN new_golongangroupitem ngi ON ngi.NoGroupItem = pph.KodeGolongan
                    WHERE pph.TanggalInput BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
                    AND pph.Jenis = 'Packing'
                    GROUP BY k.KodeKaryawan, pph.KodeGolongan)
                    AS produksi
                ON gaji.KodeKaryawan = produksi.KodeKaryawan and gaji.KodeGolongan = produksi.KodeGolongan
                INNER JOIN new_golongangroupitem ngg ON ngg.NamaGroupItem = gaji.NamaGroupItem
                WHERE gaji.Total_gaji-produksi.Total_produksi > 0 OR gaji.Total_gaji-produksi.Total_produksi < 0
                GROUP BY gaji.KodeKaryawan, gaji.KodeGolongan) as packing
            LEFT JOIN
            (SELECT gaji.Nama as karyawan, gaji.KodeKaryawan as kodekaryawan,
                    gaji.NamaGroupItem as golongan, gaji.NoGroupItem as kodegolongan,
                    produksi.Jenis as jenis,
                    COALESCE(gaji.Total_gaji,0) as buku_nutuk, 
                    COALESCE(produksi.Total_produksi,0) as cek_nutuk, 
                    COALESCE(gaji.Total_gaji-produksi.Total_produksi,0) as hutang_nutuk, 
                    ngg.NominalGroupItemNutuk as gaji_nutuk, 
                    COALESCE((gaji.Total_gaji-produksi.Total_produksi)*ngg.NominalGroupItemNutuk,0) as total_nutuk
                FROM 
                    (SELECT k.KodeKaryawan, k.Nama, ngp.KodeGolongan, COALESCE(SUM(ngp.JumlahProduksi),0) as Total_gaji, ngi.NoGroupItem, ngi.NamaGroupItem
                    FROM new_gajiandetailkaryawan ngk
                    JOIN new_gajian ng ON ngk.NoGajian = ng.NoGaji
                    JOIN new_gajiandetailproduksi ngp ON ngp.NoGajianDetailKaryawan = ngk.NoGajianDetailKaryawan
                    INNER JOIN karyawans k ON k.KodeKaryawan = ngk.KodeKaryawan
                    INNER JOIN new_golongangroupitem ngi ON ngi.NoGroupItem = ngp.KodeGolongan
                    WHERE ngp.Jenis = 'Nutuk'
                    AND ng.TanggalGaji = '" . $request->gaji . "'
                    GROUP BY k.KodeKaryawan, ngp.KodeGolongan)
                    AS gaji
                LEFT JOIN
                    (SELECT k.KodeKaryawan, k.Nama, pph.KodeGolongan, pph.Jenis, COALESCE(SUM(ppd.QtyCek),0) as Total_produksi, ngi.NamaGroupItem
                    FROM prod_produksiheader pph
                    JOIN prod_produksidetail ppd ON pph.KodeProduksi = ppd.KodeProduksi
                    INNER JOIN karyawans k ON k.KodeKaryawan = ppd.KodeKaryawan
                    INNER JOIN new_golongangroupitem ngi ON ngi.NoGroupItem = pph.KodeGolongan
                    WHERE pph.TanggalInput BETWEEN '" . $request->start . "' AND '" . $request->finish . "'
                    AND pph.Jenis = 'Nutuk'
                    GROUP BY k.KodeKaryawan, pph.KodeGolongan)
                    AS produksi
                ON gaji.KodeKaryawan = produksi.KodeKaryawan and gaji.KodeGolongan = produksi.KodeGolongan
                INNER JOIN new_golongangroupitem ngg ON ngg.NamaGroupItem = gaji.NamaGroupItem
                WHERE gaji.Total_gaji-produksi.Total_produksi > 0 OR gaji.Total_gaji-produksi.Total_produksi < 0
                GROUP BY gaji.KodeKaryawan, gaji.KodeGolongan) as nutuk
            ON packing.kodekaryawan = nutuk.kodekaryawan AND packing.kodegolongan = nutuk.kodegolongan"
        );

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
        $buku_packing = $request->buku_packing;
        $cek_packing = $request->cek_packing;
        $hutang_packing = $request->hutang_packing;
        $gaji_packing = $request->gaji_packing;
        $buku_nutuk = $request->buku_nutuk;
        $cek_nutuk = $request->cek_nutuk;
        $hutang_nutuk = $request->hutang_nutuk;
        $gaji_nutuk = $request->gaji_nutuk;
        $total = $request->total;
        foreach ($karyawan as $key => $value) {
            DB::table('prod_hutangdetail')->insert([
                'IDHutang' => $id,
                'KodeKaryawan' => $karyawan[$key],
                'KodeGolongan' => $golongan[$key],
                'QtyBuku_Packing' => $buku_packing[$key],
                'QtyCek_Packing' => $cek_packing[$key],
                'QtyHutang_Packing' => $hutang_packing[$key],
                'Gaji_Packing' => $gaji_packing[$key],
                'QtyBuku_Nutuk' => $buku_nutuk[$key],
                'QtyCek_Nutuk' => $cek_nutuk[$key],
                'QtyHutang_Nutuk' => $hutang_nutuk[$key],
                'Gaji_Nutuk' => $gaji_nutuk[$key],
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
