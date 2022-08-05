<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
            'hasil_pertandingan.id_pemain',
            'hasil_pertandingan.tipe',
            'hasil_pertandingan.waktu',
            'jadwal_pertandingan.id_tim_tuan_rumah',
            'pemain.nama as nama_pemain',
            'pemain.nomor_punggung as nomor_punggung_pemain',
            'tim_pemain.nama as nama_tim_pemain',
            'tim_pemain.logo as logo_tim_pemain',
            'tim_tuan_rumah.nama as nama_tim_tuan_rumah',
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
        ->paginate(10);

        return $data;
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
