<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style>
        p,
        tr {
            font-size: 14px;
            margin: 2;
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

        #borderless {
            border-collapse: collapse;
            border: none;
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
                            <p id="center"><b>INVOICE</b></p>
                        </div>
                        <br>
                        <div class="form-row">
                            <div style="width: 50%; float:left">
                                <table id="borderless">
                                    <tr id="borderless">
                                        <td width="24%" id="borderless">
                                            <p>Kepada yth.</p>
                                        </td>
                                        <td width="3%" id="borderless">
                                            <p>:</p>
                                        </td>
                                        <td width="73%" id="borderless">
                                            <p>{{$invoice->NamaPelanggan}}</p>
                                        </td>
                                    </tr>
                                    <tr id="borderless">
                                        <td width="24%" id="borderless">
                                            <p>Alamat</p>
                                        </td>
                                        <td width="3%" id="borderless">
                                            <p>:</p>
                                        </td>
                                        <td width="73%" id="borderless">
                                            <p>{{$suratjalan->AlamatInvoice}}</p>
                                        </td>
                                    </tr>
                                    <tr id="borderless">
                                        <td width="24%" id="borderless">
                                        </td>
                                        <td width="3%" id="borderless">
                                            <p></p>
                                        </td>
                                        <td width="73%" id="borderless">
                                            <p>{{$suratjalan->KotaInvoice}}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div style="width: 50%; float:right">
                                <table id="borderless">
                                    <tr id="borderless">
                                        <td width="30%" id="borderless">
                                        </td>
                                        <td width="30%" id="borderless">
                                            <p>No. Invoice</p>
                                        </td>
                                        <td width="40%" id="borderless">
                                            <p>:&nbsp; {{$invoice->KodeInvoicePiutangShow}}</p>
                                        </td>
                                    </tr>
                                    <tr id="borderless">
                                        <td width="30%" id="borderless">
                                        </td>
                                        <td width="30%" id="borderless">
                                            <p>No. Surat Jalan</p>
                                        </td>
                                        <td width="40%" id="borderless">
                                            <p>:&nbsp; {{$suratjalan->KodeSuratJalan}}</p>
                                        </td>
                                    </tr>
                                    <tr id="borderless">
                                        <td width="30%" id="borderless">
                                        </td>
                                        <td width="30%" id="borderless">
                                            <p>Tanggal</p>
                                        </td>
                                        <td width="40%" id="borderless">
                                            <p>:&nbsp; {{$invoice->TanggalFormat}}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <br><br><br><br><br><br>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <table id="items">
                                    <tr>
                                        <td id="center"><b>No</b></td>
                                        <!-- <td id="center"><b>Kode Barang</b></td> -->
                                        <td id="center"><b>Nama Barang</b></td>
                                        <td id="center"><b>Qty</b></td>
                                        <td id="center"><b>Satuan</b></td>
                                        <td id="center"><b>Harga</b></td>
                                        <td id="center"><b>Subtotal</b></td>
                                    </tr>
                                    {{$no = 1}}
                                    {{$tot = 0}}
                                    @foreach($items as $item)
                                    {{$tot += ($item->Qty * $item->HargaJual)}}
                                    @if($item->Qty > 0)
                                    <tr class="rowinput">
                                        <td>
                                            &nbsp;&nbsp;&nbsp;{{$no++}}
                                        </td>
                                        <!-- <td>
                                            &nbsp;&nbsp;&nbsp;{{$item->KodeItem}}
                                        </td> -->
                                        <td>
                                            &nbsp;&nbsp;&nbsp;{{$item->NamaItem}}
                                        </td>
                                        <td id="right">
                                            {{number_format(($item->Qty), 0, ',', '.')}}&nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td id="right">
                                            {{$item->KodeSatuan}}&nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td id="right">
                                            Rp. {{number_format(($item->HargaJual), 2, ',', '.')}}&nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td id="right">
                                            Rp. {{number_format(($item->HargaJual*$item->Qty), 2, ',', '.')}}&nbsp;&nbsp;&nbsp;
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach

                                    {{$disc = 0}}
                                    {{$tax = 0}}
                                    @foreach($suratjalanreturn as $sjr)
                                    {{$disc += $sjr->NilaiDiskon}}
                                    {{$tax += $sjr->NilaiPPN}}
                                    @endforeach
                                </table>
                                <br>
                                <div class="row">
                                    <div class="column">
                                        <!-- @if($suratjalan->PPN == "ya")
                                        <br><br>
                                        <p id="center">Hormat kami,</p>
                                        <br><br><br><br><br>
                                        <p id="center">( &nbsp;ANDREAS LEKSONO&nbsp; ) </p>
                                        @endif -->
                                    </div>
                                    <div class="column"></div>
                                    <div class="column">
                                        <table id="borderless">
                                            <tr id="borderless">
                                                <td width="35%" id="borderless">
                                                    <p>Subtotal</p>
                                                </td>
                                                <td width="65%" id="borderless">
                                                    <p>:&nbsp; Rp. {{number_format(($tot), 2, ',', '.')}}</p>
                                                </td>
                                            </tr>
                                            {{$month = substr($invoice->TanggalFormat, -7, 2)}}
                                            {{$year = substr($invoice->TanggalFormat, -4, 4)}}
                                            <tr id="borderless">
                                                <td width="35%" id="borderless">
                                                    @if($year == 2022 && $month <= 03)
                                                    <p>PPN (10%)</p>
                                                    @else
                                                    <p>PPN (11%)</p>
                                                    @endif
                                                </td>
                                                <td width="65%" id="borderless">
                                                    <p>:&nbsp; Rp. {{number_format(($suratjalan->NilaiPPN-$tax), 2, ',', '.')}}</p>
                                                </td>
                                            </tr>
                                            <tr id="borderless">
                                                <td width="35%" id="borderless">
                                                    <p>Diskon&nbsp;({{$suratjalan->Diskon}}%)</p>
                                                </td>
                                                @if($suratjalan->NilaiDiskon-$disc == 0)
                                                <td width="65%" id="borderless">
                                                    <p>:&nbsp; Rp. {{number_format(($suratjalan->NilaiDiskon-$disc), 0, ',', '.')}},-</p>
                                                </td>
                                                @else
                                                <td width="65%" id="borderless">
                                                    <p>:&nbsp; Rp. {{number_format(($suratjalan->NilaiDiskon-$disc), 2, ',', '.')}}</p>
                                                </td>
                                                @endif
                                            </tr>
                                            <tr id="borderless">
                                                <td width="35%" id="borderless">
                                                    <p>Total</p>
                                                </td>
                                                <td width="65%" id="borderless">
                                                    <p>:&nbsp; Rp. {{number_format(($invoice->Subtotal-$invoice->TotalReturn), 0, ',', '.')}},-</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="column"></div>
                                    <div class="column">
                                        <!-- <p id="center">Penerima,</p>
                                        <br><br>
                                        <p id="center">( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ) </p> -->
                                    </div>
                                    <div class="column">
                                        <!-- <p id="center">Hormat kami,</p>
                                        <br><br><br><br><br>
                                        <p id="center">( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ) </p> -->
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