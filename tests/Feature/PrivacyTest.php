<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Agenda;
use App\Models\AnggotaOrmada;
use App\Models\ProfilOrmada;
use App\Models\Volunteer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PrivacyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->pengurus = Admin::create([
            'nama' => 'Pengurus Test',
            'email' => 'pengurus@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pengurus_ormada',
        ]);

        $this->pemda = Admin::create([
            'nama' => 'Pemda Test',
            'email' => 'pemda@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pemda',
        ]);
    }

    /** @test */
    public function test_public_ormada_page_does_not_expose_nim_and_phone()
    {
        $profil = ProfilOrmada::create([
            'admin_id' => $this->pengurus->id,
            'nama_universitas' => 'Universitas Test',
            'alamat_universitas' => 'Test Address',
        ]);

        $anggota = AnggotaOrmada::create([
            'profil_ormada_id' => $profil->id,
            'nama_lengkap' => 'John Doe',
            'nim' => '12345678',
            'no_hp' => '081234567890',
            'program_studi' => 'Teknik Informatika',
            'status_aktif' => 'mahasiswa_biasa',
        ]);

        $response = $this->get(route('public.ormada.show', $profil));

        $response->assertStatus(200);
        
        // Assert NIM is NOT in the response
        $response->assertDontSee('12345678');
        
        // Assert phone number is NOT in the response
        $response->assertDontSee('081234567890');
        
        // Assert name IS in the response (public info)
        $response->assertSee('John Doe');
    }

    /** @test */
    public function test_public_ormada_list_does_not_expose_nim_and_phone()
    {
        $profil = ProfilOrmada::create([
            'admin_id' => $this->pengurus->id,
            'nama_universitas' => 'Universitas Test',
            'alamat_universitas' => 'Test Address',
        ]);

        $anggota = AnggotaOrmada::create([
            'profil_ormada_id' => $profil->id,
            'nama_lengkap' => 'Jane Smith',
            'nim' => '87654321',
            'no_hp' => '089876543210',
            'program_studi' => 'Sistem Informasi',
            'status_aktif' => 'mahasiswa_biasa',
        ]);

        $response = $this->get(route('public.ormada'));

        $response->assertStatus(200);
        
        // Assert NIM is NOT in the response
        $response->assertDontSee('87654321');
        
        // Assert phone number is NOT in the response
        $response->assertDontSee('089876543210');
        
        // Assert university name IS in the response
        $response->assertSee('Universitas Test');
    }

    /** @test */
    public function test_public_agenda_does_not_expose_volunteer_sensitive_data()
    {
        $agenda = Agenda::create([
            'admin_id' => $this->pemda->id,
            'nama_agenda' => 'Test Agenda Privacy',
            'kategori' => 'kegiatan_ormada',
            'deskripsi_agenda' => 'Test',
            'waktu_mulai' => now()->addDays(5),
            'waktu_selesai' => now()->addDays(6),
            'tempat' => 'Test',
            'is_published' => true,
            'tanggal_publish' => now(),
            'kuota_volunteer' => 10,
            'deadline_pendaftaran' => now()->addDays(2),
        ]);

        $volunteer = Volunteer::create([
            'agenda_id' => $agenda->id,
            'nama' => 'Test Volunteer',
            'email' => 'testvolunteer@example.com',
            'no_hp' => '081234567890',
            'status' => 'diterima',
        ]);

        $response = $this->get(route('public.agenda.show', $agenda));

        $response->assertStatus(200);
        
        // Verify the page loads successfully
        $response->assertSee('Test Agenda Privacy'); // Agenda title is shown
        
        // Verify volunteer email is NOT exposed
        $response->assertDontSee('testvolunteer@example.com');
        
        // Verify volunteer phone is NOT exposed
        $response->assertDontSee('081234567890');
    }

    /** @test */
    public function test_anggota_model_sensitive_fields_are_identified()
    {
        $profil = ProfilOrmada::create([
            'admin_id' => $this->pengurus->id,
            'nama_universitas' => 'Universitas Test',
            'alamat_universitas' => 'Test Address',
        ]);

        $anggota = AnggotaOrmada::create([
            'profil_ormada_id' => $profil->id,
            'nama_lengkap' => 'John Doe',
            'nim' => '12345678',
            'no_hp' => '081234567890',
            'email' => 'john@example.com',
            'program_studi' => 'Teknik Informatika',
            'status_aktif' => 'mahasiswa_biasa',
        ]);

        $anggotaData = $anggota->toArray();

        // Public fields that are safe to display
        $this->assertArrayHasKey('nama_lengkap', $anggotaData);
        $this->assertArrayHasKey('program_studi', $anggotaData);
        $this->assertArrayHasKey('status_aktif', $anggotaData);
        
        // Sensitive fields that should be filtered in public views
        $this->assertArrayHasKey('nim', $anggotaData);
        $this->assertArrayHasKey('no_hp', $anggotaData);
        $this->assertArrayHasKey('email', $anggotaData);
        
        // This test documents which fields need to be filtered in public views
        // Implementation should use API Resources or view composers to filter these
    }
}