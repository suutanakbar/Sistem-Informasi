<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Postingan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class PostinganFactory extends Factory
{
    public function definition(): array
    {
        return [
            'admin_id' => Admin::factory(),
            'judul' => fake()->sentence(),
            'isi_konten' => fake()->paragraphs(3, true),
            'foto' => null,
            'jenis_konten' => fake()->randomElement(['berita', 'pengumuman', 'prestasi']),
            'is_published' => false,
            'tanggal_publish' => null,
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => true,
            'tanggal_publish' => now(),
        ]);
    }

    public function withFoto(): static
    {
        return $this->state(fn (array $attributes) => [
            'foto' => 'postingan/foto/' . fake()->uuid() . '.jpg',
        ]);
    }
}