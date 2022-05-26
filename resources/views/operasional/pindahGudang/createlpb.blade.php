@extends('index')
@section('content')
<style type="text/css">
    form{
        margin: 20px 0;
    }
    form input, button{
        padding: 5px;
    }
    table{
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }
    table, th, td{
        border: 1px solid #cdcdcd;
    }
    table th, table td{
        padding: 10px;
        text-align: left;
    }
</style>

<div class="container">
  <div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
      <div class="col-sm-6">
          {{-- <h1 class="m-0 text-dark">{{$code}}</h1> --}}
      </div><!-- /.col -->
      </div><!-- /.row -->
  </div><!-- /.container-fluid -->
  </div>
  
  <div class="x_panel">
        <div class="x_title">
            <h1>Mutasi Gudang MASUK</h1>
        </div>
        <div class="x_content">
            <form action="{{ url('/pindahgudang/storelpb/'.$id) }}" method="post">
            @csrf
                <div class="form-group">
                    <label>Kode Mutasi: </label>
                    <input type="text" value="{{$id}}" class="form-control-static" readonly>
                </div>
                <div class="form-group">
                    <label>Tanggal: </label>
                    <input type="date" value="{{$sekarang}}" id="tanggal" name="tanggal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Keterangan: </label>
                    <input type="text" name="keterangan" placeholder="Keterangan" class="form-control" required>
                </div>
                <br><br>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <button type="button" class="btn btn-primary mb-3 mt-3 pull-right" onclick="addrow()">
                            <i class="fa fa-plus" aria-hidden="true"></i>Tambah Item
                        </button>
                        <br><br><br>
                        <input type="hidden" value="1" name="totalItem" id="totalItem">
                        <table id="items">
                            <tr>
                                <td>Kode & Nama Barang</td>
                                <td>Jumlah</td>
                                <td>Satuan</td>
                                <td></td>
                            </tr>
                            <tr class="rowinput">
                                <td>
                                    <select name="item[]" class="form-control input-item item1" onchange="barang(this)">
                                        <option value="" selected hidden disabled>-- Pilih item --</option>
                                        @foreach($bahansetengahjadi as $itemData)
                                            <option value="{{$itemData->KodeItem}}">{{$itemData->NamaItem}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="qty[]" class="form-control input-qty qty1" value="0" min="0" step="1" oninput="qty(this)" required>
                                </td>
                                <td>
                                    <input type="text" name="satuan[]" class="form-control input-satuan satuan1" value="Kg" readonly>
                                    {{--<select name="satuan[]" class="form-control input-satuan satuan1">
                                        <option value="Pcs">Pcs</option>
                                        <option value="Kg" selected>Kg</option>
                                    </select>--}}
                                </td>
                                <td></td>
                            </tr>
                        </table>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-success" onclick="return confirm('Simpan data ini?')">Simpan</button>
                            <a href="{{ url('/pindahgudang')}}" class="btn btn-danger mb-3 mt-3">
                                Batal
                            </a>   
                        </div>                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#tanggal').datetimepicker({
        format: "YYYY-MM-DD"
    });

    $('.item1').select2({ width: '100%' });
});

var selectedItem;
function barang(argument) {
    selectedItem = argument.value;
    let $tr = $(argument).closest('tr');
    let stok = $('option:selected', $tr).attr('data-stok');
    $('.input-qty', $tr).val(0);
    $('.input-qty', $tr).attr('max', stok);
}

function qty(argument) {
    let inputVal = $(argument).val();
    let inputMax = parseInt($(argument).attr('max'));

    if (inputVal > inputMax) { 
        $(argument).val(inputMax);
    }
}

function addrow() {
    $('.item1').select2('destroy');
    $("#totalItem").val(parseInt($("#totalItem").val())+1);
    var count =$("#totalItem").val();
    var markup = $(".rowinput").html();
    var res = "<tr class='tambah"+count+"'>"+markup+"</tr>";
    res = res.replace("qty1", "qty"+count);
    res = res.replace("item1", "item"+count);
    res = res.replace("radio1", "radio"+count);
    res = res.replace("satuan1", "satuan"+count);
    res = res.replace("<td></td>", '<td><button class="btn btn-sm btn-danger" onclick="del(this)"><i class="fa fa-trash"></i></button></td>');

    $("#items tbody").append(res);
    $('.item1').select2({ width: '100%' });
    $('.item'+count).select2({ width: '100%' });
    $('.item'+count).val('').trigger('change');
}

function del(argument) {
    let $row = $(argument).closest('tr');
    $row.remove();
    $("#totalItem").val(parseInt($("#totalItem").val())-1);
}

/*$('form').on('submit', function(e) {
    e.preventDefault();
    console.log($(this).serializeArray());
});*/
</script>
@endsection
