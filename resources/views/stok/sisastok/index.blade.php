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
                <h1 id="header">Sisa Stok</h1><br>
                <form action="{{ url('/sisastok/show') }}" method="get" style="display:inline-block;">
                    <button class="btn btn-default" type="submit">
                        Tampilkan Semua
                    </button>
                </form>
                <form style="display:inline-block;">
                    <button class="btn btn-default" data-toggle="collapse" data-target="#filteritem" type="button">
                        Filter
                    </button>
                </form>
                <br>
                <div id="filteritem" class="collapse">
                    <div class="x_content">
                        <div class="row">
                            <form action="{{ url('/sisastok/filter') }}" method="post">
                                @csrf
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <label>Jenis</label>
                                        <select class="form-control" name="jenisfil" id="jenis">
                                            <option value="bahanbaku">Bahan Baku</option>
                                            <option value="bahanjadi">Bahan Jadi</option>
                                            <option value="bahansetengahjadi">Bahan Setengah Jadi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <label>Satuan</label>
                                        <select class="form-control" name="satuanfil" id="satuan">
                                            @foreach($satuan as $sat)
                                            <option value="{{$sat->KodeSatuan}}">{{$sat->KodeSatuan}}</option>
                                            @endforeach
                                        </select>
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
                <!-- </div> -->
            </div>

            <div class="x_panel">
                <div class="x_body">
                    @if($filter == true)
                    <!-- <form action="{{ url('/kartustok/print') }}" method="post"> -->
                    @csrf
                    <!-- <div class="row pull-left"> -->
                    @if($filter)
                    <input type="hidden" value="{{$jenisfil}}" name="jenisfil">
                    <input type="hidden" value="{{$satuanfil}}" name="satuanfil">
                    @endif
                    <!-- <input type="submit" name="" value="Print" class="btn btn-danger"> -->
                    <!-- </div> -->
                    <!-- </form> -->
                    <table class="table table-light table-striped" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Kode Item</th>
                                <th>Nama Item</th>
                                <th>Sisa</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->KodeItem }}</td>
                                <td>{{ $item->NamaItem }}</td>
                                <td>{{ $item->sisa }}</td>
                                <td>{{ $item->KodeSatuan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    $('#satuan').select2({
        width: '100%'
    });
</script>
@endpush