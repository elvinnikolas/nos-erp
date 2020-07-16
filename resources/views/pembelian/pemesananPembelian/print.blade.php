<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style>
        p,
        tr {
            font-size: 12px;
        }

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

        .column {
            float: left;
            width: 33%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        #center {
            text-align: center;
        }

        #right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">
                        @csrf
                        <!-- Contents -->
                        <div class="form-row">
                            <div class="column">
                                @foreach($data as $dt)
                                <p>Kode PO : {{$dt->KodePO}}</p>
                                @endforeach
                            </div>
                            <div class="column">
                                <p id="center">Pemesanan Pembelian</p>
                                @foreach($data as $dt)
                                <p id="center">{{$dt->Tanggal}}</p>
                                @endforeach
                            </div>
                            <div class="column">
                                <p>Kepada yth.</p>
                                @foreach($supplier as $sup)
                                <p>Supplier : {{$sup->NamaSupplier}}</p>
                                @endforeach
                                @foreach($lokasi as $lok)
                                <p>Gudang : {{$lok->NamaLokasi}}</p>
                                @endforeach
                            </div>
                        </div>
                        <br><br><br><br><br><br>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <table id="items">
                                    <tr>
                                        <td id="center"><b>Kode Barang</b></td>
                                        <td id="center"><b>Nama Barang</b></td>
                                        <td id="center"><b>Jumlah</b></td>
                                        <td id="center"><b>Harga</b></td>
                                        <td id="center"><b>Total</b></td>
                                    </tr>
                                    @foreach($items as $item)
                                    <tr class="rowinput">
                                        <td>
                                            {{$item->KodeItem}}
                                        </td>
                                        <td>
                                            {{$item->NamaItem}}
                                        </td>
                                        <td id="right">
                                            {{$item->jml}} &nbsp; {{$item->NamaSatuan}}
                                        </td>
                                        <td id="right">
                                            Rp. {{number_format($item->HargaBeli)}},-
                                        </td>
                                        <td id="right">
                                            Rp. {{number_format($item->HargaBeli*$item->jml)}},-
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                <div class="row">
                                    <div class="column">
                                        <p>Total Barang : {{$jml}}</p>
                                        @foreach($data as $dt)
                                        <p>Keterangan : {{$dt->Keterangan}}</p>
                                        @endforeach
                                    </div>
                                    <div class="column"></div>
                                    <div class="column">
                                        @foreach($data as $dt)
                                        <p>Diskon : Rp. {{number_format($dt->NilaiDiskon)}},-</p>
                                        <p>PPN : Rp. {{number_format($dt->NilaiPPN)}},-</p>
                                        <p>Subtotal : Rp. {{number_format($dt->Subtotal)}},-</p>
                                        @endforeach
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="column"></div>
                                    <div class="column">
                                        <p id="center">Penerima,</p>
                                        <br><br>
                                        <p id="center">( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ) </p>
                                    </div>
                                    <div class="column">
                                        <p id="center">Hormat kami,</p>
                                        <br><br>
                                        <p id="center">( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ) </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>