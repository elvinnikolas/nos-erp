@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card uper">
                <div class="x_panel">
                    <div class="x_title">
                        <h1>Tambah Data Karyawan</h1>
                    </div>
                    <div class="x_content">
                        <form action="{{ route('masterkaryawan.store') }}" method="post" style="display:inline-block;">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label>Kode Karyawan: </label>
                                <input readonly type="text" value="{{ $newID }}" name="KodeKaryawan" placeholder="Kode Karyawan" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nama Karyawan: </label>
                                <input type="text" required="required" type="text" name="Nama" placeholder="Nama Karyawan" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Jabatan: </label>
                                <select name="Jabatan" id="Jabatan" class="form-control">
                                    <option value="Driver">Driver</option>
                                    <option value="Sales">Sales</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Alamat: </label>
                                <input type="text" required="required" name="Alamat" placeholder="Alamat" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis kelamin</label>
                                <select name="JenisKelamin" id="JenisKelamin" class="form-control">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kota: </label>
                                <input type="text" name="Kota" placeholder="Kota" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Telepon: </label>
                                <input type="text" name="Telepon" placeholder="Telepon" class="form-control">
                            </div>
                            <br>
                            <button class="btn btn-success" style="width:120px;">Simpan</button>
                        </form>
                        <form action="{{ route('masterkaryawan.index') }}" method="get">
                            <button class="btn btn-danger" style="width:120px;">Batal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection