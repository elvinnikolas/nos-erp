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
                    <h1 id="header">Kwitansi</h1>
                </div>
                <div class="x_content">
                    <form action="{{ url('/kwitansipiutang/update',$id)}}" method="post">
                        @csrf
                        <!-- Contents -->

                        <br>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label>Nomor Kwitansi</label>
                                    <input type="text" class="form-control" name="KodeKwitansi" readonly="readonly" value="{{$kwitansi->KodeKwitansi}}">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal (ttd kwitansi)</label>
                                    <div class="input-group date" id="tanggal">
                                        <input type="text" class="form-control" name="Tanggal" id="tanggal" value="{{$kwitansi->Tanggal}}">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama (ttd kwitansi)</label>
                                    <input type="text" class="form-control" name="NamaTtd" placeholder="Nama" required value="{{$kwitansi->NamaTtd}}">
                                </div>
                                <div class="form-group">
                                    <label>Kota (ttd kwitansi)</label>
                                    <input type="text" class="form-control" name="KotaTtd" placeholder="Kota" required value="{{$kwitansi->KotaTtd}}">
                                </div>
                                <div>
                                    <br>
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Simpan data ini?')">Simpan</button>
                                </div>
                            </div>
                            <div class="form-group col-md-1">
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="inputPelanggan">Pelanggan</label>
                                    <input type="text" class="form-control" name="KodePelanggan" readonly="readonly" value="{{$datapelanggan->NamaPelanggan}}">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <select class="form-control alamat1" name="AlamatPelanggan" id="alamat">
                                        @foreach($alamat as $alm)
                                        @if($alm->AlamatInvoice == $kwitansi->Alamat)
                                        <option value="{{$alm->AlamatInvoice}}" selected>{{$alm->AlamatInvoice}}</option>
                                        @else
                                        <option value="{{$alm->AlamatInvoice}}">{{$alm->AlamatInvoice}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kota">Kota</label>
                                    <select class="form-control kota1" name="KotaPelanggan" id="kota">
                                        @foreach($alamat as $alm)
                                        @if($alm->KotaInvoice == $kwitansi->Kota)
                                        <option value="{{$alm->KotaInvoice}}" selected>{{$alm->KotaInvoice}}</option>
                                        @else
                                        <option value="{{$alm->KotaInvoice}}">{{$alm->KotaInvoice}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <!-- <div class="form-row">
                            <div class="form-group col-md-12">
                                <br><br>
                                <div class="x_title">
                                </div>
                                <br>
                                <h3 id="header">Daftar Invoice</h3>
                                <a href="javascript:;" class="btn btn-primary pull-right" onclick="addrow()">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </a>
                                <br><br><br>
                                <input type="hidden" value="{{$pelanggan}}" name="KodePelanggan">
                                <input type="hidden" value="1" name="totalInvoice" id="totalInvoice">

                                @foreach($invoice as $inv)
                                <input type="hidden" id="{{$inv->KodeInvoice}}Tanggal" value="{{$inv->Tanggal}}">
                                <input type="hidden" id="{{$inv->KodeInvoice}}TanggalFormat" value="{{$inv->TanggalFormat}}">
                                <input type="hidden" id="{{$inv->KodeInvoice}}NoFaktur" value="{{$inv->NoFaktur}}">
                                <input type="hidden" id="{{$inv->KodeInvoice}}DPP" value="{{$inv->DPP}}">
                                <input type="hidden" id="{{$inv->KodeInvoice}}PPN" value="{{$inv->PPN}}">
                                <input type="hidden" id="{{$inv->KodeInvoice}}Diskon" value="{{$inv->Diskon}}">
                                <input type="hidden" id="{{$inv->KodeInvoice}}Total" value="{{$inv->Total}}">
                                <input type="hidden" id="{{$inv->KodeInvoice}}DPPReturn" value="{{$inv->DPPReturn}}">
                                <input type="hidden" id="{{$inv->KodeInvoice}}PPNReturn" value="{{$inv->PPNReturn}}">
                                <input type="hidden" id="{{$inv->KodeInvoice}}DiskonReturn" value="{{$inv->DiskonReturn}}">
                                <input type="hidden" id="{{$inv->KodeInvoice}}TotalReturn" value="{{$inv->TotalReturn}}">
                                @endforeach

                                <table id="invoices" class="table">
                                    <tr>
                                        <td id="header" style="width:16%;">Kode Invoice</td>
                                        <td id="header" style="width:12%;">Tanggal</td>
                                        <td id="header">No Faktur</td>
                                        <td id="header">DPP</td>
                                        <td id="header">PPN</td>
                                        <td id="header">Diskon</td>
                                        <td id="header">Total</td>
                                        <td></td>
                                    </tr>
                                    @foreach($datainvoice as $key => $data)
                                    <tr class="rowinput">
                                        <td>
                                            <select name="invoice[]" onchange="invoicechange(this,1);" class="form-control invoice1" id="invoice-select1">
                                                <option value="0">- Pilih Invoice -</option>
                                                @foreach($invoice as $inv)
                                                <option value="{{$inv->KodeInvoice}}">{{$inv->KodeInvoice}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input readonly="" type="hidden" name="tanggal[]" class="form-control tanggal1" required="" value="-">
                                            <input readonly="" type="text" class="form-control showtanggal1" value="-">
                                        </td>
                                        <td>
                                            <input readonly="" type="hidden" name="nofaktur[]" class="form-control nofaktur1" required="" value="-">
                                            <input readonly="" type="text" class="form-control shownofaktur1" value="-">
                                        </td>
                                        <td>
                                            <input readonly="" type="hidden" name="dpp[]" class="form-control dpp1" required="" value="0">
                                            <input readonly type="text" class="form-control showdpp1" value="Rp 0,-">
                                        </td>
                                        <td>
                                            <input readonly="" type="hidden" name="ppn[]" class="form-control ppn1" required="" value="0">
                                            <input readonly type="text" class="form-control showppn1" value="Rp 0,-">
                                        </td>
                                        <td>
                                            <input readonly="" type="hidden" name="diskon[]" class="form-control diskon1" required="" value="0">
                                            <input readonly type="text" class="form-control showdiskon1" value="Rp 0,-">
                                        </td>
                                        <td>
                                            <input readonly="" type="hidden" name="total[]" class="form-control total1" required="" value="0">
                                            <input readonly type="text" class="form-control showtotal1" value="Rp 0,-">
                                        </td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </table>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Simpan data ini?')">Simpan</button>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>DPP</label>
                                        <input type="hidden" readonly="" class="form-control dpp" name="DPP" value="0" placeholder="">
                                        <input type="text" readonly="" class="form-control showdpp" value="Rp 0,-">
                                    </div>
                                    <div class="form-group">
                                        <label>PPN</label>
                                        <input type="hidden" readonly value="0" name="PPN" class="ppn form-control">
                                        <input type="text" readonly="" class="form-control showppn" value="Rp 0,-">
                                    </div>
                                    <div class="form-group">
                                        <label>Diskon</label>
                                        <input type="hidden" readonly value="0" name="Diskon" class="diskon form-control">
                                        <input type="text" readonly="" class="form-control showdiskon" value="Rp 0,-">
                                    </div>
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="hidden" readonly="" class="form-control subtotal" value="0" name="Total" placeholder="">
                                        <input type="text" readonly="" class="form-control showsubtotal" value="Rp 0,-">
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#tanggal').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY-MM-DD'
    });

    $('#alamat').select2();
    $('#kota').select2();
    $('#invoice-select1').select2();

    function addrow() {
        $('#invoice-select1').select2('destroy');
        $("#totalInvoice").val(parseInt($("#totalInvoice").val()) + 1);
        var count = $("#totalInvoice").val();
        var markup = $(".rowinput").html();
        var res = "<tr class='tambah" + count + "'>" + markup + "</tr>";
        res = res.replace("invoice1", "invoice" + count);
        res = res.replace("invoice-select1", "invoice-select" + count);
        res = res.replace("tanggal1", "tanggal" + count);
        res = res.replace("nofaktur1", "nofaktur" + count);
        res = res.replace("dpp1", "dpp" + count);
        res = res.replace("ppn1", "ppn" + count);
        res = res.replace("diskon1", "diskon" + count);
        res = res.replace("total1", "total" + count);
        res = res.replace("showtanggal1", "showtanggal" + count);
        res = res.replace("shownofaktur1", "shownofaktur" + count);
        res = res.replace("showdpp1", "showdpp" + count);
        res = res.replace("showppn1", "showppn" + count);
        res = res.replace("showdiskon1", "showdiskon" + count);
        res = res.replace("showtotal1", "showtotal" + count);
        res = res.replace("invoicechange(this,1", "invoicechange(this," + count);
        res = res.replace("<td></td>", '<td><button type="button" onclick="del(' + count + ')" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>');

        $("#invoices tbody").append(res);
        $('#invoice-select' + count).select2({
            width: '100%'
        });
        $('#invoice-select1').select2({
            width: '100%'
        });
    }

    function invoicechange(val, int) {
        var tanggal = $("#" + val.value + "Tanggal").val();
        $(".tanggal" + int).val(tanggal);
        var showtanggal = $("#" + val.value + "TanggalFormat").val();
        $(".showtanggal" + int).val(showtanggal);
        var nofaktur = $("#" + val.value + "NoFaktur").val();
        $(".nofaktur" + int).val(nofaktur);
        $(".shownofaktur" + int).val(nofaktur);

        var dpp = $("#" + val.value + "DPP").val();
        $(".dpp" + int).val(dpp);
        var ppn = $("#" + val.value + "PPN").val();
        $(".ppn" + int).val(ppn);
        var diskon = $("#" + val.value + "Diskon").val();
        $(".diskon" + int).val(diskon);
        var total = $("#" + val.value + "Total").val();
        $(".total" + int).val(total);

        if ($("#" + val.value + "TotalReturn").val() !== null) {
            var dppreturn = $("#" + val.value + "DPPReturn").val();
            dpp = dpp - dppreturn
            $(".dpp" + int).val(dpp);
            var ppnreturn = $("#" + val.value + "PPNReturn").val();
            ppn = ppn - ppnreturn
            $(".ppn" + int).val(ppn);
            var diskonreturn = $("#" + val.value + "DiskonReturn").val();
            diskon = diskon - diskonreturn
            $(".diskon" + int).val(diskon);
            var totalreturn = $("#" + val.value + "TotalReturn").val();
            total = total - totalreturn
            $(".total" + int).val(total);
        }

        var formatdpp = 'Rp ' + number_format(dpp) + ',-';
        $(".showdpp" + int).val(formatdpp);
        var formatppn = 'Rp ' + number_format(ppn) + ',-';
        $(".showppn" + int).val(formatppn);
        var formatdiskon = 'Rp ' + number_format(diskon) + ',-';
        $(".showdiskon" + int).val(formatdiskon);
        var formattotal = 'Rp ' + number_format(total) + ',-';
        $(".showtotal" + int).val(formattotal);

        updateField();
    }

    function del(int) {
        $(".tambah" + int).remove();
        var count = $("#totalInvoice").val();
        updateField();
    }

    function updateField() {
        var tot = $("#totalInvoice").val();

        $(".subtotal").val(0);
        $(".dpp").val(0);
        $(".ppn").val(0);
        $(".diskon").val(0);
        for (var i = 1; i <= tot; i++) {
            if ($(".total" + i).val() !== undefined) {
                $(".subtotal").val(parseFloat($(".subtotal").val()) + parseFloat($(".total" + i).val()));
                $(".dpp").val(parseFloat($(".dpp").val()) + parseFloat($(".dpp" + i).val()));
                $(".ppn").val(parseFloat($(".ppn").val()) + parseFloat($(".ppn" + i).val()));
                $(".diskon").val(parseFloat($(".diskon").val()) + parseFloat($(".diskon" + i).val()));
            }
        }

        var dpp = $(".dpp").val();
        $(".dpp").val(parseFloat($(".dpp").val()));
        var ppn = $(".ppn").val();
        $(".ppn").val(parseFloat($(".ppn").val()));
        var diskon = $(".diskon").val();
        $(".diskon").val(parseFloat($(".diskon").val()));
        var subtotal = $(".subtotal").val();
        $(".subtotal").val(parseFloat($(".subtotal").val()));

        formatdpp = 'Rp ' + number_format(dpp);
        formatppn = 'Rp ' + number_format(ppn);
        formatdisc = 'Rp ' + number_format(diskon);
        formattotal = 'Rp ' + number_format(subtotal);
        $(".showppn").val(formatppn);
        $(".showdiskon").val(formatdisc);
        $(".showdpp").val(formatdpp);
        $(".showsubtotal").val(formattotal);
    }

    $('.formsub').submit(function(event) {
        tot = $("#totalInvoice").val();
        for (var i = 1; i <= tot; i++) {
            if (typeof $(".qty" + i).val() === 'undefined') {} else {
                if ($(".qty" + i).val() == 0) {
                    event.preventDefault();
                    $(".qty" + i).focus();
                }
            }
        }
    });

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