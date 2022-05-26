<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css" media="all">
        input {
            border:0;
            padding-bottom: 0px;
        }
        table{
            border:2px solid black;
            width:100%
        }
        td{
            padding:4px;
            border:0;
            border-right: 1px solid black;
        }
        th{
            padding:10px;
            text-align: center;
        }
        label{
            width: 100px !important;
        }
        .card-header{
            text-align: center;
            width: 100%;
        }
        .mebur{
            text-align: right;
            width: 100%;
        }
        .judul{
            margin-top: -35px;
            line-height: 0.5;
        }
        .page-break {
            page-break-after: avoid;
        }
        .ttd{
            margin-top: 50px;
            bottom: 0;
            width: 100%;
        }
        .pengirim{
            float: left;
            width: 30%;
            height: 150px;
            border-bottom: 1px solid black;
        }
        .penerima{
            float: right;
            width: 30%;
            height: 150px;
            border-bottom: 1px solid black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="mebur">
                <span>{{ date('d-m-Y', strtotime($pindahgudang->Tanggal)) }}</span>
            </div>
            <br><br>
            <div class="card-header judul">
                <h3><strong>Mutasi Barang</strong></h3>
                <h2>{{ $pindahgudang->KodePindah }}</h2>
            </div>
            <div>
                <label class="ano">Dari: </label>
                <span>{{ $pindahgudang->DariLokasi }}</span>
            </div>
            <div>
                <label class="ano">Ke: </label>
                <span>{{ $pindahgudang->KeLokasi }}</span>
            </div>
            <div>
                <label class="ano">Keterangan: </label>
                <span>{{ $pindahgudang->Keterangan }}</span>
            </div>
            <br>
            <div class="page-break">
                <table class="table" border="1" style="border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th scope="col">Kode Item</th>
                            <th scope="col">Nama Item</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pindahgudangdetails as $data)
                        <tr style="padding: 5;">
                            <td>{{$data->KodeItem}}</td>
                            <td>{{$data->NamaItem}}</td>
                            <td>{{$data->Qty}}</td>
                            <td>{{$data->KodeSatuan}}</td>
                            <td>{{$data->Keterangan}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="ttd">
                <div class="pengirim">
                    <p>Pengirim</p>
                </div>
                <div class="penerima">
                    <p>Penerima</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


