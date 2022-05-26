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
                    <h1 id="header">Pemesanan Penjualan</h1>
                    <h3 id="header">{{$id}}</h3>
                </div>
                <div class="x_content">
                    @if($OPN == true)
                    <form action="#" method="post">
                        @elseif($OPN == false)
                        <form action="#" method="get">
                            @endif

                            @csrf
                            <!-- Contents -->
                            <br>
                            <div class="form-row">
                                <!-- column 1 -->
                                <div class="form-group col-md-3">
                                    <input type="hidden" class="form-control" name="KodeSO" value="{{$id}}">
                                    <div class="form-group">
                                        <label for="inputDate">Tanggal</label>
                                        <input type="text" class="form-control" id="inputDate" value="{{$data->Tanggal}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDate2">Tanggal Kirim</label>
                                        <input type="text" class="form-control" id="inputDate2" value="{{$data->tgl_kirim}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputBerlaku">Masa Berlaku</label>
                                        <input type="text" class="form-control" name="Expired" value="{{$data->Expired}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTerm">Term of Payment</label>
                                        <input type="text" class="form-control" name="Term" id="inputTerm" value="{{$data->term}}" readonly>
                                    </div>
                                </div>
                                <!-- pembatas -->
                                <div class="form-group col-md-1"></div>
                                <!-- column 2 -->
                                <div class="form-group col-md-3">
                                    <div class="form-group">
                                        <label for="inputMatauang">Mata Uang</label>
                                        <input type="text" class="form-control" placeholder="" value="{{$data->NamaMataUang}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputGudang">Gudang</label>
                                        <input type="text" class="form-control" placeholder="" value="{{$data->NamaLokasi}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="pelanggan">Pelanggan</label>
                                        <input type="text" class="form-control" placeholder="" value="{{$data->NamaPelanggan}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="diskon">Diskon</label>
                                        <input type="number" class="diskon form-control" name="diskon" placeholder="%" value="{{$data->Diskon}}" readonly>
                                    </div>
                                </div>
                                <!-- pembatas -->
                                <div class="form-group col-md-1"></div>
                                <!-- column 3 -->
                                <div class="form-group col-md-3">
                                    <div class="form-group">
                                        <label for="inputPelanggan">PPN</label>
                                        @if($data->PPN == "ya")
                                        <input type="text" class="form-control" name="ppn" placeholder="" value="Ya" readonly>
                                        @else
                                        <input type="text" class="form-control" name="ppn" placeholder="" value="Tidak" readonly>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        @if($data->PPN == "ya")
                                        <label for="inputPelanggan">No Faktur Pajak</label>
                                        <input type="text" class="form-control" name="nofaktur" placeholder="" value="{{$data->NoFaktur}}" readonly>
                                        @endif
                                    </div>
                                    <label for="inputKeterangan">Keterangan</label>
                                    <textarea class="form-control" name="Keterangan" id="inputKeterangan" rows="5" readonly>{{$data->Keterangan}}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <!-- <div class="x_title"></div> -->
                                    <br><br>
                                    <div class="x_title">
                                    </div>
                                    <br>
                                    <h3 id="header">Daftar Item</h3>
                                    <br><br><br>
                                    <input type="hidden" value="1" name="totalItem" id="totalItem">

                                    <table id="items" class="table">
                                        <tr>
                                            <td id="header" style="width:18%;">Nama Barang</td>
                                            <td id="header" style="width:9%;">Qty</td>
                                            <td id="header" style="width:12%;">Satuan</td>
                                            <td id="header" style="width:18%;">Harga Satuan</td>
                                            <td id="header" style="width:20%;">Keterangan</td>
                                            <td id="header">Total</td>
                                        </tr>
                                        @foreach($items as $item)
                                        <tr class="rowinput">
                                            <td>
                                                {{$item->NamaItem}}
                                            </td>
                                            <td>
                                                {{number_format(($item->Qty), 0, ',', '.')}}
                                            </td>
                                            <td>
                                                {{$item->NamaSatuan}}
                                            </td>
                                            <td>
                                                Rp. {{number_format(($item->Harga), 2, ',', '.')}}
                                            </td>
                                            <td>
                                                {{$item->Keterangan}}
                                            </td>
                                            <td>
                                                Rp. {{number_format(($item->Subtotal), 0, ',', '.')}},-
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                    <div class="col-md-9">
                                        @if($OPN == true)
                                        <button type="submit" class="btn btn-success" formaction="{{ url('/sopenjualan/confirm/'.$id) }}" onclick="return confirm('Konfirmasi data ini?')">Konfirmasi</button>
                                        <!-- <button type="submit" class="btn btn-danger" formaction="{{ url('/sopenjualan/cancel/'.$id) }}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button> -->
                                        @elseif($OPN == false)
                                        <button type="submit" class="btn btn-primary" formaction="{{ url('/sopenjualan/print/'.$id) }}" onclick="return confirm('Print data ini?')">Print</button>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label>Subtotal</label>
                                        <input type="text" readonly class="form-control subtotal" value="{{$string_total = "Rp " . number_format(($data->Subtotal), 0, ',', '.') .",-"}}">
                                        @if($data->PPN == "ya")
                                        <label>PPN</label>
                                        <input type="text" readonly class="form-control subtotal" value="{{$string_total = "Rp " . number_format($data->NilaiPPN, 0, ',', '.') .",-"}}">
                                        @else
                                        @endif
                                        <label>Diskon</label>
                                        <input type="text" readonly class="form-control subtotal" value="{{$string_total = "Rp " . number_format($data->NilaiDiskon, 0, ',', '.') .",-"}}">
                                        <label>Total</label>
                                        <input type="text" readonly class="form-control subtotal" value="{{$string_total = "Rp " . number_format($data->Total, 0, ',', '.') .",-"}}">
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