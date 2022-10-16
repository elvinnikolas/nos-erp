@foreach($dataGolongan as $golongan)
<div class="tab-pane fade body-gaji" id="body-gaji-{{$golongan['NoGolongan']}}">
  <div class="row">
    <form class="form-horizontal">
      @csrf
      <br>
      <input type="hidden" name="Golongan" value="{{ $golongan['NoGolongan'] }}">
      <input type="hidden" name="Borongan" value="{{ $golongan['Borongan'] }}">
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12">Tanggal: </label>
        <div class="input-group datepicker col-lg-9 col-md-9 col-sm-9 col-xs-12">
          <input type="text" name="TanggalGaji" class="form-control" value="{{date('d-m-Y')}}">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-calendar"></i>
          </span>
        </div>
      </div>

      <!-- <small>Keterangan:</small>
      <br> -->
      <!-- <small>L = Lengkap ({{number_format(($golongan['UangHadir']), 0, ',', '.')}}) \\ TL = Tidak Lengkap ({{number_format(($golongan['UangHadirHarian']), 0, ',', '.')}})</small> -->
      @if($golongan['Borongan'] == 1)
      <small>HADIR : L = Lengkap \\ TL = Tidak Lengkap \\ H = Harian </small>
      <br>
      <small>LEMBUR : J = Jam \\ M = Minggu </small>
      <br>
      <small>ITEM : P = Packing \\ N = Nutuk </small>
      <br>
      @endif
      @if($golongan['Borongan'] == 0)
      <small>HADIR : P = Pokok </small>
      <br>
      <small>LEMBUR : J = Jam \\ M = Minggu </small>
      <br>
      <small>ITEM : P = Produksi </small>
      <br>
      @endif
      <!-- @foreach($golongan['GroupItem'] as $group)
      @if($golongan['Borongan'] == 1)
      <small>{{$group['NamaGroupItem']}}: {{$group['NominalGroupItem']}}</small>
      @endif
      @endforeach -->

      <table class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th rowspan="2">Nama</th>
            @if($golongan['Borongan'] == 1)
            <th colspan="3">Hadir</th>
            @elseif($golongan['Borongan'] == 0)
            <th colspan="1">Hadir</th>
            @endif
            <th colspan="2">Lembur</th>
            @if(count($golongan['GroupItem']) > 0)
            @foreach($golongan['GroupItem'] as $item)
            @if($golongan['Borongan'] == 1)
            <th colspan="2">{{ strtoupper($item['NamaGroupItem']) }}</th>
            @else
            <th>{{ strtoupper($item['NamaGroupItem']) }}</th>
            @endif
            @endforeach
            @endif
            @if($golongan['Borongan'] == 1)
            <th colspan="2">Total Item</th>
            <th colspan="2">Bonus</th>
            @endif
            @if($golongan['Borongan'] == 1)
            <th rowspan="2">Hutang</th>
            @elseif($golongan['Borongan'] == 0)
            @if(count($golongan['DataBonus']) > 0)
            @foreach($golongan['DataBonus'] as $bonus)
            <th rowspan="2">{{ strtoupper($bonus['NamaBonus']) }}</th>
            @endforeach
            @endif
            @endif
            <th rowspan="2">Subtotal</th>
          </tr>
          <tr>
            @if($golongan['Borongan'] == 1)
            <!-- hadir -->
            <th>L</th>
            <th>TL</th>
            <th>H</th>
            @elseif($golongan['Borongan'] == 0)
            <th>P</th>
            @endif
            <!-- lembur -->
            <th>J</th>
            <th>M</th>
            <!-- item -->
            @if(count($golongan['GroupItem']) > 0)
            @foreach($golongan['GroupItem'] as $item)
            @if($golongan['Borongan'] == 1)
            <th>P</th>
            <th>N</th>
            @elseif($golongan['Borongan'] == 0)
            <th>P</th>
            @endif
            @endforeach
            @endif
            <!-- total item -->
            @if($golongan['Borongan'] == 1)
            <th>P</th>
            <th>N</th>
            @endif
            <!-- bonus -->
            @if($golongan['Borongan'] == 1)
            <th>Item</th>
            <th>Lain</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @foreach($golongan['DataKaryawan'] as $karyawan)
          <tr>
            <!-- nama -->
            <td>{{ $karyawan['NamaKaryawan'] }}<input type="hidden" name="Karyawan[]" value="{{ $karyawan['KodeKaryawan'] }}"></td>
            @if($golongan['Borongan'] == 1)
            <!-- hadir -->
            <td><input type="number" name="Hadir[]" class="input-hadir form-control" step="1" min="0" max="6" data-multiplier="{{ $golongan['UangHadir'] }}" placeholder="0"></td>
            <td><input type="number" name="HadirHarian[]" class="input-hadirharian form-control" step="1" min="0" max="6" data-multiplier="{{ $golongan['UangHadirHarian'] }}" placeholder="0"></td>
            <!-- harian -->
            <td><input type="number" name="Harian[]" class="input-harian form-control" min="0" data-multiplier="1" placeholder="0"></td>
            @elseif($golongan['Borongan'] == 0)
            <!-- hadir -->
            <td><input type="number" name="Hadir[]" class="input-hadir form-control" step="1" min="0" max="6" data-multiplier="{{ $golongan['UangHadir'] }}" placeholder="0"></td>
            @endif
            <!-- lembur -->
            <td><input type="number" name="Jam[]" class="input-jam form-control" step="1" min="0" max="24" data-multiplier="{{ $golongan['UangLembur'] }}" placeholder="0"></td>
            <td><input type="number" name="Minggu[]" class="input-minggu form-control" step="1" min="0" max="1" data-multiplier="{{ $golongan['UangMinggu'] }}" placeholder="0"></td>
            <!-- group item -->
            @if(count($golongan['GroupItem']) > 0)
            @foreach($golongan['GroupItem'] as $group)
            @if($golongan['Borongan'] == 1)
            <td><input type="number" name="Produksi[{{$group['NoGroupItem']}}][]" class="input-packing form-control input-item" step="1" min="0" max="999" data-multiplier="{{ $group['NominalGroupItem'] }}" placeholder="0"></td>
            <td><input type="number" name="ProduksiNutuk[{{$group['NoGroupItem']}}][]" class="input-nutuk form-control input-item" step="1" min="0" max="999" data-multiplier="{{ $group['NominalGroupItemNutuk'] }}" placeholder="0"></td>
            @else
            <td><input type="number" name="Produksi[{{$group['NoGroupItem']}}][]" class="form-control input-item" step="1" min="0" max="999" data-multiplier="{{ $group['NominalGroupItem'] }}" placeholder="0"></td>
            @endif
            @endforeach
            @endif
            @if($golongan['Borongan'] == 1)
            <!-- total item -->
            <td class="total-packing">0</td>
            <td class="total-nutuk">0</td>
            <!-- bonus -->
            <td><input type="number" name="Bonus[]" class="input-bonus form-control" data-multiplier="1" placeholder="0" readonly></td>
            <td><input type="number" name="BonusLain[]" class="form-control" data-multiplier="1" placeholder="0"></td>
            @endif
            @if($golongan['Borongan'] == 1)
            <!-- hutang -->
            <td><input type="number" name="Hutang[]" class="input-hutang form-control" data-multiplier="-1" value="{{ $karyawan['Hutang'] }}"></td>
            @elseif($golongan['Borongan'] == 0)
            @if(count($golongan['DataBonus']) > 0)
            @foreach($golongan['DataBonus'] as $bonus)
            <td><input type="number" name="Bonus[{{$bonus['NoBonus']}}][]" class="form-control input-item" step="1" min="0" data-multiplier="{{ $bonus['NominalBonus'] }}" placeholder="0"></td>
            @endforeach
            @endif
            @endif
            <!-- subtotal -->
            <td class="subtotal" width="7%">0</td>
            <input type="hidden" name="Subtotal[]" class="input-subtotal" value="0">
          </tr>
          @endforeach
        </tbody>
      </table>
      <br>
      <div class="form-group pull-right">
        <button type="submit" class="btn btn-success" data-form="gaji-{{$golongan['NoGolongan']}}">Simpan<span></span></button>
        <button type="reset" class="btn btn-default" data-form="gaji-{{$golongan['NoGolongan']}}">Reset</button>
      </div>
    </form>
  </div>
</div>
@endforeach