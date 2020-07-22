@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Pengeluaran Tambahan</h1><br>

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

                    @elseif(session()->get('error'))
                    <div class="alert alert-danger alert-dismissible fade-show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session()->get('error') }}
                    </div>
                    @endif

                    <div class="x_content">
                        <br>
                        <a href="{{ url('/pengeluarantambahan/create')}}" class="btn btn-primary">
                            <i class="fa fa-plus" aria-hidden="true"></i> Tambah Pengeluaran
                        </a>
                        <br><br>
                        <table class="table table-light" id="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Gudang</th>
                                    <th>Pengeluaran</th>
                                    <th>Keterangan</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            @foreach ($pengeluarantambahan as $p)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($p->Tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $p->NamaLokasi }}</td>
                                <td>{{ $p->Nama}}</td>
                                <td>{{ $p->Keterangan }}</td>
                                <td>Rp.{{ number_format($p->Total, 0, ',', '.') }},-</td>
                                <td>
                                    <a href="{{ url('/pengeluarantambahan/destroy/'.$p->id)}}" class="btn-xs btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                        <i class="fa fa-trash" aria-hidden="true"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#table').DataTable({
        "order": [
            [0, "desc"]
        ]
    });
</script>
@endpush