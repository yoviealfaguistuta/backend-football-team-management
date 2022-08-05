<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPertandingan extends Model
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
    protected $table = 'jadwal_pertandingan';
    protected $primaryKey = 'id';

    /*
    |--------------------------------------------------------------------------
    | Attribute
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'id_tim_tuan_rumah',
        'id_tim_tamu',
        'tanggal',
        'waktu',
        'soft_delete',
    ];

    public function go_list() {
        
        $data = JadwalPertandingan::select(
            'jadwal_pertandingan.id',
            'jadwal_pertandingan.tanggal',
            'jadwal_pertandingan.waktu',
            'jadwal_pertandingan.id_tim_tuan_rumah',
            'tim_tuan_rumah.nama as nama_tim_tuan_rumah',
            'tim_tuan_rumah.logo as logo_tim_tuan_rumah',
            'jadwal_pertandingan.id_tim_tamu',
            'tim_tamu.nama as nama_tim_tamu',
            'tim_tamu.logo as logo_tim_tamu',
        )
        ->where('jadwal_pertandingan.soft_delete', false)
        ->join('tim as tim_tuan_rumah', 'tim_tuan_rumah.id', 'jadwal_pertandingan.id_tim_tuan_rumah')
        ->join('tim as tim_tamu', 'tim_tamu.id', 'jadwal_pertandingan.id_tim_tamu')
        ->paginate(10);

        return $data;
    }

    public function go_exists($id) {
        $data = JadwalPertandingan::where('id', $id)->exists();
        return $data;
    }

    public function go_check_match_date($id) {
        $data = JadwalPertandingan::select('tanggal', 'waktu')->where('id', $id)->first();

        // Cek apakah tanggal pembuatan data sesuai dengan tanggal dari jadwal pertandingan
        $current_date = date('Y-m-d');
        if ($current_date != $data->tanggal) {
            return $current_date . ' bukanlah tanggal pertandingan, pertandingan ini dilaksanakan pada: ' . $data->tanggal;
        }

        return 'valid';
    }

    public function go_check_match_time($id, $waktu) {
        $data = JadwalPertandingan::select('tanggal', 'waktu')->where('id', $id)->first();

        // Cek apakah data waktu telah lebih dari 300 menit saat
        // pertandingan dimulai atau data waktu lebih cepat dari jadwal pertandingan
        $match_time = new Carbon($data->waktu);
        $event_time = new Carbon($waktu);

        if ($match_time->gt($event_time)) {
            return 'Pertandingan belum dimulai';
        }

        $difference = $match_time->diffInMinutes($event_time);
        if ($difference > 180) {
            return 'Pertandingan dianggap telah selesai karena sudah dimulai ' . $difference . ' menit yang lalu';
        }

        return 'valid';
    }

    public function go_create($input) {
        $data = JadwalPertandingan::create([
            'id_tim_tuan_rumah' => $input->id_tim_tuan_rumah,
            'id_tim_tamu' => $input->id_tim_tamu,
            'tanggal' => $input->tanggal,
            'waktu' => $input->waktu,
        ]);
        return $data;
    }

    public function go_update($input, $id) {
        $data = JadwalPertandingan::where('id', $id)->update([
            'id_tim_tuan_rumah' => $input->id_tim_tuan_rumah,
            'id_tim_tamu' => $input->id_tim_tamu,
            'tanggal' => $input->tanggal,
            'waktu' => $input->waktu,
        ]);
        return $data;
    }

    public function go_delete($id) {
        $soft_delete = JadwalPertandingan::select('soft_delete')->where('id', $id)->first()->soft_delete;
        
        if ($soft_delete) {
            $data = JadwalPertandingan::where('id', $id)->delete();
            return $data;
        }

        $data = JadwalPertandingan::where('id', $id)->update([
            'soft_delete' => true
        ]);
        return $data;
    }
}
