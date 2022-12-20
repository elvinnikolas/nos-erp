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
                    <h1 id="header">Tunai Cashbon</h1><br>
                </div>
                <a href="{{ url('/penggajiancashbon/create')}}" class="btn btn-success">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Tambah Data
                </a>
                <br><br>
                <div class="x_body">
                    @csrf
                    <table class="table table-light table-striped" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Kode</th>
                                <th>Tanggal</th>
                                <th>Total Setoran</th>
                                <th>Total Cashbon</th>
                                <th width="20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cashbon as $cb)
                            <tr>
                                <td>{{ $cb->KodeCashbon }}</td>
                                <td>{{ $cb->Tanggal }}</td>
                                <td>Rp. {{ number_format($cb->TotalSetoran, 0, ',', '.') }},-</td>
                                <td>Rp. {{ number_format($cb->TotalCashbon, 0, ',', '.') }},-</td>
                                <td>
                                    <a href="{{ url('/penggajiancashbon/show/'.$cb->KodeCashbon ) }}" class="btn-xs btn btn-primary">
                                        <i class="fa fa-eye" aria-hidden="true"></i> Lihat
                                    </a>
                                    <a href="{{ url('/penggajiancashbon/edit/'.$cb->KodeCashbon ) }}" class="btn-xs btn btn-success">
                                        <i class="fa fa-pencil" aria-hidden="true"></i> Ubah
                                    </a>
                                    <a href="{{ url('/penggajiancashbon/delete/'.$cb->KodeCashbon ) }}" class="btn-xs btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                        <i class="fa fa-trash" aria-hidden="true"></i> Hapus
                                    </a>
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