@extends('index')
@section('content')
<style type="text/css">
  #black {
    color: black;
  }
</style>
<div class="container">
  <div class="x_panel">
    <div class="x_title">
      <form action="{{ url('/kwitansipiutang')}}">
        <button class="btn btn-default" data-toggle="collapse" data-target="#filter" type="button">
          <h2>Filter</h2>
        </button>
        <button class="btn btn-default" type="submit">
          <h2>Tampilkan semua</h2>
        </button>
      </form>
    </div>
    <div id="filter" class="collapse">
      <form action="{{ url('/kwitansipiutang/filter')}}" method="get">
        <div class="x_content">
          <div class="col-md-5 col-sm-5">
            <div class="form-group">
              <label>Cari:</label>
              <input type="text" class="form-control" name="name" value="{{Request::get('name')}}" placeholder="Nomor Kwitansi / Nama Pelanggan" />
            </div>
          </div>
          <div class="col-md-3 col-sm-3">
            <div class="form-group">
              <label for="tanggal">Dari:</label>
              <div class="input-group date" id="tanggal">
                <input type="text" class="form-control" name="start" value="{{ Request::get('start')}}" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-3">
            <div class="form-group">
              <label for="tanggal">Sampai:</label>
              <div class="input-group date" id="tanggalsampai">
                <input type="text" class="form-control" name="end" value="{{ Request::get('end') }}" />
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

  <!-- Alert -->
  @if(session()->get('created'))
  <div class="alert alert-success alert-dismissible fade-show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <b>{{ session()->get('created') }}</b>
  </div>

  @elseif(session()->get('edited'))
  <div class="alert alert-info alert-dismissible fade-show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <b>{{ session()->get('edited') }}</b>
  </div>

  @elseif(session()->get('deleted'))
  <div class="alert alert-danger alert-dismissible fade-show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <b>{{ session()->get('deleted') }}</b>
  </div>

  @elseif(session()->get('error'))
  <div class="alert alert-warning alert-dismissible fade-show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <b id="black">{{ session()->get('error') }}</b>
  </div>
  @endif

  <div class="x_panel">
    <div class="x_title">
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <h3>Kwitansi</h3>
        </div>
        <div class="col-md-6 col-sm-6">
          <br><br>
          <a href="{{ url('/kwitansipiutang/create')}}" class="btn btn-primary pull-right">
            <i class="fa fa-plus" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="x_content">
      <table class="table table-light table-striped" id="kwitansipiutang">
        <thead class="thead-light">
          <tr>
            <th scope="col">Nomor Kwitansi</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Pelanggan</th>
            <th scope="col">Total</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($kwitansipiutangs as $kwitansipiutang)
          <tr>
            <td>{{ $kwitansipiutang->KodeKwitansi }}</td>
            <td>{{ \Carbon\Carbon::parse($kwitansipiutang->Tanggal)->format('d-m-Y') }}</td>
            <td>{{ $kwitansipiutang->NamaPelanggan }}</td>
            <td>Rp. {{ number_format($kwitansipiutang->Total, 0, ',', '.') }},-</td>
            <td>
              <a href="{{ url('/kwitansipiutang/view/'.$kwitansipiutang->KodeKwitansi) }}" class="btn-xs btn btn-primary">
                <i class="fa fa-eye" aria-hidden="true"></i> Lihat
              </a>
              <a href="{{ url('kwitansipiutang/edit/'.$kwitansipiutang->KodeKwitansi)}}" class="btn btn-xs btn-success">
                <i class="fa fa-pencil" aria-hidden="true"></i> Ubah
              </a>
              <a href="{{ url('/kwitansipiutang/destroy/'.$kwitansipiutang->KodeKwitansi)}}" class="btn-xs btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                <i class="fa fa-trash" aria-hidden="true"></i> Hapus
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
  $('#tanggal').datetimepicker({
    format: 'YYYY-MM-DD'
  });

  $('#tanggalsampai').datetimepicker({
    defaultDate: new Date(),
    format: 'YYYY-MM-DD'
  });

  $('#kwitansipiutang').DataTable({
    "order": [],
    "pageLength": 25
  });
</script>
@endpush