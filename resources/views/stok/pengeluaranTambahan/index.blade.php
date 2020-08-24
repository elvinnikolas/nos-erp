@extends('index')
@section('content')
<style type="text/css">
    #black {
        color: black;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Biaya Operasional</h1><br>

                    <!-- Alert -->
                    @if(session()->get('created'))
                    <div class="alert alert-success alert-dismissible fade-show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <b>{{ session()->get('created') }}</b>
                    </div>

                    @elseif(session()->get('edited'))
                    <div class="alert alert-info alert-dismissible fade-show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <b>{{ session()->get('edited') }}</b>
                    </div>

                    @elseif(session()->get('deleted'))
                    <div class="alert alert-danger alert-dismissible fade-show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <b>{{ session()->get('deleted') }}</b>
                    </div>

                    @elseif(session()->get('error'))
                    <div class="alert alert-danger alert-dismissible fade-show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <b id="black">{{ session()->get('error') }}</b>
                    </div>
                    @endif

                    <div class="x_content">
                        <br>
                        <a href="{{ url('/pengeluarantambahan/create')}}" class="btn btn-primary">
                            <i class="fa fa-plus" aria-hidden="true"></i> Tambah Biaya
                        </a>
                        <br><br>
                        <table class="table table-light" id="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Kode</th>
                                    <th>Tanggal</th>
                                    <th>Gudang</th>
                                    <th>Karyawan</th>
                                    <th>Nama</th>
                                    <th>Metode</th>
                                    <th>Keterangan</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            @foreach ($pengeluarantambahan as $p)
                            <tr>
                                <td>{{ $p->KodePengeluaran }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->Tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $p->NamaLokasi }}</td>
                                <td>{{ $p->Karyawan}}</td>
                                <td>{{ $p->Nama}}</td>
                                <td>{{ $p->Metode}}</td>
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