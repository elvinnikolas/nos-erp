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

    table,
    th,
    td {
        border: 1px solid #cdcdcd;
    }

    table th,
    table td {
        padding: 10px;
        text-align: left;
    }

    #header {
        text-align: center;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1 id="header">Hutang Produksi</h1>
                </div>
                <div class="x_content">
                    <form action="{{ url('/hutangproduksi/store') }}" method="post" class="formsub">
                        @csrf
                        <!-- Contents -->
                        <br>
                        <div class="form-row">
                            <!-- column 1 -->
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label for="inputDate">Tanggal Produksi (Mulai)</label>
                                    <input type="text" readonly="" class="form-control" name="TanggalAwal" id="inputDate" value="{{$start}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputDate2">Tanggal Produksi (Sampai)</label>
                                    <input type="text" readonly="" class="form-control" name="TanggalAkhir" id="inputDate2" value="{{$finish}}">
                                </div>
                            </div>
                            <!-- pembatas -->
                            <div class="form-group col-md-1"></div>
                            <!-- column 2 -->
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label for="inputDate3">Tanggal Gajian</label>
                                    <input type="text" readonly="" class="form-control" name="TanggalGajian" id="inputDate3" value="{{$gaji}}">
                                </div>
                            </div>
                            <!-- pembatas -->
                            <div class="form-group col-md-1"></div>
                            <!-- column 3 -->
                            <div class="form-group col-md-3"></div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <br><br>
                                @if ($check_data == true)
                                <div class="x_title">
                                </div>
                                <br>
                                <h3 id="header">Daftar Hutang</h3>
                                <br>
                                <input type="hidden" value="1" name="totalItem" id="totalItem">

                                <table id="items" class="table">
                                    <tr>
                                        <th rowspan="2" style="width:14%" id="header">Karyawan</th>
                                        <th rowspan="2" style="width:12%" id="header">Golongan</th>
                                        <th colspan="2" style="width:14%" id="header">Qty Produksi (Buku)</th>
                                        <th colspan="2" style="width:14%" id="header">Qty Produksi (Cek)</th>
                                        <th colspan="2" style="width:14%" id="header">Qty Hutang</th>
                                        <th colspan="2" style="width:17%" id="header">Gaji</th>
                                        <th rowspan="2" style="width:15%" id="header">Total Hutang</th>
                                    </tr>
                                    <tr>
                                        <th id="header">Pck</th>
                                        <th id="header">Ntk</th>
                                        <th id="header">Pck</th>
                                        <th id="header">Ntk</th>
                                        <th id="header">Pck</th>
                                        <th id="header">Ntk</th>
                                        <th id="header">Pck</th>
                                        <th id="header">Ntk</th>
                                    </tr>
                                    @foreach($data as $key => $dt)
                                    <tr class="rowinput">
                                        <td>
                                            <input readonly="" type="text" class="form-control" required="" value="{{$dt->karyawan}}">
                                            <input readonly="" type="hidden" name="karyawan[]" class="form-control" required="" value="{{$dt->kodekaryawan}}">
                                        </td>
                                        <td>
                                            <input readonly="" type="text" class="form-control" required="" value="{{$dt->golongan}}">
                                            <input readonly="" type="hidden" name="golongan[]" class="form-control" required="" value="{{$dt->kodegolongan}}">
                                        </td>
                                        <td>
                                            <input type="number" step=0.01 onchange="update({{$key+1}});" name="buku_packing[]" class="form-control buku_packing{{$key+1}}" required="" value="{{$dt->buku_packing}}">
                                        </td>
                                        <td>
                                            <input type="number" step=0.01 onchange="update({{$key+1}});" name="buku_nutuk[]" class="form-control buku_nutuk{{$key+1}}" required="" value="{{$dt->buku_nutuk}}">
                                        </td>
                                        <td>
                                            <input type="number" step=0.01 onchange="update({{$key+1}});" name="cek_packing[]" class="form-control cek_packing{{$key+1}}" required="" value="{{$dt->cek_packing}}">
                                        </td>
                                        <td>
                                            <input type="number" step=0.01 onchange="update({{$key+1}});" name="cek_nutuk[]" class="form-control cek_nutuk{{$key+1}}" required="" value="{{$dt->cek_nutuk}}">
                                        </td>
                                        <td>
                                            <input type="number" readonly="" step=0.01 onchange="update({{$key+1}});" name="hutang_packing[]" class="form-control hutang_packing{{$key+1}}" required="" value="{{$dt->hutang_packing}}">
                                        </td>
                                        <td>
                                            <input type="number" readonly="" step=0.01 onchange="update({{$key+1}});" name="hutang_nutuk[]" class="form-control hutang_nutuk{{$key+1}}" required="" value="{{$dt->hutang_nutuk}}">
                                        </td>
                                        <td>
                                            <input type="number" step=0.01 onchange="update({{$key+1}});" name="gaji_packing[]" class="form-control gaji_packing{{$key+1}}" required="" value="{{$dt->gaji_packing}}">
                                        </td>
                                        <td>
                                            <input type="number" step=0.01 onchange="update({{$key+1}});" name="gaji_nutuk[]" class="form-control gaji_nutuk{{$key+1}}" required="" value="{{$dt->gaji_nutuk}}">
                                        </td>
                                        <td>
                                            <input type="text" readonly="" class="form-control showtotal{{$key+1}}" required="" value="{{$string_total = "Rp " . number_format($dt->total_packing+$dt->total_nutuk, 0, ',', '.') .",-"}}">
                                            <input type="hidden" readonly="" name="total[]" class="form-control total{{$key+1}}" required="" value="{{$dt->total_packing+$dt->total_nutuk}}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Simpan data ini?')">Simpan</button>
                                </div>
                                @else
                                <h3 id="header">Tidak ada hutang produksi ditemukan pada tanggal berikut</h3>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    function update(int) {
        var buku_packing = $(".buku_packing" + int).val();
        var buku_nutuk = $(".buku_nutuk" + int).val();
        var cek_packing = $(".cek_packing" + int).val();
        var cek_nutuk = $(".cek_nutuk" + int).val();
        var gaji_packing = $(".gaji_packing" + int).val();
        var gaji_nutuk = $(".gaji_nutuk" + int).val();

        $(".hutang_packing" + int).val(buku_packing - cek_packing);
        var hutang_packing = $(".hutang_packing" + int).val();
        $(".hutang_nutuk" + int).val(buku_nutuk - cek_nutuk);
        var hutang_nutuk = $(".hutang_nutuk" + int).val();

        $(".total" + int).val((hutang_packing * gaji_packing) + (hutang_nutuk * gaji_nutuk));
        var showtotal = 'Rp ' + number_format((hutang_packing * gaji_packing) + (hutang_nutuk * gaji_nutuk)) + ',-';
        $(".showtotal" + int).val(showtotal);
    }

    function number_format(number, decimals, decPoint, thousandsSep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
        var n = !isFinite(+number) ? 0 : +number
        var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
        var sep = (typeof thousandsSep === 'undefined') ? '.' : thousandsSep
        var dec = (typeof decPoint === 'undefined') ? ',' : decPoint
        var s = ''

        var toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec)
            return '' + (Math.round(n * k) / k)
                .toFixed(prec)
        }

        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || ''
            s[1] += new Array(prec - s[1].length + 1).join('0')
        }

        return s.join(dec)
    }
</script>
@endpush