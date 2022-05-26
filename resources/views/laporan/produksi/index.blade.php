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
                <!-- <div class="x_title"> -->
                <h1 id="header">Laporan Produksi</h1><br>
                <form style="display:inline-block;">
                    <button class="btn btn-default" data-toggle="collapse" data-target="#show" type="button">
                        Tampilkan
                    </button>
                </form>
                <form style="display:inline-block;">
                    <button class="btn btn-default" data-toggle="collapse" data-target="#filtergolongan" type="button">
                        Filter Golongan
                    </button>
                </form>
                <form style="display:inline-block;">
                    <button class="btn btn-default" data-toggle="collapse" data-target="#filteritem" type="button">
                        Filter Item
                    </button>
                </form>
                <br>

                <div id="show" class="collapse">
                    <div class="row">
                        <form action="{{ url('/laporanproduksi/show') }}" method="post">
                            @csrf
                            <div class="col-md-3">
                                <label for="inputDate">Mulai</label>
                                <div class="input-group date" id="inputDate">
                                    <input type="text" class="form-control" name="start" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <label for="inputDate">Sampai</label>
                                <div class="input-group date" id="inputDate2">
                                    <input type="text" class="form-control" name="finish" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Jenis Produksi</label>
                                <select class="form-control" name="jenis" id="jenis">
                                    <option value="golongan">Per Golongan</option>
                                    <option value="item">Per Item</option>
                                </select>
                                <label></label>
                                <input type="submit" class="form-control btn btn-primary" value="Tampilkan">
                            </div>
                            <div class="col-md-3">
                            </div>
                        </form>
                    </div>
                </div>

                <div id="filtergolongan" class="collapse">
                    <div class="x_content">
                        <div class="row">
                            <form action="{{ url('/laporanproduksi/filtergolongan') }}" method="post">
                                @csrf
                                <div class="col-md-3">
                                    <label for="inputDate">Mulai</label>
                                    <div class="input-group date" id="inputDate3">
                                        <input type="text" class="form-control" name="start" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    <label for="inputDate">Sampai</label>
                                    <div class="input-group date" id="inputDate4">
                                        <input type="text" class="form-control" name="finish" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Golongan</label>
                                    <select class="form-control" name="golongan" id="golongan">
                                        @foreach($golongans as $gol)
                                        <option value={{$gol->KodeGolongan}}>{{$gol->NamaGolongan}}</option>
                                        @endforeach
                                    </select>
                                    <label></label>
                                    <input type="submit" class="form-control btn btn-primary" value="Filter" name="">
                                </div>
                                <div class="col-md-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="filteritem" class="collapse">
                    <div class="x_content">
                        <div class="row">
                            <form action="{{ url('/laporanproduksi/filteritem') }}" method="post">
                                @csrf
                                <div class="col-md-3">
                                    <label for="inputDate">Mulai</label>
                                    <div class="input-group date" id="inputDate5">
                                        <input type="text" class="form-control" name="start" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    <label for="inputDate">Sampai</label>
                                    <div class="input-group date" id="inputDate6">
                                        <input type="text" class="form-control" name="finish" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Item</label>
                                    <select class="form-control" name="item" id="item">
                                        @foreach($items as $item)
                                        <option value={{$item->KodeItem}}>{{$item->NamaItem}}</option>
                                        @endforeach
                                    </select>
                                    <label></label>
                                    <input type="submit" class="form-control btn btn-primary" value="Filter" name="">
                                </div>
                                <div class="col-md-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="x_panel">
                <div class="x_body">
                    @if($filter)
                    @csrf
                    @if($filtergolongan)
                    <table class="table table-striped" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Karyawan</th>
                                <th>Golongan</th>
                                <th>Hasil Produksi</th>
                                <th>Hasil Cek</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produksi as $p)
                            <tr>
                                <td>{{$p->Nama}}</td>
                                <td>{{$p->golongan}}</td>
                                <td>{{$p->produksi}}</td>
                                <td>{{$p->cek}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @elseif($filteritem)
                    <table class="table table-striped" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Karyawan</th>
                                <th>Item</th>
                                <th>Hasil Produksi</th>
                                <th>Hasil Cek</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produksi as $p)
                            <tr>
                                <td>{{$p->Nama}}</td>
                                <td>{{$p->item}}</td>
                                <td>{{$p->produksi}}</td>
                                <td>{{$p->cek}}</td>
                                <td>{{$p->satuan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#table').DataTable({
        "order": [],
        "pageLength": 25
    });
    $('#golongan').select2({
        width: '100%'
    });
    $('#item').select2({
        width: '100%'
    });

    $('#inputDate').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY-MM-DD'
    });
    $('#inputDate2').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY-MM-DD'
    });
    $('#inputDate3').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY-MM-DD'
    });
    $('#inputDate4').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY-MM-DD'
    });
    $('#inputDate5').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY-MM-DD'
    });
    $('#inputDate6').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY-MM-DD'
    });
</script>
@endpush