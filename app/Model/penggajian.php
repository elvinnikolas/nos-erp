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
      'NoGolongan' => $data['Golongan'],
      'TotalGaji' => array_sum($data['Subtotal']),
      'TanggalGaji' => $tanggalGaji,
      'modified_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
    ]);

    $group = DB::table('new_golongangroupitem')
      ->where('NoGolongan', $data['Golongan'])
      ->get();

    $bonus = DB::table('new_golonganbonus')
      ->where('NoGolongan', $data['Golongan'])
      ->get();

    //karyawan borongan
    if ($data['Borongan'] == 1) {
      foreach ($data['Karyawan'] as $key => $value) {
        $id_karyawan = DB::table('new_gajiandetailkaryawan')->insertGetId([
          'NoGajian' => $idGaji,
          'KodeKaryawan' => $value,
          'AbsenLengkap' => isset($data['Hadir'][$key]) ? $data['Hadir'][$key] : 0,
          'AbsenTidakLengkap' => isset($data['HadirHarian'][$key]) ? $data['HadirHarian'][$key] : 0,
          'AbsenHarian' => isset($data['Harian'][$key]) ? $data['Harian'][$key] : 0,
          'LemburJam' => isset($data['Jam'][$key]) ? $data['Jam'][$key] : 0,
          'LemburMinggu' => isset($data['Minggu'][$key]) ? $data['Minggu'][$key] : 0,
          'Bonus' => isset($data['Bonus'][$key]) ? $data['Bonus'][$key] : 0,
          'BonusLain' => isset($data['BonusLain'][$key]) ? $data['BonusLain'][$key] : 0,
          'Hutang' => isset($data['Hutang'][$key]) ? $data['Hutang'][$key] : 0,
          'Status' => 'OPN',
          'modified_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);

        foreach ($group as $k => $kode) {
          if ($data['Produksi'][$kode->NoGroupItem][$key] > 0) {
            DB::table('new_gajiandetailproduksi')->insert([
              'NoGajianDetailKaryawan' => $id_karyawan,
              'KodeGolongan' => $kode->NoGroupItem,
              'Jenis' => 'Packing',
              'JumlahProduksi' => $data['Produksi'][$kode->NoGroupItem][$key],
              'modified_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
            ]);
          }
          if ($data['ProduksiNutuk'][$kode->NoGroupItem][$key] > 0) {
            DB::table('new_gajiandetailproduksi')->insert([
              'NoGajianDetailKaryawan' => $id_karyawan,
              'KodeGolongan' => $kode->NoGroupItem,
              'Jenis' => 'Nutuk',
              'JumlahProduksi' => $data['ProduksiNutuk'][$kode->NoGroupItem][$key],
              'modified_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
            ]);
          }
        }
      }
      //karyawan non borongan
    } else if ($data['Borongan'] == 0) {
      foreach ($data['Karyawan'] as $key => $value) {
        $id_karyawan = DB::table('new_gajiandetailkaryawan')->insertGetId([
          'NoGajian' => $idGaji,
          'KodeKaryawan' => $value,
          'AbsenLengkap' => isset($data['Hadir'][$key]) ? $data['Hadir'][$key] : 0,
          'AbsenTidakLengkap' => 0,
          'AbsenHarian' => 0,
          'LemburJam' => isset($data['Jam'][$key]) ? $data['Jam'][$key] : 0,
          'LemburMinggu' => isset($data['Minggu'][$key]) ? $data['Minggu'][$key] : 0,
          'Bonus' => 0,
          'BonusLain' => isset($data['BonusLain'][$key]) ? $data['BonusLain'][$key] : 0,
          'Hutang' => 0,
          'Status' => 'OPN',
          'modified_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);

        foreach ($group as $k => $kode) {
          if ($data['Produksi'][$kode->NoGroupItem][$key] > 0) {
            DB::table('new_gajiandetailproduksi')->insert([
              'NoGajianDetailKaryawan' => $id_karyawan,
              'KodeGolongan' => $kode->NoGroupItem,
              'Jenis' => 'Produksi',
              'JumlahProduksi' => $data['Produksi'][$kode->NoGroupItem][$key],
              'modified_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
            ]);
          }
        }

        foreach ($bonus as $b => $kode) {
          if ($data['Bonus'][$kode->NoBonus][$key] > 0) {
            DB::table('new_gajiandetailbonus')->insert([
              'NoGajianDetailKaryawan' => $id_karyawan,
              'KodeGolongan' => $kode->NoGolongan,
              'KodeBonus' => $kode->NoBonus,
              'JumlahBonus' => $data['Bonus'][$kode->NoBonus][$key],
              'modified_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
            ]);
          }
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
      ])->select('KodeKaryawan', 'Nama', 'GajiPokok', 'LemburJam')->get();

      $hutang = DB::select(
        "SELECT phd.KodeKaryawan, SUM(phd.Total) as Total FROM prod_hutangdetail phd
        JOIN prod_hutangheader ph ON ph.id = phd.IDHutang
        WHERE ph.Status = 'OPN'
        GROUP BY phd.KodeKaryawan"
      );

      foreach ($karyawan as $k) {
        $hutangKaryawan = null;
        if ($hutang) {
          foreach ($hutang as $h) {
            if ($h->KodeKaryawan == $k->KodeKaryawan) {
              $hutangKaryawan = $h->Total;
            }
          }
        }
        if ($hutangKaryawan) {
          array_push($dataKaryawan, array(
            'KodeKaryawan' => $k->KodeKaryawan,
            'NamaKaryawan' => $k->Nama,
            'Hutang' => $hutangKaryawan,
            'GajiPokok' => $k->GajiPokok,
            'LemburJam' => $k->LemburJam
          ));
        } else {
          array_push($dataKaryawan, array(
            'KodeKaryawan' => $k->KodeKaryawan,
            'NamaKaryawan' => $k->Nama,
            'Hutang' => 0,
            'GajiPokok' => $k->GajiPokok,
            'LemburJam' => $k->LemburJam
          ));
        }
      }

      $dataBonus = [];
      $bonus = DB::table('new_golonganbonus')->where([
        ['NoGolongan', '=', $gol->NoGolongan]
      ])->select('NoBonus', 'NamaBonus', 'NominalBonus')->get();

      if ($bonus) {
        foreach ($bonus as $b) {
          array_push($dataBonus, array(
            'NoBonus' => $b->NoBonus,
            'NamaBonus' => $b->NamaBonus,
            'NominalBonus' => $b->NominalBonus
          ));
        }
      }

      array_push($result, array(
        'NoGolongan' => $gol->NoGolongan,
        'KodeGolongan' => $gol->KodeGolongan,
        'NamaGolongan' => $gol->NamaGolongan,
        'UangHadir' => $gol->UangHadir,
        'UangHadirHarian' => $gol->UangHadirHarian,
        'UangLembur' => $gol->UangLembur,
        'UangMinggu' => $gol->UangMinggu,
        'Borongan' => $gol->Borongan,
        'GroupItem' => $dataGroup,
        'DataKaryawan' => $dataKaryawan,
        'DataBonus' => $dataBonus
      ));
    }

    return $result;
  }
}
