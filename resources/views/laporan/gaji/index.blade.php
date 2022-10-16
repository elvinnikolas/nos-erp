@extends('index')
@section('content')
<style type="text/css">
    #header {
        text-align: center;
    }

    #right {
        text-align: right;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1 id="header">Laporan Gaji</h1><br>
                </div>
                <form style="display:inline-block;">
                    <button class="btn btn-default" data-toggle="collapse" data-target="#show" type="button">
                        Pilih Tanggal Gajian
                    </button>
                </form>
                <div id="show" class="collapse">
                    <div class="x_content">
                        <div class="row">
                            <form action="{{ url('/laporangaji/show') }}" method="post">
                                @csrf
                                <div class="col-md-3">
                                    <label for="inputDate">Tanggal</label>
                                    <div class="input-group date" id="inputDate">
                                        <input type="text" class="form-control" name="Tanggal">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <div class="form-group">
                                        <label for=""> </label>
                                        <div class="input-group">
                                            <button type="submit" class="btn btn-md btn-block btn-success">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if($filter == true)
            <div class="x_panel">
                <br><br>
                <div class="x_body">
                    <div class="col-md-12">
                        <div class="col-md-5">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th id="header">GOLONGAN</th>
                                        <th id="header">GAJI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gajian as $gaji)
                                    <tr>
                                        <td>{{ $gaji->Golongan }}</td>
                                        <td>Rp. {{ number_format($gaji->Total, 0, ',', '.') }},-</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td id="header"><b>TOTAL GAJI</b></td>
                                        <td>Rp. {{ number_format($total_gaji, 0, ',', '.') }},-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            @if($cashbon)
                            <label>Total Gaji</label>
                            <input type="text" readonly class="form-control" value="{{"Rp. " . number_format(($total_gaji), 0, ',', '.') .",-"}}">
                            <br>
                            <label>Total Tunai</label>
                            <input type="text" readonly class="form-control" value="{{"Rp. " . number_format(($cashbon->TotalSetoran), 0, ',', '.') .",-"}}">
                            <br>
                            <label>Total Cashbon</label>
                            <input type="text" readonly class="form-control" value="{{"Rp. " . number_format(($cashbon->TotalCashbon), 0, ',', '.') .",-"}}">
                            <br>
                            <label>Sisa Uang</label>
                            <input type="text" readonly class="form-control" value="{{"Rp. " . number_format(($cashbon->TotalSetoran+$cashbon->TotalCashbon-$total_gaji), 0, ',', '.') .",-"}}">
                            @else
                            <h2>Tidak ada data setoran & cashbon ditemukan pada tanggal berikut</h2>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
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