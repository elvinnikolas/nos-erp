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
                    <h3 id="header">Resep Baru</h3>
                </div>
                <div class="x_content">
                    <form action="{{ route('masterresep.store') }}" method="post" class="formsub">
                        @csrf
                        <!-- Contents -->
                        <br>
                        <div class="form-row">
                            <!-- column 1 -->
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label for="koderesep">Kode Resep: </label>
                                    <input type="text" class="form-control bahanjadi" name="KodeResep" id="koderesep" value="{{$newkoderesep}}" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="namaresep">Resep untuk: </label>
                                    <select class="form-control bahanjadi" name="NamaResep" id="namaresep" placeholder="Pilih nama barang" required>
                                        <option selected disabled>-- Pilih nama barang --</option>
                                        @foreach($bahanjadi as $barang)
                                        <option value="{{$barang->KodeItem}}">{{$barang->NamaItem}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- pembatas -->
                            <div class="form-group col-md-1"></div>
                            <!-- column 2 -->
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label for="satuanresep">Satuan: </label>
                                    <select class="form-control bahanjadi" name="SatuanResep" id="satuanresep" placeholder="Pilih satuan barang" required>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="qtyresep">Jumlah: </label>
                                    <input type="number" required step=1 class="form-control bahanjadi" name="JumlahResep" id="jumlahresep" value=1 required>
                                </div>
                            </div>
                            <!-- pembatas -->
                            <div class="form-group col-md-1"></div>
                            <!-- column 3 -->
                            <div class="form-group col-md-3">
                                <label for="keteranganresep">Keterangan: </label>
                                <textarea class="form-control bahanjadi" name="KeteranganResep" id="keteranganresep" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <br><br>
                                <div class="x_title">
                                </div>
                                <br>
                                <h3 id="header">Daftar Bahan Setengah Jadi</h3>
                                <a href="javascript:;" class="btn btn-primary pull-right" onclick="addrow()">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </a>
                                <br><br><br>
                                <input type="hidden" value="1" name="totalItem" id="totalItem">

                                <table id="items" class="table">
                                    <tr>
                                        <th id="header" style="width:25%;">Nama Bahan</th>
                                        <th id="header" style="width:16%;">Satuan</th>
                                        <th id="header" style="width:9%;">Jumlah</th>
                                        <th id="header" style="width:25%;">Keterangan</th>
                                        <th id="header" style="width:3%;"></th>
                                    </tr>
                                    <tr class="rowinput">
                                        <td>
                                            <select name="BahanBaku[]" class="form-control" id="select-bahanbaku1" placeholder="Pilih bahan baku" onchange="satuanbaku(this)" urutan="1" required>
                                                <option selected disabled>-- Pilih bahan --</option>
                                                @foreach($bahanbaku as $baku)
                                                <option value="{{$baku->KodeItem}}">{{$baku->NamaItem}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="SatuanBahanBaku[]" class="form-control" id="select-satuan1" urutan="1" required>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" step=1 name="JumlahBahanBaku[]" class="form-control" id="input-jumlah1" urutan="1" required>
                                        </td>
                                        <td>
                                            <input type="text" step=1 name="KeteranganBahanBaku[]" class="form-control" id="input-keterangan1" urutan="1" required>
                                            <!-- <textarea class="form-control" name="KeteranganBahanBaku[]" id="textarea-keterangan1" urutan="2" required></textarea> -->
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Simpan data ini?')">Simpan</button>
                                    <!-- <button type="submit" class="btn btn-danger">Batal</button> -->
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
    $(function() {
        $('select').select2();
    });

    function addrow() {
        $('#select-bahanbaku1').select2('destroy');
        $('#select-satuan1').select2('destroy');
        $("#totalItem").val(parseInt($("#totalItem").val()) + 1);
        var count = $("#totalItem").val();
        var markup = $(".rowinput").html();
        var res = "<tr class='tambah" + count + "'>" + markup + "</tr>";
        res = res.replace("bahanbaku1", "bahanbaku" + count);
        res = res.replace("select-bahanbaku1", "select-bahanbaku" + count);
        res = res.replace("select-satuan1", "select-satuan" + count);
        res = res.replace("input-jumlah1", "input-jumlah" + count);
        res = res.replace("input-keterangan1", "input-keterangan" + count);
        // res = res.replace("textarea-keterangan1", "textarea-keterangan" + count);
        res = res.replace('urutan="1"', 'urutan="' + count + '"');
        res = res.replace("<td></td>", '<td><button type="button" onclick="del(' + count + ')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>');

        $("#items tbody").append(res);
        $('#select-bahanbaku' + count).select2({
            width: '100%'
        });
        $('#select-satuan' + count).select2({
            width: '100%'
        });
        $('#select-satuan' + count).empty();
        $('#select-bahanbaku1').select2({
            width: '100%'
        });
        $('#select-satuan1').select2({
            width: '100%'
        });
    }

    function del(int) {
        $(".tambah" + int).remove();
        $("#totalItem").val(parseInt($("#totalItem").val()) - 1);
    }

    $('#namaresep').on('change', function() {
        var resep = $(this).val();
        $('#satuanresep').empty();
        $.ajax({
            url: "{!! route('api.masterresep.satuan') !!}",
            data: {
                kode: resep
            }
        }).done(function(result) {
            $('#satuanresep').append(result);
        }).fail(function(status) {
            console.log(status);
        });
    });

    function satuanbaku(element) {
        var bahan = $(element).val();
        var urutan = $(element).attr('urutan');
        $('#select-satuan' + urutan).empty();

        $.ajax({
            url: "{!! route('api.masterresep.satuan') !!}",
            data: {
                kode: bahan
            }
        }).done(function(result) {
            $('#select-satuan' + urutan).append(result);
        });
    }
</script>
@endpush