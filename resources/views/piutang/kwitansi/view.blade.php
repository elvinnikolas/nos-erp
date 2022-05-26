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
                    <h1 id="header">Kwitansi</h1>
                </div>
                <div class="x_content">
                    <form action="{{ url('/kwitansipiutang/print',$id)}}" method="get">
                        @csrf
                        <!-- Contents -->
                        <br>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <div class="form-group">
                                    <label>Nomor Kwitansi</label>
                                    <input type="text" class="form-control" readonly="readonly" value="{{$kwitansipiutang->KodeKwitansi}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputDate">Tanggal</label>
                                    <input type="text" class="form-control" name="Tanggal" id="inputDate" readonly="readonly" value="{{\Carbon\Carbon::parse($kwitansipiutang->Tanggal)->format('d-m-Y')}}">
                                </div>
                                <div class="form-group">
                                    <label>Nama (ttd kwitansi)</label>
                                    <input type="text" class="form-control" name="NamaTtd" readonly="readonly" value="{{$kwitansipiutang->NamaTtd}}">
                                </div>
                                <div class="form-group">
                                    <label>Kota (ttd kwitansi)</label>
                                    <input type="text" class="form-control" name="KotaTtd" readonly="readonly" value="{{$kwitansipiutang->KotaTtd}}">
                                </div>
                            </div>
                            <div class="form-group col-md-1">
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="inputPelanggan">Pelanggan</label>
                                    <input type="text" class="form-control" name="KodePelanggan" readonly="readonly" value="{{$pelanggan->NamaPelanggan}}">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" rows="3" readonly="readonly">{{$kwitansipiutang->Alamat}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="kota">Kota</label>
                                    <input type="text" class="form-control" name="Kota" readonly="readonly" value="{{$kwitansipiutang->Kota}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="x_title">
                                </div>
                                <br>
                                <h3 id="header">Daftar Invoice</h3>
                                <br>
                                <table id="invoices">
                                    <tr>
                                        <td id="header">Kode Invoice</td>
                                        <td id="header">Tanggal</td>
                                        <td id="header">No Faktur</td>
                                        <td id="header">DPP</td>
                                        <td id="header">PPN</td>
                                        <td id="header">Diskon</td>
                                        <td id="header">Total</td>
                                    </tr>
                                    @foreach($invoices as $inv)
                                    <tr class="rowinput">
                                        <td>
                                            {{$inv->KodeInvoice}}
                                        </td>
                                        <td>
                                            {{\Carbon\Carbon::parse($inv->Tanggal)->format('d-m-Y')}}
                                        </td>
                                        <td>
                                            {{$inv->NoFaktur}}
                                        </td>
                                        <td>
                                            Rp. {{number_format($inv->DPP)}},-
                                        </td>
                                        <td>
                                            Rp. {{number_format($inv->PPN)}},-
                                        </td>
                                        <td>
                                            Rp. {{number_format($inv->Diskon)}},-
                                        </td>
                                        <td>
                                            Rp. {{number_format($inv->Total)}},-
                                        </td>
                                    </tr>
                                    @endforeach

                                </table>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Print data ini?')">Print</button>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>DPP</label>
                                        <input type="text" readonly class="form-control" value="{{$string_total = "Rp. " . number_format(($kwitansipiutang->DPP), 0, ',', '.') .",-"}}">
                                    </div>
                                    <div class="form-group">
                                        <label>PPN</label>
                                        <input type="text" readonly class="form-control" value="{{$string_total = "Rp. " . number_format(($kwitansipiutang->PPN), 0, ',', '.') .",-"}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Diskon</label>
                                        <input type="text" readonly class="form-control" value="{{$string_total = "Rp. " . number_format(($kwitansipiutang->Diskon), 0, ',', '.') .",-"}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="text" readonly class="form-control" value="{{$string_total = "Rp. " . number_format(($kwitansipiutang->Total), 0, ',', '.') .",-"}}">
                                    </div>
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