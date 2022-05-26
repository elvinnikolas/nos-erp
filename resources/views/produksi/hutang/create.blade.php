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
                                        <td id="header">Karyawan</td>
                                        <td id="header">Golongan</td>
                                        <td id="header">Qty Produksi (buku)</td>
                                        <td id="header">Qty Produksi (cek)</td>
                                        <td id="header">Qty Hutang</td>
                                        <td id="header">Gaji / Packing</td>
                                        <td id="header">Total Hutang</td>
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
                                            <input type="number" step=0.01 onchange="update({{$key+1}});" name="gaji[]" class="form-control gaji{{$key+1}}" required="" value="{{$dt->gaji}}">
                                            <!-- <input type="number" name="gaji[]" class="form-control" required="" value="{{number_format($dt->gaji, 0, ',', '.')}}"> -->
                                        </td>
                                        <td>
                                            <input type="number" step=0.01 onchange="update({{$key+1}});" name="produksi[]" class="form-control produksi{{$key+1}}" required="" value="{{$dt->produksi}}">
                                        </td>
                                        <td>
                                            <input type="number" readonly="" step=0.01 onchange="update({{$key+1}});" name="hutang[]" class="form-control hutang{{$key+1}}" required="" value="{{$dt->hutang}}">
                                        </td>
                                        <td>
                                            <input type="number" step=0.01 onchange="update({{$key+1}});" name="packing[]" class="form-control packing{{$key+1}}" required="" value="{{$dt->packing}}">
                                        </td>
                                        <td>
                                            <input type="text" readonly="" class="form-control showtotal{{$key+1}}" required="" value="{{$string_total = "Rp " . number_format($dt->total, 0, ',', '.') .",-"}}">
                                            <input type="hidden" readonly="" name="total[]" class="form-control total{{$key+1}}" required="" value="{{$dt->total}}">
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
        var gaji = $(".gaji" + int).val();
        var produksi = $(".produksi" + int).val();
        var packing = $(".packing" + int).val();

        $(".hutang" + int).val(gaji - produksi);
        var hutang = $(".hutang" + int).val();

        $(".total" + int).val(hutang * packing);
        var showtotal = 'Rp ' + number_format(hutang * packing) + ',-';
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