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
            'kata_sandi' => bcrypt('password'),
            'peran' => 'admin',
        ]);

        Admin::updateOrCreate([
            'email' => 'pemda@temanggung.go.id',
        ], [
            'nama' => 'Pemda Temanggung',
            'kata_sandi' => bcrypt('password'),
            'peran' => 'pemda',
        ]);

        Admin::updateOrCreate([
            'email' => 'pengurus@ormada.test',
        ], [
            'nama' => 'Pengurus Ormada',
            'kata_sandi' => bcrypt('password'),
            'peran' => 'pengurus_ormada',
        ]);
    }
}
