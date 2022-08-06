<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->id_perusahaan = 1;
        $admin->nama = 'Administrator-Man';
        $admin->email = 'test@gmail.com';
        $admin->password = bcrypt('test12345');
        $admin->soft_delete = false;
        $admin->created_at = Carbon::now();
        $admin->updated_at = Carbon::now();
        $admin->save();
    }
}
