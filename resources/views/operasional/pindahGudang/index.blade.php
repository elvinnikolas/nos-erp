@extends('index')
@section('content')
<div class="container">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Mutasi Gudang</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  
  <div class="x_panel">
    <div class="x_panel-header">
      <a href="{{ url('/pindahgudang/create') }}" class="btn btn-success">
        <i class="fa fa-plus" aria-hidden="true"></i> Buat mutasi keluar
      </a>
      <br>
      <!-- Contents -->
      <br>
      <form action="{{ url('/pindahgudang/search') }}" method="get">
        @csrf
        @method('get')
        <div class="form-row">
            <!-- column 1 -->
          <div class="form-group col-md-3">
              <div class="form-group">
                  <label for="search">Search</label>
                  <input class="form-control" id="keyword" name="keyword" type="text" placeholder="Search" value="{{$keyword}}">
              </div>
          </div>
          <div class="form-group col-md-3">
              <div class="form-group">
                <label for="mulai">Mulai</label>
                <input class="form-control" id="mulai" name="mulai" type="date" value="{{$mulai}}">
              </div>
          </div>
          <div class="form-group col-md-3">
              <div class="form-group">
                <label for="sampai">Sampai</label>
                <input class="form-control" id="sampai" name="sampai" type="date" value="{{$sampai}}">
              </div>
          </div>
          <div class="form-group col-md-3">
              <div class="form-group">
                <label for="sampai" style="color:white">.</label>
                <button type="submit" class="form-control btn btn-success">Terapkan</button>
              </div>
          </div>
        </div>
      </form>
      <hr class="style1">
      <div class="form-row">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Kode</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Dari</th>
              <th scope="col">Kepada</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($pindahgudangs as $p)
              <tr>
                  <td>{{ $p->KodePindah}}</td>
                  <td>{{ $p->Tanggal}}</td>
                  <td>{{ $p->DariLokasi}}</td>
                  <td>{{ $p->KeLokasi }}</td>
                  <td>{{ $p->Keterangan}}</td>
                  <td>
                    <a href="{{ url('/pindahgudang/edit/'.$p->KodePindah) }}" class="btn-sm btn btn-warning">
                      <i class="fa fa-pencil" aria-hidden="true"></i> Ubah
                    </a>
                    <a href="{{ url('/pindahgudang/confirmation/'.$p->KodePindah) }}" class="btn-sm btn btn-success" onclick="return confirm('Konfirmasi dokumen ini?')" target="_blank">
                      <i class="fa fa-truck" aria-hidden="true"></i> Kirim
                    </a>
                    <a href="{{ url('/pindahgudang/destroy/'.$p->KodePindah) }}" class="btn-sm btn btn-danger" onclick="return confirm('Hapus dokumen ini?')">
                      <i class="fa fa-trash" aria-hidden="true"></i> Hapus
                    </a>
                  </td>
              </tr>
            @endforeach
            </tbody>
        </table>
        <p style="text-align:center">{{ $nodataopn }}<p>
      </div>
      
      <h4>Tabel Confirmed</h4>
      <div class="form-row">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Kode</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Dari</th>
              <th scope="col">Kepada</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($pindahgudangconfirmed as $c)
              <tr>
                  <td>{{ $c->KodePindah}}</td>
                  <td>{{ $c->Tanggal}}</td>
                  <td>{{ $c->DariLokasi}}</td>
                  <td>{{ $c->KeLokasi }}</td>
                  <td>{{ $c->Keterangan}}</td>
                  <td>
                    <a href="{{ url('/pindahgudang/look/'.$c->KodePindah) }}" class="btn-sm btn btn-info">
                      <i class="fa fa-eye" aria-hidden="true"></i> Lihat
                    </a>
                    <a href="{{ url('/pindahgudang/print/'.$c->KodePindah) }}" class="btn-sm btn btn-primary" target="_blank">
                      <i class="fa fa-print" aria-hidden="true"></i> Print
                    </a>
                    @if(!empty($c->ceklpb))
                    <label class="badge badge-success">BARANG DITERIMA</label>
                    @else
                    <a href="{{ url('/pindahgudang/createlpb/'.$c->KodePindah) }}" class="btn-sm btn btn-success">
                        <i class="fa fa-check" aria-hidden="true"></i> Terima barang
                    </a>
                    @endif
                  </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <p style="text-align:center">{{ $nodatacfm }}<p>
      </div>
    </div>
  </div>
</div>
@endsection