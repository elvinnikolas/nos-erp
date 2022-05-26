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
                    <h1 id="header">Surat Jalan</h1>
                    <h3 id="header">{{$suratjalan->KodeSuratJalan}}</h3>
                </div>
                <div class="x_content">
                    <form action="{{ url('/suratJalan/updateKonfirmasi',$id)}}" method="post">
                        @csrf
                        <!-- Contents -->
                        <br>
                        <div class="form-row">
                            <!-- column 1 -->
                            <div class="form-group col-md-3">
                                <input type="hidden" class="form-control" name="KodeSJ" readonly="readonly" value="{{$suratjalan->KodeSuratJalan}}">
                                <div class="form-group">
                                    <label>Nomor SO</label>
                                    <input type="text" class="form-control" name="KodeSO" readonly="readonly" value="{{$suratjalan->KodeSO}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputDate">Tanggal</label>
                                    <input type="text" class="form-control" name="Tanggal" id="inputDate" readonly="readonly" value="{{\Carbon\Carbon::parse($suratjalan->Tanggal)->format('d-m-Y')}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputPelanggan">Pelanggan</label>
                                    <input type="text" class="form-control" name="KodePelanggan" readonly="readonly" value="{{$pelanggan->NamaPelanggan}}">
                                </div>
                                @if($suratjalan->PPN == "ya")
                                <div class="form-group">
                                    <label for="inputDate">No Faktur</label>
                                    <input type="text" class="form-control" name="NoFaktur" id="" readonly="readonly" value="{{$suratjalan->NoFaktur}}">
                                </div>
                                @endif
                            </div>
                            <!-- pembatas -->
                            <div class="form-group col-md-1"></div>
                            <!-- column 2 -->
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label for="inputBerlaku">Alamat</label>
                                    <textarea class="form-control" name="Alamat" rows="3" readonly="readonly">{{$suratjalan->Alamat}}</textarea>
                                    <input type="text" readonly class="form-control kota" name="Kota" value="{{$suratjalan->Kota}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputTerm">Sopir</label>
                                    <input type="text" class="form-control" name="KodeSopir" readonly="readonly" value="{{$driver->Nama}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputPO">No Polisi</label>
                                    <input type="text" class="form-control" name="nopol" readonly="readonly" value="{{$suratjalan->Nopol}}">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="inputPelanggan">Diskon</label> -->
                                <input type="hidden" readonly="readonly" class="diskon form-control diskon" name="diskon" value="{{$suratjalan->Diskon}}">
                                <!-- </div>
                                <div class="form-group">
                                    <label for="inputPelanggan">PPN</label> -->
                                <input type="hidden" readonly="readonly" class="diskon form-control ppn" name="ppn" value="{{$suratjalan->PPN}}">
                                <!-- </div> -->
                            </div>
                            <!-- pembatas -->
                            <div class="form-group col-md-1"></div>
                            <!-- column 3 -->
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label for="inputMatauang">Mata Uang</label>
                                    <input type="text" class="form-control" name="KodeSopir" readonly="readonly" value="{{$matauang->NamaMataUang}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputGudang">Gudang</label>
                                    <input type="text" class="form-control" name="KodeLokasi" readonly="readonly" value="{{$lokasi->NamaLokasi}}">
                                </div>
                                <div class="form-group">
                                    <label>Total Item</label>
                                    <input type="text" class="form-control" name="TotalItem" id="inputFaktur" readonly="readonly" value="{{$suratjalan->TotalItem}}">
                                </div>
                                <label for="inputKeterangan">Keterangan</label>
                                <textarea class="form-control" name="InputKeterangan" id="inputKeterangan" rows="3" readonly="readonly">{{$suratjalan->Keterangan}}</textarea>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="x_title">
                                </div>
                                <br>
                                <h3 id="header">Daftar Item</h3>
                                <br>
                                <table id="items">
                                    <tr>
                                        <td id="header">Nama Barang</td>
                                        <td id="header">Qty</td>
                                        <td id="header">Satuan</td>
                                        <td id="header">Harga Satuan</td>
                                        <td id="header">Keterangan</td>
                                        <td id="header">Total</td>
                                    </tr>
                                    @foreach($items as $key => $data)
                                    <tr class="rowinput">
                                        <td>
                                            <input type="text" class="form-control" readonly value="{{$data->NamaItem}}">
                                            <input type="hidden" readonly name="item[]" value="{{$data->KodeItem}}">
                                        </td>
                                        <td>
                                            <input type="number" readonly step=0.01 onchange="qty({{$key+1}})" name="qty[]" class="form-control qty{{$key+1}} qtyj" required="" value="{{$data->Qty}}">
                                        </td>
                                        <td>
                                            <input type="hidden" class="form-control" readonly name="satuan[]" value="{{$data->KodeSatuan}}">
                                            <input type="text" class="form-control" readonly value="{{$data->NamaSatuan}}">
                                        </td>
                                        <td>
                                            <!-- <input type="number" step=0.01 onchange="price({{$key+1}})" name="price[]" class="form-control price{{$key+1}}" required="" value="{{$data->Harga}}"> -->
                                            <input type="text" onchange="price({{$key+1}})" name="price[]" class="form-control price{{$key+1}}" required="" value="{{$data->Harga}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" readonly name="keterangan[]" value="{{$data->Keterangan}}">
                                        </td>
                                        <td>
                                            <input readonly type="hidden" name="total[]" class="form-control total{{$key+1}}" required="" value="{{$data->Harga * $data->Qty}}">
                                            <input readonly type="text" class="form-control showtotal{{$key+1}}" value="{{$string_total = "Rp " . number_format($data->Harga * $data->Qty, 0, ',', '.') .",-"}}">
                                        </td>
                                    </tr>
                                    @endforeach

                                </table>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Simpan data ini?')">Simpan</button>
                                </div>
                                <div class="col-md-3">
                                    <input type="hidden" value="{{sizeof($items)}}" class="tot">
                                    <label for="subtotal">Subtotal</label>
                                    <input type="hidden" name="total" readonly class="form-control befDis">
                                    <input type="text" readonly="" class="form-control showbefDis" value="Rp 0,-">
                                    <label for="ppn">Nilai PPN</label>
                                    <input type="hidden" readonly name="ppnval" class="ppnval form-control">
                                    <input type="text" readonly="" class="form-control showppnval" value="Rp 0,-">
                                    <label for="diskon">Nilai Diskon</label>
                                    <input type="hidden" readonly name="diskonval" class="diskonval form-control">
                                    <input type="text" readonly="" class="form-control showdiskonval" value="Rp 0,-">
                                    <label for="total">Total</label>
                                    <input type="hidden" readonly class="form-control subtotal" name="subtotal">
                                    <input type="text" readonly="" class="form-control showsubtotal" value="Rp 0,-">
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
    $('#alamat').select2()
    $('#sopir').select2()
    $('#gudang').select2()
    $('#matauang').select2()

    $('#inputDate').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY-MM-DD'
    });

    updatePrice($(".tot").val());

    function price(int) {
        var qty = $(".qty" + int).val();
        var item = $(".item" + int).val();
        var sat = $(".satuan" + int).val();
        var price = $(".price" + int).val();

        $(".total" + int).val(price * qty);
        var formattotal = 'Rp ' + number_format(price * qty) + ',-';
        $(".showtotal" + int).val(formattotal);
        var count = $(".tot").val();
        updatePrice(count);
    }

    function updatePrice(tot) {

        $(".subtotal").val(0);
        var diskon = 0;
        if ($(".diskon").val() != "") {
            diskon = parseInt($(".diskon").val());
        }
        for (var i = 1; i <= tot; i++) {
            if ($(".total" + i).val() != undefined) {
                $(".subtotal").val(parseInt($(".subtotal").val()) + parseInt($(".total" + i).val()));
            }
        }
        var befDis = $(".subtotal").val();
        $(".subtotal").val(parseInt($(".subtotal").val()));
        var ppn = $(".ppn").val();
        if (ppn == "ya") {
            ppn = parseInt(befDis) * 11 / 100;
        } else {
            ppn = parseInt(0);
        }
        diskon = (parseInt($(".subtotal").val()) + ppn) * diskon / 100;
        $(".ppnval").val(ppn);
        $(".diskonval").val(diskon);
        $(".befDis").val(parseInt($(".subtotal").val()));
        $(".subtotal").val(parseInt($(".subtotal").val()) + ppn - diskon);

        hasiltotal = parseInt(befDis) + ppn - diskon;
        formatppn = 'Rp ' + number_format(ppn) + ',-';
        formatbef = 'Rp ' + number_format(befDis) + ',-';
        formatdisc = 'Rp ' + number_format(diskon) + ',-';
        formattotal = 'Rp ' + number_format(hasiltotal) + ',-';
        $(".showppnval").val(formatppn);
        $(".showdiskonval").val(formatdisc);
        $(".showbefDis").val(formatbef);
        $(".showsubtotal").val(formattotal);
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