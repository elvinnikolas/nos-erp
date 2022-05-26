@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel" id="body_gaji">
                <div class="x_title">
                    <h1>Proses Gaji Karyawan</h1>
                </div>
                <form action="{{ url('/gaji/store') }}" method="post" style="display:inline-block;">
                    @csrf
                    @method('POST')

                    <!-- Penghitungan gaji pokok -->
                    <div class="x_content">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Golongan: </label>
                                    <select class="form-control namaGolongan">
                                        <option selected disabled hidden>-- Pilih Golongan --</option>
                                        @foreach($data_golongan as $golongan)
                                            <option value="{{ $golongan->KodeGolongan }}">{{ $golongan->NamaGolongan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Karyawan: </label>
                                    <select class="form-control namaKaryawan" id="namaKaryawan" disabled>
                                        <option selected disabled hidden>-- Pilih Karyawan --</option>
                                    </select>
                                    <input type="hidden" id="nomorGolongan">
                                </div>
                                <div class="form-group">
                                    <label>Kode Karyawan: </label>
                                    <input type="text" name="KodeKaryawan" placeholder="Kode Karyawan" class="form-control" id="kodeKaryawan" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gaji Pokok: </label>
                                    <input type="text" id="jmlGaji" class="form-control" value="0" onchange="changeNominal(this);" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Hari Kerja: </label>
                                    <input type="text" id="input_jmlGaji" class="form-control" value="0" name="HariKerja" disabled>
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
                                        <input type="text" class="form-control" name="TanggalGajian" id="inputDate" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <br><br><br>

                    <div class="form-row tabel_list" style="display: none;">
                        <div class="form-group col-md-12">
                            <div class="x_title"></div>

                            <h3 id="header" style="float: left;">Daftar Item</h3>

                            <br>

                            <input type="hidden" value="0" id="totalItem">

                            <table id="items" class="table" style="margin-bottom: 0;">
                                <tr style="background-color: #eeeeee;">
                                    <th id="header" style="width: 40%;">Nama Barang</th>
                                    <th id="header" style="width: 20%;">Harga Satuan</th>
                                    <th id="header" style="width: 20%;">Qty</th>
                                    <th id="header" style="width: 20%;">Subtotal</th>
                                </tr>
                            </table>
                            <table id="itemlist" class="table" style="margin-bottom: 0;">
                                
                            </table>
                            <table class="table">
                                <tr class="qtyTotalItem">
                                    <td style="width: 40%;"></td>
                                    <td style="width: 20%;">Jumlah Item</td>
                                    <td style="width: 20%;">
                                        <input readonly type="text" id="qtyTotalItem" value="0" class="form-control">
                                    </td>
                                    <td style="width: 20%;"></td>
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
                    <div class="form-row tabel_tambahan" style="display: none;">
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
                                <tr class="lemburHarian">
                                    <td>Gaji Harian</td>
                                    <td>
                                        <input type="hidden" id="ket_harian_hidden"  name="tag_lembur[]" value="Lembur Harian">
                                        <input type="text" id="ket_harian" name="nominal[]" class="form-control" value="0" onchange="changeNominal(this);">
                                    </td>
                                    <td>
                                        <input type="text" id="input_ket_harian" class="form-control" name="qty_lembur[]" value="0" onchange="changeQty(this);">
                                    </td>
                                    <td>
                                        <input type="text" id="total_ket_harian" class="form-control" name="subtotal_lembur[]" value="0" readonly>
                                    </td>
                                </tr>
                                <tr class="lemburJam">
                                    <td>Lembur Jam</td>
                                    <td>
                                        <input type="hidden" id="ket_jam_hidden" name="tag_lembur[]" value="Lembur Jam">
                                        <input type="text" id="ket_jam" name="nominal[]" class="form-control" value="0" onchange="changeNominal(this);">
                                    </td>
                                    <td>
                                        <input type="text" id="input_ket_jam" class="form-control" name="qty_lembur[]" value="0" onchange="changeQty(this);">
                                    </td>
                                    <td>
                                        <input type="text" id="total_ket_jam" class="form-control" name="subtotal_lembur[]" value="0" readonly>
                                    </td>
                                </tr>
                                <tr class="lemburMinggu">
                                    <td>Lembur Minggu</td>
                                    <td>
                                        <input type="hidden" id="ket_minggu_hidden" name="tag_lembur[]" value="Lembur Minggu">
                                        <input type="text" id="ket_minggu" class="form-control" name="nominal[]" value="0" onchange="changeNominal(this);">
                                    </td>
                                    <td>
                                        <input type="number" name="qty_lembur[]" id="input_ket_minggu" class="form-control" value="0" onchange="changeQty(this);">
                                    </td>
                                    <td>
                                        <input type="text" id="total_ket_minggu" class="form-control" name="subtotal_lembur[]" value="0" readonly>
                                    </td>
                                </tr>
                                <tr class="bonusKaryawan">
                                    <td>Bonus Karyawan</td>
                                    <td>
                                        <input type="hidden" id="ket_bonus_hidden" name="tag_lembur[]" value="Bonus Karyawan">
                                        <input type="text" id="ket_bonus" class="form-control" name="nominal[]" value="0" onchange="changeNominal(this);">
                                    </td>
                                    <td>
                                        <input type="number" id="input_ket_bonus" class="form-control" name="qty_lembur[]" value="0" onchange="changeQty(this);">
                                    </td>
                                    <td>
                                        <input type="hidden" id="total_ket_bonus_hidden">
                                        <input type="text" id="total_ket_bonus" class="form-control" name="subtotal_lembur[]" value="0" readonly>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br>
                    <div class="form-inline">
                        <label>Total Gaji Karyawan: </label>
                        <input type="text" readonly class="form-control" id="jmlTotalGaji" value="0">
                        <label> pembulatan: </label>
                        <input type="text" readonly class="form-control" id="jmlTotalGajiRound" value="0">
                        <input type="hidden" class="form-control" name="TotalGajiKaryawan" id="totalGajiKaryawan">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success" id="btn_simpan" style="width:120px;" onclick="return confirm('Simpan data ini?')" disabled>Simpan</button>
                    <a href="{{ url('/gaji') }}" class="btn btn-danger" style="width:120px;">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
 <script type="text/javascript">
    $('#inputDate').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY-MM-DD'
    });

    /* pilihan Golongan */
    $('.namaGolongan').select2();
    $('.namaGolongan').on('change', function() {
        /* reset semua value menjadi 0 */
        $('#namaKaryawan').html('<option selected disabled hidden>-- Pilih Karyawan --</option>');
        $('#kodeKaryawan').val('');
        $('#jmlGaji').val(0);
        $('#input_jmlGaji').val(0);
        $('#total_jmlGaji').val(0);
        $('#qtyTotalItem').val(0);
        $('#bonusItem').val(0);
        $('#totalPriceItem').val(0);
        $('#ket_harian').val(0);
        $('#input_ket_harian').val(0);
        $('#total_ket_harian').val(0);
        $('#ket_jam').val(0);
        $('#input_ket_jam').val(0);
        $('#total_ket_jam').val(0);
        $('#ket_minggu').val(0);
        $('#input_ket_minggu').val(0)
        $('#total_ket_minggu').val(0);
        $('#ket_bonus').val(0);
        $('#input_ket_bonus').val(0);
        $('#total_ket_bonus_hidden').val(0);
        $('#total_ket_bonus').val(0);
        $('#jmlTotalGaji').val(0);
        $('#jmlTotalGajiRound').val(0);
        $('#totalGajiKaryawan').val(0);

        $('#jmlGaji').attr('disabled', 'disabled');
        $('#input_jmlGaji').attr('disabled', 'disabled');

        /* list item dan list tambahan disembunyikan */
        $('.tabel_list').attr('style', 'display: none;');
        $('.tabel_tambahan').attr('style', 'display: none;');
        $('#itemlist').empty();

        var kodeGol         = $('.namaGolongan option:selected').attr('value');
        var url             = '/gaji/filterfilterkaryawanbygolongan/' + kodeGol;
        $.get(url, function(data, status) {
            if($.isEmptyObject(data)) {
                $('#namaKaryawan').attr('disabled', 'disabled');
            }
            else {
                $('#namaKaryawan').removeAttr('disabled');
                $('#namaKaryawan').empty();
                var option  = '<option selected disabled hidden>-- Pilih Karyawan --</option>';
                $.each(data, function(i, val) {
                    option  = option + '<option value="'+val.KodeKaryawan+'">'+val.Nama+'</option>'
                });
                $('#namaKaryawan').append(option);
            }
        });
    });

    /* pilihan Karyawan */
    $('.namaKaryawan').select2();
    $('.namaKaryawan').on('change', function() {
        $('#itemlist').empty();
        var kodeKar         = $('.namaKaryawan option:selected').attr('value');
        var url             = '/gaji/searchkaryawanbykode/' + kodeKar;
        $.get(url, function(data, status) {
            if($.isEmptyObject(data)) {
            }
            else {
                $('#jmlGaji').removeAttr('disabled')
                $('#input_jmlGaji').removeAttr('disabled')
                $('.tabel_list').removeAttr('style');
                $('.tabel_tambahan').removeAttr('style');
                $('#btn_simpan').removeAttr('disabled');
                
                $.each(data, function(i, val) {
                    $('#kodeKaryawan').val(val.KodeKaryawan);
                    $('#input_jmlGaji').val(val.total_absen);

                    var gol         = val.KodeGolongan;
                    var golnum      = gol.substring(4);
                    $('#nomorGolongan').val(+(golnum));

                    var harian      = 0;
                    var jam         = 0;
                    var minggu      = 0;

                    if (+(golnum) == 1) {
                        $('.lemburHarian').removeAttr('style');
                        $('.qtyTotalItem').removeAttr('style');
                        $('.bonusItem').removeAttr('style');
                        $('#bonusItem').attr('name', 'BonusKaryawan');
                        $('.bonusKaryawan').attr('style', 'display: none;');
                        $('#total_ket_bonus_hidden').removeAttr('name');
                        $('#jmlGaji').val(val.UangHadir);

                        harian      = val.LemburHarian;
                        minggu      = val.LemburMinggu;
                        $('#ket_harian').val(harian);
                        $('#ket_minggu').val(minggu);

                        $('#ket_harian').removeAttr('readonly');
                        $('#input_ket_harian').removeAttr('readonly');

                        $('#ket_jam').removeAttr('readonly');
                        $('#input_ket_jam').removeAttr('readonly');
                    }
                    else if (+(golnum) == 2 || +(golnum) == 3) {
                        $('.lemburHarian').removeAttr('style');
                        $('.qtyTotalItem').attr('style', 'display: none;');
                        $('.bonusItem').attr('style', 'display: none;');
                        $('#bonusItem').removeAttr('name');
                        $('.bonusKaryawan').attr('style', 'display: none;');
                        $('#total_ket_bonus_hidden').attr('name', 'BonusKaryawan');
                        $('#jmlGaji').val(val.UangHadir);

                        harian      = val.LemburHarian;
                        jam         = +(harian) / 7;
                        minggu      = val.LemburMinggu;
                        $('#ket_harian').val(harian);
                        $('#ket_jam').val(jam.toFixed());
                        $('#ket_minggu').val(minggu);

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
                        $('#jmlGaji').val(val.GajiPokok);

                        jam         = +(val.GajiPokok) / 7;
                        minggu      = val.LemburMinggu;
                        $('#ket_jam').val(jam.toFixed());
                        $('#ket_minggu').val(minggu);

                        $('#ket_harian').attr('readonly', 'readonly');
                        $('#input_ket_harian').attr('readonly', 'readonly');

                        $('#ket_jam').removeAttr('readonly');
                        $('#input_ket_jam').removeAttr('readonly');
                    }

                    // var total_absen = (val.total_absen_masuk + val.total_absen_keluar) / 2;
                    // if (+(golnum) < 4 && total_absen < 6) {
                    //     $('#jmlGaji').val('5000');
                    // }

                    var gaji        = +($('#jmlGaji').val());
                    var hari        = +($('#input_jmlGaji').val());
                    var gajipokok   = gaji * hari;
                    $('#total_jmlGaji').val(gajipokok);
                    $('.jmlTotalGaji').val(number_format(gajipokok));
                    $('.jmlTotalGajiRound').val(number_format(number_roundup(gajipokok)));
                    $('#totalGajiKaryawan').val(number_roundup(gajipokok));

                    /* ambil data jenis item berdasarkan jenis golongan */
                    var kodeGol = val.KodeGolongan;
                    var urlGol = '/gaji/searchitembykode/' + kodeGol;
                    $.get(urlGol, function(dt, st) {
                        if($.isEmptyObject(dt)) {
                        }
                        else {
                            var res = "";
                            var int = 0;
                            $.each(dt, function(x, v) {
                                int++;
                                res = res + '<tr class="tambahitem">' +
                                    '<td style="width: 40%;">' + 
                                        '<input type="text" readonly class="form-control" value="'+ v.NamaGolItem +'">' +
                                        '<input type="hidden" name="item[]" class="form-control" value="'+ v.KodeGolItem +'">' +
                                    '</td>' +
                                    '<td style="width: 20%;">' +
                                        '<input type="text" name="harga[]" class="form-control harga'+int+'" value="'+ v.HargaGolItem +'" onchange="harga('+int+')">' +
                                    '</td>' +
                                    '<td style="width: 20%;">' +
                                        '<input type="number" name="qty[]" class="form-control qty'+int+'" value="0" onchange="qty('+int+')">' +
                                    '</td>' +
                                    '<td style="width: 20%;">' +
                                        '<input type="text" readonly name="price[]" class="form-control price'+int+'" value="0">' +
                                    '</td>' +
                                '</tr>';
                            });
                            $('#itemlist').append(res);
                            $('#totalItem').val(int);
                        }
                    });
                });
            }
        });
    });

    $('#input_jmlGaji').on('change', function() {
        var golongan        = +($('#nomorGolongan').val());
        var hari            = +($(this).val());
        var gaji            = +($('#jmlGaji').val());
        if (golongan < 4) {
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
        var golnum      = +($('#nomorGolongan').val());
        var bonus       = 0;
        var jumlahitem  = +($('#totalItem').val());

        /* hitungan bonus untuk golongan Grendel (golongan 1) karena ada bonus tersendiri */
        if (golnum == 1) {
            var konversi    = 0;

            for (var i = 1; i <= 4; i++) {
                var qtyitem     = +($('.qty'+i).val());
                if (i == 3 || i == 4) {
                    qtyitem     = Math.round(qtyitem * 36 / 30); /* rumus FRT */
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