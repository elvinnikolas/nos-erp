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
                    <h1 id="header">Gaji Karyawan</h1><br>
                    <!-- Alert -->
                    @if(session()->get('created'))
                    <div class="alert alert-success alert-dismissible fade-show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session()->get('created') }}
                    </div>

                    @elseif(session()->get('edited'))
                    <div class="alert alert-info alert-dismissible fade-show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session()->get('edited') }}
                    </div>

                    @elseif(session()->get('deleted'))
                    <div class="alert alert-danger alert-dismissible fade-show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session()->get('deleted') }}
                    </div>

                    @elseif(session()->get('warning'))
                    <div class="alert alert-warning alert-dismissible fade-show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session()->get('warning') }}
                    </div>
                    @endif
                    <form action="{{ url('/gaji/create') }}" method="get" style="display:inline-block;">
                        <input type="submit" value="Proses Gaji Karyawan" class="btn btn-success">
                    </form>
                    <form action="{{ url('/gaji/show') }}" method="get" style="display:inline-block;">
                        <input type="submit" value="Tampilkan Histori Setahun" class="btn btn-info">
                    </form>
                    <form style="display:inline-block;">
                        <button class="btn btn-default" data-toggle="collapse" data-target="#filteritem" type="button">
                            Filter Data Gaji
                        </button>
                    </form>
                    <br>

                    <!-- ID filteritem -->
                    <div id="filteritem" class="collapse">
                        <div class="row">
                            <form action="{{ url('/gaji/filter') }}" method="post">
                                @csrf
                                @method('POST')

                                <div class="x_content">
                                    <div class="col-md-3 col-sm-3">
                                        <div class="form-group">
                                            <label>Karyawan:</label>
                                            <select class="form-control" name="karyawan" id="karyawan">
                                                <option value="KAR-000" selected>Semua Karyawan</option>
                                                @foreach($list_karyawan as $data)
                                                <option value="{{ $data->KodeKaryawan }}">
                                                    {{ $data->Nama }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <div class="form-group">
                                            <label>Bulan:</label>
                                            <select class="form-control" name="bulan" id="bulan">
                                                <option value="0" selected>Semua Bulan</option>
                                                <option value="1">Januari</option>
                                                <option value="2">Februari</option>
                                                <option value="3">Maret</option>
                                                <option value="4">April</option>
                                                <option value="5">Mei</option>
                                                <option value="6">Juni</option>
                                                <option value="7">Juli</option>
                                                <option value="8">Agustus</option>
                                                <option value="9">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <div class="form-group">
                                            <label>Tahun:</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control" name="tahun" value="{{$year_now}}" id="tahun" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <div class="form-group">
                                            <label></label>
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-md btn-block btn-success">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- ID filtergaji -->
                    <div id="filtergaji">
                        <div class="x_content">
                            <div class="col-md-12">
                                <table class="table table-striped" id="table-gaji">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Kode Gaji</th>
                                            <th>Nama</th>
                                            <th>Total Hari Kerja</th>
                                            <th>Bonus</th>
                                            <th>Total Gaji</th>
                                            <th>Tanggal Gaji</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($gaji as $data)
                                        <tr>
                                            <td>{{ $data->KodeGaji }}</td>
                                            <td>{{ $data->Nama }}</td>
                                            <td>{{ $data->TotalHariKerja }}</td>
                                            <td>{{ $data->Bonus }}</td>
                                            <td>{{ $data->TotalGaji }}</td>
                                            <td>{{ $data->TanggalGaji }}</td>
                                            <td>
                                                <form style="display:inline-block;" type="submit" action="/gaji/edit/{{$data->KodeGaji}}" method="get">
                                                    <button class="btn btn-primary btn-xs">
                                                        <i class="fa fa-pencil"></i>&nbsp;Ubah
                                                    </button>
                                                </form>

                                                <form style="display:inline-block;" action="/gaji/delete/{{$data->KodeGaji}}" method="get" onsubmit="return showConfirm()">
                                                    <button class="btn btn-danger btn-xs">
                                                        <i class="fa fa-trash"></i>&nbsp;Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#bulan').select2({
        width: '100%'
    });
    $('#karyawan').select2({
        width: '100%'
    });

    $('#table-gaji').css({
        width: '100%'
    });

    $('#table-gaji').DataTable();

    function showConfirm() {
        if (confirm("Apakah anda yakin ingin menghapus data ini?")) {
            return true;
        } else {
            return false;
        }
    }
</script>
@endpush