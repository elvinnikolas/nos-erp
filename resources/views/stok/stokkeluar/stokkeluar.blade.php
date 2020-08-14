@extends('index')
@section('content')
<style type="text/css">
    form {
        margin: 20px 0;
    }

    form input,
    button {
        padding: 5px;
    }

    table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    table th,
    table td {
        padding: 10px;
        text-align: left;
    }

    #header {
        text-align: center;
    }

    #black {
        color: black;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Stok Keluar</h1><br>
                    <a href="/stokkeluar/create" class="btn btn-primary">
                        <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
                        Tambah Stok Keluar
                    </a>
                </div>

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
                <div class="alert alert-warning alert-dismissible fade-show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <b id="black">{{ session()->get('error') }}</b>
                </div>
                @endif

                <div class="x_body">
                    <table class="table table-light table-striped" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Kode Stok Keluar</th>
                                <th>Gudang</th>
                                <th>Tanggal</th>
                                <th>Total Item</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stokkeluars as $stokkeluar)
                            <tr>
                                <td>{{ $stokkeluar->KodeStokKeluar}}</td>
                                <td>{{ $stokkeluar->NamaLokasi}}</td>
                                <td>{{ \Carbon\Carbon::parse($stokkeluar->Tanggal)->format('d-m-Y')}}</td>
                                <td>{{ $stokkeluar->TotalItem}}</td>
                                <td>
                                    <a href="{{ url('/stokkeluar/view/'.$stokkeluar->KodeStokKeluar) }}" class="btn-xs btn btn-primary">
                                        <i class="fa fa-eye" aria-hidden="true"></i> Lihat
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
        "order": [
            [0, "desc"]
        ]
    });
</script>
@endpush