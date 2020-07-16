<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style>
        p,
        tr {
            font-size: 9px;
        }

        form {
            margin: 0;
        }

        form input,
        button {
            padding: 5px;
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
            padding: 10px;
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
                                <p>No. Inv : {{$invoice->KodeInvoicePiutangShow}}</p>
                                <p>No. SJ : {{$suratjalan->KodeSuratJalan}}</p>
                            </div>
                            <div class="column">
                                <p id="center">Invoice Piutang</p>
                                <p id="center">{{$invoice->Tanggal}}</p>
                            </div>
                            <div class="column">
                                <p id="right">Kepada yth.</p>
                                <p id="right">Tuan/Toko : {{$invoice->NamaPelanggan}}</p>
                                <p id="right">Alamat : {{$suratjalan->Alamat}}</p>
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
                                <div class="row">
                                    <div class="column">
                                        <p>Total Barang : {{$jml}}</p>
                                        <p>Driver : {{$driver->Nama}}</p>
                                        <p>No. Polisi : {{$suratjalan->Nopol}}</p>
                                    </div>
                                    <div class="column"></div>
                                    <div class="column">
                                        <p id="right">Diskon : Rp. {{number_format($suratjalan->NilaiDiskon)}},-</p>
                                        <p id="right">PPN : Rp. {{number_format($suratjalan->NilaiPPN)}},-</p>
                                        <p id="right">Subtotal : Rp. {{number_format($suratjalan->Subtotal)}},-</p>
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