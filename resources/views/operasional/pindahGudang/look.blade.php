@extends('index')
@section('content')
<div class="container">
  <div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
      <div class="col-sm-6">
          {{-- <h1 class="m-0 text-dark">{{$code}}</h1> --}}
      </div><!-- /.col -->
      </div><!-- /.row -->
  </div><!-- /.container-fluid -->
  </div>
  
  <div class="x_panel">
        <div class="x_title">
            <h1>Lihat Pindah Gudang</h1>
        </div>
        <div class="x_content">
            <div class="form-group">
                <label>Kode Pindah Gudang: </label>
                <input readonly type="text" value="{{ $pindahgudang->KodePindah }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Kode User: </label>
                <input readonly type="text" value="{{ $pindahgudang->KodeUser }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Dari: </label>
                <input readonly type="text" value="{{ $pindahgudang->DariLokasi }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Ke: </label>
                <input readonly type="text" value="{{ $pindahgudang->KeLokasi }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Tanggal: </label>
                <input readonly type="text" value="{{ $pindahgudang->Tanggal }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Keterangan: </label>
                <input readonly type="text" value="{{ $pindahgudang->Keterangan }}" class="form-control">
            </div>
            <div class="form-row">
                <table class="table">
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
                    @foreach ($pindahgudangdetails as $p)
                    <tr>
                        <td>{{ $p->KodeItem}}</td>
                        <td>{{ $p->NamaItem}}</td>
                        <td>{{ $p->Qty}}</td>
                        <td>{{ $p->KodeSatuan }}</td>
                        <td>{{ $p->Keterangan}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if(empty($ceklpb))
            <a href="{{ url('/pindahgudang/createlpb/'.$pindahgudang->KodePindah) }}" class="btn-sm btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i> Penerimaan barang
            </a>
            @endif
            <a href="{{ url('/pindahgudang')}}" class="btn btn-warning mb-3 mt-3">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
