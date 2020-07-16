<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\checkPassword;
use DB;
use Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->where('status', 'OPN')->get();
        return view('usercontrol.user.index', compact('users'));
    }

    public function add()
    {
        return view('usercontrol.user.add');
    }

    public function showreset($id)
    {
        $users = DB::table('users')->where('name', $id)->get();
        return view('usercontrol.user.resetPassword', compact('users'));
    }

    public function showchange($id)
    {
        $users = DB::table('users')->where('name', $id)->get();
        return view('usercontrol.user.changePassword', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users',
            'password' => 'confirmed|min:6',
        ]);

        DB::table('users')->insert([
            'name' => $request->username,
            'fullname' => $request->name,
            'password' => Hash::make($request->password),
            'status' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Tambah user ' . $request->username,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $pesan = 'User ' . $request->name . ' berhasil ditambahkan';
        return redirect('/user')->with(['created' => $pesan]);
    }

    public function reset(Request $request)
    {
        $this->validate($request, [
            'password' => 'confirmed|min:6',
        ]);

        DB::table('users')->where('name', $request->name)->update([
            'password' => Hash::make($request->password)
        ]);

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Reset password ' . $request->name,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $pesan = 'Password user ' . $request->name . ' berhasil diubah';
        return redirect('/user')->with(['edited' => $pesan]);
    }

    public function change(Request $request)
    {
        $this->validate($request, [
            'password' => [new checkPassword],
            'newpassword' => 'confirmed|min:6',
        ]);

        DB::table('users')->where('name', $request->name)->update([
            'password' => Hash::make($request->newpassword)
        ]);

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Ubah password ' . $request->name,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $pesan = 'Password berhasil diubah';
        return redirect('/home')->with(['changepassword' => $pesan]);
    }

    public function destroy($id)
    {
        DB::table('users')->where('name', $id)->update([
            'Status' => 'DEL'
        ]);

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Hapus user ' . $id,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $pesan = 'User ' . $id . ' berhasil dihapus';
        return redirect('/user')->with(['deleted' => $pesan]);
    }
}
