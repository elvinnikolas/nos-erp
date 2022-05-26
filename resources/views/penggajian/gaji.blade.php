@foreach($dataGolongan as $golongan)
<div class="tab-pane fade body-gaji" id="body-gaji-{{$golongan['NoGolongan']}}">
  <div class="row">
    <form class="form-horizontal">
      @csrf
      <input type="hidden" name="Golongan" value="{{ $golongan['NoGolongan'] }}">
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12">Tanggal: </label>
        <div class="input-group datepicker col-lg-9 col-md-9 col-sm-9 col-xs-12">
          <input type="text" name="TanggalGaji" class="form-control" value="{{date('d-m-Y')}}">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-calendar"></i>
          </span>
        </div>
      </div>

      <small>** P = Packing | N = Nutuk</small>

      <table class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th rowspan="2">Nama</th>
            @if($golongan['Borongan'] == 1) <th rowspan="2" width="5%">Nutuk?</th> @endif
            <th>Hadir</th>
            <th>Harian</th>
            @if($golongan['Borongan'] == 0) <th>Jam</th> @endif
            @if($golongan['Borongan'] == 0) <th>Minggu</th> @endif
            @if(count($golongan['GroupItem']) > 0)
            @foreach($golongan['GroupItem'] as $item)
            @if($golongan['Borongan'] == 1)
            <th colspan="2">{{ strtoupper($item['NamaGroupItem']) }}</th>
            @else
            <th>{{ strtoupper($item['NamaGroupItem']) }}</th>
            @endif
            @endforeach
            @endif
            @if($golongan['Borongan'] == 1) <th rowspan="2">Total Item</th> @endif
            @if($golongan['Borongan'] == 1) <th rowspan="2">Bonus</th> @endif
            <th rowspan="2">Hutang</th>
            <th rowspan="2">Subtotal</th>
          </tr>
          <tr>
            <th>{{ $golongan['UangHadir'] }}</th>
            <th>{{ $golongan['UangLembur'] }}</th>
            @if($golongan['Borongan'] == 0) <th>{{ ceil($golongan['UangLembur'] / 7) }}</th> @endif
            @if($golongan['Borongan'] == 0) <th>{{ $golongan['UangMinggu'] }}</th> @endif
            @if(count($golongan['GroupItem']) > 0)
            @foreach($golongan['GroupItem'] as $item)
            @if($golongan['Borongan'] == 1)
            <th>P&nbsp;({{ $item['NominalGroupItem'] }})</th>
            <th>N&nbsp;({{ $item['NominalGroupItemNutuk'] }})</th>
            @else
            <th>({{ $item['NominalGroupItem'] }})</th>
            @endif
            @endforeach
            @endif
          </tr>
        </thead>
        <tbody>
          @foreach($golongan['DataKaryawan'] as $karyawan)
          <tr>
            <!-- nama -->
            <td>{{ $karyawan['NamaKaryawan'] }}<input type="hidden" name="Karyawan[]" value="{{ $karyawan['KodeKaryawan'] }}"></td>
            <!-- nutuk -->
            @if($golongan['Borongan'] == 1)
            <td><input type="checkbox" name="Nutuk[]" class="checkbox-nutuk"></td>
            @endif
            <!-- hadir -->
            <td><input type="number" name="Hadir[]" class="input-hadir form-control" step="1" min="0" max="6" data-multiplier="{{ $golongan['UangHadir'] }}" value="0"></td>
            <!-- l.harian -->
            <td><input type="number" name="Harian[]" class="input-harian form-control" step="1" min="0" max="6" data-multiplier="{{ $golongan['UangLembur'] }}" value="0"></td>
            <!-- l.jam -->
            @if($golongan['Borongan'] == 0)
            <td><input type="number" name="Jam[]" class="input-jam form-control" step="1" min="0" data-multiplier="{{ ceil($golongan['UangLembur'] / 7) }}" value="0"></td>
            @endif
            <!-- l.minggu -->
            @if($golongan['Borongan'] == 0)
            <td>
              {{--<input type="checkbox" name="Minggu[]" class="input-minggu" value="{{ $golongan['UangMinggu'] }}">--}}
              <input type="number" name="Minggu[]" class="input-jam form-control" step="1" min="0" max="1" data-multiplier="{{ $golongan['UangMinggu'] }}" value="0">
            </td>
            @endif
            <!-- group item -->
            @if(count($golongan['GroupItem']) > 0)
            @foreach($golongan['GroupItem'] as $group)
            @if($golongan['Borongan'] == 1)
            <td><input type="number" name="Produksi[{{$group['NoGroupItem']}}][]" class="input-packing form-control input-item" step="1" min="0" data-multiplier="{{ $group['NominalGroupItem'] }}" value="0"></td>
            <td><input type="number" name="Produksi[{{$group['NoGroupItem']}}][]" class="input-nutuk form-control input-item" step="1" min="0" data-multiplier="{{ $group['NominalGroupItemNutuk'] }}" value="0" disabled></td>
            @else
            <td><input type="number" name="Produksi[{{$group['NoGroupItem']}}][]" class="form-control input-item" step="1" min="0" data-multiplier="{{ $group['NominalGroupItem'] }}" value="0"></td>
            @endif
            @endforeach
            @endif
            <!-- total item -->
            @if($golongan['Borongan'] == 1) <td class="total-item">0</td> @endif
            <!-- bonus -->
            @if($golongan['Borongan'] == 1) <td><input type="number" name="Bonus[]" class="input-bonus form-control" data-multiplier="1" value="0"></td> @endif
            <!-- hutang -->
            <td><input type="number" name="Hutang[]" class="input-hutang form-control" data-multiplier="-1" value="0"></td>
            <!-- subtotal -->
            <td class="subtotal">0</td>
            <input type="hidden" name="Subtotal[]" class="input-subtotal" value="0">
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="form-group pull-right">
        <button type="submit" class="btn btn-success" data-form="gaji-{{$golongan['NoGolongan']}}">Simpan<span></span></button>
        <button type="reset" class="btn btn-default" data-form="gaji-{{$golongan['NoGolongan']}}">Batal</button>
      </div>
    </form>
  </div>
</div>
@endforeach