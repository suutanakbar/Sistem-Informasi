<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengumuman>
 */
class PengumumanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'admin_id' => Admin::factory(),
            'judul' => $this->faker->sentence(6, true),
            'isi' => $this->faker->paragraph(4),
            'tanggal_publish' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'foto' => null,
            'file' => null,
        ];
    }
}