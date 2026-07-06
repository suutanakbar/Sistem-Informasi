<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    public function test_login_rehashes_old_kata_sandi_without_password_column(): void
    {
        Hash::setRounds(10);

        $admin = Admin::create([
            'nama' => 'Konservasi Bersenyum',
            'email' => 'konservasi.bersenyum@example.test',
            'kata_sandi' => 'password',
            'peran' => 'pengurus_ormada',
        ]);

        Hash::setRounds(12);

        $this->post(route('login'), [
            'email' => 'konservasi.bersenyum@example.test',
            'kata_sandi' => 'password',
        ])
            ->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($admin);
        $this->assertTrue(Hash::needsRehash($admin->kata_sandi));
        $this->assertFalse(Hash::needsRehash($admin->fresh()->kata_sandi));
    }

    public function test_login_rehashes_imported_dummy_hash_on_kata_sandi(): void
    {
        DB::table('admin')->insert([
            'nama' => 'Pengurus Konservasi Bersenyum',
            'email' => 'konservasi.bersenyum@gmail.com',
            'kata_sandi' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'peran' => 'pengurus_ormada',
            'dibuat_pada' => now(),
            'diperbarui_pada' => now(),
        ]);

        $admin = Admin::where('email', 'konservasi.bersenyum@gmail.com')->firstOrFail();

        $this->post(route('login'), [
            'email' => 'konservasi.bersenyum@gmail.com',
            'kata_sandi' => 'password',
        ])
            ->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($admin);
        $this->assertDatabaseMissing('admin', [
            'email' => 'konservasi.bersenyum@gmail.com',
            'kata_sandi' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
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
