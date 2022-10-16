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
                <!-- <h1 id="header">Histori Penggajian</h1><br> -->
                <br>
                <form style="display:inline-block;">
                    <button class="btn btn-default" data-toggle="collapse" data-target="#filter" type="button">
                        Pilih Tanggal
                    </button>
                </form>
                <form action="{{ url('/penggajianselesai/show') }}" method="get" style="display:inline-block;">
                    <button class="btn btn-default" type="submit">
                        Tampilkan Semua
                    </button>
                </form>
                <br>
                <div id="filter" class="collapse">
                    <div class="x_content">
                        <div class="row">
                            <form action="{{ url('/penggajianselesai/filter') }}" method="post">
                                @csrf
                                <div class="col-md-3">
                                    <label for="inputDate">Tanggal</label>
                                    <div class="input-group date" id="inputDate">
                                        <input type="text" class="form-control" name="tanggal">
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
                <!-- </div> -->
            </div>

            @if($filter == true)
            <div class="x_panel">
                <div class="x_body">
                    @csrf
                    <table class="table table-light table-striped" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Kode Gaji</th>
                                <th>Tanggal</th>
                                <th>Golongan</th>
                                <th>Total Gaji</th>
                                <th width="20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gaji as $gj)
                            <tr>
                                <td>{{ $gj->KodeGaji }}</td>
                                <td>{{ $gj->TanggalGaji }}</td>
                                <td>{{ $gj->NamaGolongan }}</td>
                                <td>Rp. {{ number_format($gj->TotalGaji, 0, ',', '.') }},-</td>
                                <td>
                                    <a href="{{ url('/penggajian/view/'.$gj->NoGaji ) }}" class="btn-xs btn btn-primary">
                                        <i class="fa fa-eye" aria-hidden="true"></i> Lihat
                                    </a>
                                    <a href="{{ url('/penggajian/edit/'.$gj->NoGaji ) }}" class="btn-xs btn btn-success">
                                        <i class="fa fa-pencil" aria-hidden="true"></i> Ubah
                                    </a>
                                    <a href="{{ url('/penggajian/delete/'.$gj->NoGaji ) }}" class="btn-xs btn btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
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
    $('#inputDate').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY-MM-DD'
    });
</script>
@endpush