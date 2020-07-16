<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\karyawan;
use DB;
use Datatables;

class MasterKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('master.karyawan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $last_id = DB::select('SELECT * FROM karyawans ORDER BY KodeKaryawan DESC LIMIT 1');

        //Auto generate ID
        if ($last_id == null) {
            $newID = "KAR-001";
        } else {
            $string = $last_id[0]->KodeKaryawan;
            $id = substr($string, -3, 3);
            $new = $id + 1;
            $new = str_pad($new, 3, '0', STR_PAD_LEFT);
            $newID = "KAR-" . $new;
        }

        return view('master.karyawan.create', compact('newID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'KodeKaryawan' => 'required',
            'Nama' => 'required',
            'Alamat' => 'required',
            'Jabatan' => 'required',
        ]);

        karyawan::create([
            'KodeKaryawan' => $request->KodeKaryawan,
            'Nama' => $request->Nama,
            'Alamat' => $request->Alamat,
            'Kota' => $request->Kota,
            'Telepon' => $request->Telepon,
            'JenisKelamin' => $request->JenisKelamin,
            'KodeUser' => \Auth::user()->name,
            'Status' => 'OPN',
            'Jabatan' => $request->Jabatan
        ]);

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Tambah karyawan ' . $request->KodeKaryawan,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $pesan = 'Karyawan ' . $request->Nama . ' berhasil ditambahkan';
        return redirect('/masterkaryawan')->with(['created' => $pesan]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = DB::table('karyawans')->get()->where('KodeKaryawan', $id);
        return view('master.karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'KodeKaryawan' => 'required',
            'Nama' => 'required',
            'Alamat' => 'required',
            'Jabatan' => 'required',
        ]);

        DB::table('karyawans')->where('KodeKaryawan', $request->KodeKaryawan)->update([
            'KodeKaryawan' => $request->KodeKaryawan,
            'Nama' => $request->Nama,
            'Alamat' => $request->Alamat,
            'Kota' => $request->Kota,
            'Telepon' => $request->Telepon,
            'KodeUser' => \Auth::user()->name,
            'Status' => 'OPN',
            'Jabatan' => $request->Jabatan,
            'JenisKelamin' => $request->JenisKelamin,
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Update karyawan ' . $request->KodeKaryawan,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $pesan = 'Karyawan ' . $request->Nama . ' berhasil diubah';
        return redirect('/masterkaryawan')->with(['edited' => $pesan]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karyawan = karyawan::find($id);
        $karyawan->Status = 'DEL';
        $karyawan->save();

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Hapus karyawan ' . $id,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $karyawan = DB::table('karyawans')->get()->where('KodeKaryawan', $id);
        foreach ($karyawan as $kar) {
            $pesan = 'karyawan ' . $kar->Nama . ' berhasil dihapus';
        }
        return redirect('/masterkaryawan')->with(['deleted' => $pesan]);
    }

    public function apiOPN()
    {
        $karyawan = DB::table('karyawans')
            ->where('Status', 'OPN')
            ->get();

        return Datatables::of($karyawan)
            ->addColumn('action', function ($karyawan) {
                return
                    '<form style="display:inline-block;" type="submit" action="/masterkaryawan/' . $karyawan->KodeKaryawan . '/edit" method="get">' .
                    '<button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>&nbsp;Ubah</button></form>' .

                    '<form style="display:inline-block;" action="/masterkaryawan/delete/' . $karyawan->KodeKaryawan . '" method="get" onsubmit="return showConfirm()">' .
                    '<button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>&nbsp;Hapus</button></form>';
            })
            ->make(true);
    }
}
