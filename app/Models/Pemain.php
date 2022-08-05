<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemain extends Model
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
    protected $table = 'pemain';
    protected $primaryKey = 'id';

    /*
    |--------------------------------------------------------------------------
    | Attribute
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'id_tim',
        'nama',
        'tinggi_badan',
        'berat_badan',
        'posisi_pemain',
        'nomor_punggung',
        'soft_delete',
    ];

    public function go_list() {
        
        $data = Pemain::select(
            'pemain.id_tim',
            'pemain.nama',
            'pemain.tinggi_badan',
            'pemain.berat_badan',
            'pemain.posisi_pemain',
            'pemain.nomor_punggung',
            'pemain.created_at',
            'tim.nama as nama_tim',
            'perusahaan.nama as nama_perusahaan',
        )
        ->where('pemain.soft_delete')
        ->join('tim', 'tim.id', 'pemain.id_tim')
        ->join('perusahaan', 'perusahaan.id', 'tim.id_perusahaan')
        ->paginate(10);

        return $data;
    }

    public function go_exists($id) {
        $data = Pemain::where('id', $id)->exists();
        return $data;
    }

    public function go_nomor_punggung_exists($id_tim, $nomor_punggung, $old_nomor_punggung = null, $id = null) {
        if ($old_nomor_punggung == null) {
            $data = Pemain::where([['id_tim', $id_tim], ['nomor_punggung', $nomor_punggung]])->exists();
            return $data;
        }

        if ($old_nomor_punggung == $nomor_punggung) {
            return false;
        }
        
        $data = Pemain::select('id', 'nomor_punggung')->where([['id_tim', $id_tim], ['nomor_punggung', $nomor_punggung]])->exists();
        return $data;
    }

    public function go_detail($id) {
        $data = Pemain::where('id', $id)->first();
        return $data;
    }

    public function go_create($input) {
        $data = Pemain::create([
            'id_tim' => $input->id_tim,
            'nama' => $input->nama,
            'tinggi_badan' => $input->tinggi_badan,
            'berat_badan' => $input->berat_badan,
            'posisi_pemain' => $input->posisi_pemain,
            'nomor_punggung' => $input->nomor_punggung,
        ]);
        return $data;
    }

    public function go_update($input, $id) {

        $data = Pemain::where('id', $id)->update([
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
        $soft_delete = Pemain::select('soft_delete')->where('id', $id)->first()->soft_delete;
        
        if ($soft_delete) {
            $data = Pemain::where('id', $id)->delete();
            return $data;
        }

        $data = Pemain::where('id', $id)->update([
            'soft_delete' => true
        ]);
        return $data;
    }
}
