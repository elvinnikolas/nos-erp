@extends('index')
@section('content')
<style type="text/css">
    table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid #cdcdcd;
    }

    table th,
    table td {
        padding: 10px;
        text-align: left;
    }

    #header {
        text-align: center;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card uper">
                <div class="x_panel">
                    <div class="x_title">
                        <h1>Tambah Biaya Operasional</h1>
                    </div>
                    <div class="x_content">
                        <form action="{{ url('/pengeluarantambahan/store') }}" method="post" style="display:inline-block;">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label>Nama:</label>
                                <input type="text" required="required" name="Nama" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tanggal:</label>
                                <input type="date" required="required" name="Tanggal" class="form-control" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                            </div>
                            <div class="form-group">
                                <label>Gudang:</label>
                                <select name="KodeLokasi" class="form-control">
                                    @foreach($lokasi as $lok)
                                    <option value="{{$lok->KodeLokasi}}">{{$lok->NamaLokasi}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Mata Uang:</label>
                                <select name="KodeMataUang" class="form-control">
                                    @foreach($matauang as $mu)
                                    <option value="{{$mu->KodeMataUang}}">{{$mu->NamaMataUang}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Total:</label>
                                <input type="number" required="required" name="Total" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Keterangan:</label>
                                <textarea id="Keterangan" name="Keterangan" class="form-control"></textarea>
                            </div>
                            <button class="btn btn-success" style="width:120px;">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection