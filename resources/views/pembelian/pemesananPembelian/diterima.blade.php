@extends('index')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <form action="{{ url('/diterimaPembelian')}}">
            <button class="btn btn-default" data-toggle="collapse" data-target="#filter" type="button">
              <h2>Filter</h2>
            </button>
            <button class="btn btn-default" type="submit">
              <h2>Tampilkan semua</h2>
            </button>
          </form>
        </div>
        <div id="filter" class="collapse">
          <form action="{{ url('/diterimaPembelian/filter')}}" method="get">
            <div class="x_content">
              <div class="col-md-5 col-sm-5">
                <div class="form-group">
                  <label for="tanggalpo">Dari :</label>
                  <div class="input-group date" id="tanggalpo">
                    <input type="text" class="form-control" name="start" value="{{ Request::get('start')}}" />
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-md-5 col-sm-5">
                <div class="form-group">
                  <label for="tanggalposampai">Sampai :</label>
                  <div class="input-group date" id="tanggalposampai">
                    <input type="text" class="form-control" name="end" value="{{ Request::get('end')}}" />
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-md-2 col-sm-2">
                <div class="form-group">
                  <label for=""> </label>
                  <div class="input-group">
                    <button type="submit" class="btn btn-md btn-block btn-success">
                      <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="x_panel">
        <div class="x_title">
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <h3>Pemesanan Pembelian Diterima</h3>
              <p>Purchase Order<p>
            </div>
            <div class="col-md-6 col-sm-6">
              <br><br>
            </div>
          </div>
        </div>
        <div class="x_content">
          <table class="table table-light" id="table">
            <thead class="thead-light">
              <tr>
                <th>Kode PO</th>
                <th>Tanggal</th>
                <th>Term</th>
                <th>Supplier</th>
                <th>Gudang</th>
                <th>Total</th>
                <th>Aksi</th>
              </tr>
            </thead>
            @foreach ($pemesananpenjualan as $p)
            <tr>
              <td>{{ $p->KodePO}}</td>
              <td>{{ \Carbon\Carbon::parse($p->Tanggal)->format('d-m-Y') }}</td>
              <td>{{ $p->term }} hari</td>
              <td>{{ $p->NamaSupplier }}</td>
              <td>{{ $p->NamaLokasi  }}</td>
              <td>Rp. {{ number_format($p->Total, 0, ',', '.') }},-</td>
              <td>
                <a href="{{ url('/popembelian/lihat/'. $p->KodePO )}}" class="btn-xs btn btn-primary">
                  <i class="fa fa-eye" aria-hidden="true"></i> Lihat
                </a>
                <a href="{{ url('/popembelian/destroy/'.$p->KodePO)}}" class="btn-xs btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                  <i class="fa fa-trash" aria-hidden="true"></i> Hapus
                </a>
              </td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
  $('#tanggalpo').datetimepicker({
    format: 'YYYY-MM-DD'
  });

  $('#tanggalposampai').datetimepicker({
    defaultDate: new Date(),
    format: 'YYYY-MM-DD'
  });

  $('#table').DataTable({
    "order": []
  });
</script>
@endpush