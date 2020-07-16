<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h1>Pemesanan Penjualan</h1>
              <h3>Sales Order</h3>
            </div>
            <div class="card-body">
              <table class="table table-light">
                <thead class="thead-light">
                  <tr>
                    <th>Kode SO</th>
                    <th>Tanggal</th>
                    <th>Tanggal Kirim</th>
                    <th>Expired</th>
                    <th>Mata Uang</th>
                    <th>Gudang</th>
                    <th>Pelanggan</th>
                    <th>Term</th>
                  </tr>
                </thead>
                  @foreach ($pemesananpenjualan as $p)
                    <tr>
                        <td>{{ $p->KodeSO}}</td>
                        <td>{{ $p->Tanggal}}</td>
                        <td>{{ $p->tgl_kirim}}</td>
                        <td>{{ $p->Expired }}</td>
                        <td>{{ $p->KodeMataUang}}</td>
                        <td>{{ $p->KodeLokasi}}</td>
                        <td>{{ $p->KodePelanggan}}</td>
                        <td>{{ $p->term }}</td>
                    </tr>
                  @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
    

