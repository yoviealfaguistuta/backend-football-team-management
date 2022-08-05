<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tim extends Model
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
    protected $table = 'tim';
    protected $primaryKey = 'id';

    /*
    |--------------------------------------------------------------------------
    | Attribute
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'id_perusahaan',
        'nama',
        'logo',
        'tahun_berdiri',
        'alamat_markas_tim',
        'kota_markas_tim',
        'soft_delete',
    ];

    public function go_list() {
        
        $data = Tim::select(
            'tim.id',
            'tim.id_perusahaan',
            'perusahaan.nama as nama_perusahaan',
            'tim.nama',
            'tim.logo',
            'tim.tahun_berdiri',
            'tim.alamat_markas_tim',
            'tim.kota_markas_tim',
            'tim.created_at',
        )
        ->where('tim.soft_delete', false)
        ->join('perusahaan', 'perusahaan.id', 'tim.id_perusahaan')
        ->paginate(10);

        return $data;
    }

    public function go_exists($id) {
        $data = Tim::where('id', $id)->exists();
        return $data;
    }

    public function go_create($input) {
        $data = Tim::create([
            'id_perusahaan' => $input->id_perusahaan,
            'nama' => $input->nama,
            'logo' => $input->logo,
            'tahun_berdiri' => $input->tahun_berdiri,
            'alamat_markas_tim' => $input->alamat_markas_tim,
            'kota_markas_tim' => $input->kota_markas_tim,
        ]);
        return $data;
    }

    public function go_update($input, $id) {
        $data = Tim::where('id', $id)->update([
            'id_perusahaan' => $input->id_perusahaan,
            'nama' => $input->nama,
            'tahun_berdiri' => $input->tahun_berdiri,
            'alamat_markas_tim' => $input->alamat_markas_tim,
            'kota_markas_tim' => $input->kota_markas_tim,
        ]);
        return $data;
    }

    public function go_delete($id) {
        $soft_delete = Tim::select('soft_delete')->where('id', $id)->first()->soft_delete;
        
        if ($soft_delete) {
            $data = Tim::where('id', $id)->delete();
            return $data;
        }

        $data = Tim::where('id', $id)->update([
            'soft_delete' => true
        ]);
        return $data;
    }

    public function go_update_logo($id, $file) {
        $data = Tim::select('logo')->where('id', $id)->update([
            'logo' => $file
        ]);
        return $data;
    }

    public function go_get_old_logo($id) {
        $data = Tim::select('logo')->where('id', $id)->first()->logo;
        return $data;
    }
}
