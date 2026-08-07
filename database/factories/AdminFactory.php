<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
            'peran' => fake()->randomElement(['admin', 'pemda', 'pengurus_ormada']),
            'terakhir_masuk' => now(),
        ];
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'peran' => 'admin',
        ]);
    }

    public function pemda(): static
    {
        return $this->state(fn (array $attributes) => [
            'peran' => 'pemda',
        ]);
    }

    public function pengurusOrmada(): static
    {
        return $this->state(fn (array $attributes) => [
            'peran' => 'pengurus_ormada',
        ]);
    }
}