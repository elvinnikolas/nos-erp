<div class="tab-pane fade" id="body-absen">
  <div class="row">
    <form class="form-horizontal">
      @csrf
      <div class="form-group">
        <label class="control-label col-lg-1 col-md-1 col-sm-1 col-xs-12">Tanggal : </label>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <div class="input-group datepicker">
            <input type="text" name="TanggalAbsen" class="form-control" value="{{date('d-m-Y')}}">
            <span class="input-group-addon">
              <i class="glyphicon glyphicon-calendar"></i>
            </span>
          </div>
        </div>
      </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th width="15%">Karyawan</th>
            <th><input type="checkbox" id="checkbox-absen-semua"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($dataKaryawan as $data)
          <tr>
            <td>{{$data->Nama}}</td>
            <td><input type="checkbox" class="checkbox-absen-karyawan" name="KodeKaryawan[]" value="{{$data->KodeKaryawan}}"></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="form-group pull-right">
        <button type="submit" class="btn btn-success" data-form="absen">Simpan<span></span></button>
        <button type="reset" class="btn btn-default" data-form="absen">Batal</button>
      </div>
    </form>
  </div>
</div>