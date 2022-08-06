<?php

namespace Database\Seeders;

use App\Models\Perusahaan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perusahaan = new Perusahaan();
        $perusahaan->id = 1;
        $perusahaan->nama = 'Ayo Indonesia';
        $perusahaan->soft_delete = false;
        $perusahaan->created_at = Carbon::now();
        $perusahaan->updated_at = Carbon::now();
        $perusahaan->save();
    }
}
