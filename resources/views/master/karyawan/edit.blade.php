@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Edit Data Karyawan</h1>
                </div>
                <div class="x_content">
                    @foreach($karyawan as $kar)
                    <form action="{{ route('masterkaryawan.update',$kar->KodeKaryawan) }}" method="post" style="display:inline-block;">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Kode Karyawan: </label>
                            <input readonly type="text" value="{{ $kar->KodeKaryawan }}" name="KodeKaryawan" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nama Karyawan: </label>
                            <input type="text" value="{{ $kar->Nama }}" required="required" type="text" name="Nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Jabatan: </label>
                            <select name="Jabatan" value="{{ $kar->Jabatan }}" id="Jabatan" class="form-control">
                                @if($kar->Jabatan == "Driver")
                                <option value="Driver" selected>Driver</option>
                                <option value="Sales">Sales</option>
                                @elseif($kar->Jabatan == "Sales")
                                <option value="Driver">Driver</option>
                                <option value="Sales" selected>Sales</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Alamat: </label>
                            <textarea class="form-control" name="Alamat" placeholder="Alamat" required>{{ $kar->Alamat }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis kelamin</label>
                            <select name="JenisKelamin" value="{{ $kar->JenisKelamin }}" id="JenisKelamin" class="form-control">
                                @if($kar->JenisKelamin == "Laki-laki")
                                <option value="Laki-laki" selected>Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                                @elseif($kar->JenisKelamin == "Perempuan")
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan" selected>Perempuan</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kota: </label>
                            <input type="text" name="Kota" value="{{ $kar->Kota }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Telepon: </label>
                            <input type="text" name="Telepon" value="{{ $kar->Telepon }}" class="form-control">
                        </div>
                        <br>
                        <button class="btn btn-success" style="width:120px;">Simpan</button>
                    </form>
                    @endforeach
                    <form action="{{ route('masterkaryawan.index') }}" method="get">
                        <button class="btn btn-danger" style="width:120px;">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection