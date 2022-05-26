@extends('index')
@section('content')
<style type="text/css">
    form {
        margin: 20px 0;
    }

    form input,
    button {
        padding: 5px;
    }

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
            <div class="x_panel">
                <div class="x_title">
                    <h1 id="header">Buat Kwitansi</h1>
                </div>
                <div class="x_content">
                    <form action="{{ url('/kwitansipiutang/create/kwitansi')}}" method="post" class="formsub">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <br>
                                    <div class="form-group">
                                        <label for="pelanggan">Pilih Pelanggan</label>
                                        <select name="pelanggan" class="form-control" id="pelanggan">
                                            <option value="0">- Pilih Pelanggan -</option>
                                            @foreach($pelanggans as $pelanggan)
                                            <option name="pelanggan" value="{{$pelanggan->KodePelanggan}}">{{$pelanggan->NamaPelanggan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <input type="submit" name="" value="Buat Kwitansi" class="btn btn-primary">
                            </div>
                            <div class="so-detail-container">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#pelanggan').select2()
</script>
@endpush