<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HasilPertandingan extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Tinker
    |--------------------------------------------------------------------------
    */
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Static Configuration
    |--------------------------------------------------------------------------
    */
    protected $table = 'hasil_pertandingan';
    protected $primaryKey = 'id';

    /*
    |--------------------------------------------------------------------------
    | Attribute
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'id_jadwal_pertandingan',
        'id_pemain',
        'tipe',
        'waktu',
        'soft_delete',
    ];

    public function go_list() {
        
        $data = HasilPertandingan::select(
            'hasil_pertandingan.id_jadwal_pertandingan',
            // 'jadwal_pertandingan.id_tim_tuan_rumah',
            'tim_tuan_rumah.nama as nama_tim_tuan_rumah',
            'tim_tuan_rumah.id as id_tim_tuan_rumah',
            'tim_tamu.id as id_tim_tamu',
            'tim_tamu.nama as nama_tim_tamu',
            'tim_tuan_rumah.logo as logo_tim_tuan_rumah',
            'tim_tamu.logo as logo_tim_tamu',
        )
        ->where('hasil_pertandingan.soft_delete', false)
        ->join('jadwal_pertandingan', 'jadwal_pertandingan.id', 'hasil_pertandingan.id_jadwal_pertandingan')
        ->join('pemain', 'pemain.id', 'hasil_pertandingan.id_pemain')
        ->join('tim as tim_pemain', 'tim_pemain.id', 'pemain.id_tim')
        ->join('tim as tim_tuan_rumah', 'tim_tuan_rumah.id', 'jadwal_pertandingan.id_tim_tuan_rumah')
        ->join('tim as tim_tamu', 'tim_tamu.id', 'jadwal_pertandingan.id_tim_tamu')
        ->groupBy(
            'hasil_pertandingan.id_jadwal_pertandingan',
            'jadwal_pertandingan.id_tim_tuan_rumah',
            'tim_tuan_rumah.nama',
            'tim_tuan_rumah.id',
            'tim_tamu.id',
            'tim_tamu.nama',
            'tim_tuan_rumah.logo',
            'tim_tamu.logo'
        )->paginate(10);

        return $this->get_detail_match($data);
    }

    public function get_detail_match($data)
    {
        for ($i=0; $i < count($data); $i++) {
            
            // Inisialisasi default value agar mempermudah pengolahan dalam Frontend
            $skor_tim_tuan_rumah = 0;
            $skor_tim_tamu = 0;
            $kartu_kuning = 0;
            $kartu_merah = 0;
            $data[$i]['hasil'] = HasilPertandingan::select(
                'hasil_pertandingan.id',
                'pemain.nama as nama_pemain',
                'hasil_pertandingan.tipe',
                'hasil_pertandingan.waktu',
                'pemain.id_tim as id_tim_pemain',
                'pemain.nomor_punggung as nomor_punggung_pemain',
                'tim_pemain.nama as nama_tim_pemain',
            )
            ->where('hasil_pertandingan.soft_delete', false)
            ->join('jadwal_pertandingan', 'jadwal_pertandingan.id', 'hasil_pertandingan.id_jadwal_pertandingan')
            ->join('pemain', 'pemain.id', 'hasil_pertandingan.id_pemain')
            ->join('tim as tim_pemain', 'tim_pemain.id', 'pemain.id_tim')
            ->where('jadwal_pertandingan.id', $data[$i]->id_jadwal_pertandingan)->get();
            
            // Inisialisasi default value agar mempermudah pengolahan dalam Frontend
            $data[$i]['skor_tuan_rumah'] = 0;
            $data[$i]['skor_tamu'] = 0;
            $data[$i]['kartu_kuning'] = 0;
            $data[$i]['kartu_merah'] = 0;
            for ($k=0; $k < count($data[$i]['hasil']); $k++) {
                
                // Menetapkan apakah pemain ini berada di tim "Tuan Rumah"
                if ($data[$i]->id_tim_tuan_rumah == $data[$i]['hasil'][$k]->id_tim_pemain) {
                    $data[$i]['hasil'][$k]['status_tim'] = 'Tuan Rumah';
                }

                // Menetapkan apakah pemain ini berada di tim "Tamu"
                if ($data[$i]->id_tim_tamu == $data[$i]['hasil'][$k]->id_tim_pemain) {
                    $data[$i]['hasil'][$k]['status_tim'] = 'Tamu';
                }

                if ($data[$i]['hasil'][$k]->tipe == 1) {
                    if ($data[$i]->id_tim_tuan_rumah == $data[$i]['hasil'][$k]->id_tim_pemain) {
                        $skor_tim_tuan_rumah++;
                    }

                    if ($data[$i]->id_tim_tamu == $data[$i]['hasil'][$k]->id_tim_pemain) {
                        $skor_tim_tamu++;
                    }
                } else if ($data[$i]['hasil'][$k]->tipe == 2) {
                    $kartu_kuning++;
                    $data[$i]['kartu_kuning'] = $kartu_kuning++;
                } else if ($data[$i]['hasil'][$k]->tipe == 3) {
                    $kartu_merah++;
                    $data[$i]['kartu_merah'] = $kartu_merah++;
                }

                $data[$i]['skor_tuan_rumah'] = $skor_tim_tuan_rumah;
                $data[$i]['skor_tamu'] = $skor_tim_tamu;
                $data[$i]['total_skor_akhir'] = 'Skor Tim Tuan Rumah: ' . $skor_tim_tuan_rumah . ' - Skor Tim Tamu: ' . $skor_tim_tamu;
            }
        }

        return $data;
    }

    public function go_check_player($id_jadwal_pertandingan, $id_pemain) {

        $id_tim_pemain = Pemain::select('id_tim')->where('id', $id_pemain)->first()->id_tim;

        if (JadwalPertandingan::select('id_tim_tuan_rumah', 'id_tim_tamu')->where([['id', $id_jadwal_pertandingan], ['id_tim_tuan_rumah', $id_tim_pemain]])->orWhere([['id', $id_jadwal_pertandingan], ['id_tim_tamu', $id_tim_pemain]])->exists()) {
            return true;
        }
        return false;
    }

    public function go_exists($id) {
        $data = HasilPertandingan::where('id', $id)->exists();
        return $data;
    }

    public function go_create($input) {
        $data = HasilPertandingan::create([
            'id_jadwal_pertandingan' => $input->id_jadwal_pertandingan,
            'id_pemain' => $input->id_pemain,
            'tipe' => $input->tipe,
            'waktu' => $input->waktu,
        ]);
        return $data;
    }

    public function go_update($input, $id) {

        $data = HasilPertandingan::where('id', $id)->update([
            'id_jadwal_pertandingan' => $input->id_jadwal_pertandingan,
            'id_pemain' => $input->id_pemain,
            'tipe' => $input->tipe,
            'waktu' => $input->waktu,
        ]);
        return $data;
    }

    public function go_delete($id) {
        $soft_delete = HasilPertandingan::select('soft_delete')->where('id', $id)->first()->soft_delete;
        
        if ($soft_delete) {
            $data = HasilPertandingan::where('id', $id)->delete();
            return $data;
        }

        $data = HasilPertandingan::where('id', $id)->update([
            'soft_delete' => true
        ]);
        return $data;
    }
}
