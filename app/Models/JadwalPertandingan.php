<?php

namespace App\Models;

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
            'jadwal_pertandingan.id_tim_tuan_rumah',
            'jadwal_pertandingan.id_tim_tamu',
            'jadwal_pertandingan.tanggal',
            'jadwal_pertandingan.waktu',
            'tim_tuan_rumah.nama as nama_tim_tuan_rumah',
            'tim_tamu.nama as nama_tim_tamu',
            'tim_tuan_rumah.logo as logo_tim_tuan_rumah',
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
            'id_tim' => $input->id_tim,
            'nama' => $input->nama,
            'tinggi_badan' => $input->tinggi_badan,
            'berat_badan' => $input->berat_badan,
            'posisi_pemain' => $input->posisi_pemain,
            'nomor_punggung' => $input->nomor_punggung,
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
