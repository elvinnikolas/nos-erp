<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class golongan extends Model
{
    public static function setGolongan(array $data)
    {
        $noGolongan = empty($data['NoGolongan']) ? 0 : $data['NoGolongan'];
        if ($noGolongan == 0) {
            $noGolongan = DB::table('new_golongan')->insertGetId([
                'NamaGolongan' => strtoupper($data['NamaGolongan']),
                'UangHadir' => $data['UangHadir'],
                'UangHadirHarian' => $data['UangHadirHarian'],
                'UangLembur' => $data['UangLembur'],
                'UangMinggu' => $data['UangMinggu'],
                'Borongan' => 1,
                'modified_at' => \Carbon\Carbon::now()
            ]);

            $kodeGolongan = $noGolongan < 10 ? 'GOL-0' . $noGolongan : 'GOL-' . $noGolongan;
            DB::table('new_golongan')->where('NoGolongan', $noGolongan)->update([
                'KodeGolongan' => $kodeGolongan
            ]);
        } else {
            DB::table('new_golongan')->where('NoGolongan', $data['NoGolongan'])->update([
                'NamaGolongan' => strtoupper($data['NamaGolongan']),
                'UangHadir' => $data['UangHadir'],
                'UangHadirHarian' => $data['UangHadirHarian'],
                'UangLembur' => $data['UangLembur'],
                'UangMinggu' => $data['UangMinggu'],
                'Borongan' => 1,
                'modified_at' => \Carbon\Carbon::now()
            ]);
        }

        if (isset($data['GroupItem'])) {
            $listGroupItem = [];
            foreach ($data['GroupItem'] as $key => $value) {
                if (isset($data['NoGroupItem'][$key])) {
                    $lastId = $data['NoGroupItem'][$key];
                } else {
                    $last_data = DB::select(
                        "SELECT * FROM new_golongangroupitem
                        ORDER BY NoGroupItem desc
                        LIMIT 1"
                    );
                    $lastId = $last_data[0]->NoGroupItem;
                    if (!empty($lastId)) {
                        $lastId = $lastId + 1;
                    } else {
                        $lastId = 1;
                    }
                }

                array_push($listGroupItem, $lastId);

                DB::table('new_golongangroupitem')->updateOrInsert(
                    ['NoGroupItem' => $lastId],
                    [
                        'NamaGroupItem' => $value,
                        'NoGolongan' => $noGolongan,
                        'NominalGroupItem' => $data['NominalGroupItem'][$key],
                        'NominalGroupItemNutuk' => $data['NominalGroupItemNutuk'][$key]
                    ]
                );

                if (isset($data['GroupItemDetail'][$value])) {
                    DB::table('new_golongangroupitemdetail')
                        ->where('NoGroupItem', $lastId)
                        ->delete();

                    foreach ($data['GroupItemDetail'][$value] as $idx => $val) {
                        DB::table('new_golongangroupitemdetail')->insert([
                            'NoGolongan' => $noGolongan,
                            'NoGroupItem' => $lastId,
                            'KodeItem' => $val
                        ]);
                    }
                }
            }

            DB::table('new_golongangroupitem')
                ->where('NoGolongan', $noGolongan)
                ->whereNotIn('NoGroupItem', $listGroupItem)
                ->delete();
        } else {
            DB::table('new_golongangroupitem')
                ->where('NoGolongan', $noGolongan)
                ->delete();
        }

        DB::table('eventlogs')->insert([
            'KodeUser' => Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now()->format('d-m-Y'),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Modif data golongan no: ' . $noGolongan . ' | nama: ' . $data['NamaGolongan'],
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return 'success';
    }

    public static function getGolongan($id = '')
    {
        $result = [];
        if ($id == '') {
            $golongan = DB::table('new_golongan')->where('Status', 'OPN')->get();
        } else {
            $golongan = DB::table('new_golongan')->where('NoGolongan', $id)->get();
        }

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

            $dataItem = [];
            $item = DB::table('items')->where('Status', 'OPN')->select('KodeItem', 'NamaItem')->get();
            foreach ($item as $i) {
                array_push($dataItem, array(
                    'KodeItem' => $i->KodeItem,
                    'NamaItem' => $i->NamaItem
                ));
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
                'DataItem' => $dataItem
            ));
        }

        return $result;
    }

    public static function getListItem()
    {
        $result = DB::table('items')->where('Status', 'OPN')
            ->select('KodeItem', 'NamaItem')
            ->get();

        return $result;
    }

    public static function deleteGolongan($id): void
    {
        DB::table('new_golongan')->where('NoGolongan', $id)->update([
            'Status' => 'DEL',
            'modified_at' => \Carbon\Carbon::now()
        ]);

        // DB::table('new_golongangroupitem')->where('NoGolongan', $id)->delete();
        // DB::table('new_golongangroupitemdetail')->where('NoGolongan', $id)->delete();

        DB::table('eventlogs')->insert([
            'KodeUser' => Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now()->format('d-m-Y'),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Hapus data golongan no: ' . $id,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return;
    }
}
