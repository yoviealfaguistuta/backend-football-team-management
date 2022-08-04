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

    public function go_list()
    {
        $data = Tim::paginate(10);
        return $data;
    }

    public function go_create($input)
    {
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

    public function go_update($input, $id)
    {
        $data = Tim::where('id', $id)->update([
            'nama' => $input->nama
        ]);
        return $data;
    }

    public function go_delete($id)
    {
        $data = Tim::where('id', $id)->delete();
        return $data;
    }
}
