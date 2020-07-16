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
                                @foreach($invoice as $inv)
                                <p>No Invoice : {{$inv->KodeInvoiceHutangShow}}</p>
                                <p>No LPB : {{$inv->KodeLPB}}</p>
                                @endforeach
                            </div>
                            <div class="column">
                                <p id="center"><b>Invoice</b></p>
                                @foreach($invoice as $inv)
                                <p id="center">{{$inv->Tanggal}}</p>
                                @endforeach
                            </div>
                            <div class="column">
                                <p>Kepada yth.</p>
                                @foreach($invoice as $inv)
                                <p>Gudang : {{$inv->NamaLokasi}}</p>
                                <br>
                                <p>Supplier : {{$inv->NamaSupplier}}</p>
                                <p>Alamat : {{$inv->Alamat}}</p>
                                @endforeach
                            </div>
                        </div>
                        <br><br><br><br><br><br><br><br>
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
                                        @foreach($invoice as $inv)
                                        <p>Keterangan : {{$inv->Keterangan}}</p>
                                        @endforeach
                                    </div>
                                    <div class="column">
                                        @foreach($invoice as $inv)
                                        <p>Total Hutang : Rp. {{number_format($inv->Subtotal)}},-</p>
                                        <p>Total Bayar : Rp. {{number_format($inv->bayar)}},-</p>
                                        <p>Sisa Hutang : Rp. {{number_format($inv->Subtotal - $inv->bayar)}},-</p>
                                        @endforeach
                                    </div>
                                    <div class="column">

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