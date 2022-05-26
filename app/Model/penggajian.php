<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use Datatables;

class penggajian extends Model
{
  public static function setAbsen(array $data)
  {
    if (!isset($data['KodeKaryawan']) || empty($data['KodeKaryawan'])) {
      return 'failed';
    } else {
      $tanggal = date_format(date_create($data['TanggalAbsen']), 'Y-m-d');
      DB::table('new_absenkaryawan')->where('TanggalAbsen', $tanggal)->delete();
      foreach ($data['KodeKaryawan'] as $key => $value) {
        DB::table('new_absenkaryawan')->insert([
          'KodeKaryawan' => $value,
          'TanggalAbsen' => $tanggal
        ]);
      }

      return 'success';
    }
  }

  public static function setGaji(array $data)
  {
    $tanggalGaji = date_format(date_create($data['TanggalGaji']), 'Y-m-d');
    $kodeGaji = 'GJ' . date_format(date_create($data['TanggalGaji']), 'Ymd') . $data['Golongan'];
    $idGaji = DB::table('new_gajian')->insertGetId([
      'KodeGaji' => $kodeGaji,
      'TanggalGaji' => $tanggalGaji,
      'NoGolongan' => $data['Golongan'],
      'TotalGaji' => array_sum($data['Subtotal']),
      'modified_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
    ]);

    $group = DB::table('new_golongangroupitem')
      ->where('NoGolongan', $data['Golongan'])
      ->get();

    foreach ($data['Karyawan'] as $key => $value) {
      $id_karyawan = DB::table('new_gajiandetailkaryawan')->insertGetId([
        'NoGajian' => $idGaji,
        'KodeKaryawan' => $value,
        'Nutuk' => isset($data['Nutuk'][$key]) ? 1 : 0,
        'AbsenMasuk' => $data['Hadir'][$key],
        'LemburHarian' => $data['Harian'][$key],
        'LemburJam' => isset($data['Harian'][$key]) ? $data['Harian'][$key] : 0,
        'LemburMinggu' => isset($data['Minggu'][$key]) ? $data['Minggu'][$key] : 0,
        'Bonus' => isset($data['Bonus'][$key]) ? $data['Bonus'][$key] : 0,
        'Hutang' => isset($data['Hutang'][$key]) ? $data['Hutang'][$key] : 0,
        'modified_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
      ]);

      foreach ($group as $k => $kode) {
        if ($data['Produksi'][$kode->NoGroupItem][$key] > 0) {
          DB::table('new_gajiandetailproduksi')->insert([
            'NoGajianDetailKaryawan' => $id_karyawan,
            'KodeItem' => $kode->NoGroupItem,
            'JumlahProduksi' => $data['Produksi'][$kode->NoGroupItem][$key],
            'modified_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
          ]);
        }
      }
    }

    return 'success';
  }

  public static function getDataGolongan()
  {
    $result = [];
    $golongan = DB::table('new_golongan')->where('Status', 'OPN')->get();

    foreach ($golongan as $gol) {
      $dataGroup = [];
      $group = DB::table('new_golongangroupitem')
        ->where('NoGolongan', $gol->NoGolongan)
        ->get();

      foreach ($group as $gr) {
        $groupDetail = DB::table('new_golongangroupitemdetail')
          ->join('items', 'new_golongangroupitemdetail.KodeItem', '=', 'items.KodeItem')
          ->where('NoGroupItem', $gr->NoGroupItem)
          ->select(
            'items.KodeItem',
            'items.NamaItem'
          )
          ->get();

        $dataGroupDetail = [];
        foreach ($groupDetail as $grd) {
          array_push($dataGroupDetail, array(
            'KodeItem' => $grd->KodeItem,
            'NamaItem' => $grd->NamaItem
          ));
        }

        array_push($dataGroup, array(
          'NoGroupItem' => $gr->NoGroupItem,
          'NamaGroupItem' => $gr->NamaGroupItem,
          'NominalGroupItem' => $gr->NominalGroupItem,
          'NominalGroupItemNutuk' => $gr->NominalGroupItemNutuk,
          'GroupDetail' => $dataGroupDetail
        ));
      }

      $dataKaryawan = [];
      $karyawan = DB::table('karyawans')->where([
        ['Status', '=', 'OPN'],
        ['KodeGolongan', '=', $gol->KodeGolongan]
      ])->select('KodeKaryawan', 'Nama')->get();
      foreach ($karyawan as $k) {
        array_push($dataKaryawan, array(
          'KodeKaryawan' => $k->KodeKaryawan,
          'NamaKaryawan' => $k->Nama
        ));
      }

      array_push($result, array(
        'NoGolongan' => $gol->NoGolongan,
        'KodeGolongan' => $gol->KodeGolongan,
        'NamaGolongan' => $gol->NamaGolongan,
        'UangHadir' => $gol->UangHadir,
        'UangLembur' => $gol->UangLembur,
        'UangMinggu' => $gol->UangMinggu,
        'Borongan' => $gol->Borongan,
        'GroupItem' => $dataGroup,
        'DataKaryawan' => $dataKaryawan
      ));
    }

    return $result;
  }
}
