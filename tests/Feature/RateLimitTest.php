<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Agenda;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RateLimitTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->pemda = Admin::create([
            'nama' => 'Pemda Test',
            'email' => 'pemda@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pemda',
        ]);
    }

    /** @test */
    public function test_volunteer_registration_rate_limited()
    {
        // Create an agenda with volunteer quota
        $agenda = Agenda::create([
            'admin_id' => $this->pemda->id,
            'nama_agenda' => 'Test Agenda',
            'kategori' => 'kegiatan_ormada',
            'deskripsi_agenda' => 'Test',
            'waktu_mulai' => now()->addDays(5),
            'waktu_selesai' => now()->addDays(6),
            'tempat' => 'Test',
            'is_published' => true,
            'tanggal_publish' => now(),
            'kuota_volunteer' => 100,
            'deadline_pendaftaran' => now()->addDays(2),
        ]);

        // Make 5 requests (should succeed - limit is 5 per minute)
        for ($i = 0; $i < 5; $i++) {
            $response = $this->post(route('agenda.daftar-volunteer', $agenda), [
                'nama' => "Volunteer $i",
                'email' => "volunteer$i@test.com",
                'no_hp' => '081234567890',
                'alasan' => 'Test',
            ]);
            
            // Should succeed (200 or redirect)
            $this->assertTrue($response->getStatusCode() === 200 || $response->getStatusCode() === 302);
        }

        // 6th request should be rate limited
        $response = $this->post(route('agenda.daftar-volunteer', $agenda), [
            'nama' => 'Volunteer 6',
            'email' => 'volunteer6@test.com',
            'no_hp' => '081234567890',
            'alasan' => 'Test',
        ]);

        // Should return 429 (Too Many Requests)
        $response->assertStatus(429);
    }

}