<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;

class PenggajianController extends Controller
{
    public function index()
    {
    	$list_golongan = DB::table('golongans')
            ->where('Status','OPN')
            ->get();
    	// return view('penggajian.index2', compact('list_golongan'));
        return view('penggajian.index', compact('list_golongan'));
    }

    /*fungsi-fungsi untuk absen*/
    public function absensi()
    {
        $daftarGolongan     = DB::table('golongans')
                            ->select('KodeGolongan', 'NamaGolongan')
                            ->where('Status', 'OPN')
                            ->get();
        return view('penggajian.absensi', compact('daftarGolongan'));
    }

    public function absensiSimpan(Request $request) {
    	$awal       = date_format(date_create($request->tanggalAbsen1), 'Y-m-d');
        $akhir      = date_format(date_create($request->tanggalAbsen2), 'Y-m-d');
        $status     = $request->statusAbsen;
        $jumlah     = $request->jumlahKaryawan;
        $karyawan   = $request->kodeKaryawan;
        $namaGolongan   = $request->namaGolongan;
        
        foreach ($karyawan as $key => $value) {
            $tgl1   = strtotime($awal);
            $tgl2   = strtotime($akhir);
            $x = 0;
            if ($tgl1 == $tgl2) {
                DB::table('absensis')
                ->updateOrInsert([
                    "KodeKaryawan"      => $karyawan[$key],
                    "TanggalAbsen"      => date('Y-m-d', $tgl2),
                ], [
                    "StatusAbsen"       => $status[$key][$x],
                    "created_at"        => date('Y-m-d H:i:s'),
                ]);
            } else {
                while ($tgl1 <= $tgl2) {
                    DB::table('absensis')
                    ->updateOrInsert([
                        "KodeKaryawan"      => $karyawan[$key],
                        "TanggalAbsen"      => date('Y-m-d', $tgl1),
                    ], [
                        "StatusAbsen"       => $status[$key][$x],
                        "created_at"        => date('Y-m-d H:i:s'),
                    ]);
                    $tgl1 = strtotime("+1 day", $tgl1);
                    $x++;
                }
            }
        }

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Absensi tanggal ' . $awal . ' s/d ' . $akhir . ' golongan ' . $namaGolongan,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

    	return redirect('/penggajian')->with(['created' => 'Absensi tanggal ' . $awal . ' s/d ' . $akhir . ' golongan ' . $namaGolongan.' berhasil diinput']);
    }

    /*fungsi-fungsi untuk gaji*/
    public function gaji() {
    	$daftarGolongan 	= DB::table('golongans')->where('Status', 'OPN')->get();
    	// return view('penggajian.gaji', compact('daftarGolongan'));
        return view('penggajian.gaji', compact('daftarGolongan'));
    }

    public function gajiSimpan(Request $request) {
        $kodeKaryawan           = $request->kodeKaryawan;
        $gajiKaryawan           = $request->gajiKaryawan;
        $jumlahHariKerja        = $request->jumlahHariKerja;
        $subtotalGaji           = $request->subtotalGaji;
        $lemburHarian           = $request->lemburHarian;
        $jumlahLemburHarian     = $request->jumlahLemburHarian;
        $subtotalLemburHarian   = $request->subtotalLemburHarian;
        $subtotalLemburMinggu   = $request->subtotalLemburMinggu;
        $lemburJam              = $request->lemburJam;
        $jumlahLemburJam        = $request->jumlahLemburJam;
        $subtotalLemburJam      = $request->subtotalLemburJam;
        $subtotalHargaBarang    = $request->subtotalHargaBarang;
        $bonus                  = $request->bonus;
        $jumlahBonus            = $request->jumlahBonus;
        $subtotalBonus          = $request->subtotalBonus;
        $totalGaji              = $request->totalGaji;
        
        $jumlahBarang           = $request->jumlahBarang;
        $kodeBarang             = $request->kodeBarang;
        $hargaBarang            = $request->hargaBarang;
        for ($i=0; $i < $jumlahBarang; $i++) { 
            $barangKaryawan[$i] = $request->barangKaryawan[$i+1];
        }

        foreach ($kodeKaryawan as $key => $value) {
            DB::table('gajians')
            ->updateOrInsert([
                'KodeGaji'                  => 'GAJI'.str_replace('-', '', $request->tanggalGaji).'-'.substr($kodeKaryawan[$key], -3),
                'TanggalGaji'               => date('Y-m-d', strtotime($request->tanggalGaji)),
            ], [
                'KodeKaryawan'              => $kodeKaryawan[$key],
                'SubtotalGaji'              => $subtotalGaji[$key],
                'SubtotalLemburHarian'      => $subtotalLemburHarian[$key],
                'SubtotalLemburJam'         => $subtotalLemburJam[$key],
                'SubtotalLemburMinggu'      => $subtotalLemburMinggu[$key],
                'SubtotalBonus'             => $subtotalBonus[$key],
                'SubtotalHargaBarang'       => $subtotalHargaBarang[$key],
                'TotalGaji'                 => $totalGaji[$key],
                'Status'                    => 'OPN',
                'EnkripsiKodeGaji'          => md5('GAJI'.str_replace('-', '', $request->tanggalGaji).'-'.substr($kodeKaryawan[$key], -3)),
                'updated_at'                => date('Y-m-d H:i:s'),
            ]);

            for ($i=0; $i < $jumlahBarang; $i++) { 
                DB::table('detailgajians')
                ->updateOrInsert([
                    'KodeGaji'                  => 'GAJI'.str_replace('-', '', $request->tanggalGaji).'-'.substr($kodeKaryawan[$key], -3),
                    'KodeBarang'                => $kodeBarang[$i],
                ], [
                    'HargaBarang'               => $hargaBarang[$i],
                    'JumlahBarang'              => $barangKaryawan[$i][$key],
                    'SubtotalHargaBarang'       => (int)$hargaBarang[$i] * (int)$barangKaryawan[$i][$key],
                    'EnkripsiKodeGaji'          => md5('GAJI'.str_replace('-', '', $request->tanggalGaji).'-'.substr($kodeKaryawan[$key], -3)),
                    'updated_at'                => date('Y-m-d H:i:s'),
                ]);
            }

            DB::table('tambahangajians')
            ->updateOrInsert([
                'KodeGaji'                  => 'GAJI'.str_replace('-', '', $request->tanggalGaji).'-'.substr($kodeKaryawan[$key], -3),
            ], [
                'Gaji'                      => $gajiKaryawan[$key],
                'JumlahHariKerja'           => $jumlahHariKerja[$key],
                'LemburHarian'              => $lemburHarian[$key],
                'JumlahLemburHarian'        => $jumlahLemburHarian[$key],
                'LemburJam'                 => $lemburJam[$key],
                'JumlahLemburJam'           => $jumlahLemburJam[$key],
                'Bonus'                     => $bonus[$key],
                'JumlahBonus'               => $jumlahBonus[$key],
                'EnkripsiKodeGaji'          => md5('GAJI'.str_replace('-', '', $request->tanggalGaji).'-'.substr($kodeKaryawan[$key], -3)),
                'updated_at'                => date('Y-m-d H:i:s'),
            ]);
        }

        DB::table('eventlogs')->insert([
            'KodeUser' => \Auth::user()->name,
            'Tanggal' => \Carbon\Carbon::now(),
            'Jam' => \Carbon\Carbon::now()->format('H:i:s'),
            'Keterangan' => 'Gaji tanggal ' . $request->tanggalGaji . ' untuk golongan ' . $request->golonganKaryawan,
            'Tipe' => 'OPN',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect('/penggajian')->with(['created' => 'Gaji tanggal ' . $request->tanggalGaji . ' untuk golongan ' . $request->golonganKaryawan . ' berhasil dibuat']);
    }

    /*fungsi ambil data karyawan berdasarkan golongan*/
    public function apiKaryawan($golongan, $tanggalGaji) {
        $tanggal    = date_format(date_create($tanggalGaji), 'Y-m-d');
        $karyawanAbsen   = DB::table('karyawans')
            ->selectRaw('*, count(absensis.StatusAbsen) as JumlahAbsen')
            ->join('golongans', function($join) {
                $join->on('karyawans.KodeGolongan', '=', 'golongans.KodeGolongan');
            })
            ->join('absensis', function($join) {
                $join->on('karyawans.KodeKaryawan', '=', 'absensis.KodeKaryawan');
            })
            ->where('karyawans.KodeGolongan', $golongan)
            ->where('karyawans.Status', 'OPN')
            ->where('absensis.StatusAbsen', '1')
            ->whereRaw('absensis.TanggalAbsen BETWEEN (SELECT DATE_SUB("'.$tanggal.'", INTERVAL (DAYOFWEEK("'.$tanggal.'")-1) DAY)) AND "'.$tanggal.'"')
            ->groupBy('karyawans.KodeKaryawan')
            ->orderBy('karyawans.Nama', 'ASC')
            ->get();

        $karyawanNonAbsen = DB::table('karyawans')
            ->join('golongans', function($join) {
                $join->on('karyawans.KodeGolongan', '=', 'golongans.KodeGolongan');
            })
            ->where('karyawans.KodeGolongan', $golongan)
            ->where('karyawans.Status', 'OPN')
            ->orderBy('karyawans.Nama', 'ASC')
            ->get();
        
    	$resultAbsen 		= json_decode($karyawanAbsen);
        $resultNonAbsen     = json_decode($karyawanNonAbsen);
    	if ($resultAbsen != null) { return response()->json($resultAbsen); }
    	else { return response()->json($resultNonAbsen); }
    }

    // public function apiGaji($kodeKaryawan, $tanggalGaji) {
    //     $tanggal = date_format(date_create($tanggalGaji), 'Y-m-d');
    //     $karyawan           = DB::table('karyawans')
    //         ->selectRaw('*, count(absensis.StatusAbsen) as JumlahAbsen')
    //         ->join('golongans', function($join) {
    //             $join->on('karyawans.KodeGolongan', '=', 'golongans.KodeGolongan');
    //         })
    //         ->join('absensis', function($join) {
    //             $join->on('karyawans.KodeKaryawan', '=', 'absensis.KodeKaryawan');
    //         })
    //         ->where('karyawans.KodeKaryawan', $kodeKaryawan)
    //         ->where('karyawans.Status', 'OPN')
    //         ->where('absensis.StatusAbsen', '1')
    //         ->whereRaw('absensis.TanggalAbsen BETWEEN (SELECT DATE_SUB("'.$tanggal.'", INTERVAL (DAYOFWEEK("'.$tanggal.'")-1) DAY)) AND "'.$tanggal.'"')
    //         ->groupBy('karyawans.KodeKaryawan')
    //         ->get();

    //     $result         = json_decode($karyawan);
    //     if ($result != null) { return response()->json($result); }
    //     else { return response()->json([]); }
    // }

    /*fungsi ambil daftar barang berdasarkan golongan*/
    public function apiBarang($kodeGolongan) {
    	$barang 			= DB::table('detailgolongans')
            ->select('KodeGolItem', 'NamaGolItem', 'HargaGolItem')
    		->where('KodeGolongan', $kodeGolongan)
    		->get();

    	$barang 		= json_decode($barang);
    	if ($barang != null) { return response()->json($barang); }
    	else { return response()->json([]); }
    }

    /*fungsi ambil data absen saat Tanggal Absen diubah*/
    public function apiAbsen($tanggal1, $tanggal2, $golongan) {
        $karyawans = DB::table('karyawans')
                    ->select('KodeKaryawan', 'Nama')
                    ->where('KodeGolongan', $golongan)
                    ->where('Status', 'OPN')
                    ->orderBy('karyawans.Nama', 'ASC')
                    ->get();
        
        $htmlabsen = '';
        $htmlabsen = $htmlabsen
                    .'<tr>'
                    .'<th id="header">No</th>'
                    .'<th id="header">Nama</th>';

        $tanggal1   = date_format(date_create($tanggal1),"d-m-Y");
        $tanggal2   = date_format(date_create($tanggal2),"d-m-Y");
        $tgl1   = strtotime($tanggal1);
        $tgl2   = strtotime($tanggal2);
        if ($tgl1 == $tgl2) {
            $htmlabsen = $htmlabsen
                        .'<th id="header">'.date('d-m-Y', $tgl2).'</th>';
        }
        else {
            while ($tgl1 <= $tgl2) {
                $htmlabsen = $htmlabsen
                            .'<th id="header">'.date('d-m-Y', $tgl1).'</th>';
                $tgl1 = strtotime("+1 day", $tgl1);
            }
        }
        
        $htmlabsen = $htmlabsen
                    .'<th id="header"><input type="checkbox" id="semuaMasuk"> Masuk Semua?</th>'
                    .'</tr>';

        $nomor = 0;
        foreach ($karyawans as $key => $value) {
            $tgl1   = strtotime($tanggal1);
            $tgl2   = strtotime($tanggal2);
            $nomor++;
            $htmlabsen = $htmlabsen
                    .'<tr>'
                    .'<td>'.$nomor.'</td>'
                    .'<td>'.$value->Nama.'<input type="hidden" name="kodeKaryawan[]" value="'.$value->KodeKaryawan.'" id="karyawan'.$nomor.'"></td>';

            $noabsen = 0;
            if ($tgl1 == $tgl2) {
                $noabsen++;
                $htmlabsen = $htmlabsen
                            .'<td>'
                            .'<div class="form-inline">'
                            .'<input type="hidden" class="statusAbsen '.$value->KodeKaryawan.' '.$nomor.'" name="statusAbsen['.$key.'][]" value="0" tanggal="'.date('d-m-Y', $tgl2).'">'
                            .'<input type="checkbox" class="statusAbsen '.$value->KodeKaryawan.' '.$nomor.'" id="'.$nomor.'_'.$noabsen.'" value="0">'
                            .'</div>'
                            .'</td>';
            }
            else {
                while ($tgl1 <= $tgl2) {
                    $noabsen++;
                    $htmlabsen = $htmlabsen
                                .'<td>'
                                .'<div class="form-inline">'
                                .'<input type="hidden" class="statusAbsen '.$value->KodeKaryawan.' '.$nomor.'" name="statusAbsen['.$key.'][]" value="0" tanggal="'.date('d-m-Y', $tgl1).'">'
                                .'<input type="checkbox" class="statusAbsen '.$value->KodeKaryawan.' '.$nomor.'" id="'.$nomor.'_'.$noabsen.'" value="0">'
                                .'</div>'
                                .'</td>';
                    $tgl1 = strtotime("+1 day", $tgl1);
                }
            }

            $htmlabsen = $htmlabsen
                    .'<td>'
                    .'<div class="form-inline">'
                    .'<input type="checkbox" class="absenSemua '.$nomor.'" id="'.$value->KodeKaryawan.'" value="0">'
                    .'</div>'
                    .'</td>';

            $htmlabsen = $htmlabsen . '</tr>';
        }

        $htmlabsen = $htmlabsen . '<input type="hidden" name="jumlahKaryawan" value="'.$nomor.'">';

        return $htmlabsen;
    }

    /*fungsi untuk ambil data total gaji per tanggal dan total gaji semuanya*/
    public function apiLaporan($tanggal1, $tanggal2) {
        $awal   = date_format(date_create($tanggal1), 'Y-m-d');
        $akhir  = date_format(date_create($tanggal2), 'Y-m-d');

        $golongan   = DB::table('golongans')
                    ->select('NamaGolongan', 'KodeGolongan')
                    ->orderBy('KodeGolongan')
                    ->get();

        $golongan       = json_decode($golongan);
        $countGolongan  = count($golongan);
        $query          = '';
        $nomor          = 0;
        foreach ($golongan as $key => $value) {
            $nomor++;
            $query      = $query . "sum(case when (golongans.NamaGolongan='".$value->NamaGolongan."') then gajians.TotalGaji else '0' end) as '".$value->NamaGolongan."'";
            if ($nomor < $countGolongan) {
                $query  = $query . ", ";
            }
        }

        $data = DB::select("SELECT gajians.TanggalGaji, ".$query." FROM gajians
                            JOIN karyawans ON gajians.KodeKaryawan = karyawans.KodeKaryawan
                            JOIN golongans ON karyawans.KodeGolongan = golongans.KodeGolongan
                            WHERE gajians.TanggalGaji BETWEEN '".$awal."' AND '".$akhir."'
                            GROUP BY gajians.TanggalGaji");
        
        $laporan = '';
        if (count($data) > 0) {
            $laporan = $laporan . '<table class="table table-hover table-striped tabelLaporan">'
                    .'<tr>';

            $laporan = $laporan . '<th>No</th>';
            $laporan = $laporan . '<th>Tanggal Gaji</th>';
            foreach ($golongan as $key => $value) {
                $laporan = $laporan . '<th>' . $value->NamaGolongan . '</th>';
            }
            $laporan = $laporan . '</tr>';
            $count = 1;

            foreach ($data as $key => $value) {
                $laporan = $laporan . '<tr>';
                $laporan = $laporan . '<td>' . $count . '</td>';
                $laporan = $laporan . '<td>' . date_format(date_create($value->TanggalGaji), 'd-m-Y') . '</td>';
                foreach ($golongan as $k => $v) {
                    $obj = $v->NamaGolongan;
                    $laporan = $laporan . '<td>' . ($value->$obj != null ? number_format($value->$obj, 0, "", ".") : '0') . '</td>';
                }
                $laporan = $laporan . '</tr>';
                $count++;
            }

            $dataTotal = DB::select("SELECT ".$query." FROM gajians
                   JOIN karyawans ON gajians.KodeKaryawan = karyawans.KodeKaryawan
                   JOIN golongans ON karyawans.KodeGolongan = golongans.KodeGolongan
                   WHERE gajians.TanggalGaji BETWEEN '".$awal."' AND '".$akhir."'");

            $gajiSemua = 0;
            $laporan = $laporan . '<tr><td></td><td><b>Subtotal Gaji</b></td>';
            foreach ($dataTotal[0] as $key => $value) {
                $gajiSemua = $gajiSemua + $value;
                $laporan = $laporan . '<td>' . number_format($value, 0, "", ".") . '</td>';
            }
            
            $laporan = $laporan . '</tr>';
            $laporan = $laporan . '</table>';
            $laporan = $laporan . '<br><h3>Total Pengeluaran Gaji : <b>'.number_format($gajiSemua, 0, "", ".").'</b></h3>';
        } else {
            $laporan = 'Tidak ada pengeluaran gaji pada tanggal tersebut';
        }

        return $laporan;
    }

    public function apiGaji(Request $request)
    {
        $tanggal = date_format(date_create($request->tgl), 'Y-m-d');
        $golongan = $request->gol;

        $header_tabel = '';
        $body_tabel = '';
        $nomorbarang = 0;
        $nomorkaryawan = 0;

        $datagolongan = DB::table('detailgolongans')->where('KodeGolongan', $golongan)->get();

        $header_tabel = '<thead>'
        .'<tr>'
        .'<th class="headerTabel" width="3%">No</th>'
        .'<th class="headerTabel" '.(($golongan == 'GOL-01' || $golongan == 'GOL-02') ? 'width="6%"' : '').'>Nama</th>'
        .'<th class="headerTabel" '.(($golongan == 'GOL-01' || $golongan == 'GOL-02') ? 'width="8%"' : '').'>Gaji Borongan</th>'
        .'<th class="headerTabel" '.(($golongan == 'GOL-01' || $golongan == 'GOL-02') ? 'width="5%"' : '').'></th>'
        .'<th class="headerTabel" '.(($golongan == 'GOL-01' || $golongan == 'GOL-02') ? 'width="8%"' : '').'>Gaji Harian</th>'
        .'<th class="headerTabel" '.(($golongan == 'GOL-01' || $golongan == 'GOL-02') ? 'width="5%"' : '').'></th>'
        .'<th class="headerTabel" '.(($golongan == 'GOL-01' || $golongan == 'GOL-02') ? 'width="7%"' : '').'>Lembur Minggu</th>'
        .'<th class="headerTabel lemburJam" '.($golongan == 'GOL-01' ? 'style="display: none;"' : '').'>Lembur Jam</th>'
        .'<th class="headerTabel lemburJam" '.($golongan == 'GOL-01' ? 'style="display: none;"' : '').'></th>';                

        foreach ($datagolongan as $key => $value) {
            $header_tabel = $header_tabel
            .'<th class="headerTabel" '.(($golongan == 'GOL-01' || $golongan == 'GOL-02') ? 'width="6%"' : '').'>'. $value->NamaGolItem .'</th>'
            .'<input type="hidden" name="kodeBarang[]" value="'.$value->KodeGolItem.'">';
        }

        $header_tabel = $header_tabel
        .'<th class="headerTabel" width="6%" '.($golongan != 'GOL-01' ? 'style="display: none;"' : '').'>Jumlah</th>'
        .'<th class="headerTabel" width="8%" '.(($golongan == 'GOL-02' || $golongan == 'GOL-03') ? 'style="display: none;"' : '').'>Bonus</th>'
        .'<th class="headerTabel" '.(($golongan == 'GOL-01' || $golongan == 'GOL-02' || $golongan == 'GOL-03' || $golongan == 'GOL-08') ? 'style="display: none;"' : '').'>Jumlah (Hari)</th>'
        .'<th class="headerTabel" width="6%">Subtotal</th>'
        .'</tr>'
        .'<tr>'
        .'<td class="headerTabel" height="50%"></td>'
        .'<td class="headerTabel" height="50%"></td>'
        .'<td class="headerTabel" height="50%">Besaran</td>'
        .'<td class="headerTabel" height="50%">Hari</td>'
        .'<td class="headerTabel" height="50%">Besaran</td>'
        .'<td class="headerTabel" height="50%">Hari</td>'
        .'<td class="headerTabel" height="50%"></td>'
        .'<td class="headerTabel" height="50%" '.($golongan == 'GOL-01' ? 'style="display: none;"' : '').'>Besaran</td>' //untuk kolom lembur jam
        .'<td class="headerTabel" height="50%" '.($golongan == 'GOL-01' ? 'style="display: none;"' : '').'>Jam</td>'; //untuk kolom lembur jam

        foreach ($datagolongan as $key => $value) {
            $nomorbarang = $nomorbarang + 1;
            $header_tabel = $header_tabel
            .'<td class="headerTabel" height="50%">'.$value->HargaGolItem.'</td>'
            .'<input type="hidden" class="hargaBarang'.$nomorbarang.'" name="hargaBarang[]" value="'.$value->HargaGolItem.'">';
        }

        $header_tabel = $header_tabel
        .'<td class="headerTabel" height="50%" '.($golongan != 'GOL-01' ? 'style="display: none;"' : '').'></td>' //untuk kolom konversi
        .'<td class="headerTabel" height="50%" '.(($golongan == 'GOL-02' || $golongan == 'GOL-03') ? 'style="display: none;"' : '').'>Besaran</td>' //untuk kolom bonus
        .'<td class="headerTabel" height="50%" '.(($golongan == 'GOL-01' || $golongan == 'GOL-02' || $golongan == 'GOL-03' || $golongan == 'GOL-08') ? 'style="display: none;"' : '').'>Hari</td>' //untuk kolom jumlah bonus
        .'<td class="headerTabel" height="50%"></td>'
        .'</tr>'
        .'</thead>';

        $cekgaji = DB::table('gajians')
        ->join('karyawans', 'gajians.KodeKaryawan','=','karyawans.KodeKaryawan')
        ->where('karyawans.KodeGolongan', $golongan)
        ->where('gajians.TanggalGaji', $tanggal)
        ->limit(3)
        ->get();

        if (count($cekgaji) > 0) {
            $datagaji = DB::table('karyawans')
            ->join('golongans', 'golongans.KodeGolongan','=','karyawans.KodeGolongan')
            ->join('gajians', 'gajians.KodeKaryawan','=','karyawans.KodeKaryawan')
            ->join('tambahangajians', 'tambahangajians.KodeGaji','=','gajians.KodeGaji')
            ->where('karyawans.KodeGolongan', $golongan)
            ->where('gajians.TanggalGaji', $tanggal)
            ->get();

            $body_tabel = '<tbody>';

            foreach ($datagaji as $index => $content) {
                $nomorkaryawan = $nomorkaryawan + 1;

                $body_tabel = $body_tabel
                .'<tr>'
                .'<input type="hidden" name="kodeGaji[]" value="'.$content->KodeGaji.'">'
                .'<td>'.$nomorkaryawan.'</td>'
                .'<th class="headerTabel" style="background-color: #ffee00; text-align: left; vertical-align: middle;">'.$content->Nama.'</th>'
                .'<input type="hidden" value="'.$content->KodeKaryawan.'" name="kodeKaryawan[]">'
                .'<td><input type="number" min="0" class="form-control '.$nomorkaryawan.' gajiKaryawan'.$nomorkaryawan.'" value="'.$content->Gaji.'" name="gajiKaryawan[]" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')"></td>'
                .'<td><input type="number" min="0" class="form-control '.$nomorkaryawan.' jumlahHariKerja'.$nomorkaryawan.' hariKerja" value="'.$content->JumlahHariKerja.'" name="jumlahHariKerja[]" id="'.$nomorkaryawan.'" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')"></td>'
                .'<input type="hidden" class="subtotalGaji'.$nomorkaryawan.'" value="'.$content->SubtotalGaji.'" name="subtotalGaji[]">'
                .'<td><input type="number" min="0" class="form-control '.$nomorkaryawan.' lemburHarian'.$nomorkaryawan.'" value="'.$content->LemburHarian.'" name="lemburHarian[]" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')"></td>'
                .'<td><input type="number" min="0" class="form-control '.$nomorkaryawan.' jumlahLemburHarian'.$nomorkaryawan.'" value="'.$content->JumlahLemburHarian.'" name="jumlahLemburHarian[]" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')"></td>'
                .'<input type="hidden" class="subtotalLemburHarian'.$nomorkaryawan.'" value="'.$content->SubtotalLemburHarian.'" name="subtotalLemburHarian[]">'
                .'<td style="vertical-align: middle;"><input type="number" min="0" class="form-control '.$nomorkaryawan.' subtotalLemburMinggu'.$nomorkaryawan.'" value="'.$content->SubtotalLemburMinggu.'" name="subtotalLemburMinggu[]" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')" readonly></td>'
                .'<input type="hidden" class="lemburMinggu'.$nomorkaryawan.'" value="'.$content->LemburMinggu.'">'
                .($golongan == 'GOL-01' ? '' : '<td>').'<input type="'.($golongan == 'GOL-01' ? 'hidden' : 'number').'" min="0" class="form-control '.$nomorkaryawan.' lemburJam'.$nomorkaryawan.'" value="'.$content->LemburJam.'" name="lemburJam[]" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')">'
                .($golongan == 'GOL-01' ? '' : '<td>').'<input type="'.($golongan == 'GOL-01' ? 'hidden' : 'number').'" min="0" class="form-control '.$nomorkaryawan.' jumlahLemburJam'.$nomorkaryawan.'" value="'.$content->JumlahLemburJam.'" name="jumlahLemburJam[]" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')">'
                .'<input type="hidden" class="subtotalLemburJam'.$nomorkaryawan.'" value="'.$content->SubtotalLemburJam.'" name="subtotalLemburJam[]">';

                $databarang = DB::table('detailgajians')
                ->join('gajians', 'gajians.KodeGaji','=','detailgajians.KodeGaji')
                ->where('gajians.KodeKaryawan', $content->KodeKaryawan)
                ->where('gajians.TanggalGaji', $tanggal)
                ->select('detailgajians.JumlahBarang')
                ->get();

                $i = 0;
                $konversi = 0;
                foreach ($databarang as $idx => $val) {
                    $i++;
                    if ($golongan == 'GOL-01') {
                        if ($i <= 4) {
                            $jumlah = $val->JumlahBarang;

                            if ($i == 3 || $i == 4) {
                                $jumlah = round($jumlah * 36 / 30);
                            }

                            $konversi = $konversi + $jumlah;
                        }
                    }
                    $body_tabel = $body_tabel
                    .'<td><input type="number" min="0" class="form-control '.$nomorkaryawan.' jumlahBarang'.$nomorkaryawan.' barangKaryawan'.$i.$nomorkaryawan.'" value="'.$val->JumlahBarang.'" name="barangKaryawan['.$i.'][]" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')"></td>';
                }

                $body_tabel = $body_tabel
                .'<input type="hidden" class="subtotalHargaBarang'.$nomorkaryawan.'" value="'.$content->SubtotalHargaBarang.'" name="subtotalHargaBarang[]">'
                .'<td class="konversiBarang'.$nomorkaryawan.'" style="text-align: right; vertical-align: middle; '.($golongan != 'GOL-01' ? 'display: none;' : '').'">'.$konversi.'</td>'
                .(($golongan == 'GOL-02' || $golongan == 'GOL-03') ? '' : '<td>').'<input type="'.(($golongan == 'GOL-02' || $golongan == 'GOL-03') ? 'hidden' : 'number').'" min="0" class="form-control '.$nomorkaryawan.' bonus'.$nomorkaryawan.'" value="'.$content->Bonus.'" name="bonus[]" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')" '.($golongan == 'GOL-01' ? 'readonly' : '').'>'
                .(($golongan == 'GOL-01' || $golongan == 'GOL-02' || $golongan == 'GOL-03') ? '' : '<td>').'<input type="'.(($golongan == 'GOL-01' || $golongan == 'GOL-02' || $golongan == 'GOL-03') ? 'hidden' : 'number').'" min="0" class="form-control '.$nomorkaryawan.' jumlahBonus'.$nomorkaryawan.'" value="'.$content->JumlahBonus.'" name="jumlahBonus[]" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')">'
                .'<input type="hidden" class="subtotalBonus'.$nomorkaryawan.'" value="'.$content->SubtotalBonus.'" name="subtotalBonus[]">'
                .'<td class="totalGajiKaryawan'.$nomorkaryawan.'" style="text-align: right; vertical-align: middle; background-color: #eeffcc;">'.$content->TotalGaji.'</td>'
                .'<input type="hidden" class="totalGaji'.$nomorkaryawan.'" value="'.$content->TotalGaji.'" name="totalGaji[]">'
                . '</tr>';
            }

            $body_tabel = $body_tabel.'</tbody>';
        }
        else {
            $datagaji = DB::table('karyawans')
            ->selectRaw('*, count(absensis.StatusAbsen) as JumlahAbsen')
            ->join('absensis', 'karyawans.KodeKaryawan', '=', 'absensis.KodeKaryawan')
            ->join('golongans', 'karyawans.KodeGolongan', '=', 'golongans.KodeGolongan')
            ->where('karyawans.Status', 'OPN')
            ->where('karyawans.KodeGolongan', $golongan)
            ->where('absensis.StatusAbsen', '1')
            ->whereRaw('absensis.TanggalAbsen BETWEEN (SELECT DATE_SUB("'.$tanggal.'", INTERVAL (DAYOFWEEK("'.$tanggal.'")-1) DAY)) AND "'.$tanggal.'"')
            ->groupBy('karyawans.KodeKaryawan')
            ->orderBy('karyawans.Nama', 'ASC')
            ->get();

            if (count($datagaji) == 0) {
                $datagaji = DB::table('karyawans')
                ->join('golongans', 'karyawans.KodeGolongan', '=', 'golongans.KodeGolongan')
                ->where('karyawans.Status', 'OPN')
                ->where('karyawans.KodeGolongan', $golongan)
                ->groupBy('karyawans.KodeKaryawan')
                ->orderBy('karyawans.Nama', 'ASC')
                ->get();
            }
            $body_tabel = '<tbody>';

            foreach ($datagaji as $index => $content) {
                $nomorkaryawan = $nomorkaryawan + 1;

                $body_tabel = $body_tabel
                .'<tr>'
                .'<td>'.$nomorkaryawan.'</td>'
                .'<th class="headerTabel" style="background-color: #ffee00; text-align: left; vertical-align: middle;">'.$content->Nama.'</th>'
                .'<input type="hidden" value="'.$content->KodeKaryawan.'" name="kodeKaryawan[]">'
                .'<td><input type="number" min="0" class="form-control '.$nomorkaryawan.' gajiKaryawan'.$nomorkaryawan.'" value="'.($content->GajiPokok == "0" ? $content->UangHadir : $content->GajiPokok).'" name="gajiKaryawan[]" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')"></td>'
                .'<td><input type="number" min="0" class="form-control '.$nomorkaryawan.' jumlahHariKerja'.$nomorkaryawan.' hariKerja" value="'.(isset($content->JumlahAbsen) ? $content->JumlahAbsen : '0').'" name="jumlahHariKerja[]" id="'.$nomorkaryawan.'" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')"></td>'
                .'<input type="hidden" class="subtotalGaji'.$nomorkaryawan.'" value="0" name="subtotalGaji[]">'
                .'<td><input type="number" min="0" class="form-control '.$nomorkaryawan.' lemburHarian'.$nomorkaryawan.'" value="'.$content->LemburHarian.'" name="lemburHarian[]" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')"></td>'
                .'<td><input type="number" min="0" class="form-control '.$nomorkaryawan.' jumlahLemburHarian'.$nomorkaryawan.'" value="0" name="jumlahLemburHarian[]" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')"></td>'
                .'<input type="hidden" class="subtotalLemburHarian'.$nomorkaryawan.'" value="0" name="subtotalLemburHarian[]">'
                .'<td style="vertical-align: middle;"><input type="number" min="0" class="form-control '.$nomorkaryawan.' subtotalLemburMinggu'.$nomorkaryawan.'" value="0" name="subtotalLemburMinggu[]" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')" readonly></td>'
                .'<input type="hidden" class="lemburMinggu'.$nomorkaryawan.'" value="'.$content->LemburMinggu.'">'
                .($golongan == 'GOL-01' ? '' : '<td>').'<input type="'.($golongan == 'GOL-01' ? 'hidden' : 'number').'" min="0" class="form-control '.$nomorkaryawan.' lemburJam'.$nomorkaryawan.'" value="'.((int)($content->LemburHarian) / 7).'" name="lemburJam[]" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')">'
                .($golongan == 'GOL-01' ? '' : '<td>').'<input type="'.($golongan == 'GOL-01' ? 'hidden' : 'number').'" min="0" class="form-control '.$nomorkaryawan.' jumlahLemburJam'.$nomorkaryawan.'" value="0" name="jumlahLemburJam[]" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')">'
                .'<input type="hidden" class="subtotalLemburJam'.$nomorkaryawan.'" value="0" name="subtotalLemburJam[]">';

                for ($i=1; $i <= count($datagolongan); $i++) { 
                    $body_tabel = $body_tabel
                    .'<td><input type="number" min="0" class="form-control '.$nomorkaryawan.' jumlahBarang'.$nomorkaryawan.' barangKaryawan'.$i.$nomorkaryawan.'" value="0" name="barangKaryawan['.$i.'][]" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')"></td>';
                }

                $body_tabel = $body_tabel
                .'<input type="hidden" class="subtotalHargaBarang'.$nomorkaryawan.'" value="0" name="subtotalHargaBarang[]">'
                .'<td class="konversiBarang'.$nomorkaryawan.'" style="text-align: right; vertical-align: middle; '.($golongan != 'GOL-01' ? 'display: none;' : '').'">0</td>'
                .(($golongan == 'GOL-02' || $golongan == 'GOL-03') ? '' : '<td>').'<input type="'.(($golongan == 'GOL-02' || $golongan == 'GOL-03') ? 'hidden' : 'number').'" min="0" class="form-control '.$nomorkaryawan.' bonus'.$nomorkaryawan.'" value="0" name="bonus[]" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')" '.($golongan == 'GOL-01' ? 'readonly' : '').'>'
                .(($golongan == 'GOL-01' || $golongan == 'GOL-02' || $golongan == 'GOL-03') ? '' : '<td>').'<input type="'.(($golongan == 'GOL-01' || $golongan == 'GOL-02' || $golongan == 'GOL-03') ? 'hidden' : 'number').'" min="0" class="form-control '.$nomorkaryawan.' jumlahBonus'.$nomorkaryawan.'" value="0" name="jumlahBonus[]" onchange="perubahanTotalGaji(this, '.$nomorkaryawan.')">'
                .'<input type="hidden" class="subtotalBonus'.$nomorkaryawan.'" value="0" name="subtotalBonus[]">'
                .'<td class="totalGajiKaryawan'.$nomorkaryawan.'" style="text-align: right; vertical-align: middle; background-color: #eeffcc;">0</td>'
                .'<input type="hidden" class="totalGaji'.$nomorkaryawan.'" value="0" name="totalGaji[]">'
                . '</tr>';
            }

            $body_tabel = $body_tabel.'</tbody>';
        }
        $body_tabel = $body_tabel
        .'<input type="hidden" class="golonganKaryawan" value="'.$golongan.'" name="golonganKaryawan">'
        .'<input type="hidden" value="'.count($datagolongan).'" name="jumlahBarang">';

        $result = $header_tabel.$body_tabel;
        return $result;
    }
}