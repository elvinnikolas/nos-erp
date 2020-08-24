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
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label>Nama:</label>
                                    <input type="text" required="required" name="Nama" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Karyawan:</label>
                                    <input type="text" required="required" name="Karyawan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal:</label>
                                    <div class="input-group date" id="inputDate">
                                        <input type="text" class="form-control" name="Tanggal" id="inputDate" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
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
                                    <label>Metode Pembayaran:</label>
                                    <select name="Metode" class="form-control">
                                        <option value="Cash">Cash</option>
                                        <option value="Transfer">Transfer</option>
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#inputDate').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY-MM-DD'
    });
</script>
@endpush