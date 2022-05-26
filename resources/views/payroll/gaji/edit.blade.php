@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel" id="body_gaji">
                <div class="x_title">
                    <h1>Proses Gaji Karyawan</h1>
                </div>
                <form action="{{ url('/gaji/update/' . $id) }}" method="post" style="display:inline-block;">
                    @csrf
                    @method('POST')

                    <!-- Penghitungan gaji pokok -->
                    @foreach($gaji as $data)
                    <div class="x_content">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Golongan: </label>
                                    <input type="text" class="form-control" value="{{$data->NamaGolongan}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Karyawan: </label>
                                    <input type="text" class="form-control" value="{{$data->Nama}}" readonly>
                                    <input type="hidden" id="nomorGolongan" value="{{$data->KodeGolongan}}">
                                </div>
                                <div class="form-group">
                                    <label>Kode Karyawan: </label>
                                    <input type="text" class="form-control" value="{{$data->KodeKaryawan}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gaji Pokok: </label>
                                    <input type="text" id="jmlGaji" class="form-control" value="0" onchange="changeNominal(this);">
                                    <input type="hidden" id="jmlGaji_hidden_borongan" value="{{$data->UangHadir}}">
                                    <input type="hidden" id="jmlGaji_hidden_pokok" value="{{$data->GajiPokok}}">
                                </div>
                                <div class="form-group">
                                    <label>Hari Kerja: </label>
                                    <input type="text" id="input_jmlGaji" class="form-control" value="{{$data->TotalHariKerja}}" name="HariKerja">
                                </div>
                                <div class="form-group">
                                    <label>Total Gaji Pokok: </label>
                                    <input type="text" name="SubtotalGajiPokok" readonly id="total_jmlGaji" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Gajian:</label>
                                    <div class="input-group date" id="inputDate">
                                        <input type="text" class="form-control" name="TanggalGajian" id="inputDate" value="{{$data->TanggalGaji}}">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <br><br><br>

                    <div class="form-row tabel_list">
                        <div class="form-group col-md-12">
                            <div class="x_title"></div>

                            <h3 id="header" style="float: left;">Daftar Item</h3>

                            <br>

                            <input type="hidden" value="{{$totalItem}}" id="totalItem">

                            <table id="items" class="table">
                                <tr style="background-color: #eeeeee;">
                                    <th id="header" style="width: 40%;">Nama Barang</th>
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
                                        <input type="text" name="harga[]" class="form-control harga{{$x}}" value="{{$datadetail->HargaItem}}" onchange="harga({{$x}});">
                                    </td>
                                    <td>
                                        <input type="number" name="qty[]" class="form-control qty{{$x}}" value="{{$datadetail->QtyItem}}" onchange="qty({{$x}});">
                                    </td>
                                    <td>
                                        <input type="text" readonly name="price[]" class="form-control price{{$x}}" value="{{$datadetail->SubtotalItem}}">
                                    </td>
                                </tr>
                                @endforeach
                                <tr class="qtyTotalItem">
                                    <td></td>
                                    <td>Jumlah Item</td>
                                    <td>
                                        <input readonly type="text" id="qtyTotalItem" value="0" class="form-control">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr class="bonusItem">
                                    <td></td>
                                    <td>Bonus</td>
                                    <td>
                                        <input readonly type="text" id="bonusItem" value="0" class="form-control">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Subtotal Harga</td>
                                    <td>
                                        <input readonly type="text" id="totalPriceItem" value="0" class="form-control">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br><br><br>

                    <!-- Penghitungan gaji berdasarkan TAMBAHAN GAJI (LEMBUR DLL) -->
                    <div class="form-row tabel_tambahan">
                        <div class="form-group col-md-12">
                            <div class="x_title"></div>

                            <h3 id="header" style="float: left;">Tambahan Lainnya</h3>

                            <br>

                            <table id="itemtambahans" class="table">
                                <tr style="background-color: #eeeeee;">
                                    <th id="header" style="width: 25%;">Keterangan</th>
                                    <th id="header" style="width: 25%;">Nominal</th>
                                    <th id="header" style="width: 25%;">Jumlah</th>
                                    <th id="header" style="width: 25%;">Subtotal</th>
                                </tr>
                                @foreach($hariangaji as $harian)
                                <tr class="lemburHarian">
                                    <td>Gaji Harian</td>
                                    <td>
                                        <input type="hidden" id="ket_harian_hidden"  name="tag_lembur[]" value="Lembur Harian">
                                        <input type="text" id="ket_harian" name="nominal[]" class="form-control" value="{{$harian->Nominal}}" onchange="changeNominal(this);">
                                    </td>
                                    <td>
                                        <input type="text" id="input_ket_harian" class="form-control" name="qty_lembur[]" value="{{$harian->QtyTambahan}}" onchange="changeQty(this);">
                                    </td>
                                    <td>
                                        <input type="text" id="total_ket_harian" class="form-control" name="subtotal_lembur[]" value="{{$harian->SubtotalTambahan}}" readonly>
                                    </td>
                                </tr>
                                @endforeach

                                @foreach($jamgaji as $jam)
                                <tr class="lemburJam">
                                    <td>Lembur Jam</td>
                                    <td>
                                        <input type="hidden" id="ket_jam_hidden" name="tag_lembur[]" value="Lembur Jam">
                                        <input type="text" id="ket_jam" name="nominal[]" class="form-control" value="{{$jam->Nominal}}" onchange="changeNominal(this);">
                                    </td>
                                    <td>
                                        <input type="text" id="input_ket_jam" class="form-control" name="qty_lembur[]" value="{{$jam->QtyTambahan}}" onchange="changeQty(this);">
                                    </td>
                                    <td>
                                        <input type="text" id="total_ket_jam" class="form-control" name="subtotal_lembur[]" value="{{$jam->SubtotalTambahan}}" readonly>
                                    </td>
                                </tr>
                                @endforeach

                                @foreach($minggugaji as $minggu)
                                <tr class="lemburMinggu">
                                    <td>Lembur Minggu</td>
                                    <td>
                                        <input type="hidden" id="ket_minggu_hidden" name="tag_lembur[]" value="Lembur minggu">
                                        <input type="text" id="ket_minggu" class="form-control" name="nominal[]" value="{{$minggu->Nominal}}" onchange="changeNominal(this);">
                                    </td>
                                    <td>
                                        <input type="number" name="qty_lembur[]" id="input_ket_minggu" class="form-control" value="{{$minggu->QtyTambahan}}" onchange="changeQty(this);">
                                    </td>
                                    <td>
                                        <input type="text" id="total_ket_minggu" class="form-control" name="subtotal_lembur[]" value="{{$minggu->SubtotalTambahan}}" readonly>
                                    </td>
                                </tr>
                                @endforeach

                                @foreach($bonusgaji as $bonus)
                                <tr class="bonusKaryawan">
                                    <td>Bonus Karyawan</td>
                                    <td>
                                        <input type="hidden" id="ket_bonus_hidden" name="tag_lembur[]" value="Bonus Karyawan">
                                        <input type="text" id="ket_bonus" class="form-control" name="nominal[]" value="{{$bonus->Nominal}}" onchange="changeNominal(this);">
                                    </td>
                                    <td>
                                        <input type="number" id="input_ket_bonus" class="form-control" name="qty_lembur[]" value="{{$bonus->QtyTambahan}}" onchange="changeQty(this);">
                                    </td>
                                    <td>
                                        <input type="hidden" id="total_ket_bonus_hidden" value="0">
                                        <input type="text" id="total_ket_bonus" class="form-control" name="subtotal_lembur[]" value="{{$bonus->SubtotalTambahan}}" readonly>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

                    <br>
                    <div class="form-inline">
                        <label>Total Gaji Karyawan: </label>
                        <input type="text" readonly class="form-control" id="jmlTotalGaji" value="0">
                        <label> pembulatan: </label>
                        <input type="text" readonly class="form-control" id="jmlTotalGajiRound" value="0">
                        <input type="hidden" class="form-control" name="TotalGajiKaryawan" id="totalGajiKaryawan" value="{{$data->TotalGaji}}">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success" id="btn_simpan" style="width:120px;" onclick="return confirm('Simpan data ini?')">Simpan</button>
                    <a href="{{ url('/gaji') }}" class="btn btn-danger" style="width:120px;">Batal</a>
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
        /* hitungan subtotalgaji  */
        var golongan        = $('#nomorGolongan').val();
        var gaji            = 0;
        var hari            = +($('#input_jmlGaji').val());
        if (golongan == 'GOL-01' || golongan == 'GOL-02' || golongan == 'GOL-03') {
            if (hari >= 6) { gaji = 10000; }
            else { gaji = 5000; }
        }
        else {
            gaji            = +($('#jmlGaji_hidden_pokok').val());
        }
        var subtotalgaji    = gaji * hari;
        $('#jmlGaji').val(gaji);
        $('#total_jmlGaji').val(subtotalgaji);

        /* hitungan subtotalprice */
        var bonus           = 0;
        var subtotalprice   = 0;
        var totalitem       = +($('#totalItem').val());
        for (var i = 1; i <= totalitem; i++) {
            var price       = +($('.price'+i).val());
            subtotalprice   = subtotalprice + price;
        }
            /* khusus golongan 1 ada hitungan bonus berdasarkan jumlah item */
            if (golongan == 'GOL-01') {
                var konversi        = 0;
                for (var j = 1; j <= 4; j++) {
                    var qty         = +($('.qty'+j).val());
                    if (j == 3 || j == 4) {
                        qty         = Math.round(qty * 36 / 30); /* rumus FRT */
                    }
                    konversi        = konversi + qty;
                }
                $('#qtyTotalItem').val(konversi);

                if (konversi < 20) { bonus      = 0; }
                else if (konversi >= 20 && konversi < 25) { bonus   = konversi * 1000; }
                else if (konversi == 25) { bonus    = 30000; }
                else if (konversi == 26) { bonus    = 31000; }
                else if (konversi == 27) { bonus    = 32000; }
                else if (konversi == 28) { bonus    = 33000; }
                else if (konversi == 29) { bonus    = 34000; }
                else if (konversi >= 30) { bonus    = 40000; }
            }
        $('#bonusItem').val(bonus);
        $('#totalPriceItem').val(subtotalprice);

        /* Bonus pembeda untuk golongan borongan dan non-borongan */
        if (golongan == 'GOL-01') {
            $('.lemburHarian').removeAttr('style');
            $('.qtyTotalItem').removeAttr('style');
            $('.bonusItem').removeAttr('style');
            $('#bonusItem').attr('name', 'BonusKaryawan');
            $('.bonusKaryawan').attr('style', 'display: none;');
            $('#total_ket_bonus_hidden').removeAttr('name');

            $('#ket_harian').removeAttr('readonly');
            $('#input_ket_harian').removeAttr('readonly');

            $('#ket_jam').removeAttr('readonly');
            $('#input_ket_jam').removeAttr('readonly');
        }
        else if (golongan == 'GOL-02' || golongan == 'GOL-03') {
            $('.lemburHarian').removeAttr('style');
            $('.qtyTotalItem').attr('style', 'display: none;');
            $('.bonusItem').attr('style', 'display: none;');
            $('#bonusItem').removeAttr('name');
            $('.bonusKaryawan').attr('style', 'display: none;');
            $('#total_ket_bonus_hidden').attr('name', 'BonusKaryawan');

            $('#ket_harian').removeAttr('readonly');
            $('#input_ket_harian').removeAttr('readonly');

            $('#ket_jam').removeAttr('readonly');
            $('#input_ket_jam').removeAttr('readonly');
        }
        else {
            $('.lemburHarian').attr('style', 'display: none;');
            $('.qtyTotalItem').attr('style', 'display: none;');
            $('.bonusItem').attr('style', 'display: none;');
            $('#bonusItem').removeAttr('name');
            $('.bonusKaryawan').removeAttr('style');
            $('#total_ket_bonus_hidden').attr('name', 'BonusKaryawan');

            $('#ket_harian').attr('readonly', 'readonly');
            $('#input_ket_harian').attr('readonly', 'readonly');

            $('#ket_jam').removeAttr('readonly');
            $('#input_ket_jam').removeAttr('readonly');
        }

        sumGaji();
    });

    $('#inputDate').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY-MM-DD'
    });

    $('#input_jmlGaji').on('change', function() {
        var golongan        = $('#nomorGolongan').val();
        var hari            = +($(this).val());
        var gaji            = +($('#jmlGaji').val());
        if (golongan == 'GOL-01' || golongan == 'GOL-02' || golongan == 'GOL-03') {
            if (hari < 6) {
                gaji        = 5000;
            }
            else {
                gaji        = 10000;
            }
            $('#jmlGaji').val(gaji);
        }
        var subtotalgaji    = gaji * hari;
        $('#total_jmlGaji').val(subtotalgaji);

        sumGaji();
    });

    function qty(int) {
        var golongan    = $('#nomorGolongan').val();
        var bonus       = 0;
        var jumlahitem  = +($('#totalItem').val());

        /* hitungan bonus untuk golongan Grendel (golongan 1) karena ada bonus tersendiri */
        if (golongan == 'GOL-01' || golongan == 'GOL-02' || golongan == 'GOL-03') {
            var konversi    = 0;

            for (var i = 1; i <= 4; i++) {
                var qtyitem     = +($('.qty'+i).val());
                if (i == 3 || i == 4) {
                    qtyitem     = qtyitem * 36 / 30; /* rumus FRT */
                }
                konversi        = konversi + qtyitem;
            }
            $('#qtyTotalItem').val(konversi);

            if (konversi < 20) { bonus      = 0; }
            else if (konversi >= 20 && konversi < 25) { bonus   = konversi * 1000; }
            else if (konversi == 25) { bonus    = 30000; }
            else if (konversi == 26) { bonus    = 31000; }
            else if (konversi == 27) { bonus    = 32000; }
            else if (konversi == 28) { bonus    = 33000; }
            else if (konversi == 29) { bonus    = 34000; }
            else if (konversi >= 30) { bonus    = 40000; }
        }
        $('#bonusItem').val(bonus);

        /* hitungan harga per item */
        var harga           = +($('.harga'+int).val());
        var qty             = +($('.qty'+int).val());
        var price           = harga * qty;
        $('.price'+int).val(price);

        /* hitungan subtotal harga dari semua item */
        var totalprice      = 0;
        for (var j = 1; j <= jumlahitem; j++) {
            var subprice    = +($('.price'+j).val());
            totalprice      = totalprice + subprice;
        }
        $('#totalPriceItem').val(totalprice);

        sumGaji();
    }

    function harga(int) {
        /* hitungan harga per item */
        var harga           = +($('.harga'+int).val());
        var qty             = +($('.qty'+int).val());
        var price           = harga * qty;
        $('.price'+int).val(price);

        /* hitungan subtotal harga dari semua item */
        var totalprice      = 0;
        for (var j = 1; j <= jumlahitem; j++) {
            var subprice    = +($('.price'+j).val());
            totalprice      = totalprice + subprice;
        }
        $('#totalPriceItem').val(totalprice);

        sumGaji();
    }

    function changeNominal(element) {
        /* untuk perubahan di besaran 
        untuk id: jmlGaji, ket_harian, ket_jam, ket_minggu, ket_bonus
        */
        var idelement                   = $(element).attr('id');
        var nominalelement              = parseInt( $('#'+idelement).val() );
        var qtyelement                  = parseInt( $('#input_'+idelement).val() );
        console.log(idelement + " : " + nominalelement + " : " + qtyelement);
        var totalelement                = nominalelement * qtyelement;
        $('#total_'+idelement).val(totalelement);

        sumGaji();
    }

    function changeQty(element) {
        /* untuk berubahan di jumlah(qty) 
        untuk id: input_jmlGaji, input_ket_harian, input_ket_jam, input_ket_minggu, input_ket_bonus
        */
        var id                          = $(element).attr('id');
        id                              = id.split('_'); /* untuk ekstrak input_ */
        var idelement                   = '';
        for(var i = 1; i < id.length; i++) {
            if (i < id.length-1) {
                idelement       = idelement + id[i] + '_';
            }
            else {
                idelement       = idelement + id[i];
            }
        }
        var nominalelement              = parseInt( $('#'+idelement).val() );
        var qtyelement                  = parseInt( $('#input_'+idelement).val() );
        console.log(idelement + " : " + nominalelement + " : " + qtyelement);
        var totalelement                = nominalelement * qtyelement;
        $('#total_'+idelement).val(totalelement);

        sumGaji();
    }

    function sumGaji() {
        /* total gaji seluruhnya 
        var: gaji + bonus + totalprice + harian + jam + minggu + bonuskar = totalgaji
        */
        var gaji            = +($('#total_jmlGaji').val());
        var bonus           = +($('#bonusItem').val());
        var totalprice      = +($('#totalPriceItem').val());
        var harian          = +($('#total_ket_harian').val());
        var jam             = +($('#total_ket_jam').val());
        var minggu          = +($('#total_ket_minggu').val());
        var bonuskar        = +($('#total_ket_bonus').val());
        $('#total_ket_bonus_hidden').val(bonuskar);

        var totalgaji       = gaji + bonus + totalprice + harian + jam + minggu + bonuskar;
        console.log(totalgaji);
        $('#jmlTotalGaji').val(number_format(totalgaji));
        $('#jmlTotalGajiRound').val(number_format(number_roundup(totalgaji)));
        $('#totalGajiKaryawan').val(number_roundup(totalgaji));
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

    function number_roundup(number) {
        number = number.toString();
        var number_length = number.length;
        var hundreds = +(number.substr(-3));
        var after_hundreds = +(number.substr(0, number_length-3));
        var roundup = '';
        if (hundreds >= 100) {
            hundreds = '000';
            after_hundreds = after_hundreds + 1;
            after_hundreds = after_hundreds.toString();
            roundup = after_hundreds + hundreds;
        }
        else {
            hundreds = '000';
            after_hundreds = after_hundreds.toString();
            roundup = after_hundreds + hundreds;
        }
        return roundup;
    }

</script> 
@endpush