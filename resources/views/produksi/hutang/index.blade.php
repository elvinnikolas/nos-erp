@extends('index')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 style="text-align:center">HUTANG PRODUKSI</h1>

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
                    @endif

                    <a href="{{ route('hutangproduksi.select') }}" class="btn btn-success">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Hitung Hutang
                    </a><br><br>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_body">
                    <table class="table table-striped" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Tanggal Gajian</th>
                                <th>Tanggal Produksi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hutang as $hut)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($hut->TanggalGajian)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($hut->TanggalAwal)->format('d-m-Y') }}&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;{{ \Carbon\Carbon::parse($hut->TanggalAkhir)->format('d-m-Y') }}</td>
                                <td>{{ $hut->Status == 'OPN' ? 'Belum Lunas' : 'Lunas' }}</td>
                                <td>
                                    @if($hut->Status != 'CFM')
                                    <a href="{{ url('/hutangproduksi/confirm/'.$hut->id)}}" class="btn-xs btn btn-info" onclick="return confirm('Konfirmasi data ini?')">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </a>
                                    @endif
                                    <a href="{{ url('/hutangproduksi/show/'. $hut->id )}}" class="btn-xs btn btn-primary">
                                        <i class="fa fa-eye" aria-hidden="true"></i> Lihat
                                    </a>
                                    @if($hut->Status == 'OPN')
                                    <a href="{{ url('/hutangproduksi/destroy/'.$hut->id)}}" class="btn-xs btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                        <i class="fa fa-trash" aria-hidden="true"></i> Hapus
                                    </a>
                                    @endif
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
@endsection

@push('scripts')
<script>
    $('#table').DataTable({
        "order": [],
        "pageLength": 25
    });

    function showConfirm() {
        if (confirm("Apakah anda yakin ingin menghapus data ini?")) {

        } else {
            return false;
        }
    }
</script>
@endpush