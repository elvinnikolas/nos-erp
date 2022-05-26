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
                    <h1 id="header">Hutang Produksi</h1>
                </div>
                <div class="x_content">
                    <div class="form-row">
                        @csrf
                        <!-- Contents -->
                        <br>
                        <div class="form-row">
                            <!-- column 1 -->
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label for="inputDate">Tanggal Produksi (Mulai)</label>
                                    <input type="text" readonly="" class="form-control" name="TanggalAwal" id="inputDate" value="{{$hutang->TanggalAwal}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputDate2">Tanggal Produksi (Sampai)</label>
                                    <input type="text" readonly="" class="form-control" name="TanggalAkhir" id="inputDate2" value="{{$hutang->TanggalAkhir}}">
                                </div>
                            </div>
                            <!-- pembatas -->
                            <div class="form-group col-md-1"></div>
                            <!-- column 2 -->
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label for="inputDate3">Tanggal Gajian</label>
                                    <input type="text" readonly="" class="form-control" name="TanggalGajian" id="inputDate3" value="{{$hutang->TanggalGajian}}">
                                </div>
                            </div>
                            <!-- pembatas -->
                            <div class="form-group col-md-1"></div>
                            <!-- column 3 -->
                            <div class="form-group col-md-3"></div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <br><br>
                        <div class="x_title">
                        </div>
                        <br>
                        <h3 id="header">Daftar Hutang</h3>
                        <br><br>
                        <input type="hidden" value="1" name="totalItem" id="totalItem">

                        <table id="items" class="table">
                            <tr>
                                <td id="header">Karyawan</td>
                                <td id="header">Golongan</td>
                                <td id="header">Qty Produksi (buku)</td>
                                <td id="header">Qty Produksi (cek)</td>
                                <td id="header">Qty Hutang</td>
                                <td id="header">Gaji / Packing</td>
                                <td id="header">Total Hutang</td>
                            </tr>
                            @foreach($detail as $d)
                            <tr class="rowinput">
                                <td>
                                    <input type="text" readonly class="form-control" value="{{ $d->Nama}}">
                                </td>
                                <td>
                                    <input type="text" readonly class="form-control" value="{{ $d->NamaGroupItem}}">
                                </td>
                                <td>
                                    <input type="text" readonly class="form-control" value="{{ $d->Qty}}">
                                </td>
                                <td>
                                    <input type="text" readonly class="form-control" value="{{ $d->QtyCek}}">
                                </td>
                                <td>
                                    <input type="text" readonly class="form-control" value="{{ $d->QtyHutang}}">
                                </td>
                                <td>
                                    <input type="text" readonly class="form-control" value="{{ $d->Gaji}}">
                                </td>
                                <td>
                                    <input type="text" readonly class="form-control" value="{{ $d->Total}}">
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="col-md-9">
                            <!-- <button type="submit" class="btn btn-success">Simpan</button> -->
                            <!-- <button type="submit" class="btn btn-danger">Batal</button> -->
                        </div>
                        <div class="col-md-3">
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