<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_login_using_email_and_kata_sandi(): void
    {
        $admin = Admin::create([
            'nama' => 'Admin Sistem',
            'email' => 'admin@example.test',
            'kata_sandi' => 'password',
            'peran' => 'admin',
        ]);

        $this->post(route('login'), [
            'email' => 'admin@example.test',
            'kata_sandi' => 'password',
        ])
            ->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($admin);
        $this->assertNotNull($admin->fresh()->terakhir_masuk);
    }

    public function test_login_rejects_invalid_password(): void
    {
        Admin::create([
            'nama' => 'Pengurus',
            'email' => 'pengurus@example.test',
            'kata_sandi' => 'password',
            'peran' => 'pengurus_ormada',
        ]);

        $this->from(route('login'))
            ->post(route('login'), [
                'email' => 'pengurus@example.test',
                'kata_sandi' => 'salah',
            ])
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_admin_can_logout(): void
    {
        $admin = Admin::create([
            'nama' => 'Pemda',
            'email' => 'pemda@example.test',
            'kata_sandi' => 'password',
            'peran' => 'pemda',
        ]);

        $this->actingAs($admin)
            ->post(route('logout'))
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }
}
