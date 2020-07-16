<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style>
        p,
        tr {
            font-size: 9px;
            margin: 0;
        }

        form {
            margin: 0;
        }

        form input,
        button {
            padding: 0px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            padding: 0;
            margin: 0;
        }

        table,
        th,
        td {
            border: 1px solid #cdcdcd;
        }

        table th,
        table td {
            padding: 0;
            text-align: left;
        }

        .column {
            margin: 0;
            display: inline-block;
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

        #marginless {
            margin: 0;
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
                        <div class="form-row" id="marginless">
                            <div class="column">
                                @foreach($data as $dt)
                                <p>No. SO : {{$dt->KodeSO}}</p>
                                @endforeach
                                @foreach($data as $dt)
                                <p>Tanggal kirim : {{$dt->tgl_kirim}}</p>
                                @endforeach
                            </div>
                            <div class="column">
                                <p id="center">Pemesanan Penjualan</p>
                                @foreach($data as $dt)
                                <p id="center">{{$dt->Tanggal}}</p>
                                @endforeach
                            </div>
                            <div class="column">
                                <p id="right">Kepada yth.</p>
                                @foreach($data as $dt)
                                <p id="right">Tuan/Toko : {{$dt->NamaPelanggan}}</p>
                                @endforeach
                            </div>
                        </div>
                        <br><br><br><br>
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
                                            {{$item->Qty}} &nbsp; {{$item->NamaSatuan}}
                                        </td>
                                        <td id="right">
                                            Rp. {{number_format($item->HargaJual)}},-
                                        </td>
                                        <td id="right">
                                            Rp. {{number_format($item->HargaJual*$item->Qty)}},-
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                <br><br>
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
                                        <p id="right">Diskon : Rp. {{number_format($dt->NilaiDiskon)}},-</p>
                                        <p id="right">PPN : Rp. {{number_format($dt->NilaiPPN)}},-</p>
                                        <p id="right">Subtotal : Rp. {{number_format($dt->Total)}},-</p>
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