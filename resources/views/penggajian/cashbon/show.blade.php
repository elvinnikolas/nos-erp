@extends('index')
@section('content')
<style type="text/css">
    #header {
        text-align: center;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1 id="header">Setoran & Cashbon</h1><br>
                </div>

                <div class="x_body">
                    <div class="row">
                        <form>
                            @csrf
                            <div class="form-group">
                                <div class="control-label col-md-3">
                                    <label for="inputDate">Tanggal</label>
                                    <div class="input-group date" id="inputDate">
                                        <input type="text" readonly class="form-control" value="{{$cashbon->Tanggal}}">
                                    </div>
                                </div>
                                <div class="control-label col-md-3">
                                    <label>Total Setoran</label>
                                    <div class="input-group" id="inputTotalSetoran">
                                        <input readonly type="text" class="form-control" value="Rp. {{ number_format($cashbon->TotalSetoran, 0, ',', '.') }},-">
                                    </div>
                                </div>
                                <div class="control-label col-md-3">
                                    <label>Total Cashbon</label>
                                    <div class="input-group" id="inputTotalCashbon">
                                        <input readonly type="text" class="form-control" value="Rp. {{ number_format($cashbon->TotalCashbon, 0, ',', '.') }},-">
                                    </div>
                                </div>
                            </div>
                            <br><br><br><br><br>
                            <hr>
                            <div class="row">
                                <div class="control-label col-md-8">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Karyawan</th>
                                                <th>Nominal Cashbon</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($karyawan as $key => $data)
                                            <tr>
                                                <td>{{$data->Nama}}</td>
                                                <td><input readonly type="text" class="form-control" value="Rp. {{ number_format($data->Nominal, 0, ',', '.') }},-"></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <a href="{{ url('/penggajiancashbon')}}" class="btn btn-primary">
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection