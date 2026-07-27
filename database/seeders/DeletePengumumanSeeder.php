<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DeletePengumumanSeeder extends Seeder
{
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::table('pengumuman')->truncate();
    }
}