<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
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
    protected $table = 'perusahaan';
    protected $primaryKey = 'id';

    /*
    |--------------------------------------------------------------------------
    | Attribute
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'nama',
        'soft_delete',
    ];


    public function go_list() {
        $data = Perusahaan::paginate(10);
        return $data;
    }

    public function go_exists($id) {
        $data = Perusahaan::where('id', $id)->exists();
        return $data;
    }

    public function go_create($input) {
        $data = Perusahaan::create([
            'nama' => $input->nama
        ]);
        return $data;
    }

    public function go_update($input, $id) {
        $data = Perusahaan::where('id', $id)->update([
            'nama' => $input->nama
        ]);
        return $data;
    }

    public function go_delete($id) {
        $soft_delete = Perusahaan::select('soft_delete')->where('id', $id)->first()->soft_delete;
        
        if ($soft_delete) {
            $data = Perusahaan::where('id', $id)->delete();
            return $data;
        }

        $data = Perusahaan::where('id', $id)->update([
            'soft_delete' => true
        ]);
        return $data;
    }
}
