@extends('index')
@section('content')
<style type="text/css">
    #header {
        text-align: center;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <!-- <div class="x_title"> -->
                <h1>Pilih Tanggal</h1><br>
                <div class="row">
                    <form action="{{ url('/hutangproduksi/create') }}" method="post">
                        @csrf
                        <div class="col-md-3">
                            <label for="inputDate">Tanggal Produksi (Mulai)</label>
                            <div class="input-group date" id="inputDate">
                                <input type="text" class="form-control" name="start" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <label for="inputDate">Tanggal Produksi (Sampai)</label>
                            <div class="input-group date" id="inputDate2">
                                <input type="text" class="form-control" name="finish" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Tanggal Gajian</label>
                            <div class="input-group date" id="inputDate3">
                                <input type="text" class="form-control" name="gaji" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <label></label>
                            <input type="submit" class="form-control btn btn-primary" value="Tampilkan">
                        </div>
                        <div class="col-md-3">
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
    $('#inputDate').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY-MM-DD'
    });
    $('#inputDate2').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY-MM-DD'
    });
    $('#inputDate3').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY-MM-DD'
    });
</script>
@endpush