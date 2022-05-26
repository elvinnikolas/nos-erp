@extends('index')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 style="text-align:center">DATA RESEP</h1>

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

                    <a href="{{ route('masterresep.create') }}" class="btn btn-success" data-function="tambah">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Tambah Resep
                    </a><br><br>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_body">
                    <div class="x_title">
                        <h3>Daftar Resep</h3><br>
                    </div>
                    <table class="table table-striped" id="table-resep">
                        <thead class="thead-light">
                            <tr>
                                <th>Kode Resep</th>
                                <th>Nama Resep</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Keterangan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <br><br>

                    <small>*Tekan tombol <b>LIHAT BAHAN</b> untuk menampilkan bahan baku yang digunakan</small>

                    <br><br>
                    <div class="x_title">
                        <h3>Bahan baku yang digunakan</h3><br>
                    </div>
                    <table class="table table-striped" id="table-resep-detail">
                        <thead class="thead-light">
                            <tr>
                                <th>Bahan Baku</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
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
    $(function() {
        $('#table-resep').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('api.masterresep') !!}",
            columns: [{
                    data: 'KodeResep'
                },
                {
                    data: 'NamaItem'
                },
                {
                    data: 'Qty'
                },
                {
                    data: 'NamaSatuan'
                },
                {
                    data: 'Keterangan'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            "pageLength": 10
        });
    });

    function showConfirm() {
        if (confirm("Apakah anda yakin ingin menghapus data ini?")) {

        } else {
            return false;
        }
    }

    function detailResep(resep) {
        $('#table-resep-detail').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                "url": "{!! route('api.masterresep.detail') !!}",
                "data": {
                    "kode": resep
                }
            },
            columns: [{
                    data: 'NamaItem'
                },
                {
                    data: 'Qty'
                },
                {
                    data: 'NamaSatuan'
                },
                {
                    data: 'Keterangan'
                }
            ],
            "pageLength": 25
        });
    }
</script>
@endpush