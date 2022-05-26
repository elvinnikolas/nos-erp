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
                    <h1 id="header">Absensi Karyawan</h1><br>
                    <a href="{{ url('/absensi/absen') }}" style="display: inline-block;" class="btn btn-default">Absen Karyawan</a>
                    <a href="{{ url('/absensi/histori') }}" style="display: inline-block;" class="btn btn-info">Histori Absen Setahun</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection