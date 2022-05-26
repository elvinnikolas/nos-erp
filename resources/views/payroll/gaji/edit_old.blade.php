@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Slip Gaji Karyawan</h1>
                    <h3>$kode</h3>
                </div>
                <form action="{{ url('/gaji/update/' . $kode) }}" method="post" style="display:inline-block;">
                    @csrf
                    @method('POST')

                    @foreach($gaji as $data)
                        <!-- Penghitungan gaji pokok -->
                        <div class="x_content">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nama Karyawan: </label>
                                        <input type="text" class="form-control" value="{{$data->Nama}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Kode Karyawan: </label>
                                        <input type="text" class="form-control" value="{{$data->KodeKaryawan}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Golongan: </label>
                                        <input type="text" class="form-control" value="{{$data->KodeGolongan}}" readonly>
                                        <input type="hidden" id="nomorGolongan" value="{{$nomorkode}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gaji Pokok: </label>
                                        <input type="text" id="jmlGaji" class="form-control" value="{{$uangpokok}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Hari Kerja: </label>
                                        <input type="number" id="hariKerja" class="form-control" value="{{$data->TotalHariKerja}}" name="HariKerja" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Total Gaji Pokok: </label>
                                        <input type="text" name="SubtotalGajiPokok" readonly id="jmlGajiFormat" class="form-control" value="{{$data->SubtotalGaji}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tanggal Gajian:</label>
                                        <div class="input-group date" id="inputDate">
                                            <input type="text" class="form-control" value="{{$data->TanggalGaji}}" readonly>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <br><br><br>

                        <!-- Penghitungan gaji berdasarkan JUMLAH ITEM -->
                        <div class="form-row tabel_list">
                            <div class="form-group col-md-12">
                                <br><br>
                                <div class="x_title">
                                </div>
                                <br>
                                <h3 id="header" style="float: left;">Daftar Item</h3>
                                <br><br><br>
                                <input type="hidden" id="totalItem" value="{{$totalItem}}">

                                <table id="items" class="table">
                                    <tr style="background-color: #eeeeee;">
                                        <th id="header" style="width: 20%;">Nama Barang</th>
                                        <th id="header" style="width: 20%;">Harga Satuan</th>
                                        <th id="header" style="width: 20%;">Qty</th>
                                        <th id="header" style="width: 20%;">Subtotal</th>
                                    </tr>
                                    @php ($x = 0)
                                    @foreach($detailgaji as $datadetail)
                                    @php ($x++)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="item[]" value="{{$datadetail->KodeGolItem}}">
                                            <input type="text" class="form-control" value="{{$datadetail->NamaGolItem}}" readonly>
                                        </td>
                                        <td>
                                            <input type="text" name="harga[]" class="form-control harga{{$x}}" value="{{$datadetail->HargaItem}}" onchange="harga( {{$x}} )">
                                        </td>
                                        <td>
                                            <input type="number" name="qty[]" class="form-control qty{{$x}}" value="{{$datadetail->QtyItem}}" onchange="qty( {{$x}} )">
                                        </td>
                                        <td>
                                            <input type="text" readonly name="price[]" class="form-control price{{$x}}" value="{{$datadetail->SubtotalItem}}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                <table class="table">
                                    <tr>
                                        <td style="width: 20%;"></td>
                                        <td style="width: 20%;">Jumlah Item</td>
                                        <td style="width: 20%;">
                                            <input readonly type="text" id="qtyTotalItem" value="{{$data->JumlahItem}}" class="form-control" name="JumlahItem">
                                        </td>
                                        <td style="width: 20%;"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%;"></td>
                                        <td style="width: 20%;">Bonus</td>
                                        <td style="width: 20%;">
                                            <input readonly type="text" id="bonusItem" value="{{$data->Bonus}}" class="form-control" name="Bonus">
                                        </td>
                                        <td style="width: 20%;"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%;"></td>
                                        <td style="width: 20%;"></td>
                                        <td style="width: 20%;">Total</td>
                                        <td style="width: 20%;">
                                            <input readonly type="text" id="totalPriceItem" value="0" class="form-control">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <br><br><br>

                        <!-- Penghitungan gaji berdasarkan TAMBAHAN GAJI (LEMBUR DLL) -->
                        <div class="form-row tabel_list">
                            <div class="form-group col-md-12">
                                <br><br>
                                <div class="x_title">
                                </div>
                                <br>
                                <h3 id="header" style="float: left;">Tambahan Lainnya</h3>
                                <br><br><br>

                                <table id="itemtambahans" class="table">
                                    <tr style="background-color: #eeeeee;">
                                        <th id="header" style="width: 20%;">Keterangan</th>
                                        <th id="header" style="width: 20%;"></th>
                                        <th id="header" style="width: 20%;">Nominal</th>
                                        <th id="header" style="width: 20%;">Qty</th>
                                        <th id="header" style="width: 20%;">Subtotal</th>
                                    </tr>
                                    <tr>
                                        @foreach($harian as $datahari)
                                        <td>Lembur Harian</td>
                                        <td>
                                        @if($datahari->StatusKeterangan == 'Y')
                                            @php ($checked = 'checked')
                                            @php ($readonly = '')
                                        @else
                                            @php ($checked = '')
                                            @php ($readonly = 'readonly')
                                        @endif
                                            <input type="checkbox" id="check_ket_harian" {{$checked}}>
                                            <input type="hidden" name="tag_lembur[]" value="Lembur Harian">
                                            <input type="hidden" name="status[]" id="val_ket_harian" value="{{($datahari->StatusKeterangan == 'Y') ? '1' : '0'}}">
                                        </td>
                                        <td>
                                            <input type="hidden" id="ket_harian_hidden" value="{{$datahari->Nominal}}">
                                            <input type="text" id="ket_harian" name="nominal[]" class="form-control" value="{{$datahari->Nominal}}" {{$readonly}}>
                                        </td>
                                        <td>
                                            <input type="number" id="input_ket_harian" class="form-control" name="qty_lembur[]" value="{{$datahari->QtyTambahan}}" {{$readonly}}>
                                            <input type="hidden" id="input_ket_harian_hidden" value="{{$datahari->QtyTambahan}}">
                                        </td>
                                        <td>
                                            <input type="text" id="total_ket_harian" class="form-control" name="subtotal_lembur[]" value="{{$datahari->SubtotalTambahan}}" readonly>
                                            <input type="hidden" id="total_ket_harian_hidden" value="{{$datahari->SubtotalTambahan}}">
                                        </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach($minggu as $dataminggu)
                                        <td>Lembur Minggu</td>
                                        <td>
                                        @if($dataminggu->StatusKeterangan == 'Y')
                                            @php ($checked = 'checked')
                                            @php ($readonly = '')
                                        @else
                                            @php ($checked = '')
                                            @php ($readonly = 'readonly')
                                        @endif
                                            <input type="checkbox" id="check_ket_minggu" {{$checked}}>
                                            <input type="hidden" name="tag_lembur[]" value="Lembur Minggu">
                                            <input type="hidden" name="status[]" id="val_ket_minggu" value="{{($dataminggu->StatusKeterangan == 'Y') ? '1' : '0'}}">
                                        </td>
                                        <td>
                                            <input type="hidden" id="ket_minggu_hidden" value="{{$dataminggu->Nominal}}">
                                            <input type="text" id="ket_minggu" name="nominal[]" class="form-control" value="{{$dataminggu->Nominal}}" {{$readonly}}>
                                        </td>
                                        <td>
                                            <input type="number" id="input_ket_minggu" class="form-control" name="qty_lembur[]" value="{{$dataminggu->QtyTambahan}}" readonly>
                                            <input type="hidden" id="input_ket_minggu_hidden" value="{{$dataminggu->QtyTambahan}}">
                                        </td>
                                        <td>
                                            <input type="text" id="total_ket_minggu" class="form-control" name="subtotal_lembur[]" value="{{$dataminggu->SubtotalTambahan}}" readonly>
                                        </td>
                                        @endforeach
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <br>
                        <div class="form-inline">
                            <label>Total Gaji Karyawan: </label>
                            <input type="text" readonly class="form-control jmlTotalGaji" value="0">
                            <label> pembulatan: </label>
                            <input type="text" readonly class="form-control jmlTotalGajiRound" value="{{$data->TotalGaji}}">
                            <input type="hidden" class="form-control" name="TotalGajiKaryawan" id="totalGajiKaryawan" value="{{$data->TotalGaji}}">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success" id="btn_simpan" style="width:120px;" onclick="return confirm('Ubah data ini?')">Ubah</button>
                        <!-- <form action="{{ url('/gaji') }}" method="get">
                            <button class="btn btn-danger" style="width:120px;">Batal</button>
                        </form> -->
                        <a href="{{ url('/gaji') }}" class="btn btn-danger" style="width: 120px;">Batal</a>

                    @endforeach
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
 <script type="text/javascript">
    $(document).ready(function() {
        var totalItem           = +($('#totalItem').val());
        var priceitem      = 0;
        for (var i=1; i <= totalItem; i++) {
            var price           = +($('.price'+i).val());
            priceitem           = priceitem + price;
        }
        $('#totalPriceItem').val(priceitem);

        var gajipokok           = +($('#jmlGajiFormat').val());
        var bonus               = +($('#bonusItem').val());
        var harian              = +($('#total_ket_harian').val());
        var minggu              = +($('#total_ket_minggu').val());

        var jmlTotalGaji        = gajipokok + bonus + priceitem + harian + minggu;
        $('.jmlTotalGaji').val(number_format(jmlTotalGaji));
        jmlTotalGaji        = number_roundup(jmlTotalGaji);
        $('.jmlTotalGajiRound').val(number_format(jmlTotalGaji));
        $('#totalGajiKaryawan').val(jmlTotalGaji);
    });
    

    $('#jmlGaji').on('change', function() {
        var gaji            = +($('#jmlGaji').val());
        var hari            = +($('#hariKerja').val());
        var gajipokok       = gaji * hari;
        $('#jmlGajiFormat').val(gajipokok);
        
        var bonus           = +($('#bonusItem').val());
        var priceitem       = +($('#totalPriceItem').val());
        var harian          = +($('#total_ket_harian').val());
        var minggu          = +($('#total_ket_minggu').val());
        var jmlTotalGaji    = gajipokok + bonus + priceitem + harian + minggu;
        $('.jmlTotalGaji').val(number_format(jmlTotalGaji));
        jmlTotalGaji        = number_roundup(jmlTotalGaji);
        $('.jmlTotalGajiRound').val(number_format(jmlTotalGaji));
        $('#totalGajiKaryawan').val(jmlTotalGaji);
    });

    $('#hariKerja').on('change', function() {
        var gaji            = +($('#jmlGaji').val());
        var hari            = +($('#hariKerja').val());
        var golongan        = $('#nomorGolongan').val();
        if (+(golongan) < 4) {
            if (hari < 6) {
                gaji        = 5000;
                $('#jmlGaji').val(gaji);
            }
        }
        var gajipokok       = gaji * hari;
        $('#jmlGajiFormat').val(gajipokok);
        
        var bonus           = +($('#bonusItem').val());
        var priceitem       = +($('#totalPriceItem').val());
        var harian          = +($('#total_ket_harian').val());
        var minggu          = +($('#total_ket_minggu').val());
        var jmlTotalGaji    = gajipokok + bonus + priceitem + harian + minggu;
        $('.jmlTotalGaji').val(number_format(jmlTotalGaji));
        jmlTotalGaji        = number_roundup(jmlTotalGaji);
        $('.jmlTotalGajiRound').val(number_format(jmlTotalGaji));
        $('#totalGajiKaryawan').val(jmlTotalGaji);
    });
    
    $('#check_ket_harian').on('change', function(){
        if(this.checked) {
            $('#ket_harian').removeAttr('readonly');
            $('#input_ket_harian').removeAttr('readonly');
            $('#val_ket_harian').val('1');
            $('#ket_harian').val($('#ket_harian_hidden').val());
        }
        else {
            $('#ket_harian').attr('readonly', 'readonly');
            $('#input_ket_harian').attr('readonly', 'readonly');

            $('#val_ket_harian').val('0');
            $('#ket_harian').val('0');
            $('#input_ket_harian').val('0');
            $('#total_ket_harian').val('0');
        }

        var harian          = +($('#total_ket_harian').val());
            
        var gajipokok       = +($('#jmlGajiFormat').val());
        var bonus           = +($('#bonusItem').val());
        var priceitem       = +($('#totalPriceItem').val());
        var minggu          = +($('#total_ket_minggu').val());
        var jmlTotalGaji    = gajipokok + bonus + priceitem + harian + minggu;
        $('.jmlTotalGaji').val(number_format(jmlTotalGaji));
        jmlTotalGaji        = number_roundup(jmlTotalGaji);
        $('.jmlTotalGajiRound').val(number_format(jmlTotalGaji));
        $('#totalGajiKaryawan').val(jmlTotalGaji);
    });
    
    $('#check_ket_minggu').on('change', function(){
        if(this.checked) {
            $('#ket_minggu').removeAttr('readonly');

            $('#val_ket_minggu').val('1');

            var ket_minggu  = +($('#ket_minggu_hidden').val());
            if (ket_minggu == 0) {
                var ket_harian  = +($('#ket_harian_hidden').val());
                ket_minggu      = Math.round(ket_harian/7 * 3);
            }
            $('#ket_minggu').val(ket_minggu);
            $('#input_ket_minggu').val('1');
            $('#total_ket_minggu').val(ket_minggu);
            
        }
        else {
            $('#ket_minggu').attr('readonly', 'readonly');

            $('#val_ket_minggu').val('0');
            $('#ket_minggu').val('0');
            $('#input_ket_minggu').val('0');
            $('#total_ket_minggu').val('0');
        }
        var minggu          = +($('#total_ket_minggu').val());

        var gajipokok       = +($('#jmlGajiFormat').val());
        var bonus           = +($('#bonusItem').val());
        var priceitem       = +($('#totalPriceItem').val());
        var harian          = +($('#total_ket_harian').val());
        var jmlTotalGaji    = gajipokok + bonus + priceitem + harian + minggu;
        $('.jmlTotalGaji').val(number_format(jmlTotalGaji));
        jmlTotalGaji        = number_roundup(jmlTotalGaji);
        $('.jmlTotalGajiRound').val(number_format(jmlTotalGaji));
        $('#totalGajiKaryawan').val(jmlTotalGaji);
    });

    $('#ket_harian').on('change', function() {
        var ket_harian      = +($('#ket_harian').val());
        var qty_harian      = +($('#input_ket_harian').val());
        var harian          = ket_harian * qty_harian;
        $('#total_ket_harian').val(harian);

        var gajipokok       = +($('#jmlGajiFormat').val());
        var bonus           = +($('#bonusItem').val());
        var priceitem       = +($('#totalPriceItem').val());
        var minggu          = +($('#total_ket_minggu').val());
        var jmlTotalGaji    = gajipokok + bonus + priceitem + harian + minggu;
        $('.jmlTotalGaji').val(number_format(jmlTotalGaji));
        jmlTotalGaji        = number_roundup(jmlTotalGaji);
        $('.jmlTotalGajiRound').val(number_format(jmlTotalGaji));
        $('#totalGajiKaryawan').val(jmlTotalGaji);
    });

    $('#input_ket_harian').on('change', function() {
        var ket_harian      = +($('#ket_harian').val());
        var qty_harian      = +($('#input_ket_harian').val());
        var harian          = ket_harian * qty_harian;
        $('#total_ket_harian').val(harian);

        var gajipokok       = +($('#jmlGajiFormat').val());
        var bonus           = +($('#bonusItem').val());
        var priceitem       = +($('#totalPriceItem').val());
        var minggu          = +($('#total_ket_minggu').val());
        var jmlTotalGaji    = gajipokok + bonus + priceitem + harian + minggu;
        $('.jmlTotalGaji').val(number_format(jmlTotalGaji));
        jmlTotalGaji        = number_roundup(jmlTotalGaji);
        $('.jmlTotalGajiRound').val(number_format(jmlTotalGaji));
        $('#totalGajiKaryawan').val(jmlTotalGaji);
    });

    $('#ket_minggu').on('change', function() {
        var minggu          = +($('#ket_minggu').val());
        $('#total_ket_minggu').val(minggu);

        var gajipokok       = +($('#jmlGajiFormat').val());
        var bonus           = +($('#bonusItem').val());
        var priceitem       = +($('#totalPriceItem').val());
        var harian          = +($('#total_ket_harian').val());
        var jmlTotalGaji    = gajipokok + bonus + priceitem + harian + minggu;
        $('.jmlTotalGaji').val(number_format(jmlTotalGaji));
        jmlTotalGaji        = number_roundup(jmlTotalGaji);
        $('.jmlTotalGajiRound').val(number_format(jmlTotalGaji));
        $('#totalGajiKaryawan').val(jmlTotalGaji);
    });

    function harga(int) {
        var harga           = +($('.harga'+int).val());
        var qty             = +($('.qty'+int).val());
        var price           = harga * qty;
        $('.price'+int).val(price);

        var totalItem       = $('#totalItem').val();
        var priceitem       = 0;
        for (var x=1; x <= totalItem; x++) {
            var hrgItem     = +($('.price'+x).val());
            priceitem       = priceitem + hrgItem;
        }
        $('#totalPriceItem').val(priceitem);

        var gajipokok       = +($('#jmlGajiFormat').val());
        var bonus           = +($('#bonusItem').val());
        var harian          = +($('#total_ket_harian').val());
        var minggu          = +($('#total_ket_minggu').val());

        var jmlTotalGaji    = gajipokok + priceitem + bonus + harian + minggu;
        $('.jmlTotalGaji').val(number_format(jmlTotalGaji));
        jmlTotalGaji        = number_roundup(jmlTotalGaji);
        $('.jmlTotalGajiRound').val(number_format(jmlTotalGaji));
        $('#totalGajiKaryawan').val(jmlTotalGaji);
    }

    function qty(int) {
        var harga           = +($('.harga'+int).val());
        var qty             = +($('.qty'+int).val());
        var price           = harga * qty;
        $('.price'+int).val(price);

        var totalItem       = $('#totalItem').val();
        var priceitem       = 0;
        var qtyitem         = 0;
        for (var x=1; x <= totalItem; x++) {
            var hrgItem     = +($('.price'+x).val());
            priceitem       = priceitem + hrgItem;

            var jmlItem     = +($('.qty'+x).val());
            qtyitem         = qtyitem + jmlItem;
        }
        $('#totalPriceItem').val(priceitem);
        $('#qtyTotalItem').val(qtyitem);

        var gajipokok       = +($('#jmlGajiFormat').val());

        var nominalbonus    = 0;
        var noGol           = $('#nomorGolongan').val();
        if (noGol == '1') {
            var betot       = 0;
            var bonus       = 0;
            for (var x=1; x<=totalItem-1; x++) {
                var qty     = +($('.qty'+x).val());
                betot       = betot + qty;

                if (x == 2) {
                    qty     = Math.fround(qty*36/30);
                    bonus   = bonus + qty;
                    console.log(qty);
                }
                else {
                    bonus   = bonus + qty;
                }
            }
            if (bonus>=20 && bonus<25) { nominalbonus = bonus * 1000; }
            else if (bonus >= 25) { nominalbonus = 30000; }
            else { nominalbonus = 0; }

            $('#qtyTotalItem').val(betot);
            $('#bonusItem').val(nominalbonus);
        }

        var harian          = +($('#total_ket_harian').val());
        var minggu          = +($('#total_ket_minggu').val());

        var jmlTotalGaji    = gajipokok + priceitem + nominalbonus + harian + minggu;
        $('.jmlTotalGaji').val(number_format(jmlTotalGaji));
        jmlTotalGaji = number_roundup(jmlTotalGaji);
        $('.jmlTotalGajiRound').val(number_format(jmlTotalGaji));
        $('#totalGajiKaryawan').val(jmlTotalGaji);
    }


    function number_format(number, decimals, decPoint, thousandsSep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number;
        var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals);
        var sep = (typeof thousandsSep === 'undefined') ? '.' : thousandsSep;
        var dec = (typeof decPoint === 'undefined') ? ',' : decPoint;
        var s = '';

        var toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + (Math.round(n * k) / k)
                .toFixed(prec);
        }

        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }

        return s.join(dec);
    }

    function number_roundup(number) {
        number = number.toString();
        var number_length = number.length;
        var hundreds = +(number.substr(-3));
        var after_hundreds = +(number.substr(0, number_length-3));
        var roundup = '';
        if (hundreds > 0) {
            hundreds = '000';
            after_hundreds = after_hundreds + 1;
            after_hundreds = after_hundreds.toString();
            roundup = after_hundreds + hundreds;
        }
        else {
            roundup = number;
        }
        return roundup;
    }
</script> 
@endpush