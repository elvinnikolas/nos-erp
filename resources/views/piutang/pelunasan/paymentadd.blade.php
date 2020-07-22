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
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Pelunasan Piutang</h1>
                </div>
                <div class="x_content">
                    <form action="{{ url('/pelunasanpiutang/payment/'.$invoice->KodeInvoicePiutang.'/add')}}" method="post" class="formsub">
                        @csrf

                        <!-- Contents -->
                        <br>
                        <div class="form-row">
                            <!-- column 1 -->
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="inputDate">Kode Invoice</label>
                                    <input type="text" class="form-control" name="kode" value="{{$invoice->KodeInvoicePiutangShow}}" readonly="" id="inputDate">
                                </div>
                                <div class="form-group">
                                    <label for="inputDate">Mata Uang</label>
                                    <select class="form-control" name="matauang">
                                        @foreach($matauang as $m)
                                        <option value="{{$m->KodeMataUang}}">{{$m->NamaMataUang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputDate">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="AR">Piutang (AR)</option>
                                        <option value="AP">Hutang (AP)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-4">

                                <div class="form-group">
                                    <label for="inputDate">Tanggal Pembayaran</label>
                                    <input type="date" class="form-control" name="Tanggal" id="inputDate" required="required" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputDate">Metode Pembayaran</label>
                                    <select class="form-control" name="metode">
                                        <option value="Kas">Kas</option>
                                        <option value="Bank">Bank</option>
                                        <option value="Cek">Cek</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="inputDate">Jumlah</label>
                                    <input type="number" class="form-control jml" name="jml" placeholder="{{$sisa}}" required="required" pattern="[0-9]+([\.,][0-9]+)?" step="0.01">
                                    <input type="hidden" class="form-control jmlshow" name="jmlshow" value="{{$sisa}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputDate">Keterangan</label>
                                    <textarea class="form-control" name="keterangan"></textarea>
                                </div>
                            </div>
                            <input type="submit" name="" value="Simpan" class="btn btn-primary pull-right">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".jml").change(function() {
        if (parseFloat($(".jml").val()) > parseFloat($(".jmlshow").val())) {
            $(".jml").val($(".jmlshow").val());
        }
    });
</script>
@endsection