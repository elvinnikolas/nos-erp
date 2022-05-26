@extends('index')
@section('styles')
<style>
  #content-penggajian table th {
    white-space: nowrap;
    text-align: center;
  }
</style>
@endsection
@section('content')
<ul class="nav nav-tabs">
  <li class="nav-item" style="border-right: 1px solid #ddd;">
    <a href="#body-absen" data-toggle="tab" class="nav-link"><span class="fa fa-clock-o"></span>&nbsp;Absen Karyawan</a>
  </li>
  <li class="dropdown nav-item" style="border-right: 1px solid #ddd;">
    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><span class="fa fa-money"></span>&nbsp;Gaji Karyawan&nbsp;<span class="caret"></span></a>
    <ul class="dropdown-menu">
      @foreach($golongan as $data)
      <li><a href="#body-gaji-{{$data['NoGolongan']}}" data-toggle="tab">{{$data['NamaGolongan']}}</a></li>
      @endforeach
    </ul>
  </li>
  <li class="nav-item" style="border-right: 1px solid #ddd;">
    <a href="#body-laporan" data-toggle="tab" class="nav-link"><span class="fa fa-history"></span>&nbsp;Riwayat Penggajian</a>
  </li>
</ul>
<div class="tab-content" id="content-penggajian">
  @include('penggajian.absensi', ['dataKaryawan' => $karyawan])
  @include('penggajian.gaji', ['dataGolongan' => $dataGolongan])
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    $('.datepicker').datetimepicker({
      format: "DD-MM-YYYY"
    });

    $('#content-penggajian table').DataTable({
      scrollY: "45vh",
      scrollX: true,
      scrollCollapse: true,
      paging: false,
      info: false,
      orderCellsTop: true,
      columnDefs: [{
          targets: [0],
          orderable: true,
          searchable: true
        },
        {
          targets: "_all",
          orderable: false,
          searchable: false
        }
      ]
    });
  });

  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
  });

  $('button[type="submit"]').each(function() {
    $(this).on('click', function() {
      let form = $(this).data('form');
      $(this).prop('disabled', true);
      $('span', this).toggleClass('fa fa-spinner fa-spin');
      $(`#body-${form} form`).submit();
    });
  });

  $('button[type="reset"]').each(function() {
    $(this).on('click', function() {
      let form = $(this).data('form');
      if ($(`#body-${form} button[type="submit"] span`).is('.fa, .fa-spinner, .fa-spin')) {
        $(`#body-${form} button[type="submit"]`).prop('disabled', false);
        $(`#body-${form} button[type="submit"] span`).toggleClass('fa fa-spinner fa-spin');
      }
      $(`#body-${form} form`)[0].reset();
      $(`#body-${form} .subtotal`).text('0');
      $(`#body-${form} .input-subtotal`).attr('value', 0);
      $(`#body-${form} .total-item`).text('0');
      $(`#body-${form} .input-bonus`).val(0);
      $(`#body-${form} .input-bonus`).attr('value', 0);
    });
  });

  $('#body-absen form').on('submit', function(e) {
    e.preventDefault(); /*console.log($(this).serializeArray());*/
    let dataAbsen = new FormData(this);
    $.ajax({
      url: "{{route('penggajian.absen')}}",
      method: "post",
      data: dataAbsen,
      cache: false,
      contentType: false,
      processData: false
    }).done((response) => {
      if (response.status == 'failed') {
        alert('Tidak ada kode karyawan yang dipilih');
        this.reset();
        $('button[type="submit"]', this).prop('disabled', false);
        $('button[type="submit"] span', this).toggleClass('fa fa-spinner fa-spin');
      } else if (response.status == 'success') {
        alert('Absen karyawan tanggal ' + $('.datepicker input', this).val() + ' telah disimpan');
        this.reset();
        $('button[type="submit"]', this).prop('disabled', false);
        $('button[type="submit"] span', this).toggleClass('fa fa-spinner fa-spin');
      }
    }).fail((error) => {
      console.log(error);
    });
  });

  $('.body-gaji form').each(function() {
    $(this).on('submit', function(e) {
      e.preventDefault();
      console.log($(this).serializeArray());
      let dataGaji = new FormData(this);
      $.ajax({
        url: "{{ route('penggajian.gaji') }}",
        method: "post",
        data: dataGaji,
        cache: false,
        contentType: false,
        processData: false
      }).done((response) => {
        alert('Gaji karyawan berhasil disimpan');
        this.reset();
        $('button[type="submit"]', this).prop('disabled', false);
        $('button[type="submit"] span', this).toggleClass('fa fa-spinner fa-spin');

        $(`#body-${form} .subtotal`).text('0');
        $(`#body-${form} .input-subtotal`).attr('value', 0);
        $(`#body-${form} .total-item`).text('0');
        $(`#body-${form} .input-bonus`).val(0);
        $(`#body-${form} .input-bonus`).attr('value', 0);
      }).fail((error) => {
        console.log(error);
        alert('SERVER error saat simpan gaji');
        $('button[type="submit"]', this).prop('disabled', false);
        $('button[type="submit"] span', this).toggleClass('fa fa-spinner fa-spin');
      });
    });
  });

  $('input#checkbox-absen-semua').on('change', function() {
    if ($(this).is(':checked')) {
      $('input.checkbox-absen-karyawan').prop('checked', true);
    } else {
      $('input.checkbox-absen-karyawan').prop('checked', false);
    }
  });

  $('.body-gaji table').each(function() {
    let totalItem = 0;
    let subTotal = 0;
    let bonusItem = 0;

    $('.checkbox-nutuk', this).on('change', function() {
      subTotal = 0;
      totalItem = 0;
      bonusItem = 0;

      let $row = $(this).closest('tr');

      if ($(this, $row).is(':checked')) {
        $('.input-packing', $row).prop('disabled', true);
        $('.input-packing', $row).attr('value', 0);
        $('.input-packing', $row).val(0);
        $('.input-nutuk', $row).prop('disabled', false);
      } else {
        $('.input-packing', $row).prop('disabled', false);
        $('.input-nutuk', $row).prop('disabled', true);
        $('.input-nutuk', $row).attr('value', 0);
        $('.input-nutuk', $row).val(0);
      }

      $('.total-item', $row).text(totalItem);
      $('.input-bonus', $row).attr('value', 0);
      $('.input-bonus', $row).val(0);

      $('input[type="number"]', $row).each(function() {
        let inputValue = Number($(this).val());
        let inputNominal = Number($(this).data('multiplier'));
        subTotal = subTotal + (inputValue * inputNominal);
      });

      $('.subtotal', $row).text(subTotal);
      $('.input-subtotal', $row).attr('value', subTotal);
    });

    $('input[type="number"]', this).on('input', function() {
      subTotal = 0;
      totalItem = 0;
      bonusItem = 0;

      let $tr = $(this).closest('tr');

      $('input[type="number"]', $tr).each(function() {
        let inputValue = Number($(this).val());
        let inputNominal = Number($(this).data('multiplier'));
        subTotal = subTotal + (inputValue * inputNominal);

        if ($(this).is('.input-item')) {
          totalItem += inputValue;
        }
      });

      if ($('.checkbox-nutuk', $tr).is(':checked')) {
        if (totalItem == 30) {
          bonusItem = 20000;
        } else if (totalItem == 31) {
          bonusItem = 21000;
        } else if (totalItem == 32) {
          bonusItem = 22000;
        } else if (totalItem == 33) {
          bonusItem = 23000;
        } else if (totalItem == 34) {
          bonusItem = 24000;
        } else if (totalItem == 35) {
          bonusItem = 30000;
        } else if (totalItem == 36) {
          bonusItem = 31000;
        } else if (totalItem == 37) {
          bonusItem = 32000;
        } else if (totalItem == 38) {
          bonusItem = 33000;
        } else if (totalItem == 39) {
          bonusItem = 34000;
        } else if (totalItem == 40) {
          bonusItem = 40000;
        } else if (totalItem == 41) {
          bonusItem = 41000;
        } else if (totalItem == 42) {
          bonusItem = 42000;
        } else if (totalItem == 43) {
          bonusItem = 43000;
        } else if (totalItem == 44) {
          bonusItem = 44000;
        } else if (totalItem == 45) {
          bonusItem = 50000;
        } else if (totalItem == 46) {
          bonusItem = 51000;
        } else if (totalItem == 47) {
          bonusItem = 52000;
        } else if (totalItem == 48) {
          bonusItem = 53000;
        } else if (totalItem == 49) {
          bonusItem = 54000;
        } else if (totalItem == 50) {
          bonusItem = 60000;
        } else if (totalItem > 50) {
          bonusItem = totalItem * 1000 + 10000;
        }
      } else {
        if (totalItem == 40) {
          bonusItem = 20000;
        } else if (totalItem == 41) {
          bonusItem = 21000;
        } else if (totalItem == 42) {
          bonusItem = 22000;
        } else if (totalItem == 43) {
          bonusItem = 23000;
        } else if (totalItem == 44) {
          bonusItem = 24000;
        } else if (totalItem == 45) {
          bonusItem = 30000;
        } else if (totalItem == 46) {
          bonusItem = 31000;
        } else if (totalItem == 47) {
          bonusItem = 32000;
        } else if (totalItem == 48) {
          bonusItem = 33000;
        } else if (totalItem == 49) {
          bonusItem = 34000;
        } else if (totalItem == 50) {
          bonusItem = 40000;
        } else if (totalItem == 51) {
          bonusItem = 41000;
        } else if (totalItem == 52) {
          bonusItem = 42000;
        } else if (totalItem == 53) {
          bonusItem = 43000;
        } else if (totalItem == 54) {
          bonusItem = 44000;
        } else if (totalItem == 55) {
          bonusItem = 50000;
        } else if (totalItem == 56) {
          bonusItem = 51000;
        } else if (totalItem == 57) {
          bonusItem = 52000;
        } else if (totalItem == 58) {
          bonusItem = 53000;
        } else if (totalItem == 59) {
          bonusItem = 54000;
        } else if (totalItem == 60) {
          bonusItem = 60000;
        } else if (totalItem > 60) {
          bonusItem = totalItem * 1000;
        }
      }

      if ($('td', $tr).is('.total-item')) {
        $('.total-item', $tr).text(totalItem);
      }
      if ($('input', $tr).is('.input-bonus')) {
        $('.input-bonus', $tr).attr('value', bonusItem);
        $('.input-bonus', $tr).val(bonusItem);
      }

      $('.subtotal', $tr).text(subTotal);
      $('.input-subtotal', $tr).attr('value', subTotal);
    });
  });
</script>
@endpush