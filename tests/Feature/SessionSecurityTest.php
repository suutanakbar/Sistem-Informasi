<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SessionSecurityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_session_id_regenerated_after_login()
    {
        $admin = Admin::create([
            'nama' => 'Test Admin',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'peran' => 'admin',
        ]);

        // Visit login page to start session
        $this->get('/login');
        $oldSessionId = session()->getId();

        // Attempt login
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard'));
        
        // Verify user is authenticated
        $this->assertAuthenticated();

        // Session ID should be different after login
        $newSessionId = session()->getId();
        $this->assertNotEquals($oldSessionId, $newSessionId);
    }

    /** @test */
    public function test_login_form_contains_csrf_token()
    {
        $response = $this->get('/login');
        
        $response->assertStatus(200);
        
        // Verify CSRF token field is present in the form
        $response->assertSee('_token');
    }

    /** @test */
    public function test_logout_invalidates_session()
    {
        $admin = Admin::create([
            'nama' => 'Test Admin',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'peran' => 'admin',
        ]);

        // Login first
        $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $sessionBeforeLogout = session()->getId();

        // Logout
        $response = $this->post('/logout');
        
        $response->assertRedirect(route('login'));
        $this->assertGuest();

        // Session should be invalidated (new session ID)
        $sessionAfterLogout = session()->getId();
        $this->assertNotEquals($sessionBeforeLogout, $sessionAfterLogout);
    }
}