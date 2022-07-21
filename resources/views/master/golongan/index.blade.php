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

          <button type="button" class="btn btn-success" onclick="showModal(this)" data-action="create">
            <span class="fa fa-plus"></span>&nbsp;Tambah borongan
          </button>
          <br><br>
        </div>
      </div>
      <div class="x_panel">
        <div class="x_body">
          <table class="table table-striped" id="table-golongan">
            {{--<input type="hidden" name="JumlahDataGolongan" value="{{$last}}">--}}
            <thead class="thead-light">
              <tr>
                <th>Kode Golongan</th>
                <th>Nama Golongan</th>
                <th>Uang Hadir</th>
                <th>Uang Lembur</th>
                <th>Uang Minggu</th>
                <th width="20%"></th>
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
        <h4 class="modal-title">Data golongan</h4>
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
                <label>Hadir</label>
                <input type="number" name="UangHadir" class="form-control" step="1" min="0" placeholder="0" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Hadir (Harian Tidak Lengkap)</label>
                <input type="number" name="UangHadirHarian" class="form-control" step="1" min="0" placeholder="0" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Lembur (Jam)</label>
                <input type="number" name="UangLembur" class="form-control" step="1" min="0" placeholder="0" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Lembur (Minggu)</label>
                <input type="number" name="UangMinggu" class="form-control" step="1" min="0" placeholder="0" required>
              </div>
            </div>
          </div>
          <hr>
          <div class="row col-md-12">
            <button type="button" class="btn btn-sm btn-primary pull-right" onclick="addrow()">
              <span class="fa fa-plus"></span>
            </button>
            <h5>Group Item</h5>
            <input type="hidden" name="JumlahGroupItem" value="0">
            <table id="table-list-group-item" class="table table-bordered">
              <thead>
                <tr>
                  <th width="20%">Nama Group</th>
                  <th width="10%">Nominal</th>
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
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><span></span>&nbsp;Simpan</button>
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
      columnDefs: [{
        targets: 5,
        orderable: false,
        searchable: false,
        render: (data) => {
          return `
          <button type="button" class="btn btn-sm btn-warning" onclick="showModal(this)" data-action="update" data-id=${data}>
            <span class="fa fa-pencil"></span>&nbsp;Ubah
          </button>
          &nbsp;&nbsp;
          <form action="{{ url('mastergolongan/${data}') }}" method="post" onsubmit="return showConfirm()" style="display: inline;">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-danger">
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
          data: "UangHadir"
        },
        {
          data: "UangLembur"
        },
        {
          data: "UangMinggu"
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

  $('button[type="submit"]').on('click', function() {
    $(this).prop('disabled', true);
    $('#form-golongan').submit();
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

  function showConfirm() {
    if (confirm("HAPUS data berikut?")) {
      return true;
    } else {
      return false;
    }
  }

  function showModal(element) {
    let action = $(element).data('action');
    if (action == 'create') {
      $('#table-list-group-item tbody').empty();
      /*let jumlahGolongan = parseInt($('input[name="JumlahDataGolongan"]').val());
      jumlahGolongan = jumlahGolongan  + 1;
      $('input[name="NoGolongan"]').attr('value', jumlahGolongan);*/
    } else if (action == 'update') {
      $('#table-list-group-item tbody').empty();
      let id = $(element).data('id');
      $.ajax({
        url: "{{route('api.mastergolongan')}}",
        data: {
          "id": id
        }
      }).then(function(response) {
        $('input[name="NoGolongan"]').attr('value', response[0].NoGolongan);
        $('input[name="NamaGolongan"]').attr('value', response[0].NamaGolongan);
        $('input[name="UangHadir"]').attr('value', response[0].UangHadir);
        $('input[name="UangHadirHarian"]').attr('value', response[0].UangHadirHarian);
        $('input[name="UangLembur"]').attr('value', response[0].UangLembur);
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
      });
    }

    $('#modal-golongan').modal({
      keyboard: false,
      backdrop: "static"
    });
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

  function deleterow(row) {
    $(row).closest('tr').remove();
  }
</script>
@endpush