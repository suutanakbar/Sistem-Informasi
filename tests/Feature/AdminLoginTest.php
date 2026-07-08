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

    public function test_admin_can_login_using_email_and_password(): void
    {
        $admin = Admin::create([
            'nama' => 'Admin Sistem',
            'email' => 'admin@example.test',
            'password' => bcrypt('password'),
            'peran' => 'admin',
        ]);

        $this->post(route('login'), [
            'email' => 'admin@example.test',
            'password' => 'password',
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
            'password' => bcrypt('password'),
            'peran' => 'pengurus_ormada',
        ]);

        $this->from(route('login'))
            ->post(route('login'), [
                'email' => 'pengurus@example.test',
                'password' => 'salah',
            ])
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_login_rehashes_old_password_without_password_column(): void
    {
        Hash::setRounds(10);

        $admin = Admin::create([
            'nama' => 'Konservasi Bersenyum',
            'email' => 'konservasi.bersenyum@example.test',
            'password' => bcrypt('password'),
            'peran' => 'pengurus_ormada',
        ]);

        Hash::setRounds(12);

        $this->post(route('login'), [
            'email' => 'konservasi.bersenyum@example.test',
            'password' => 'password',
        ])
            ->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($admin);
        $this->assertTrue(Hash::needsRehash($admin->password));
        $this->assertFalse(Hash::needsRehash($admin->fresh()->password));
    }

    public function test_login_rehashes_imported_dummy_hash_on_password(): void
    {
        DB::table('admin')->insert([
            'nama' => 'Pengurus Konservasi Bersenyum',
            'email' => 'konservasi.bersenyum@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'peran' => 'pengurus_ormada',
            'dibuat_pada' => now(),
            'diperbarui_pada' => now(),
        ]);

        $admin = Admin::where('email', 'konservasi.bersenyum@gmail.com')->firstOrFail();

        $this->post(route('login'), [
            'email' => 'konservasi.bersenyum@gmail.com',
            'password' => 'password',
        ])
            ->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($admin);
        $this->assertDatabaseMissing('admin', [
            'email' => 'konservasi.bersenyum@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
    }

    public function test_admin_can_logout(): void
    {
        $admin = Admin::create([
            'nama' => 'Pemda',
            'email' => 'pemda@example.test',
            'password' => bcrypt('password'),
            'peran' => 'pemda',
        ]);

        $this->actingAs($admin)
            ->post(route('logout'))
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }
}
