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
                    <div class="form-row">
                        @csrf
                        <!-- Contents -->
                        <br>
                        <div class="form-row">
                            <!-- column 1 -->
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label for="inputDate">Tanggal Produksi (Mulai)</label>
                                    <input type="text" readonly="" class="form-control" name="TanggalAwal" id="inputDate" value="{{$hutang->TanggalAwal}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputDate2">Tanggal Produksi (Sampai)</label>
                                    <input type="text" readonly="" class="form-control" name="TanggalAkhir" id="inputDate2" value="{{$hutang->TanggalAkhir}}">
                                </div>
                            </div>
                            <!-- pembatas -->
                            <div class="form-group col-md-1"></div>
                            <!-- column 2 -->
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label for="inputDate3">Tanggal Gajian</label>
                                    <input type="text" readonly="" class="form-control" name="TanggalGajian" id="inputDate3" value="{{$hutang->TanggalGajian}}">
                                </div>
                            </div>
                            <!-- pembatas -->
                            <div class="form-group col-md-1"></div>
                            <!-- column 3 -->
                            <div class="form-group col-md-3"></div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <br><br>
                        <div class="x_title">
                        </div>
                        <br>
                        <h3 id="header">Daftar Hutang</h3>
                        <br><br>
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
                            @foreach($detail as $d)
                            <tr class="rowinput">
                                <td>
                                    <input type="text" readonly class="form-control" value="{{ $d->Nama}}">
                                </td>
                                <td>
                                    <input type="text" readonly class="form-control" value="{{ $d->NamaGroupItem}}">
                                </td>
                                <td>
                                    <input type="text" readonly class="form-control" value="{{ $d->QtyBuku_Packing}}">
                                </td>
                                <td>
                                    <input type="text" readonly class="form-control" value="{{ $d->QtyBuku_Nutuk}}">
                                </td>
                                <td>
                                    <input type="text" readonly class="form-control" value="{{ $d->QtyCek_Packing}}">
                                </td>
                                <td>
                                    <input type="text" readonly class="form-control" value="{{ $d->QtyCek_Nutuk}}">
                                </td>
                                <td>
                                    <input type="text" readonly class="form-control" value="{{ $d->QtyHutang_Packing}}">
                                </td>
                                <td>
                                    <input type="text" readonly class="form-control" value="{{ $d->QtyHutang_Nutuk}}">
                                </td>
                                <td>
                                    <input type="text" readonly class="form-control" value="{{ $d->Gaji_Packing}}">
                                </td>
                                <td>
                                    <input type="text" readonly class="form-control" value="{{ $d->Gaji_Nutuk}}">
                                </td>
                                <td>
                                    <input type="text" readonly class="form-control" value="{{$string_total = "Rp " . number_format($d->Total, 0, ',', '.') .",-"}}">
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="col-md-9">
                            <!-- <button type="submit" class="btn btn-success">Simpan</button> -->
                            <!-- <button type="submit" class="btn btn-danger">Batal</button> -->
                        </div>
                        <div class="col-md-3">
                        </div>
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