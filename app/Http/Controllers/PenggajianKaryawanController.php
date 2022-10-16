<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\penggajian;
use App\Model\golongan;

use DB;

class PenggajianKaryawanController extends Controller
{
    public function index()
    {
        $karyawan = DB::table('karyawans')
            ->where('Status', 'OPN')
            ->select('KodeKaryawan', 'Nama')
            ->orderBy('Nama', 'asc')
            ->get();

        $golongan = golongan::getGolongan();
        $dataGolongan = penggajian::getDataGolongan();
        /*$golonganBorongan = penggajian::getDataGolongan('borongan');
        $golonganNonBorongan = penggajian::getDataGolongan('non-borongan');*/

        return view('penggajian.index', compact('karyawan', 'golongan', 'dataGolongan'));
    }

    public function absen(Request $request)
    {
        $result = penggajian::setAbsen($request->all());
        return response()->json(['status' => $result]);
    }

    public function gaji(Request $request)
    {
        $result = penggajian::setGaji($request->all());
        return response()->json(['status' => $result]);
    }

    public function laporan()
    {
    }

    public function index_selesai()
    {
        $gaji = DB::select(
            "SELECT gaji.*, gol.NamaGolongan 
            FROM new_gajian gaji
            INNER JOIN new_golongan gol 
            ON gaji.NoGolongan = gol.NoGolongan
            WHERE gaji.Status = 'OPN'
            ORDER BY gaji.NoGaji DESC"
        );
        $filter = false;
        return view('penggajian.selesai.index', compact('gaji', 'filter'));
    }

    public function show(Request $request)
    {
        $gaji = DB::select(
            "SELECT gaji.*, gol.NamaGolongan 
            FROM new_gajian gaji
            INNER JOIN new_golongan gol 
            ON gaji.NoGolongan = gol.NoGolongan
            WHERE gaji.Status = 'OPN'
            ORDER BY gaji.NoGaji DESC"
        );
        foreach ($gaji as $gj) {
            $gj->TanggalGaji = \Carbon\Carbon::parse($gj->TanggalGaji)->format('d-m-Y');
        }
        $filter = true;
        return view('penggajian.selesai.index', compact('gaji', 'filter'));
    }

    public function filter(Request $request)
    {
        $gaji = DB::select(
            "SELECT gaji.*, gol.NamaGolongan 
            FROM new_gajian gaji
            INNER JOIN new_golongan gol 
            ON gaji.NoGolongan = gol.NoGolongan
            WHERE gaji.TanggalGaji = '" . $request->tanggal . "' AND gaji.Status = 'OPN'
            ORDER BY gaji.NoGaji DESC"
        );
        foreach ($gaji as $gj) {
            $gj->TanggalGaji = \Carbon\Carbon::parse($gj->TanggalGaji)->format('d-m-Y');
        }
        $filter = true;
        return view('penggajian.selesai.index', compact('gaji', 'filter'));
    }

    public function index_cashbon()
    {
        $cashbon = DB::select(
            "SELECT *
            FROM new_gajiancashbon
            WHERE Status = 'OPN'
            ORDER BY NoCashbon DESC"
        );

        foreach ($cashbon as $cb) {
            $cb->Tanggal = \Carbon\Carbon::parse($cb->Tanggal)->format('d-m-Y');
        }

        return view('penggajian.cashbon.index', compact('cashbon'));
    }

    public function create_cashbon()
    {
        $karyawan = DB::table('karyawans')
            ->where('Status', 'OPN')
            ->select('KodeKaryawan', 'Nama')
            ->orderBy('Nama', 'asc')
            ->get();

        return view('penggajian.cashbon.create', compact('karyawan'));
    }

    public function store_cashbon(Request $request)
    {
        $last_id = DB::select("SELECT * FROM new_gajiancashbon ORDER BY NoCashbon DESC LIMIT 1");
        $year_now = date('y');
        $month_now = date('m');

        if ($last_id == null) {
            $newID = "CB-" . $year_now . $month_now . "001";
        } else {
            $string = $last_id[0]->KodeCashbon;
            $id = substr($string, -3, 3);
            $month = substr($string, -5, 2);
            $year = substr($string, -7, 2);

            if ((int) $year_now > (int) $year) {
                $newID = "001";
            } else if ((int) $month_now > (int) $month) {
                $newID = "001";
            } else {
                $newID = $id + 1;
                $newID = str_pad($newID, 3, '0', STR_PAD_LEFT);
            }
            $newID = "CB-" . $year_now . $month_now . $newID;
        }

        DB::table('new_gajiancashbon')->insert([
            'KodeCashbon' => $newID,
            'Tanggal' => $request->Tanggal,
            'TotalCashbon' => $request->TotalCashbon,
            'TotalSetoran' => $request->TotalSetoran,
            'Status' => 'OPN',
            'modified_at' => \Carbon\Carbon::now(),
        ]);

        $nominal = $request->Nominal;
        $kode = $request->KodeKaryawan;
        foreach ($nominal as $key => $value) {
            if ($value && $value !== 0) {
                DB::table('new_gajiancashbondetail')->insert([
                    'KodeCashbon' => $newID,
                    'KodeKaryawan' => $kode[$key],
                    'Nominal' => $value,
                    'modified_at' => \Carbon\Carbon::now(),
                ]);
            }
        }

        // DB::table('eventlogs')->insert([
        //     'KodeUser' => \Auth::user()->name,
        //     'Tanggal' => \Carbon\Carbon::now(),
        //     'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
        //     'Keterangan' => 'Tambah pemesanan penjualan ' . $newID,
        //     'Tipe' => 'OPN',
        //     'created_at' => \Carbon\Carbon::now(),
        //     'updated_at' => \Carbon\Carbon::now(),
        // ]);

        // $pesan = 'SO ' . $newID . ' berhasil ditambahkan';
        // return redirect('/sopenjualan')->with(['created' => $pesan]);

        return redirect('/penggajiancashbon');
    }

    public function show_cashbon($id)
    {
        $cashbon = DB::table('new_gajiancashbon')
            ->where('KodeCashbon', $id)
            ->first();

        $cashbon->Tanggal = \Carbon\Carbon::parse($cashbon->Tanggal)->format('d-m-Y');

        $karyawan = DB::select(
            "SELECT k.KodeKaryawan, k.Nama, c.Nominal 
            FROM karyawans k
            INNER JOIN new_gajiancashbondetail c
            ON c.KodeKaryawan = k.KodeKaryawan AND c.KodeCashbon = '" . $id . "'
            WHERE k.Status = 'OPN'
            ORDER BY k.Nama ASC"
        );

        return view('penggajian.cashbon.show', compact('cashbon', 'karyawan'));
    }

    public function edit_cashbon($id)
    {
        $cashbon = DB::table('new_gajiancashbon')
            ->where('KodeCashbon', $id)
            ->first();

        $karyawan = DB::select(
            "SELECT k.KodeKaryawan, k.Nama, c.Nominal 
            FROM karyawans k
            LEFT JOIN new_gajiancashbondetail c
            ON c.KodeKaryawan = k.KodeKaryawan AND c.KodeCashbon = '" . $id . "'
            WHERE k.Status = 'OPN'
            ORDER BY k.Nama ASC"
        );

        return view('penggajian.cashbon.edit', compact('cashbon', 'karyawan'));
    }

    public function update_cashbon(Request $request, $id)
    {
        DB::table('new_gajiancashbon')
            ->where('KodeCashbon', $id)
            ->update([
                'Tanggal' => $request->Tanggal,
                'TotalCashbon' => $request->TotalCashbon,
                'TotalSetoran' => $request->TotalSetoran,
                'modified_at' => \Carbon\Carbon::now(),
            ]);

        DB::table('new_gajiancashbondetail')
            ->where('KodeCashbon', $id)
            ->delete();

        $nominal = $request->Nominal;
        $kode = $request->KodeKaryawan;
        foreach ($nominal as $key => $value) {
            if ($value && $value !== 0) {
                DB::table('new_gajiancashbondetail')->insert([
                    'KodeCashbon' => $id,
                    'KodeKaryawan' => $kode[$key],
                    'Nominal' => $value,
                    'modified_at' => \Carbon\Carbon::now(),
                ]);
            }
        }

        return redirect('/penggajiancashbon');
    }

    public function destroy_cashbon($id)
    {
        DB::table('new_gajiancashbon')->where('KodeCashbon', $id)->update([
            'Status' => 'DEL'
        ]);

        return redirect('/penggajiancashbon');
    }
}
