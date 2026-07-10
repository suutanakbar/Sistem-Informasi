<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfilOrmada>
 */
class ProfilOrmadaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $universitas = [
            'Universitas Gadjah Mada',
            'Universitas Indonesia',
            'Institut Teknologi Bandung',
            'Universitas Airlangga',
            'Universitas Padjadjaran',
            'Universitas Diponegoro',
            'Universitas Sebelas Maret',
            'Universitas Brawijaya',
        ];

        $universitasTerpilih = $this->faker->randomElement($universitas);
        $logoFileName = 'logo-' . strtolower(str_replace(' ', '-', $universitasTerpilih)) . '.png';

        return [
            'admin_id' => Admin::factory(),
            'nama_universitas' => $universitasTerpilih,
            'alamat_universitas' => $this->faker->address(),
            'total_mahasiswa_univ' => $this->faker->numberBetween(5000, 50000),
            'logo' => 'logos/' . $logoFileName,
            'deskripsi' => $this->faker->paragraph(3),
        ];
    }
}