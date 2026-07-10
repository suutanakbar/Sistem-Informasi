<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Agenda;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgendaFactory extends Factory
{
    public function definition(): array
    {
        $kategori = fake()->randomElement(['kegiatan_ormada', 'kegiatan_pemda', 'baksos', 'pendidikan', 'kesehatan', 'lingkungan', 'lainnya']);

        return [
            'admin_id' => Admin::factory(),
            'nama_agenda' => fake()->sentence(),
            'deskripsi_agenda' => fake()->paragraphs(3, true),
            'gambar_poster' => 'agenda/placeholder.jpg',
            'waktu_mulai' => fake()->dateTimeBetween('+1 week', '+2 weeks'),
            'waktu_selesai' => fake()->dateTimeBetween('+2 weeks', '+3 weeks'),
            'tempat' => fake()->address(),
            'kategori' => $kategori,
            'kuota_volunteer' => null,
            'deadline_pendaftaran' => null,
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

    public function withVolunteer(): static
    {
        return $this->state(fn (array $attributes) => [
            'kuota_volunteer' => fake()->numberBetween(10, 100),
            'deadline_pendaftaran' => fake()->dateTimeBetween('+1 week', '+2 weeks'),
        ]);
    }
}