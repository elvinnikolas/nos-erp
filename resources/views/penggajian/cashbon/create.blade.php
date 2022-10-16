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
                <div class="x_title">
                    <h1 id="header">Setoran & Cashbon</h1><br>
                </div>

                <div class="x_body">
                    <div class="row">
                        <form action="{{ url('/penggajiancashbon/store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="control-label col-md-3">
                                    <label for="inputDate">Tanggal</label>
                                    <div class="input-group date" id="inputDate">
                                        <input type="text" class="form-control" name="Tanggal" required>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="control-label col-md-1"></div>
                                <div class="control-label col-md-3" style="display: inline">
                                    <label>Total Setoran</label>
                                    <div class="input-group" id="inputTotalSetoran">
                                        <input type="text" class="form-control setoran" name="TotalSetoran" placeholder="0" required onchange="input_setoran()">
                                        <input readonly type="text" class="form-control setoranshow" value="Rp. 0,-">
                                    </div>
                                </div>
                                <div class="control-label col-md-1"></div>
                                <div class="control-label col-md-3">
                                    <label>Total Cashbon</label>
                                    <div class="input-group" id="inputTotalCashbon">
                                        <input readonly type="hidden" class="form-control total" name="TotalCashbon" value="0">
                                        <input readonly type="text" class="form-control totalshow" value="Rp. 0,-">
                                    </div>
                                </div>
                            </div>
                            <br><br><br><br><br>
                            <hr>
                            <div class="row">
                                <div class="control-label col-md-12">
                                    <table class="table table-bordered" id="tableKaryawan">
                                        <thead>
                                            <tr>
                                                <th width="30%">Karyawan</th>
                                                <th>Nominal Cashbon</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($karyawan as $key => $data)
                                            <tr>
                                                <td>{{$data->Nama}}</td>
                                                <td><input class="form-control nominal{{$key+1}}" onchange="input_nominal({{$key+1}})" type="number" name="Nominal[]" placeholder="0"></td>
                                                <td><input readonly type="text" class="form-control nominalshow{{$key+1}}" value="Rp. 0,-"></td>
                                                <input type="hidden" name="KodeKaryawan[]" value="{{$data->KodeKaryawan}}">
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br></br>
                            <div class="form-group">
                                <input type="hidden" readonly value="{{sizeof($karyawan)}}" class="count">
                                <button type="submit" class="btn btn-success" data-form="absen" onclick="return confirm('Simpan data ini?')">Simpan<span></span></button>
                                <button type="reset" class="btn btn-default" data-form="absen">Reset</button>
                            </div>
                        </form>
                    </div>
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

    $('#tableKaryawan').DataTable({
        scrollY: "50vh",
        scrollCollapse: true,
        paging: false,
        info: false,
        orderCellsTop: true,
        columnDefs: [{
                targets: [0],
                orderable: true,
                searchable: true
            },
            {
                targets: "_all",
                orderable: false,
                searchable: false
            }
        ]
    });

    update_total($(".count").val());

    function update_total(int) {
        $(".total").val(0);
        for (var i = 1; i <= int; i++) {
            if ($(".nominal" + i).val()) {
                $(".total").val(parseInt($(".total").val()) + parseInt($(".nominal" + i).val()));
            }
        }
        var total = $(".total").val();
        var format = 'Rp. ' + number_format(total) + ',-';
        $(".totalshow").val(format);
    }

    function input_setoran() {
        var setoran = $(".setoran").val();
        var format = 'Rp. ' + number_format(setoran) + ',-';
        $(".setoranshow").val(format);
    }

    function input_nominal(int) {
        var nominal = $(".nominal" + int).val();
        var format = 'Rp. ' + number_format(nominal) + ',-';
        $(".nominalshow" + int).val(format);
        var count = $(".count").val();
        update_total(count);
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