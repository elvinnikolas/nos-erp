@extends('index')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 style="text-align:center">DATA KARYAWAN</h1>

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

                    <a href="{{ route('masterkaryawan.create') }}" class="btn btn-success">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Tambah Karyawan
                    </a><br><br>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_body">
                    <table class="table table-striped" id="table-karyawan">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Jabatan</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Telepon</th>
                                <th>Aksi</th>
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
        $('#table-karyawan').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('api.masterkaryawan') !!}",
            columns: [{
                    data: 'Nama',
                    name: 'Nama'
                },
                {
                    data: 'JenisKelamin',
                    name: 'JenisKelamin'
                },
                {
                    data: 'Jabatan',
                    name: 'Jabatan'
                },
                {
                    data: 'Alamat',
                    name: 'Alamat'
                },
                {
                    data: 'Kota',
                    name: 'Kota'
                },
                {
                    data: 'Telepon',
                    name: 'Telepon'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });

    function showConfirm() {
        if (confirm("Apakah anda yakin ingin menghapus data ini?")) {
            return true;
        } else {
            return false;
        }
    }
</script>
@endpush