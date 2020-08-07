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
                    <h1 id="header">Return Penerimaan Barang</h1>
                </div>
                <div class="x_content">
                    <form action="{{ url('/returnPenerimaanBarang/store',$id)}}" method="post" class="formsub">
                        @csrf
                        <!-- Contents -->
                        <br>
                        <div class="form-row">
                            <!-- column 1 -->
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label>Nomor Penerimaan Barang</label>
                                    <select name="KodePB" class="form-control" id="KodePB" onchange="refresh(this)">
                                        @foreach($pb as $data)
                                        @if($data->KodePenerimaanBarang == $id)
                                        <option selected="selected" value="{{$data->KodePenerimaanBarang}}">{{$data->KodePenerimaanBarang}}</option>
                                        @else
                                        <option value="{{$data->KodePenerimaanBarang}}">{{$data->KodePenerimaanBarang}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputDate">Tanggal</label>
                                    <input type="date" class="form-control" name="Tanggal" id="inputDate" required="required" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                </div>
                            </div>
                            <!-- pembatas -->
                            <div class="form-group col-md-1"></div>
                            <!-- column 2 -->
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label for="inputTerm">Sales</label>
                                    <input type="text" class="form-control" name="KodeSales" id="inputBerlaku" value="{{$sales->Nama}}" readonly="" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="inputPelanggan">Supplier</label>
                                    <input type="text" class="form-control" name="KodeSupplier" id="KodeSupplier" value="{{$pbDet->supplier->NamaSupplier}}" readonly="" required="required">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="inputPelanggan">Diskon</label> -->
                                <input type="hidden" step=0.01 readonly="readonly" class="diskon form-control diskon" name="diskon" id="inputBerlaku" value="{{$po->Diskon}}">
                                <!-- </div>
                                <div class="form-group">
                                    <label for="inputPelanggan">PPn</label> -->
                                <input type="hidden" readonly="readonly" class="diskon form-control ppn" name="ppn" id="inputBerlaku" value="{{$po->PPN}}">
                                <!-- </div> -->
                            </div>
                            <!-- pembatas -->
                            <div class="form-group col-md-1"></div>
                            <!-- column 3 -->
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label for="inputMatauang">Mata Uang</label>
                                    <input type="text" class="form-control" name="KodeMataUang" id="KodeMataUang" value="{{$pbDet->uang->NamaMataUang}}" readonly="" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="inputGudang">Gudang</label>
                                    <input type="text" class="form-control" name="KodeLokasi" id="NamaLokasi" value="{{$pbDet->gudang->NamaLokasi}}" readonly="" required="required">
                                </div>
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
                                        <td id="header">Total</td>/
                                    </tr>
                                    @foreach($items as $key => $data)
                                    <tr class="rowinput">
                                        <td>
                                            <input type="text" class="form-control" readonly="readonly" value="{{$data->NamaItem}}">
                                            <input type="hidden" readonly="readonly" name="item[]" value="{{$data->KodeItem}}">
                                        </td>
                                        <td>
                                            <input type="number" step=0.01 onchange="qty({{$key+1}})" name="qty[]" class="form-control qty{{$key+1}} qtyj" required="" placeholder="{{$data->jml}}">
                                            <input type="hidden" step=0.01 class="max{{$key+1}}" value="{{$data->jml}}">
                                        </td>
                                        <td>
                                            <input type="hidden" class="form-control" readonly name="satuan[]" value="{{$data->KodeSatuan}}">
                                            <input type="text" class="form-control" readonly value="{{$data->NamaSatuan}}">
                                        </td>
                                        <td>
                                            <input readonly="" type="text" name="price[]" class="form-control price{{$key+1}}" required="" value="{{$data->Harga}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" readonly name="keterangan[]" value="{{$data->Keterangan}}" />
                                        </td>
                                        <td>
                                            <input readonly type="text" name="total[]" class="form-control total{{$key+1}}" required="" value="{{$data->Harga * $data->jml}}">
                                        </td>
                                    </tr>
                                    @endforeach

                                </table>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                                <div class="col-md-3">
                                    <input type="hidden" value="{{sizeof($items)}}" class="tot">
                                    <label for="subtotal">Subtotal</label>
                                    <input type="text" name="total" readonly class="form-control befDis">
                                    <label for="ppn">Nilai PPN</label>
                                    <input type="text" readonly name="ppnval" class="ppnval form-control">
                                    <label for="diskon">Nilai Diskon</label>
                                    <input type="text" readonly name="diskonval" class="diskonval form-control">
                                    <label for="total">Total</label>
                                    <input type="text" readonly class="form-control subtotal" name="subtotal">
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
    $('#KodePB').select2();

    function refresh(val) {
        var base = "{{ url('/') }}" + "/returnPenerimaanBarang/create/" + val.value;
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
            //     if ($(".qty" + i).val() == 0) {
            //         event.preventDefault();
            //         $(".qty" + i).focus();
            //     }
            // }
        }
    });
</script>
@endpush