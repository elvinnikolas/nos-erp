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
            border: 1px solid #000000;
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
                            <p id="center"><b>Kuitansi No. {{$kwitansipiutang->KodeKwitansi}}</b></p>
                        </div>
                        <br><br>
                        <div class="form-row">
                            <div>
                                <table id="borderless">
                                    <tr id="borderless">
                                        <td width="24%" id="borderless">
                                            <p>Sudah terima dari</p>
                                        </td>
                                        <td width="3%" id="borderless">
                                            <p>:</p>
                                        </td>
                                        <td width="73%" id="borderless">
                                            <p>{{$pelanggan->NamaPelanggan}}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <table id="borderless">
                                    <tr id="borderless">
                                        <td width="24%" id="borderless">
                                        </td>
                                        <td width="3%" id="borderless">
                                        </td>
                                        <td width="73%" id="borderless">
                                            <p>{{$kwitansipiutang->Alamat}}</p>
                                            <p>{{$kwitansipiutang->Kota}}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <br>
                            <div>
                                <table id="borderless">
                                    <tr id="borderless">
                                        <td width="24%" id="borderless">
                                            <p>Banyaknya uang</p>
                                        </td>
                                        <td width="3%" id="borderless">
                                            <p>:</p>
                                        </td>
                                        <td width="73%" id="borderless">
                                            <p>Rp. {{number_format(($kwitansipiutang->Total), 0, ',', '.')}},-</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <table id="borderless">
                                    <tr id="borderless">
                                        <td width="24%" id="borderless">
                                        </td>
                                        <td width="3%" id="borderless">
                                        </td>
                                        <td width="73%" id="borderless">
                                            <p># {{$terbilang}} rupiah #</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <br>
                            <div>
                                <table id="borderless">
                                    <tr id="borderless">
                                        <td width="24%" id="borderless">
                                            <p>Untuk pembayaran</p>
                                        </td>
                                        <td width="3%" id="borderless">
                                            <p>:</p>
                                        </td>
                                        <td width="73%" id="borderless">
                                            <p>Faktur pajak no. {{$min_faktur}} sampai {{$max_faktur}}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <table id="borderless">
                                    <tr id="borderless">
                                        <td width="24%" id="borderless">
                                        </td>
                                        <td width="3%" id="borderless">
                                        </td>
                                        <td width="73%" id="borderless">
                                            <p>Tanggal {{$min_date}} sampai {{$max_date}}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="row">
                                    <div class="column">
                                        <br>
                                        <table>
                                            <tr>
                                                <td width="30%">
                                                    <p>DPP</p>
                                                </td>
                                                <td width="70%" id="right">
                                                    <p>&nbsp;&nbsp;&nbsp;Rp. {{number_format(($kwitansipiutang->DPP), 0, ',', '.')}},-&nbsp;&nbsp;&nbsp;</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="30%">
                                                    <p>PPN 10%</p>
                                                </td>
                                                <td width="70%" id="right">
                                                    <p>&nbsp;&nbsp;&nbsp;Rp. {{number_format(($kwitansipiutang->PPN), 0, ',', '.')}},-&nbsp;&nbsp;&nbsp;</p>
                                                </td>
                                            </tr>
                                            @if ($kwitansipiutang->Diskon > 0)
                                            <tr>
                                                <td width="30%">
                                                    <p>Diskon</p>
                                                </td>
                                                <td width="70%" id="right">
                                                    <p>&nbsp;&nbsp;&nbsp;Rp. {{number_format(($kwitansipiutang->Diskon), 0, ',', '.')}},-&nbsp;&nbsp;&nbsp;</p>
                                                </td>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
                                    <div class="column">
                                    </div>
                                    <div class="column">
                                        <p id="center">{{$kwitansipiutang->KotaTtd}}, {{$terbilang_tanggal}}</p>
                                        <br><br><br><br><br>
                                        <p id="center">( &nbsp;{{$kwitansipiutang->NamaTtd}}&nbsp; ) </p>
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