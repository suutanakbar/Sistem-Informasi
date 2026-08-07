<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test admin creation via controller stores hashed password.
     */
    public function test_admin_creation_via_controller_hashes_password(): void
    {
        // Create initial admin for authentication
        $initialAdmin = Admin::create([
            'nama' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
            'peran' => 'admin',
        ]);

        $this->actingAs($initialAdmin);

        $response = $this->post(route('admin.store'), [
            'nama' => 'Test Admin',
            'email' => 'testadmin@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'peran' => 'admin',
        ]);

        $response->assertRedirect(route('admin.index'));
        $response->assertSessionHas('status', 'Admin berhasil ditambahkan.');

        $admin = Admin::where('email', 'testadmin@example.com')->first();
        $this->assertNotNull($admin);
        $this->assertNotEquals('password123', $admin->password);
        $this->assertTrue(Hash::check('password123', $admin->password));
    }

    /**
     * Test admin login with password created via controller.
     */
    public function test_admin_login_after_controller_creation(): void
    {
        // Create admin via factory (simulating controller creation with hashed cast)
        $admin = Admin::factory()->create([
            'nama' => 'Login Test Admin',
            'email' => 'logintest@example.com',
            'password' => 'securepassword',
            'peran' => 'admin',
        ]);

        // Attempt login
        $response = $this->post(route('login'), [
            'email' => 'logintest@example.com',
            'password' => 'securepassword',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($admin);
    }

    /**
     * Test admin update via controller hashes password when changed.
     */
    public function test_admin_update_hashes_password_when_changed(): void
    {
        $admin = Admin::factory()->create([
            'email' => 'updatetest@example.com',
            'password' => 'oldpassword',
            'peran' => 'admin',
        ]);

        $this->actingAs($admin);

        $response = $this->put(route('admin.update', $admin), [
            'nama' => $admin->nama,
            'email' => $admin->email,
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
            'peran' => $admin->peran,
        ]);

        $response->assertRedirect(route('admin.index'));

        $admin->refresh();
        $this->assertNotEquals('newpassword', $admin->password);
        $this->assertTrue(Hash::check('newpassword', $admin->password));
    }

    /**
     * Test admin update does not change password when empty.
     */
    public function test_admin_update_preserves_password_when_empty(): void
    {
        $admin = Admin::factory()->create([
            'email' => 'preservetest@example.com',
            'password' => 'originalpassword',
            'peran' => 'admin',
        ]);

        $originalPasswordHash = $admin->password;

        $this->actingAs($admin);

        $response = $this->put(route('admin.update', $admin), [
            'nama' => 'Updated Name',
            'email' => $admin->email,
            'password' => '',
            'password_confirmation' => '',
            'peran' => $admin->peran,
        ]);

        $response->assertRedirect(route('admin.index'));

        $admin->refresh();
        $this->assertEquals($originalPasswordHash, $admin->password);
    }
}
