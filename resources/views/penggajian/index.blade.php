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
  <!-- <li class="nav-item" style="border-right: 1px solid #ddd;">
    <a href="#body-laporan" data-toggle="tab" class="nav-link"><span class="fa fa-history"></span>&nbsp;Riwayat Penggajian</a>
  </li> -->
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
      scrollY: "50vh",
      // scrollX: true,
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
      // $(`#body-${form} form`)[0].reset();
      // $(`#body-${form} .subtotal`).val('0');
      // $(`#body-${form} .input-subtotal`).attr('value', 0);
      // $(`#body-${form} .total-packing`).val('0');
      // $(`#body-${form} .total-nutuk`).val('0');
      // $(`#body-${form} .input-bonus`).val(0);
      // $(`#body-${form} .input-bonus`).attr('value', 0);
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
        location.reload();
        $('button[type="submit"]', this).prop('disabled', false);
        $('button[type="submit"] span', this).toggleClass('fa fa-spinner fa-spin');

        // $(`#body-${form} .subtotal`).text('0');
        // $(`#body-${form} .input-subtotal`).attr('value', 0);
        // $(`#body-${form} .total-item`).text('0');
        // $(`#body-${form} .input-bonus`).val(0);
        // $(`#body-${form} .input-bonus`).attr('value', 0);
      }).fail((error) => {
        console.log(error);
        alert('Terjadi kesalahan saat simpan gaji');
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
    let totalNutuk = 0;
    let totalPacking = 0;
    let bonusNutuk = 0;
    let bonusPacking = 0;
    let bonusItem = 0;

    $('input[type="number"]', this).on('input', function() {
      subTotal = 0;
      totalNutuk = 0;
      totalPacking = 0;
      bonusNutuk = 0;
      bonusPacking = 0;
      bonusItem = 0;

      let $tr = $(this).closest('tr');

      $('input[type="number"]', $tr).each(function() {
        let inputValue = Number($(this).val());
        let inputNominal = Number($(this).data('multiplier'));

        if ($(this).is('.input-nutuk')) {
          totalNutuk += inputValue;

          if (totalNutuk == 30) {
            bonusNutuk = 20000;
          } else if (totalNutuk == 31) {
            bonusNutuk = 21000;
          } else if (totalNutuk == 32) {
            bonusNutuk = 22000;
          } else if (totalNutuk == 33) {
            bonusNutuk = 23000;
          } else if (totalNutuk == 34) {
            bonusNutuk = 24000;
          } else if (totalNutuk == 35) {
            bonusNutuk = 30000;
          } else if (totalNutuk == 36) {
            bonusNutuk = 31000;
          } else if (totalNutuk == 37) {
            bonusNutuk = 32000;
          } else if (totalNutuk == 38) {
            bonusNutuk = 33000;
          } else if (totalNutuk == 39) {
            bonusNutuk = 34000;
          } else if (totalNutuk == 40) {
            bonusNutuk = 40000;
          } else if (totalNutuk == 41) {
            bonusNutuk = 41000;
          } else if (totalNutuk == 42) {
            bonusNutuk = 42000;
          } else if (totalNutuk == 43) {
            bonusNutuk = 43000;
          } else if (totalNutuk == 44) {
            bonusNutuk = 44000;
          } else if (totalNutuk == 45) {
            bonusNutuk = 50000;
          } else if (totalNutuk == 46) {
            bonusNutuk = 51000;
          } else if (totalNutuk == 47) {
            bonusNutuk = 52000;
          } else if (totalNutuk == 48) {
            bonusNutuk = 53000;
          } else if (totalNutuk == 49) {
            bonusNutuk = 54000;
          } else if (totalNutuk == 50) {
            bonusNutuk = 60000;
          } else if (totalNutuk > 50) {
            bonusNutuk = totalNutuk * 1000 + 10000;
          }
        }

        if ($(this).is('.input-packing')) {
          totalPacking += inputValue;

          if (totalPacking == 40) {
            bonusPacking = 20000;
          } else if (totalPacking == 41) {
            bonusPacking = 21000;
          } else if (totalPacking == 42) {
            bonusPacking = 22000;
          } else if (totalPacking == 43) {
            bonusPacking = 23000;
          } else if (totalPacking == 44) {
            bonusPacking = 24000;
          } else if (totalPacking == 45) {
            bonusPacking = 30000;
          } else if (totalPacking == 46) {
            bonusPacking = 31000;
          } else if (totalPacking == 47) {
            bonusPacking = 32000;
          } else if (totalPacking == 48) {
            bonusPacking = 33000;
          } else if (totalPacking == 49) {
            bonusPacking = 34000;
          } else if (totalPacking == 50) {
            bonusPacking = 40000;
          } else if (totalPacking == 51) {
            bonusPacking = 41000;
          } else if (totalPacking == 52) {
            bonusPacking = 42000;
          } else if (totalPacking == 53) {
            bonusPacking = 43000;
          } else if (totalPacking == 54) {
            bonusPacking = 44000;
          } else if (totalPacking == 55) {
            bonusPacking = 50000;
          } else if (totalPacking == 56) {
            bonusPacking = 51000;
          } else if (totalPacking == 57) {
            bonusPacking = 52000;
          } else if (totalPacking == 58) {
            bonusPacking = 53000;
          } else if (totalPacking == 59) {
            bonusPacking = 54000;
          } else if (totalPacking == 60) {
            bonusPacking = 60000;
          } else if (totalPacking > 60) {
            bonusPacking = totalPacking * 1000;
          }
        }

        bonusItem = bonusNutuk + bonusPacking;
        $('.input-bonus', $tr).attr('value', bonusItem);
        $('.input-bonus', $tr).val(bonusItem);

        subTotal = subTotal + (inputValue * inputNominal);
      });

      if ($('td', $tr).is('.total-nutuk')) {
        $('.total-nutuk', $tr).text(totalNutuk);
      }
      if ($('td', $tr).is('.total-packing')) {
        $('.total-packing', $tr).text(totalPacking);
      }

      var subtotal_format = number_format(subTotal);

      $('.subtotal', $tr).text(subtotal_format);
      $('.input-subtotal', $tr).attr('value', subTotal);
    });
  });

  function number_format(number, decimals, decPoint, thousandsSep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
    var n = !isFinite(+number) ? 0 : +number
    var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
    var sep = (typeof thousandsSep === 'undefined') ? '.' : thousandsSep
    var dec = (typeof decPoint === 'undefined') ? ',' : decPoint
    var s = ''

    var toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec)
      return '' + (Math.round(n * k) / k)
        .toFixed(prec)
    }

    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
    if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
    }
    if ((s[1] || '').length < prec) {
      s[1] = s[1] || ''
      s[1] += new Array(prec - s[1].length + 1).join('0')
    }

    return s.join(dec)
  }
</script>
@endpush