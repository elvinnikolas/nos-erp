@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- panel kode scanner -->
            <div class="x_panel">
                <div class="x_title">
                    <h1>Absensi Karyawan</h1>
                    <a href="{{ url('/absensi/absen') }}" style="display: inline-block;" class="btn btn-default">Absen Karyawan</a>
                    <a href="{{ url('/absensi/histori') }}" style="display: inline-block;" class="btn btn-info">Histori Absen Setahun</a>
                </div>
                <div class="x_content">
                    <div class="form-group">
                        <label>Kode Karyawan: </label>
                        <input type="text" class="form-control" id="id" autofocus>
                    </div>
                </div>
            </div>

            <!-- panel tampilan data -->
            <div class="x_panel">
                <div class="x_content">
                    <!-- warning jika karyawan sudah absen keluar -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <h4 id="textwarning" style="color: red;"></h4>
                        </div>
                    </div>

                    <!-- sisi kiri untuk barcode, nama, kode karyawan -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>KODE:</label>
                            <h3 id="textkode"></h3>
                        </div>

                        <div class="form-group">
                            <label>NAMA: </label>
                            <h3 id="textnama"></h3>
                        </div>
                    </div>

                    <!-- pemisah -->
                    <div class="col-md-1"></div>

                    <!-- sisi kanan untuk tanggal absen dan status absen (masuk atau keluar) -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>STATUS: </label>
                            <h3 id="textstatus"></h3>
                        </div>

                        <div class="form-group"></div>

                        <div class="form-group">
                            <label>TANGGAL: </label>
                            <h3 id="texttanggal"></h3>
                        </div>
                        
                        <div class="form-group">
                            <label>WAKTU: </label>
                            <h3 id="textwaktu"></h3>
                        </div>
                    </div>

                    <!-- form untuk disimpan -->
                    <form action="{{ url('/absensi/store') }}" method="POST" id="formdata">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="kode" id="kode" value="">
                        <input type="hidden" id="nama" value="">
                        <input type="hidden" id="status" name="status" value="">
                        <input type="hidden" id="tanggal" name="tanggal" value="">
                        <input type="hidden" id="waktu" name="waktu" value="">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
	$('#id').on('change', function() {
        var id          = $('#id').val();
        var urlget      = '/absensi/data/' + id;

        $.get(urlget, function(data, status) {
            console.log(status);
            if (status == 'success') {
                if ($.isEmptyObject(data)) {
                }
                else {
                    console.log(data);
                    $.each(data, function(i, val) {
                        if (val.warning == 'true') {
                            // console.log('karyawan ' + id + 'sudah absen keluar');
                            $('#textwarning').html(val.message);
                            $('#formdata')[0].reset();
                            $('#textkode').html('');
                            $('#textnama').html('');
                            $('#textstatus').html('');
                            $('#texttanggal').html('');
                            $('#textwaktu').html('');
                            $('#id').val('');
                            $('#id').focus();
                        }
                        else {
                            // console.log(val);
                            $('#textkode').html(val.KodeKaryawan);
                            $('#textnama').html(val.Nama);
                            $('#textstatus').html(val.StatusAbsen);
                            $('#texttanggal').html(val.TanggalAbsen);
                            $('#textwaktu').html(val.WaktuAbsen);
                            $('#kode').val(val.KodeKaryawan);
                            $('#nama').val(val.Nama);
                            $('#status').val(val.StatusAbsen);
                            $('#tanggal').val(val.TanggalAbsen);
                            $('#waktu').val(val.WaktuAbsen);
                            $('#textwarning').html('');
                            
                            var urlpost = '/absensi/store';
                            $.post(urlpost, {
                                kode: $('#kode').val(),
                                tanggal: $('#tanggal').val(),
                                waktu: $('#waktu').val(),
                                status: $('#status').val(),
                                _token: '{{ csrf_token() }}'
                            }, function(response) {
                                // console.log('data berhasil disimpan');
                                $('#formdata')[0].reset();
                                $('#id').val('');
                                $('#id').focus();
                            });
                        }
                    });  
                }
            }
            else {
                $('#textwarning').html('Karyawan ' + id + ' tidak ditemukan');
                $('#id').val('');
                $('#id').focus();
            }
        });
	});
</script>
@endpush