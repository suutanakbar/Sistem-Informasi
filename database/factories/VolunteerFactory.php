<?php

namespace Database\Factories;

use App\Models\Agenda;
use App\Models\Volunteer;
use Illuminate\Database\Eloquent\Factories\Factory;

class VolunteerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'agenda_id' => Agenda::factory(),
            'nama' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'no_hp' => fake()->phoneNumber(),
            'alasan' => fake()->sentence(),
            'status' => 'pending',
        ];
    }

    public function diterima(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'diterima',
        ]);
    }

    public function ditolak(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'ditolak',
        ]);
    }
}