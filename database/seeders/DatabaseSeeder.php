<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::updateOrCreate([
            'email' => 'admin@ormada.test',
        ], [
            'nama' => 'Admin Sistem',
            'kata_sandi' => 'password',
            'peran' => 'admin',
        ]);
    }
}
