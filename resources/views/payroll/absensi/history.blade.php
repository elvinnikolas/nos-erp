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

                    <div>
                        <div class="x_content">
                            <div class="col-md-12">
                                <table class="table table-striped" id="table-absen">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Tanggal Absensi</th>
                                            <th>Waktu Absensi</th>
                                            <th>Kode Karyawan</th>
                                            <th>Nama Karyawan</th>
                                            <th>Status Absen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($absen as $data)
                                        <tr>
                                            <td>{{ $data->TanggalAbsen }}</td>
                                            <td>{{ $data->WaktuAbsen }}</td>
                                            <td>{{ $data->KodeKaryawan }}</td>
                                            <td>{{ $data->Nama }}</td>
                                            <td>{{ $data->StatusAbsen }}</td>
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
    $('#table-absen').css({
        width: '100%'
    });

    $('#table-absen').DataTable({
        "order": [
            [0, "desc"],
            [1, "desc"],
            [2, "asc"],
            [4, "desc"],
        ]
    });
</script>
@endpush