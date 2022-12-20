@extends('index')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h1 style="text-align:center">DATA GOLONGAN</h1>

          <!-- Alert -->
          @if(session()->get('created'))
          <div class="alert alert-success alert-dismissible fade-show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session()->get('created') }}
          </div>

          @elseif(session()->get('edited'))
          <div class="alert alert-info alert-dismissible fade-show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session()->get('edited') }}
          </div>

          @elseif(session()->get('deleted'))
          <div class="alert alert-danger alert-dismissible fade-show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session()->get('deleted') }}
          </div>
          @endif

          <button type="button" class="btn btn-success" onclick="showModal(this)" data-action="create" data-jenis="borongan">
            <span class="fa fa-plus"></span>&nbsp;Borongan
          </button>
          <button type="button" class="btn btn-primary" onclick="showModal(this)" data-action="create" data-jenis="non">
            <span class="fa fa-plus"></span>&nbsp;Non Borongan
          </button>
          <br><br>
        </div>
      </div>
      <div class="x_panel">
        <div class="x_body">
          <table class="table table-striped" id="table-golongan">
            <thead class="thead-light">
              <tr>
                <th>Kode Golongan</th>
                <th>Nama Golongan</th>
                <th>Hadir (Lengkap)</th>
                <th>Hadir (Tidak Lengkap)</th>
                <!-- <th>Lembur (Jam)</th> -->
                <th>Lembur (Minggu)</th>
                <th width="15%"></th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-golongan">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>Data Golongan Borongan</b></h4>
      </div>
      <form class="form-horizontal" id="form-golongan">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-md-2">Nama Golongan: </label>
            <div class="col-md-10">
              <input type="hidden" name="NoGolongan">
              <input type="text" name="NamaGolongan" class="form-control" placeholder="Nama Golongan" required style="text-transform: uppercase;">
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Hadir (Lengkap)</label>
                <input type="number" name="UangHadir" class="form-control" step="1" min="0" placeholder="0" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Hadir (Tidak Lengkap)</label>
                <input type="number" name="UangHadirHarian" class="form-control" step="1" min="0" placeholder="0" required>
              </div>
            </div>
            <!-- <div class="col-md-3">
              <div class="form-group">
                <label>Lembur (Jam)</label>
                <input type="number" name="UangLembur" class="form-control" step="1" min="0" placeholder="0" required>
              </div>
            </div> -->
            <div class="col-md-3">
              <div class="form-group">
                <label>Lembur (Minggu)</label>
                <input type="number" name="UangMinggu" class="form-control" step="1" min="0" placeholder="0" required>
              </div>
            </div>
            <input type="hidden" name="Borongan" class="form-control" value="1">
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <button type="button" class="btn btn-sm btn-primary pull-right" onclick="addrow()">
                <span class="fa fa-plus"></span>
              </button>
              <h5><b>Daftar Group Item</b></h5>
              <input type="hidden" name="JumlahGroupItem" value="0">
              <table id="table-list-group-item" class="table table-bordered">
                <thead>
                  <tr>
                    <th width="20%">Nama Group</th>
                    <th width="10%">Packing</th>
                    <th width="10%">Nutuk</th>
                    <th>Daftar Item</th>
                    <th width="10%"></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" data-jenis="borongan"><span></span>&nbsp;Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-golongan-non">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>Data Golongan Non Borongan</b></h4>
      </div>
      <form class="form-horizontal" id="form-golongan-non">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-md-2">Nama Golongan: </label>
            <div class="col-md-10">
              <input type="hidden" name="NoGolongan">
              <input type="text" name="NamaGolongan" class="form-control" placeholder="Nama Golongan" required style="text-transform: uppercase;">
            </div>
          </div>
          <hr>
          <div class="row">
            <!-- <div class="col-md-4">
              <div class="form-group">
                <label>Hadir (Pokok)</label>
                <input type="number" name="UangHadir" class="form-control" step="1" min="0" placeholder="0" required>
              </div>
            </div> -->
            <!-- <div class="col-md-4">
              <div class="form-group">
                <label>Lembur (Jam)</label>
                <input type="number" name="UangLembur" class="form-control" step="1" min="0" placeholder="0" required>
              </div>
            </div> -->
            <div class="col-md-4">
              <div class="form-group">
                <label>Lembur (Minggu)</label>
                <input type="number" name="UangMinggu" class="form-control" step="1" min="0" placeholder="0" required>
              </div>
            </div>
            <input type="hidden" name="Borongan" class="form-control" value="0">
          </div>
          <!-- bonus -->
          <hr>
          <div class="row">
            <div class="col-md-12">
              <button type="button" id="btn_bonus" class="btn btn-sm btn-primary pull-right" onclick="addrow_bonus()">
                <span class="fa fa-plus"></span>
              </button>
              <h5><b>Daftar Bonus</b></h5>
              <input type="hidden" name="JumlahBonus" value="0">
              <table id="table-list-bonus" class="table table-bordered">
                <thead>
                  <tr>
                    <th>Nama Bonus</th>
                    <th>Nominal</th>
                    <th width="10%"></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
          <!-- group item -->
          <hr>
          <div class="row">
            <div class="col-md-12">
              <button type="button" class="btn btn-sm btn-primary pull-right" onclick="addrow_non()">
                <span class="fa fa-plus"></span>
              </button>
              <h5><b>Daftar Group Item</b></h5>
              <input type="hidden" name="JumlahGroupItemNon" value="0">
              <table id="table-list-group-item-non" class="table table-bordered">
                <thead>
                  <tr>
                    <th width="20%">Nama Group</th>
                    <th width="20%">Nominal</th>
                    <th>Daftar Item</th>
                    <th width="10%"></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" data-jenis="non"><span></span>&nbsp;Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    $('#table-golongan').DataTable({
      scrollY: false,
      scrollX: false,
      columnDefs: [{
        targets: 5,
        orderable: false,
        searchable: false,
        render: (data) => {
          return `
          <button type="button" class="btn btn-primary btn-xs" onclick="showModal(this)" data-action="update" data-id=${data}>
            <span class="fa fa-pencil"></span>&nbsp;Ubah
          </button>
          <form action="{{ url('mastergolongan/${data}') }}" method="post" onsubmit="return showConfirm()" style="display: inline;">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-xs btn-danger">
              <span class="fa fa-trash"></span>&nbsp;Hapus
            </button>
          </form>`;
        }
      }],
      ajax: {
        url: "{{route('api.mastergolongan')}}",
        data: {
          "id": ''
        },
        dataSrc: ""
      },
      columns: [{
          data: "KodeGolongan"
        },
        {
          data: "NamaGolongan"
        },
        {
          data: "UangHadir",
          render: $.fn.dataTable.render.number('.', ',', 0, 'Rp. ')
        },
        {
          data: "UangHadirHarian",
          render: $.fn.dataTable.render.number('.', ',', 0, 'Rp. ')
        },
        // {
        //   data: "UangLembur",
        //   render: $.fn.dataTable.render.number('.', ',', 0, 'Rp. ')
        // },
        {
          data: "UangMinggu",
          render: $.fn.dataTable.render.number('.', ',', 0, 'Rp. ')
        },
        {
          data: "NoGolongan"
        }
      ]
    });
  });

  $('#modal-golongan').on('hide.bs.modal', function() {
    $('#form-golongan')[0].reset();
    $('#table-list-group-item tbody').empty();
  });

  $('#modal-golongan-non').on('hide.bs.modal', function() {
    $('#form-golongan-non')[0].reset();
    $('#table-list-group-item-non tbody').empty();
  });

  $('button[type="submit"]').on('click', function() {
    $(this).prop('disabled', true);
    let jenis = $(this).data('jenis');
    if (jenis == 'borongan') {
      $('#form-golongan').submit();
    } else if (jenis == 'non') {
      $('#form-golongan-non').submit();
    }
  });

  $('#form-golongan').on('submit', function(event) {
    event.preventDefault();
    console.log($(this).serializeArray());
    let formdata = new FormData(this);

    $.ajax({
      url: "{{ route('mastergolongan.store') }}",
      method: "post",
      data: formdata,
      contentType: false,
      processData: false,
      cache: false
    }).done(function(response) {
      // console.log(response);
      alert('Data berhasil ditambahkan');
      $('#modal-golongan').modal('hide');

      let table = $('#table-golongan').DataTable();
      table.ajax.reload(null, false);
      $('button[type="submit"]').prop('disabled', false);
    }).fail(function(error) {
      // alert('SERVER ERROR');
      console.log(error);
      $('#modal-golongan').modal('hide');
    });
  });

  $('#form-golongan-non').on('submit', function(event) {
    event.preventDefault();
    console.log($(this).serializeArray());
    let formdata = new FormData(this);

    $.ajax({
      url: "{{ route('mastergolongan.store') }}",
      method: "post",
      data: formdata,
      contentType: false,
      processData: false,
      cache: false
    }).done(function(response) {
      // console.log(response);
      alert('Data berhasil ditambahkan');
      $('#modal-golongan-non').modal('hide');

      let table = $('#table-golongan').DataTable();
      table.ajax.reload(null, false);
      $('button[type="submit"]').prop('disabled', false);
    }).fail(function(error) {
      // alert('SERVER ERROR');
      console.log(error);
      $('#modal-golongan-non').modal('hide');
    });
  });

  function showConfirm() {
    if (confirm("HAPUS data berikut?")) {
      return true;
    } else {
      return false;
    }
  }

  function showModal(element) {
    let action = $(element).data('action');
    let jenis = $(element).data('jenis');
    $('input[name="NoGolongan"]').attr('value', '');
    $('input[name="NamaGolongan"]').attr('value', '');
    $('input[name="UangHadir"]').attr('value', '');
    $('input[name="UangHadirHarian"]').attr('value', '');
    // $('input[name="UangLembur"]').attr('value', '');
    $('input[name="UangMinggu"]').attr('value', '');
    $('#table-list-bonus tbody').empty();
    $('#table-list-group-item tbody').empty();
    $('#table-list-group-item-non tbody').empty();

    if (action == 'update') {
      let id = $(element).data('id');
      $.ajax({
        url: "{{route('api.mastergolongan')}}",
        data: {
          "id": id
        }
      }).then(function(response) {
        if (response[0].Borongan == 1) {
          $('input[name="NoGolongan"]').attr('value', response[0].NoGolongan);
          $('input[name="NamaGolongan"]').attr('value', response[0].NamaGolongan);
          $('input[name="UangHadir"]').attr('value', response[0].UangHadir);
          $('input[name="UangHadirHarian"]').attr('value', response[0].UangHadirHarian);
          // $('input[name="UangLembur"]').attr('value', response[0].UangLembur);
          $('input[name="UangMinggu"]').attr('value', response[0].UangMinggu);

          $.each(response[0].GroupItem, function(index, value) {
            let jumlahGroup = parseInt($('input[name="JumlahGroupItem"]').val());
            jumlahGroup = jumlahGroup + 1;
            let tableRow = `
              <tr>
                <td>
                  <input type="hidden" name="NoGroupItem[]" value="${value.NoGroupItem}">
                  <input type="text" name="GroupItem[]" class="form-control group" width="50%" placeholder="Group Item" style="text-transform: uppercase;" group="${jumlahGroup}" value="${value.NamaGroupItem}" required>
                </td>
                <td>
                  <input type="number" name="NominalGroupItem[]" class="form-control group" placeholder="0" step="1" min="0" group="${jumlahGroup}" value="${value.NominalGroupItem}" required>
                </td>
                <td>
                  <input type="number" name="NominalGroupItemNutuk[]" class="form-control group" placeholder="0" step="1" min="0" group="${jumlahGroup}" value="${value.NominalGroupItemNutuk}" required>
                </td>
                <td>
                  <select multiple class="form-control ${jumlahGroup}" name="GroupItemDetail[${value.NamaGroupItem}][]" group="${jumlahGroup}" required>
                  </select>
                </td>
                <td>
                  <button type="button" onclick="deleterow(this)" class="btn btn-sm btn-danger">
                    <span class="fa fa-trash"></span>
                  </button>
                </td>
              </tr>
            `;
            $('#table-list-group-item tbody').append(tableRow);

            $(`#table-list-group-item tbody select.${jumlahGroup}`).select2({
              width: "100%",
              placeholder: "Pilih item",
              allowClear: true
            });

            $.each(response[0].DataItem, function(idx, val) {
              $(`#table-list-group-item tbody select.${jumlahGroup}`).append(`
                <option value="${val.KodeItem}">${val.NamaItem}</option>
              `);
            });

            let selectValArray = [];
            $.each(value.GroupDetail, function(key, content) {
              selectValArray.push(content.KodeItem);
            });
            $(`#table-list-group-item tbody select.${jumlahGroup}`).val(selectValArray);
            $(`#table-list-group-item tbody select.${jumlahGroup}`).trigger('change');

            $('input[name="JumlahGroupItem"]').attr('value', jumlahGroup);

            $('#table-list-group-item tbody input').on('input', function(e) {
              let noGroup = $(this).attr('group');
              let inputGroup = $(this).val();
              $('select[group="' + noGroup + '"]').attr('name', `GroupItemDetail[${inputGroup}][]`);
            });
          });

          $('#modal-golongan').modal({
            keyboard: false,
            backdrop: "static"
          });

        } else if (response[0].Borongan == 0) {
          $('input[name="NoGolongan"]').attr('value', response[0].NoGolongan);
          $('input[name="NamaGolongan"]').attr('value', response[0].NamaGolongan);
          $('input[name="UangHadir"]').attr('value', response[0].UangHadir);
          // $('input[name="UangLembur"]').attr('value', response[0].UangLembur);
          $('input[name="UangMinggu"]').attr('value', response[0].UangMinggu);

          $.each(response[0].Bonus, function(index, value) {
            let jumlahBonus = parseInt($('input[name="JumlahBonus"]').val());
            jumlahBonus = jumlahBonus + 1;
            let tableRow = `
              <tr>
                <td>
                  <input type="hidden" name="NoBonus[]" value="${value.NoBonus}">
                  <input type="text" name="NamaBonus[]" class="form-control group" placeholder="Nama Bonus" style="text-transform: uppercase;" group="${jumlahBonus}" value="${value.NamaBonus}" required>
                </td>
                <td>
                  <input type="number" name="NominalBonus[]" class="form-control group" placeholder="0" step="1" min="0" group="${jumlahBonus}" value="${value.NominalBonus}" required>
                </td>
                <td>
                  <button type="button" onclick="deleterow(this)" class="btn btn-sm btn-danger">
                    <span class="fa fa-trash"></span>
                  </button>
                </td>
              </tr>
            `;
            $('#table-list-bonus tbody').append(tableRow);
          });

          $.each(response[0].GroupItem, function(index, value) {
            let jumlahGroup = parseInt($('input[name="JumlahGroupItemNon"]').val());
            jumlahGroup = jumlahGroup + 1;
            let tableRow = `
              <tr>
                <td>
                  <input type="hidden" name="NoGroupItem[]" value="${value.NoGroupItem}">
                  <input type="text" name="GroupItem[]" class="form-control group" width="50%" placeholder="Group Item" style="text-transform: uppercase;" group="${jumlahGroup}" value="${value.NamaGroupItem}" required>
                </td>
                <td>
                  <input type="number" name="NominalGroupItem[]" class="form-control group" placeholder="0" step="1" min="0" group="${jumlahGroup}" value="${value.NominalGroupItem}" required>
                </td>
                <td>
                  <select multiple class="form-control ${jumlahGroup}" name="GroupItemDetail[${value.NamaGroupItem}][]" group="${jumlahGroup}" required>
                  </select>
                </td>
                <td>
                  <button type="button" onclick="deleterow(this)" class="btn btn-sm btn-danger">
                    <span class="fa fa-trash"></span>
                  </button>
                </td>
              </tr>
            `;
            $('#table-list-group-item-non tbody').append(tableRow);

            $(`#table-list-group-item-non tbody select.${jumlahGroup}`).select2({
              width: "100%",
              placeholder: "Pilih item",
              allowClear: true
            });

            $.each(response[0].DataItem, function(idx, val) {
              $(`#table-list-group-item-non tbody select.${jumlahGroup}`).append(`
                <option value="${val.KodeItem}">${val.NamaItem}</option>
              `);
            });

            let selectValArray = [];
            $.each(value.GroupDetail, function(key, content) {
              selectValArray.push(content.KodeItem);
            });
            $(`#table-list-group-item-non tbody select.${jumlahGroup}`).val(selectValArray);
            $(`#table-list-group-item-non tbody select.${jumlahGroup}`).trigger('change');

            $('input[name="JumlahGroupItemNon"]').attr('value', jumlahGroup);

            $('#table-list-group-item-non tbody input').on('input', function(e) {
              let noGroup = $(this).attr('group');
              let inputGroup = $(this).val();
              $('select[group="' + noGroup + '"]').attr('name', `GroupItemDetail[${inputGroup}][]`);
            });
          });

          $('#modal-golongan-non').modal({
            keyboard: false,
            backdrop: "static"
          });
        }
      });
    }
    if (jenis == 'borongan') {
      $('#modal-golongan').modal({
        keyboard: false,
        backdrop: "static"
      });
    } else if (jenis == 'non') {
      $('#modal-golongan-non').modal({
        keyboard: false,
        backdrop: "static"
      });
    }
  }

  function addrow(table) {
    var result;
    let jumlahGroup = parseInt($('input[name="JumlahGroupItem"]').val());
    jumlahGroup = jumlahGroup + 1;

    result = `
      <tr>
        <td>
          <input type="text" name="GroupItem[]" class="form-control group" width="50%" placeholder="Group Item" style="text-transform: uppercase;" group="${jumlahGroup}" required>
        </td>
        <td>
          <input type="number" name="NominalGroupItem[]" class="form-control group" placeholder="0" step="1" min="0" group="${jumlahGroup}" required>
        </td>
        <td>
          <input type="number" name="NominalGroupItemNutuk[]" class="form-control group" placeholder="0" step="1" min="0" group="${jumlahGroup}" required>
        </td>
        <td>
          <select multiple class="form-control ${jumlahGroup}" name="" group="${jumlahGroup}" required>
          </select>
        </td>
        <td>
          <button type="button" onclick="deleterow(this)" class="btn btn-sm btn-danger">
            <span class="fa fa-trash"></span>
          </button>
        </td>
      </tr>
    `;

    $('#table-list-group-item tbody').append(result);

    $(`#table-list-group-item tbody select.${jumlahGroup}`).select2({
      width: "100%",
      placeholder: "Pilih item",
      allowClear: true
    });

    $.ajax({
      url: "{{route('api.mastergolongan.item')}}"
    }).done(function(response) {
      $.each(response, function(i, val) {
        $(`#table-list-group-item tbody select.${jumlahGroup}`).append('<option value="' + val.KodeItem + '">' + val.NamaItem + '</option>');
      });
    }).fail(function(error) {
      console.log(error);
    });

    $('input[name="JumlahGroupItem"]').attr('value', jumlahGroup);

    $('#table-list-group-item tbody input[type="text"]').on('input', function(e) {
      let noGroup = $(this).attr('group');
      let inputGroup = $(this).val();
      $('select[group="' + noGroup + '"]').attr('name', `GroupItemDetail[${inputGroup}][]`);
      $('select[group="' + noGroup + '"]').prop('disabled', false);
    });
  }

  function addrow_non(table) {
    var result;
    let jumlahGroup = parseInt($('input[name="JumlahGroupItemNon"]').val());
    jumlahGroup = jumlahGroup + 1;

    result = `
      <tr>
        <td>
          <input type="text" name="GroupItem[]" class="form-control group" width="50%" placeholder="Group Item" style="text-transform: uppercase;" group="${jumlahGroup}" required>
        </td>
        <td>
          <input type="number" name="NominalGroupItem[]" class="form-control group" placeholder="0" step="1" min="0" group="${jumlahGroup}" required>
        </td>
        <td>
          <select multiple class="form-control ${jumlahGroup}" name="" group="${jumlahGroup}" required>
          </select>
        </td>
        <td>
          <button type="button" onclick="deleterow(this)" class="btn btn-sm btn-danger">
            <span class="fa fa-trash"></span>
          </button>
        </td>
      </tr>
    `;

    $('#table-list-group-item-non tbody').append(result);

    $(`#table-list-group-item-non tbody select.${jumlahGroup}`).select2({
      width: "100%",
      placeholder: "Pilih item",
      allowClear: true
    });

    $.ajax({
      url: "{{route('api.mastergolongan.item')}}"
    }).done(function(response) {
      $.each(response, function(i, val) {
        $(`#table-list-group-item-non tbody select.${jumlahGroup}`).append('<option value="' + val.KodeItem + '">' + val.NamaItem + '</option>');
      });
    }).fail(function(error) {
      console.log(error);
    });

    $('input[name="JumlahGroupItemNon"]').attr('value', jumlahGroup);

    $('#table-list-group-item-non tbody input[type="text"]').on('input', function(e) {
      let noGroup = $(this).attr('group');
      let inputGroup = $(this).val();
      $('select[group="' + noGroup + '"]').attr('name', `GroupItemDetail[${inputGroup}][]`);
      $('select[group="' + noGroup + '"]').prop('disabled', false);
    });
  }

  function addrow_bonus(table) {
    var result;
    let jumlahBonus = parseInt($('input[name="JumlahBonus"]').val());
    jumlahBonus = jumlahBonus + 1;

    result = `
      <tr>
        <td>
          <input type="text" name="NamaBonus[]" class="form-control group" placeholder="Nama Bonus" style="text-transform: uppercase;" group="${jumlahBonus}" required>
        </td>
        <td>
          <input type="number" name="NominalBonus[]" class="form-control group" placeholder="0" step="1" min="0" group="${jumlahBonus}" required>
        </td>
        <td>
          <button type="button" onclick="deleterow(this)" class="btn btn-sm btn-danger">
            <span class="fa fa-trash"></span>
          </button>
        </td>
      </tr>
    `;

    $('#table-list-bonus tbody').append(result);

    $('input[name="JumlahBonus"]').attr('value', jumlahBonus);
  }

  function deleterow(row) {
    $(row).closest('tr').remove();
  }
</script>
@endpush