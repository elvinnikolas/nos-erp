@extends('home')
@section('content')
<style>
  .btn {
    background-color: DodgerBlue;
    border: none;
    color: white;
    padding: 12px 16px;
    font-size: 16px;
    cursor: pointer;
  }
  
  /* Darker background on mouse-over */
  .btn:hover {
    background-color: RoyalBlue;
  }
  </style>
  <div class="card">
      <div class="card-header">
          <form >
          <!-- <button class="btn btn-success">
              <i class="fas fa-plus">&nbsp;&nbsp;Tambah Data P.O</i>
          </button> -->

          <!-- Contents -->
          <br>
          <div class="form-row">
              <!-- column 1 -->
              <div class="form-group col-md-3">
                <div class="form-group">
                  <label for="inputRSJ">Nomor Return Surat Jalan</label>
                  <select class="form-control" id="inputRSJ">
                    <option>RSJ-150700005</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputDate">Tanggal</label>
                  <input type="date" class="form-control" id="inputDate1" value="2015-11-07" disabled>
                </div>
              </div>
              <!-- pembatas -->
              <div class="form-group col-md-1"></div>
              <!-- column 2 -->
              <div class="form-group col-md-4">
                <div class="form-group">
                  <label for="inputGudang">Gudang</label>
                  <select class="form-control" id="inputGudang" disabled>
                    <option>Toko Widodo</option>
                    <option>Toko Dennis</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputCustomer">Customer</label>
                  <select class="form-control" id="inputCustomer" disabled>
                    <option>Musdalifah</option>
                    <option>Sumarni</option>
                  </select>
                </div>
              </div>
              <!-- pembatas -->
              <div class="form-group col-md-1"></div>
              <!-- column 3 -->
              <div class="form-group col-md-3">
                <label for="inputKeterangan">Keterangan</label>
                <textarea class="form-control" id="inputKeterangan" rows="5"></textarea>
              </div>
          </div>
          <hr class="style1">
          <div class="form-row">
            <table class="table table-bordered">
              <thead>
                  <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Nama Barang</th>
                      <th scope="col">Jumlah</th>
                      <th scope="col">Keterangan</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <th>1</th>
                      <td>Besi</td>
                      <td>10</td>
                      <td></td>

                  </tr>
                  <tr>
                      <th>2</th>
                      <td>Baja</td>
                      <td>20</td>
                      <td> </td>

                  </tr>
                  <tr>
                      <td>3</td>
                      <td>Kayu</td>
                      <td>30</td>
                      <td> </td>

                  </tr>
              </tbody>
          </table>
          </div>
          <div class="form-row">
            <div class="form-group col-md-1"></div>
            <div class="form-group col-md-3">
              <br>
              <button type="button" class="btn btn-success">&nbsp;&nbsp;Konfirmasi&nbsp;&nbsp;</button>
            </div>
            <div class="form-group col-md-4"></div>
            <div class="form-group col-md-3">
              <div class="form-group">
                <br>
              <button type="button" class="btn btn-success">&nbsp;&nbsp;Cetak&nbsp;&nbsp;</button>
              </div>
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
@endsection