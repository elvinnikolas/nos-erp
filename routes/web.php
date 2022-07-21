<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    //ROUTE MASTER
    // route menu
    Route::resource('/mastergudang', 'MasterGudangController');
    Route::resource('/masterklasifikasi', 'MasterKlasifikasiController');
    Route::resource('/mastersatuan', 'MasterSatuanController');
    Route::resource('/mastermatauang', 'MasterMataUangController');
    Route::resource('/masteritem', 'MasterItemController');
    Route::resource('/masterpelanggan', 'MasterPelangganController');
    Route::resource('/mastersupplier', 'MasterSupplierController');
    Route::resource('/masterkaryawan', 'MasterKaryawanController');
    Route::resource('/mastergolongan', 'MasterGolonganController');
    Route::resource('/masterjabatan', 'MasterJabatanController');
    Route::resource('/masterresep', 'MasterResepController');
    Route::resource('/masterbonus', 'MasterBonusController');

    Route::get('mastergolongan/test', 'MasterGolonganController@test')->name('mastergolongan.test');
    Route::get('api/mastergolongan', 'MasterGolonganController@apiOPN')->name('api.mastergolongan');
    Route::get('api/mastergolongan/item', 'MasterGolonganController@apiItem')->name('api.mastergolongan.item');
    Route::get('api/bonus', 'MasterBonusController@dataBonus')->name('bonus.data');
    Route::get('api/bonus/detail', 'MasterBonusController@dataBonusDetail')->name('bonus.data.detail');

    Route::get('/masteritem/editkonversi/{idItem}/{idSatuan}', 'MasterItemController@editkonversi');

    Route::get('/mastergudang/delete/{id}', 'MasterGudangController@destroy');
    Route::get('/masterklasifikasi/delete/{id}', 'MasterKlasifikasiController@destroy');
    Route::get('/mastersatuan/delete/{id}', 'MasterSatuanController@destroy');
    Route::get('/mastermatauang/delete/{id}', 'MasterMataUangController@destroy');
    Route::get('/masteritem/delete/{id}', 'MasterItemController@destroy');
    Route::get('/masterkaryawan/delete/{id}', 'MasterKaryawanController@destroy');
    Route::get('/masterpelanggan/delete/{id}', 'MasterPelangganController@destroy');
    Route::get('/mastersupplier/delete/{id}', 'MasterSupplierController@destroy');
    Route::get('/mastergolongan/delete/{id}', 'MasterGolonganController@destroy');
    Route::get('/masterjabatan/delete/{id}', 'MasterJabatanController@destroy');
    Route::get('/masterresep/delete/{id}', 'MasterResepController@destroy');
    Route::get('/masterbonus/delete/{id}', 'MasterBonusController@destroy');

    Route::get('/masterkaryawan/print/{id}', 'MasterKaryawanController@print');

    // route API master
    Route::get('api/mastergudang', 'MasterGudangController@apiOPN')->name('api.mastergudang');
    Route::get('api/masterklasifikasi', 'MasterKlasifikasiController@apiOPN')->name('api.masterklasifikasi');
    Route::get('api/mastersatuan', 'MasterSatuanController@apiOPN')->name('api.mastersatuan');
    Route::get('api/mastermatauang', 'MasterMataUangController@apiOPN')->name('api.mastermatauang');
    Route::get('api/masteritem', 'MasterItemController@apiOPN')->name('api.masteritem');
    Route::get('api/masterkaryawan', 'MasterKaryawanController@apiOPN')->name('api.masterkaryawan');
    Route::get('api/masterpelanggan', 'MasterPelangganController@apiOPN')->name('api.masterpelanggan');
    Route::get('api/mastersupplier', 'MasterSupplierController@apiOPN')->name('api.mastersupplier');
    Route::get('api/mastergolongan', 'MasterGolonganController@apiOPN')->name('api.mastergolongan');
    Route::get('api/masterjabatan', 'MasterJabatanController@apiOPN')->name('api.masterjabatan');
    Route::get('api/masterresep', 'MasterResepController@apiOPN')->name('api.masterresep');
    Route::get('api/masterresep/detail', 'MasterResepController@apiDetail')->name('api.masterresep.detail');
    Route::get('api/masterresep/satuan', 'MasterResepController@apiSatuanOPN')->name('api.masterresep.satuan');

    //ROUTE PEMBELIAN
    //route pemesananpembelian
    Route::get('/popembelian', 'PemesananPembelianController@index');
    Route::get('/pokonfirmasi', 'PemesananPembelianController@konfirmasiPembelian');
    Route::get('/poditerima', 'PemesananPembelianController@diterimaPembelian');
    Route::get('/pobatal', 'PemesananPembelianController@batalPembelian');
    Route::get('/pokonfirmasi/filter', 'PemesananPembelianController@konfirmasiPembelianFilter');
    Route::get('/poditerima/filter', 'PemesananPembelianController@diterimaPembelianFilter');
    Route::get('/pobatal/filter', 'PemesananPembelianController@batalPembelianFilter');

    //route PO
    Route::get('/popembelian/cari', 'PemesananPembelianController@filterData');
    Route::post('/popembelian/store', 'PemesananPembelianController@store');
    Route::get('/popembelian/create', 'PemesananPembelianController@create');
    Route::get('/popembelian/show/{id}', 'PemesananPembelianController@show');
    Route::get('/popembelian/lihat/{id}', 'PemesananPembelianController@lihat');
    Route::get('/popembelian/edit/{id}', 'PemesananPembelianController@edit');
    Route::post('/popembelian/update/{id}', 'PemesananPembelianController@update');
    Route::get('/popembelian/destroy/{id}', 'PemesananPembelianController@destroy');
    Route::get('/popembelian/confirm/{id}', 'PemesananPembelianController@confirm');
    Route::post('/popembelian/confirm/{id}', 'PemesananPembelianController@confirm');
    Route::post('/popembelian/cancel/{id}', 'PemesananPembelianController@cancel');
    Route::post('/popembelian/print/{id}', 'PemesananPembelianController@print');

    //route penerimaan barang
    Route::get('/penerimaanBarang', 'PenerimaanBarangController@index');
    Route::get('/penerimaanBarang/cari', 'PenerimaanBarangController@filterData');
    Route::get('/penerimaanBarang/create', 'PenerimaanBarangController@createBySup');
    Route::post('/penerimaanBarang/store/{id}', 'PenerimaanBarangController@store');
    Route::get('/penerimaanBarang/edit/{id}', 'PenerimaanBarangController@edit');
    Route::post('/penerimaanBarang/update/{id}', 'PenerimaanBarangController@update');
    Route::get('/penerimaanBarang/searchpobysupid/{id}', 'PenerimaanBarangController@searchPOBySupId');
    Route::get('/penerimaanBarang/createbasedpo/{id}', 'PenerimaanBarangController@createBasedPO');
    Route::get('/penerimaanBarang/show/{id}', 'PenerimaanBarangController@show');
    Route::get('/penerimaanBarang/lihat/{id}', 'PenerimaanBarangController@lihat');
    Route::get('/penerimaanBarang/destroy/{id}', 'PenerimaanBarangController@destroy');
    Route::get('/penerimaanBarang/confirm/{id}', 'PenerimaanBarangController@confirm');
    Route::post('/penerimaanBarang/confirm/{id}', 'PenerimaanBarangController@confirm');
    Route::post('/penerimaanBarang/cancel/{id}', 'PenerimaanBarangController@cancel');
    Route::post('/penerimaanBarang/print/{id}', 'PenerimaanBarangController@print');
    Route::get('/konfirmasiPenerimaanBarang', 'PenerimaanBarangController@konfirmasiPenerimaanBarang');
    Route::get('/konfirmasiPenerimaanBarang/cari', 'PenerimaanBarangController@filterKonfirmasiPenerimaanBarang');
    Route::get('/batalPenerimaanBarang', 'PenerimaanBarangController@batalPenerimaanBarang');

    //route return penerimaan barang
    Route::get('/returnPenerimaanBarang', 'ReturnPenerimaanBarangController@index');
    Route::get('/returnPenerimaanBarang/cari', 'ReturnPenerimaanBarangController@filterData');
    Route::get('/returnPenerimaanBarang/create/{id}', 'ReturnPenerimaanBarangController@create');
    Route::post('/returnPenerimaanBarang/store/{id}', 'ReturnPenerimaanBarangController@store');
    Route::get('/returnPenerimaanBarang/show/{id}', 'ReturnPenerimaanBarangController@show');
    Route::get('/returnPenerimaanBarang/lihat/{id}', 'ReturnPenerimaanBarangController@lihat');
    Route::post('/returnPenerimaanBarang/print/{id}', 'ReturnPenerimaanBarangController@print');
    Route::post('/returnPenerimaanBarang/confirm/{id}', 'ReturnPenerimaanBarangController@confirm');
    Route::post('/returnPenerimaanBarang/cancel/{id}', 'ReturnPenerimaanBarangController@cancel');
    Route::get('/returnPenerimaanBarang/destroy/{id}', 'ReturnPenerimaanBarangController@destroy');
    Route::get('/konfirmasiReturnPenerimaanBarang', 'ReturnPenerimaanBarangController@konfirmasi');
    Route::get('/konfirmasiReturnPenerimaanBarang/cari', 'ReturnPenerimaanBarangController@filterKonfirmasi');
    Route::get('/batalReturnPenerimaanBarang', 'ReturnPenerimaanBarangController@batal');

    //ROUTE PENJUALAN
    //route pemesananpenjualan
    Route::get('/sopenjualan', 'PemesananPenjualanController@index');
    Route::get('/sopenjualan/cari', 'PemesananPenjualanController@filterData');
    Route::post('/sopenjualan/store', 'PemesananPenjualanController@store');
    Route::get('/sopenjualan/create', 'PemesananPenjualanController@create');
    Route::get('/sopenjualan/show/{id}', 'PemesananPenjualanController@show');
    Route::get('/sopenjualan/lihat/{id}', 'PemesananPenjualanController@lihat');
    Route::get('/sopenjualan/edit/{id}', 'PemesananPenjualanController@edit');
    Route::post('/sopenjualan/update/{id}', 'PemesananPenjualanController@update');
    Route::get('/sopenjualan/destroy/{id}', 'PemesananPenjualanController@destroy');
    Route::get('/sopenjualan/confirm/{id}', 'PemesananPenjualanController@confirm');
    Route::post('/sopenjualan/confirm/{id}', 'PemesananPenjualanController@confirm');
    Route::get('/sopenjualan/cancel/{id}', 'PemesananPenjualanController@cancel');
    Route::get('/sopenjualan/print/{id}', 'PemesananPenjualanController@print');

    Route::get('/konfirmasiPenjualan', 'PemesananPenjualanController@konfirmasiPenjualan');
    Route::get('/batalPenjualan', 'PemesananPenjualanController@batalPenjualan');
    Route::get('/dikirimPenjualan', 'PemesananPenjualanController@dikirimPenjualan');
    Route::get('/konfirmasiPenjualan/filter', 'PemesananPenjualanController@konfirmasiPenjualanFilter');
    Route::get('/batalPenjualan/filter', 'PemesananPenjualanController@batalPenjualanFilter');
    Route::get('/dikirimPenjualan/filter', 'PemesananPenjualanController@dikirimPenjualanFilter');
    Route::post('/konfirmasiPenjualan/print', 'PemesananPenjualanController@konfirmasiPenjualanPrint');

    //route surat jalan
    Route::get('/suratJalan/cari', 'SuratJalanController@filterData');
    Route::get('/suratJalan', 'SuratJalanController@index');
    // Route::get('/suratJalan/create/{id}','SuratJalanController@create');
    Route::post('/suratJalan/store/{id}', 'SuratJalanController@store');
    Route::get('/suratJalan/edit/{id}', 'SuratJalanController@edit');
    Route::post('/suratJalan/update/{id}', 'SuratJalanController@update');
    Route::get('/suratJalan/editKonfirmasi/{id}', 'SuratJalanController@editKonfirmasi');
    Route::post('/suratJalan/updateKonfirmasi/{id}', 'SuratJalanController@updateKonfirmasi');
    Route::get('/suratJalan/create', 'SuratJalanController@createByCust');
    Route::get('/suratJalan/searchsobycustid/{id}', 'SuratJalanController@searchSOByCustId');
    Route::get('/suratJalan/createbasedso/{id}', 'SuratJalanController@createBasedSO');

    Route::get('/suratJalan/show/{id}', 'SuratJalanController@show');
    Route::get('/suratJalan/view/{id}', 'SuratJalanController@view');
    Route::get('/suratJalan/print/{id}', 'SuratJalanController@print');
    Route::get('/suratJalan/confirm/{id}', 'SuratJalanController@confirm');
    Route::post('/suratJalan/confirm/{id}', 'SuratJalanController@confirm');
    Route::get('/konfirmasiSuratJalan/cari', 'SuratJalanController@filterKonfirmasiSuratJalan');
    Route::get('/konfirmasiSuratJalan', 'SuratJalanController@konfirmasiSuratJalan');
    Route::get('/suratJalan/destroy/{id}', 'SuratJalanController@destroy');

    //route return surat jalan
    Route::get('/returnSuratJalan/add/{id}', 'ReturnSuratJalanController@add');
    Route::post('/returnSuratJalan/store/{id}', 'ReturnSuratJalanController@store');
    Route::get('/returnSuratJalan/cari', 'ReturnSuratJalanController@filterData');
    Route::get('/returnSuratJalan', 'ReturnSuratJalanController@index');
    Route::get('/returnSuratJalan/show/{id}', 'ReturnSuratJalanController@show');
    Route::get('/returnSuratJalan/view/{id}', 'ReturnSuratJalanController@view');
    Route::post('/returnSuratJalan/print/{id}', 'ReturnSuratJalanController@print');
    Route::post('/returnSuratJalan/confirm/{id}', 'ReturnSuratJalanController@confirm');
    Route::get('/konfirmasiReturnSuratJalan', 'ReturnSuratJalanController@konfirmasiSuratJalanReturn');
    Route::get('/konfirmasiReturnSuratJalan/cari', 'ReturnSuratJalanController@filterKonfirmasiSuratJalanReturn');
    Route::get('/returnSuratJalan/destroy/{id}', 'ReturnSuratJalanController@destroy');

    //route penjualan langsung
    Route::get('/penjualanLangsung', 'PenjualanLangsungController@index');
    Route::get('/penjualanLangsung/show/{id}', 'PenjualanLangsungController@show');
    Route::get('/penjualanLangsung/create', 'PenjualanLangsungController@create');
    Route::post('/penjualanLangsung/store', 'PenjualanLangsungController@store');

    //route return penjualan langsung
    Route::get('/returnPenjualanLangsung/{id}', 'ReturnPenjualanLangsungController@index');
    Route::post('/returnPenjualanLangsung/{id}/store', 'ReturnPenjualanLangsungController@store');

    //ROUTE STOK
    //route stok masuk
    Route::get('/stokmasuk', 'StokMasukController@index');
    Route::post('/stokmasuk/filter', 'StokMasukController@filter');
    Route::post('/stokmasuk/filterdate', 'StokMasukController@filterdate');
    Route::get('/stokmasuk/create', 'StokMasukController@create');
    Route::get('/stokmasuk/view/{id}', 'StokMasukController@view');
    Route::post('/stokmasuk/store', 'StokMasukController@store');

    //route stok keluar
    Route::get('/stokkeluar', 'StokKeluarController@index');
    Route::post('/stokkeluar/filter', 'StokKeluarController@filter');
    Route::post('/stokkeluar/filterdate', 'StokKeluarController@filterdate');
    Route::get('/stokkeluar/create', 'StokKeluarController@create');
    Route::get('/stokkeluar/view/{id}', 'StokKeluarController@view');
    Route::post('/stokkeluar/store', 'StokKeluarController@store');

    //route sisa stok
    Route::get('/sisastok', 'SisaStokController@index');
    Route::get('/sisastok/show', 'SisaStokController@show');
    Route::post('/sisastok/filter', 'SisaStokController@filter');

    //ROUTE LAPORAN
    //route kartu stok
    Route::get('/kartustok', 'KartuStokController@index');
    Route::get('/kartustok/show', 'KartuStokController@show');
    Route::post('/kartustok/filter', 'KartuStokController@filter');

    //route data stok
    Route::get('/datastok', 'DataStokController@index');
    Route::post('/datastok/show', 'DataStokController@show');
    Route::post('/datastok/filter', 'DataStokController@filter');
    Route::post('/datastok/filterdate', 'DataStokController@filterdate');

    //route buku kas
    Route::get('/bukukasbesar', 'BukuKasBesarController@index');
    Route::get('/bukukasbesar/show', 'BukuKasBesarController@show');
    Route::post('/bukukasbesar/filter', 'BukuKasBesarController@filter');

    Route::get('/bukukaskecil', 'BukuKasKecilController@index');
    Route::get('/bukukaskecil/show', 'BukuKasKecilController@show');
    Route::post('/bukukaskecil/filter', 'BukuKasKecilController@filter');

    //route penjualan
    Route::get('/laporanpenjualan', 'LaporanPenjualanController@index');
    Route::get('/laporanpenjualan/{id}', 'LaporanPenjualanController@show');
    Route::post('/laporanpenjualan/filter', 'LaporanPenjualanController@filter');
    Route::post('/laporanpenjualan/filterdate', 'LaporanPenjualanController@filterdate');

    //route produksi
    Route::get('/laporanproduksi', 'LaporanProduksiController@index');
    Route::post('/laporanproduksi/show', 'LaporanProduksiController@show');
    Route::post('/laporanproduksi/filtergolongan', 'LaporanProduksiController@filtergolongan');
    Route::post('/laporanproduksi/filteritem', 'LaporanProduksiController@filteritem');

    //ROUTE OPERASIONAL
    //route pengeluaran tambahan
    Route::get('/pengeluarantambahan', 'PengeluaranTambahanController@index');
    Route::get('/pengeluarantambahan/create', 'PengeluaranTambahanController@create');
    Route::post('/pengeluarantambahan/store', 'PengeluaranTambahanController@store');
    Route::get('/pengeluarantambahan/edit/{id}', 'PengeluaranTambahanController@edit');
    Route::post('/pengeluarantambahan/update/{id}', 'PengeluaranTambahanController@update');
    Route::get('/pengeluarantambahan/destroy/{id}', 'PengeluaranTambahanController@destroy');

    //route saldo
    Route::get('/saldo', 'SaldoController@index');
    Route::get('/saldo/showkonversi', 'SaldoController@showkonversi');
    Route::get('/saldo/history', 'SaldoController@history');
    Route::post('/saldo/history/filter', 'SaldoController@filter');
    Route::post('/saldo/storekonversi', 'SaldoController@storekonversi');

    //ROUTE HUTANG
    //route pelunasan hutang
    Route::get('/pelunasanhutang', 'PelunasanHutangController@index');
    Route::get('/pelunasanhutang/invoice/{id}', 'PelunasanHutangController@invoice');
    Route::get('/pelunasanhutang/payment/{id}', 'PelunasanHutangController@payment');
    Route::get('/pelunasanhutang/payment/{id}/add', 'PelunasanHutangController@addpayment');
    Route::post('/pelunasanhutang/payment/{id}/add', 'PelunasanHutangController@addpaymentpost');
    Route::get('/pelunasanhutang/payment/{id}/edit', 'PelunasanHutangController@edit');
    Route::post('/pelunasanhutang/payment/{id}/update', 'PelunasanHutangController@update');

    //route invoice hutang
    Route::get('/invoicehutang', 'InvoiceHutangController@hutang');
    Route::post('/invoicehutang/filter', 'InvoiceHutangController@filter');
    Route::get('/invoicehutang/edit/{id}', 'InvoiceHutangController@edit');
    Route::post('/invoicehutang/update/{id}', 'InvoiceHutangController@update');
    Route::get('/invoicehutang/print/{id}', 'InvoiceHutangController@print');
    Route::get('/fixinvoicehutang', 'PenerimaanBarangController@fixInvoiceID');

    //ROUTE PIUTANG
    //route invoice piutang
    Route::get('/invoicepiutang', 'InvoicePiutangController@piutang');
    Route::post('/invoicepiutang/filter', 'InvoicePiutangController@filter');
    Route::get('/invoicepiutang/edit/{id}', 'InvoicePiutangController@edit');
    Route::post('/invoicepiutang/update/{id}', 'InvoicePiutangController@update');
    Route::get('/invoicepiutang/print/{id}', 'InvoicePiutangController@print');
    Route::get('/fixinvoicepiutang', 'SuratJalanController@fixInvoideID');

    //route pelunasan piutang
    Route::get('/pelunasanpiutang', 'PelunasanPiutangController@index');
    Route::get('/pelunasanpiutang/invoice/{id}', 'PelunasanPiutangController@invoice');
    Route::get('/pelunasanpiutang/payment/{id}', 'PelunasanPiutangController@payment');
    Route::get('/pelunasanpiutang/payment/{id}/add', 'PelunasanPiutangController@addpayment');
    Route::post('/pelunasanpiutang/payment/{id}/add', 'PelunasanPiutangController@addpaymentpost');
    Route::get('/pelunasanpiutang/payment/{id}/edit', 'PelunasanPiutangController@edit');
    Route::post('/pelunasanpiutang/payment/{id}/update', 'PelunasanPiutangController@update');

    //route kwitansi piutang
    Route::get('/kwitansipiutang', 'KwitansiPiutangController@index');
    Route::get('/kwitansipiutang/filter', 'KwitansiPiutangController@filter');
    Route::get('/kwitansipiutang/view/{id}', 'KwitansiPiutangController@view');
    Route::get('/kwitansipiutang/create', 'KwitansiPiutangController@create');
    Route::post('/kwitansipiutang/create/kwitansi', 'KwitansiPiutangController@createKwitansi');
    Route::post('/kwitansipiutang/store', 'KwitansiPiutangController@store');
    Route::get('/kwitansipiutang/edit/{id}', 'KwitansiPiutangController@edit');
    Route::post('/kwitansipiutang/update/{id}', 'KwitansiPiutangController@update');
    Route::get('/kwitansipiutang/print/{id}', 'KwitansiPiutangController@print');
    Route::get('/kwitansipiutang/destroy/{id}', 'KwitansiPiutangController@destroy');

    //ROUTE EVENTLOG
    Route::get('/eventlog', 'EventlogController@index');

    //ROUTE USER
    Route::get('/user', 'UserController@index');
    Route::get('/user/add', 'UserController@add');
    Route::post('/user/store', 'UserController@store');
    Route::get('/user/change', 'UserController@change');
    Route::get('/user/reset', 'UserController@reset');
    Route::get('/user/change/{id}', 'UserController@showchange');
    Route::get('/user/reset/{id}', 'UserController@showreset');
    Route::get('/user/destroy/{id}', 'UserController@destroy');

    //ROUTE PAYROLL
    //route absensi
    Route::get('/absensi', 'AbsensiController@index');
    Route::get('/absensi/absen', 'AbsensiController@create');
    Route::post('/absensi/store', 'AbsensiController@store');
    Route::get('/absensi/histori', 'AbsensiController@history');
    Route::get('/absensi/data/{id}', 'AbsensiController@dataAbsen');

    //route gaji
    Route::get('/gaji', 'GajiController@index');
    Route::get('/gaji/create', 'GajiController@create');
    Route::get('/gaji/edit/{id}', 'GajiController@edit');
    Route::get('/gaji/delete/{id}', 'GajiController@destroy');
    Route::post('/gaji/store', 'GajiController@store');
    Route::get('/gaji/show', 'GajiController@show');
    Route::post('/gaji/filter', 'GajiController@filter');
    Route::post('/gaji/update/{id}', 'GajiController@update');
    Route::get('/gaji/filterfilterkaryawanbygolongan/{kode}', 'GajiController@filterByGolongan');
    Route::get('/gaji/searchkaryawanbykode/{kode}', 'GajiController@searchByKode');
    Route::get('/gaji/searchitembykode/{kode}', 'GajiController@searchItemByKode');

    //ROUTE PENGGAJIAN
    Route::get('penggajian', 'PenggajianKaryawanController@index')->name('penggajian');
    Route::post('penggajian/absen', 'PenggajianKaryawanController@absen')->name('penggajian.absen');
    Route::post('penggajian/gaji', 'PenggajianKaryawanController@gaji')->name('penggajian.gaji');
    Route::post('penggajian/laporan', 'PenggajianKaryawanController@laporan')->name('penggajian.laporan');

    //ROUTE PRODUKSI
    //route hasil produksi
    Route::resource('/produksi', 'ProduksiController');
    Route::get('api/produksi', 'ProduksiController@dataProduksi')->name('produksi.data');
    Route::get('api/produksi/detail', 'ProduksiController@dataProduksiDetail')->name('produksi.data.detail');

    //route pemeriksaan produksi
    Route::get('/pemeriksaanproduksi', 'PemeriksaanProduksiController@index');
    Route::get('/pemeriksaanproduksi/create', 'PemeriksaanProduksiController@create');
    Route::get('/pemeriksaanproduksi/select/{id}', 'PemeriksaanProduksiController@select');
    Route::post('/pemeriksaanproduksi/store/{id}', 'PemeriksaanProduksiController@store');
    Route::get('api/pemeriksaanproduksi', 'PemeriksaanProduksiController@dataPemeriksaan')->name('produksi.pemeriksaan.data');
    Route::get('api/pemeriksaanproduksi/detail', 'PemeriksaanProduksiController@dataPemeriksaanDetail')->name('produksi.pemeriksaan.detail');

    //route hutang produksi
    Route::get('/hutangproduksi', 'HutangProduksiController@index');
    Route::get('/hutangproduksi/select', 'HutangProduksiController@select')->name('hutangproduksi.select');
    Route::post('/hutangproduksi/create', 'HutangProduksiController@create');
    Route::post('/hutangproduksi/store', 'HutangProduksiController@store');
    Route::get('/hutangproduksi/show/{id}', 'HutangProduksiController@show');
    Route::get('/hutangproduksi/confirm/{id}', 'HutangProduksiController@confirm');
    Route::get('/hutangproduksi/destroy/{id}', 'HutangProduksiController@destroy');

    //ROUTE MUTASI
    Route::get('/pindahgudang', 'PindahGudangController@index');
    Route::get('/pindahgudang/create', 'PindahGudangController@create');
    Route::get('/pindahgudang/search', 'PindahGudangController@search');
    Route::get('/pindahgudang/edit/{id}', 'PindahGudangController@edit');
    Route::get('/pindahgudang/confirmation/{id}', 'PindahGudangController@confirmation');
    Route::get('/pindahgudang/destroy/{id}', 'PindahGudangController@destroy');
    Route::get('/pindahgudang/look/{id}', 'PindahGudangController@look');
    Route::get('/pindahgudang/print/{id}', 'PindahGudangController@print');
    Route::get('/pindahgudang/createlpb/{id}', 'PindahGudangController@createlpb');
    Route::post('/pindahgudang/confirm/{id}', 'PindahGudangController@confirm');
    Route::post('/pindahgudang/store', 'PindahGudangController@store');
    Route::post('/pindahgudang/update/{id}', 'PindahGudangController@update');
    Route::post('/pindahgudang/storelpb/{id}', 'PindahGudangController@storelpb');
});
