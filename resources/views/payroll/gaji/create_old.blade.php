@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel" id="body_gaji">
                <div class="x_title">
                    <h1>Slip Gaji Karyawan</h1>
                </div>
                <form action="{{ url('/gaji/store') }}" method="post" style="display:inline-block;">
                    @csrf
                    @method('POST')

                    <!-- Penghitungan gaji pokok -->
                    <div class="x_content">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Karyawan: </label>
                                    <select class="form-control namaKaryawan">
                                        <option selected disabled hidden>-- Pilih Karyawan --</option>
                                        @foreach($data_karyawan as $karyawan)
                                            <option value="{{ $karyawan->KodeKaryawan }}">{{ $karyawan->Nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kode Karyawan: </label>
                                    <input type="text" name="KodeKaryawan" placeholder="Kode Karyawan" class="form-control" id="kodeKaryawan" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Golongan: </label>
                                    <input type="text" placeholder="Golongan Karyawan" class="form-control" id="golonganKaryawan" readonly>
                                    <input type="hidden" id="nomorGolongan">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gaji Pokok: </label>
                                    <input type="text" id="jmlGaji" class="form-control" value="0">
                                </div>
                                <div class="form-group">
                                    <label>Hari Kerja: </label>
                                    <input type="text" id="hariKerja" class="form-control" value="0" name="HariKerja">
                                </div>
                                <div class="form-group">
                                    <label>Total Gaji Pokok: </label>
                                    <input type="text" name="SubtotalGajiPokok" readonly id="jmlGajiFormat" class="form-control" value="0">
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
                            <br><br>

                            <div class="x_title"></div>

                            <br>

                            <h3 id="header" style="float: left;">Daftar Item</h3>

                            <br><br><br>

                            <input type="hidden" value="0" id="totalItem">

                            <table id="items" class="table">
                                <tr style="background-color: #eeeeee;">
                                    <th id="header" style="width: 20%;">Nama Barang</th>
                                    <th id="header" style="width: 20%;">Harga Satuan</th>
                                    <th id="header" style="width: 20%;">Qty</th>
                                    <th id="header" style="width: 20%;">Subtotal</th>
                                </tr>
                            </table>
                            <table id="itemlist" class="table">
                                
                            </table>
                            <table class="table">
                                <tr class="qtyTotalItem">
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;">Jumlah Item</td>
                                    <td style="width: 20%;">
                                        <input readonly type="text" id="qtyTotalItem" value="0" class="form-control" name="JumlahItem">
                                    </td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                <tr class="bonus" style="display: none;">
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;">Bonus</td>
                                    <td style="width: 20%;">
                                        <input type="text" id="bonus" value="0" class="form-control">
                                    </td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                <tr class="qtybonus" style="display: none;">
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;">Qty</td>
                                    <td style="width: 20%;">
                                        <input type="text" id="qtybonus" value="0" class="form-control">
                                    </td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;">Total Bonus</td>
                                    <td style="width: 20%;">
                                        <input readonly type="text" id="bonusItem" value="0" class="form-control" name="Bonus">
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
                    <div class="form-row tabel_tambahan" style="display: none;">
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
								<tr class="tabel_lembur_harian">
                                    <td>Lembur Harian/Jam</td>
									<td>
										<input type="checkbox" id="check_ket_harian">
                                        <input type="hidden" name="tag_lembur[]" value="Lembur Harian">
                                        <input type="hidden" name="status[]" id="val_ket_harian" value="0">
									</td>
									<td>
										<input type="hidden" id="ket_harian_hidden">
										<input type="text" id="ket_harian" name="nominal[]" class="form-control" value="0" readonly>
									</td>
									<td>
										<input type="text" id="input_ket_harian" class="form-control" name="qty_lembur[]" value="0" readonly>
									</td>
									<td>
										<input type="text" id="total_ket_harian" class="form-control" name="subtotal_lembur[]" value="0" readonly>
									</td>
                                </tr>
								<tr>
                                    <td>Lembur Minggu</td>
									<td>
										<input type="checkbox" id="check_ket_minggu">
                                        <input type="hidden" name="tag_lembur[]" value="Lembur Minggu">
                                        <input type="hidden" name="status[]" id="val_ket_minggu" value="0">
									</td>
									<td>
										<input type="hidden" id="ket_minggu_hidden">
										<input type="text" id="ket_minggu" class="form-control" name="nominal[]" value="0" readonly>
									</td>
									<td>
                                        <input type="number" name="qty_lembur[]" id="input_ket_minggu" class="form-control" value="0" readonly>
									</td>
									<td>
										<input type="text" id="total_ket_minggu" class="form-control" name="subtotal_lembur[]" value="0" readonly>
									</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br>
                    <div class="form-inline">
                        <label>Total Gaji Karyawan: </label>
                        <input type="text" readonly class="form-control jmlTotalGaji" value="0">
                        <label> pembulatan: </label>
                        <input type="text" readonly class="form-control jmlTotalGajiRound" value="0">
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

    $('.namaKaryawan').select2();
    $('.namaKaryawan').on('change', function() {
        $('#itemlist').empty();
        $('#qtyTotalItem').val("0");
        $('#bonusItem').val("0");
        $('#totalPriceItem').val("0");

        $('#check_ket_harian').removeAttr('checked');
        $('#ket_harian').attr('readonly', 'readonly');
        $('#input_ket_harian').attr('readonly', 'readonly');
        $('#val_ket_harian').val('0');
        $('#ket_harian').val('0');
        $('#input_ket_harian').val('0');
        $('#total_ket_harian').val('0');

        $('#check_ket_minggu').removeAttr('checked');
        $('#ket_minggu').attr('readonly', 'readonly');
        $('#val_ket_minggu').val('0');
        $('#ket_minggu').val('0');
        $('#input_ket_minggu').val('0');
        $('#total_ket_minggu').val('0');

        var kodeKar         = $('.namaKaryawan option:selected').attr('value');
        var url             = '/gaji/searchkaryawanbykode/' + kodeKar;
        $.get(url, function(data, status) {
            if($.isEmptyObject(data)) {
            }
            else {
                console.log(data);
                $('.tabel_list').removeAttr('style');
                $('.tabel_tambahan').removeAttr('style');
				$('#btn_simpan').removeAttr('disabled');
				
                $.each(data, function(i, val) {
                    $('#kodeKaryawan').val(val.KodeKaryawan);
                    $('#golonganKaryawan').val(val.KodeGolongan);
                    $('#hariKerja').val(val.total_absen);

                    var gol         = val.KodeGolongan;
                    var golnum      = gol.substring(4);
                    $('#nomorGolongan').val(+(golnum));
                    console.log($('#nomorGolongan').val());
                    if (+(golnum) < 4) {
                        $('.qtyTotalItem').removeAttr('style');
                        $('.bonus').attr('style', 'display: none;');
                        $('.qtybonus').removeAttr('style');
                        $('#jmlGaji').val(val.UangHadir);
                    }
                    else {
                        $('.qtyTotalItem').attr('style', 'display: none;');
                        $('.bonus').removeAttr('style');
                        $('.qtybonus').attr('style', 'display: none;');
                        $('#jmlGaji').val(val.GajiPokok);
                    }

                    var total_absen = (val.total_absen_masuk + val.total_absen_keluar) / 2;
                    if (+(golnum) < 4 && total_absen < 6) {
                        $('#jmlGaji').val('5000');
                    }

                    var gaji        = +($('#jmlGaji').val());
                    var hari        = +($('#hariKerja').val());
                    var gajipokok   = gaji * hari;
                    $('#jmlGajiFormat').val(gajipokok);
                    $('.jmlTotalGaji').val(number_format(gajipokok));
                    $('.jmlTotalGajiRound').val(number_format(number_roundup(gajipokok)));
                    $('#totalGajiKaryawan').val(gajipokok);
					
					$('#ket_harian_hidden').val(val.UangHarian);
					var harian      = +($('#ket_harian_hidden').val());
					var lembur      = Math.round(harian/7 * 3);
					$('#ket_minggu_hidden').val(lembur);

                    // ambil data jenis item berdasarkan golongan karyawan
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
                                    '<td style="width: 20%;">' + 
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
        jmlTotalGaji        = number_roundup($('.jmlTotalGaji').val());
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
        jmlTotalGaji        = number_roundup($('.jmlTotalGaji').val());
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
        jmlTotalGaji        = number_roundup($('.jmlTotalGaji').val());
        $('.jmlTotalGajiRound').val(number_format(jmlTotalGaji));
        $('#totalGajiKaryawan').val(jmlTotalGaji);
	});
	
	$('#check_ket_minggu').on('change', function(){
		if(this.checked) {
			$('#ket_minggu').removeAttr('readonly');

            $('#val_ket_minggu').val('1');
            $('#ket_minggu').val($('#ket_minggu_hidden').val());
            $('#input_ket_minggu').val('1');
            $('#total_ket_minggu').val($('#ket_minggu_hidden').val());
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
        jmlTotalGaji        = number_roundup($('.jmlTotalGaji').val());
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
        jmlTotalGaji        = number_roundup($('.jmlTotalGaji').val());
        $('.jmlTotalGajiRound').val(number_format(jmlTotalGaji));
        $('#totalGajiKaryawan').val(jmlTotalGaji);
    });

    $('#input_ket_harian').on('change', function() {
        var ket_harian      = +($('#ket_harian').val());
        var qty_harian      = +($('#input_ket_harian').val());
        var harian          = Math.round(ket_harian * qty_harian);
        $('#total_ket_harian').val(harian);

        var gajipokok       = +($('#jmlGajiFormat').val());
        var bonus           = +($('#bonusItem').val());
        var priceitem       = +($('#totalPriceItem').val());
        var minggu          = +($('#total_ket_minggu').val());
        var jmlTotalGaji    = gajipokok + bonus + priceitem + harian + minggu;
        $('.jmlTotalGaji').val(number_format(jmlTotalGaji));
        jmlTotalGaji        = number_roundup($('.jmlTotalGaji').val());
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
        jmlTotalGaji        = number_roundup($('.jmlTotalGaji').val());
        $('.jmlTotalGajiRound').val(number_format(jmlTotalGaji));
        $('#totalGajiKaryawan').val(jmlTotalGaji);
    });

    $('#bonus').on('change', function() {
        var bns             = +($('#bonus').val()); console.log(bns);
        var qtybns          = +($('#qtybonus').val()); console.log(qtybns);
        var bonus           = bns * qtybns;
        $('#bonusItem').val(bonus);

        var gajipokok       = +($('#jmlGajiFormat').val());
        var priceitem       = +($('#totalPriceItem').val());
        var harian          = +($('#total_ket_harian').val());
        var minggu          = +($('#total_ket_minggu').val());
        var jmlTotalGaji    = gajipokok + bonus + priceitem + harian + minggu;
        $('.jmlTotalGaji').val(number_format(jmlTotalGaji));
        jmlTotalGaji        = number_roundup($('.jmlTotalGaji').val());
        $('.jmlTotalGajiRound').val(number_format(jmlTotalGaji));
        $('#totalGajiKaryawan').val(jmlTotalGaji);
    });

    $('#qtybonus').on('change', function() {
        var bns             = +($('#bonus').val()); console.log(bns);
        var qtybns          = +($('#qtybonus').val()); console.log(qtybns);
        var bonus           = bns * qtybns;
        $('#bonusItem').val(bonus);

        var gajipokok       = +($('#jmlGajiFormat').val());
        var priceitem       = +($('#totalPriceItem').val());
        var harian          = +($('#total_ket_harian').val());
        var minggu          = +($('#total_ket_minggu').val());
        var jmlTotalGaji    = gajipokok + bonus + priceitem + harian + minggu;
        $('.jmlTotalGaji').val(number_format(jmlTotalGaji));
        jmlTotalGaji        = number_roundup($('.jmlTotalGaji').val());
        $('.jmlTotalGajiRound').val(number_format(jmlTotalGaji));
        $('#totalGajiKaryawan').val(jmlTotalGaji);
    });

    function harga(int) {
        var harga = +($('.harga'+int).val());
        var qty = +($('.qty'+int).val());
        var price = harga * qty;
        $('.price'+int).val(price);

        var totalItem = $('#totalItem').val();
        var priceitem = 0;
        for (var x=1; x <= totalItem; x++) {
            var hrgItem = +($('.price'+x).val());
            priceitem = priceitem + hrgItem;
        }
        $('#totalPriceItem').val(priceitem);

        var gajipokok = +($('#jmlGajiFormat').val());
        var bonus       = +($('#bonusItem').val());
        var harian      = +($('#total_ket_harian').val());
        var minggu      = +($('#total_ket_minggu').val());

        var jmlTotalGaji = gajipokok + priceitem + bonus + harian + minggu;
        $('.jmlTotalGaji').val(number_format(jmlTotalGaji));
        jmlTotalGaji = number_roundup($('.jmlTotalGaji').val());
        $('.jmlTotalGajiRound').val(number_format(jmlTotalGaji));
        $('#totalGajiKaryawan').val(jmlTotalGaji);
    }

    function qty(int) {
        var harga = +($('.harga'+int).val());
        var qty = +($('.qty'+int).val());
        var price = harga * qty;
        $('.price'+int).val(price);

        var totalItem = $('#totalItem').val();
        var priceitem = 0;
        var qtyitem = 0;
        for (var x=1; x <= totalItem; x++) {
            var hrgItem = +($('.price'+x).val());
            priceitem = priceitem + hrgItem;

            var jmlItem = +($('.qty'+x).val());
            qtyitem = qtyitem + jmlItem;
        }
        $('#totalPriceItem').val(priceitem);
        $('#qtyTotalItem').val(qtyitem);

        var gajipokok = +($('#jmlGajiFormat').val());

        var nominalbonus = 0;
        var noGol = $('#nomorGolongan').val();
        if (noGol == '1') {
            var betot = 0;
            var bonus = 0;
            for (var x=1; x<=totalItem-1; x++) {
                var qty = +($('.qty'+x).val());
                betot = betot + qty;

                if (x == 2) {
                    qty = qty * 36 /30;
                    bonus = bonus + qty;
                    console.log(qty);
                }
                else {
                    bonus = bonus + qty;
                }
            }
            if (bonus>=20 && bonus<25) { nominalbonus = bonus * 1000; }
            else if (bonus >= 25) { nominalbonus = 30000; }
            else { nominalbonus = 0; }

            $('#qtyTotalItem').val(betot);
            $('#bonusItem').val(nominalbonus);
        }

        var harian      = +($('#total_ket_harian').val());
        var minggu      = +($('#total_ket_minggu').val());

        var jmlTotalGaji = gajipokok + priceitem + nominalbonus + harian + minggu;
        $('.jmlTotalGaji').val(number_format(jmlTotalGaji));
        jmlTotalGaji = number_roundup($('.jmlTotalGaji').val());
        $('.jmlTotalGajiRound').val(number_format(jmlTotalGaji));
        $('#totalGajiKaryawan').val(jmlTotalGaji);
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
        if (hundreds > 100) {
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