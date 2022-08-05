<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function go_report($id_jadwal_pertandingan) {
        
        $data = JadwalPertandingan::select(
            'hasil_pertandingan.id_jadwal_pertandingan',
            'jadwal_pertandingan.id_tim_tuan_rumah',
            'tim_tuan_rumah.id as id_tim_tuan_rumah',
            'tim_tamu.id as id_tim_tamu',
            'tim_tuan_rumah.nama as nama_tim_tuan_rumah',
            'tim_tamu.nama as nama_tim_tamu',
            'tim_tuan_rumah.logo as logo_tim_tuan_rumah',
            'tim_tamu.logo as logo_tim_tamu',
        )
        ->where('hasil_pertandingan.soft_delete', false)
        ->join('hasil_pertandingan', 'hasil_pertandingan.id_jadwal_pertandingan', 'jadwal_pertandingan.id')
        ->join('pemain', 'pemain.id', 'hasil_pertandingan.id_pemain')
        ->join('tim as tim_pemain', 'tim_pemain.id', 'pemain.id_tim')
        ->join('tim as tim_tuan_rumah', 'tim_tuan_rumah.id', 'jadwal_pertandingan.id_tim_tuan_rumah')
        ->join('tim as tim_tamu', 'tim_tamu.id', 'jadwal_pertandingan.id_tim_tamu')
        ->groupBy(
            'hasil_pertandingan.id_jadwal_pertandingan',
            'jadwal_pertandingan.id_tim_tuan_rumah',
            'tim_tuan_rumah.id',
            'tim_tamu.id',
            'tim_tuan_rumah.nama',
            'tim_tamu.nama',
            'tim_tuan_rumah.logo',
            'tim_tamu.logo'
        )
        ->where([
            ['jadwal_pertandingan.id', $id_jadwal_pertandingan], 
            ['jadwal_pertandingan.soft_delete', false]
        ])
        ->first();

        if ($data) {

            // Inisialisasi default value agar mempermudah pengolahan dalam Frontend
            $skor_tim_tuan_rumah = 0;
            $skor_tim_tamu = 0;
            $kartu_kuning = 0;
            $kartu_merah = 0;
            $pemain_dengan_gol_terbanyak = [];
            $data['hasil'] = HasilPertandingan::select(
                'jadwal_pertandingan.id as id_jadwal_pertandingan',
                'pemain.nama as nama_pemain',
                'hasil_pertandingan.tipe',
                'hasil_pertandingan.waktu',
                'pemain.id_tim as id_tim_pemain',
                'pemain.nomor_punggung as nomor_punggung_pemain',
                'tim_pemain.nama as tim',
            )
            ->join('jadwal_pertandingan', 'jadwal_pertandingan.id', 'hasil_pertandingan.id_jadwal_pertandingan')
            ->join('pemain', 'pemain.id', 'hasil_pertandingan.id_pemain')
            ->join('tim as tim_pemain', 'tim_pemain.id', 'pemain.id_tim')
            ->where([
                ['jadwal_pertandingan.id', $id_jadwal_pertandingan], 
                ['jadwal_pertandingan.soft_delete', false]
            ])
            ->get();
        
            // Inisialisasi default value agar mempermudah pengolahan dalam Frontend
            $data['skor_tuan_rumah'] = 0;
            $data['skor_tamu'] = 0;
            $data['kartu_kuning'] = 0;
            $data['kartu_merah'] = 0;
            for ($k=0; $k < count($data['hasil']); $k++) {

                // Menetapkan apakah pemain ini berada di tim "Tuan Rumah"
                if ($data->id_tim_tuan_rumah == $data['hasil'][$k]->id_tim_pemain) {
                    $data['hasil'][$k]['status_tim'] = 'Tuan Rumah';
                }

                // Menetapkan apakah pemain ini berada di tim "Tamu"
                if ($data->id_tim_tamu == $data['hasil'][$k]->id_tim_pemain) {
                    $data['hasil'][$k]['status_tim'] = 'Tamu';
                }

                // Cek jika data yang diberikan bertipe 1 atau (GOL)
                if ($data['hasil'][$k]->tipe == 1) {
                    array_push($pemain_dengan_gol_terbanyak, $data['hasil'][$k]->nama_pemain);
                    if ($data->id_tim_tuan_rumah == $data['hasil'][$k]->id_tim_pemain) {
                        $skor_tim_tuan_rumah++;
                    }

                    if ($data->id_tim_tamu == $data['hasil'][$k]->id_tim_pemain) {
                        $skor_tim_tamu++;
                    }
                // Cek jika data yang diberikan bertipe 2 atau (Pelanggaran Kartu Kuning)
                } else if ($data['hasil'][$k]->tipe == 2) {
                    $kartu_kuning++;
                    $data['kartu_kuning'] = $kartu_kuning++;

                // Cek jika data yang diberikan bertipe 2 atau (Pelanggaran Kartu Merah)
                } else if ($data['hasil'][$k]->tipe == 3) {
                    $kartu_merah++;
                    $data['kartu_merah'] = $kartu_merah++;
                }
                
                $data['skor_tuan_rumah'] = $skor_tim_tuan_rumah;
                $data['skor_tamu'] = $skor_tim_tamu;
                $data['total_skor_akhir'] = 'Skor Tim Tuan Rumah: ' . $skor_tim_tuan_rumah . ' - Skor Tim Tamu: ' . $skor_tim_tamu;

                // Menentukan pemenang dari pertandingan, apakah tim Tuan Rumah Menang, Tim Tamu Menang atau Draw
                if ($skor_tim_tuan_rumah > $skor_tim_tamu) {
                    $data['status_akhir_pertandingan'] = $data->nama_tim_tuan_rumah . ' (Tuan Rumah) Menang';
                } else if ($skor_tim_tuan_rumah == $skor_tim_tamu) {
                    $data['status_akhir_pertandingan'] = 'Draw';
                } else {
                    $data['status_akhir_pertandingan'] = $data->nama_tim_tamu . ' (Tamu) Menang';
                }
            }

            // Melakukan pengelompokan untuk "key" dalam array yang memiliki value sama
            $group_of_gol = array_count_values($pemain_dengan_gol_terbanyak);
            $data['jumlah_gol'] = $group_of_gol;
            
            // Mengurutkan array dari value yang terbesar
            arsort($group_of_gol);

            // Menghitung data yang terbanyak di dalam array
            $data['gol_terbanyak'] = key($group_of_gol) . ' mencetak gol terbanyak';
            
            // Mengambil total seluruh pertandingan yang di menangkan oleh Tim Tuan Rumah dan Tim Tamu
            $total_seluruh_kemenangan = $this->get_all_winning_match();
            $data['detail_seluruh_kemenangan'] = $total_seluruh_kemenangan;
            
            $data['total_seluruh_kemenangan_tuan_rumah'] = array_sum(array_column($total_seluruh_kemenangan,'tuan_rumah'));
            $data['total_seluruh_kemenangan_tamu'] = array_sum(array_column($total_seluruh_kemenangan,'tamu'));

            return $data;
        }
        return 'Pertandingan tidak ditemukan';
    }

    public function get_all_winning_match()
    {
        $pertandingan = HasilPertandingan::select(
            'hasil_pertandingan.id_jadwal_pertandingan',
            'jadwal_pertandingan.id_tim_tuan_rumah',
            'tim_tuan_rumah.id as id_tim_tuan_rumah',
            'tim_tamu.id as id_tim_tamu',
        )
        ->where('hasil_pertandingan.soft_delete', false)
        ->join('jadwal_pertandingan', 'jadwal_pertandingan.id', 'hasil_pertandingan.id_jadwal_pertandingan')
        ->join('tim as tim_tuan_rumah', 'tim_tuan_rumah.id', 'jadwal_pertandingan.id_tim_tuan_rumah')
        ->join('tim as tim_tamu', 'tim_tamu.id', 'jadwal_pertandingan.id_tim_tamu')
        ->groupBy(
            'hasil_pertandingan.id_jadwal_pertandingan',
            'jadwal_pertandingan.id_tim_tuan_rumah',
            'tim_tuan_rumah.id',
            'tim_tamu.id',
        )
        ->where('hasil_pertandingan.soft_delete', false)
        ->get();

        for ($i=0; $i < count($pertandingan); $i++) {
            $hasil = HasilPertandingan::select(
                'hasil_pertandingan.id',
                'hasil_pertandingan.tipe',
                'pemain.id_tim as id_tim_pemain',
                'tim_pemain.nama as nama_tim_pemain',
            )
            ->where('hasil_pertandingan.soft_delete', false)
            ->join('jadwal_pertandingan', 'jadwal_pertandingan.id', 'hasil_pertandingan.id_jadwal_pertandingan')
            ->join('pemain', 'pemain.id', 'hasil_pertandingan.id_pemain')
            ->join('tim as tim_pemain', 'tim_pemain.id', 'pemain.id_tim')
            ->where('jadwal_pertandingan.id', $pertandingan[$i]->id_jadwal_pertandingan)->get();
            
            // Inisialisasi default value agar mempermudah pengolahan dalam Frontend
            $kemenangan_total_tuan_rumah = 0;
            $kemenangan_total_tamu = 0;
            $skor_tim_tuan_rumah = 0;
            $skor_tim_tamu = 0;
            
            for ($k=0; $k < count($hasil); $k++) { 

                if ($hasil[$k]->tipe == 1) {
                    // Menambahkan skor tim Tuan Rumah jika data bertipe = 1 (GOL)
                    if ($pertandingan[$i]->id_tim_tuan_rumah == $hasil[$k]->id_tim_pemain) {
                        $skor_tim_tuan_rumah++;
                    }

                    // Menambahkan skor tim Tamu jika data bertipe = 1 (GOL)
                    if ($pertandingan[$i]->id_tim_tamu == $hasil[$k]->id_tim_pemain) {
                        $skor_tim_tamu++;
                    }
                }
            }

            // Menambahkan total seluruh kemengangan tim Tuan Rumah dan tim Tamu
            if ($skor_tim_tuan_rumah > $skor_tim_tamu) {
                $kemenangan_total_tuan_rumah++;
            } else if ($skor_tim_tuan_rumah < $skor_tim_tamu) {
                $kemenangan_total_tamu++;
            }

            $data[$i]['id_jadwal_pertandingan'] = $pertandingan[$i]->id_jadwal_pertandingan;
            $data[$i]['tuan_rumah'] = $kemenangan_total_tuan_rumah;
            $data[$i]['tamu'] = $kemenangan_total_tamu;
        }
        
        return $data;
    }
}
