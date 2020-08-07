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
                    <h1 id="header">Buat Penerimaan Barang</h1>
                </div>
                <div class="x_content">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <div class="form-group">
                                <br>
                                <label for="">Supplier</label>
                                <select name="supId" class="form-control" id="supId">
                                    <option value="0">- Pilih Supplier -</option>
                                    @foreach($suppliers as $supplier)
                                    <option name="KodeSupplier" value="{{$supplier->KodeSupplier}}">{{$supplier->NamaSupplier}}</option>
                                    @endforeach
                                </select>
                                <br><br>
                                <div class="po-select-container">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-1">
                        </div>
                        <div class="po-detail-container">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#supId').select2()
    $('#alamat').select2()
    $('#sales').select2()
    $('#gudang').select2()
    $('#matauang').select2()

    $('#supId').on('change', function() {
        var nameId = $('#supId option:selected').attr('value');
        if (nameId == 0) {
            $('.po-select-container').html('');
        } else {
            $('.po-select-container').html('');
            var my_url = '/penerimaanBarang/searchpobysupid/' + nameId;
            $.get(my_url, function(datas, status) {
                var html = '';
                if ($.isEmptyObject(datas)) {
                    html = '<label for="">Tidak ada PO ditemukan</label>';
                } else {
                    $('.po-select-empty').removeClass('hidden');
                    var options = ''
                    $.each(datas, function(i, val) {
                        options = options + '<option value="' + val + '">' + val + '</option>'
                    });
                    html = '<label for="">Kode PO</label>' +
                        '<select name="poId" class="form-control" id="poId">' +
                        '<option  selected="selected" value="0">- Pilih kode PO -</option>' +
                        options +
                        '</select>';
                }
                $('.po-select-container').html(html)
                $('#poId').select2()
            });
        }
        $('.po-detail-container').html('');
    });
    $('body').on('change', '#poId', function() {
        var poId = $('#poId option:selected').attr('value');
        if (poId == 0) {
            $('.po-detail-container').html('')
        } else {
            var my_url = '/penerimaanBarang/createbasedpo/' + poId;
            $.get(my_url, function(datas, status) {
                $('.po-detail-container').html(datas)
            });
        }

    });

    function refresh(val) {
        var base = "{{ url('/') }}" + "/penerimaanBarang/create/" + val.value;
        window.location.href = base;
    }

    updatePrice($(".tot").val());

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
        diskon = parseInt($(".subtotal").val()) * diskon / 100;
        $(".subtotal").val(parseInt($(".subtotal").val()));
        var ppn = $(".ppn").val();
        if (ppn == "ya") {
            ppn = parseInt(befDis) * 10 / 100;
        } else {
            ppn = parseInt(0);
        }
        $(".ppnval").val(ppn);
        $(".diskonval").val(diskon);
        $(".befDis").val(parseInt($(".subtotal").val()));
        $(".subtotal").val(parseInt($(".subtotal").val()) + ppn - diskon);
    }

    function qty(int) {
        var qty = $(".qty" + int).val();
        var max = $(".max" + int).val();
        if (parseInt(qty) > parseInt(max)) {
            $(".qty" + int).val(max);
        }
        var qty = $(".qty" + int).val();
        var price = $(".price" + int).val();
        $(".total" + int).val(price * qty);
        var count = $(".tot").val();
        updatePrice(count);
    }

    $('.formsub').submit(function(event) {
        tot = $(".tot").val();
        for (var i = 1; i <= tot; i++) {
            if (typeof $(".qty" + i).val() === 'undefined') {}
            // else {
            //   if ($(".qty" + i).val() == 0) {
            //     event.preventDefault();
            //     $(".qty" + i).focus();
            //   }
            // }
        }
    });
</script>
@endpush