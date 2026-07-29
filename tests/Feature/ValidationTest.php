<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Agenda;
use App\Models\Aspirasi;
use App\Models\Postingan;
use App\Models\ProfilOrmada;
use App\Models\Proposal;
use App\Models\Volunteer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ValidationTest extends TestCase
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

        $this->admin = Admin::create([
            'nama' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'peran' => 'admin',
        ]);
    }

    /** @test */
    public function test_email_case_insensitive_duplicate_volunteer()
    {
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
            'kuota_volunteer' => 10,
            'deadline_pendaftaran' => now()->addDays(2),
        ]);

        // First registration with lowercase
        Volunteer::create([
            'agenda_id' => $agenda->id,
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'no_hp' => '081234567890',
            'status' => 'pending',
        ]);

        // Try to register with uppercase - should be rejected
        $response1 = $this->post(route('agenda.daftar-volunteer', $agenda), [
            'nama' => 'John Doe',
            'email' => 'JOHN@EXAMPLE.COM',
            'no_hp' => '081234567890',
        ]);
        
        // Should return redirect with error
        $response1->assertSessionHas('error');
        
        // Try with mixed case - should also be rejected
        $response2 = $this->post(route('agenda.daftar-volunteer', $agenda), [
            'nama' => 'John Doe',
            'email' => 'John@Example.COM',
            'no_hp' => '081234567890',
        ]);
        
        $response2->assertSessionHas('error');

        // Assert only 1 volunteer exists (no new registrations)
        $this->assertEquals(1, Volunteer::where('agenda_id', $agenda->id)->count());
    }

    /** @test */
    public function test_proposal_rejects_exe_file_with_pdf_extension()
    {
        $pemda = Admin::create([
            'nama' => 'Pemda Target',
            'email' => 'pemda@target.com',
            'password' => bcrypt('password'),
            'peran' => 'pemda',
        ]);

        $this->actingAs($this->pengurus)
            ->post(route('proposal.store'), [
                'dinas_tujuan_id' => $pemda->id,
                'judul_kegiatan' => 'Proposal Test',
                'deskripsi_kegiatan' => 'Test',
                'jenis_bantuan' => 'dana',
                'file_proposal' => UploadedFile::fake()->create('proposal.exe', 100),
            ])
            ->assertSessionHasErrors('file_proposal');
    }

    /** @test */
    public function test_proposal_rejects_pdf_file_too_large()
    {
        $pemda = Admin::create([
            'nama' => 'Pemda Target',
            'email' => 'pemda2@target.com',
            'password' => bcrypt('password'),
            'peran' => 'pemda',
        ]);

        $this->actingAs($this->pengurus)
            ->post(route('proposal.store'), [
                'dinas_tujuan_id' => $pemda->id,
                'judul_kegiatan' => 'Proposal Test',
                'deskripsi_kegiatan' => 'Test',
                'jenis_bantuan' => 'dana',
                'file_proposal' => UploadedFile::fake()->create('proposal.pdf', 6000), // 6MB
            ])
            ->assertSessionHasErrors('file_proposal');
    }

    /** @test */
    public function test_postingan_rejects_foto_too_large()
    {
        $this->actingAs($this->pengurus)
            ->post(route('postingan.store'), [
                'judul' => 'Postingan Test',
                'isi_konten' => 'Test content',
                'jenis_konten' => 'berita',
                'foto' => UploadedFile::fake()->create('foto.jpg', 3000), // 3MB
            ])
            ->assertSessionHasErrors('foto');
    }

    /** @test */
    public function test_agenda_rejects_poster_too_large()
    {
        $this->actingAs($this->pengurus)
            ->post(route('agenda.store'), [
                'nama_agenda' => 'Agenda Test',
                'kategori' => 'kegiatan_ormada',
                'deskripsi_agenda' => 'Test',
                'gambar_poster' => UploadedFile::fake()->create('poster.jpg', 3000), // 3MB
                'waktu_mulai' => now()->addDays(5),
                'waktu_selesai' => now()->addDays(6),
                'tempat' => 'Test',
            ])
            ->assertSessionHasErrors('gambar_poster');
    }

    /** @test */
    public function test_proposal_accepts_valid_pdf_file()
    {
        $pemda = Admin::create([
            'nama' => 'Pemda Valid',
            'email' => 'pemda@valid.com',
            'password' => bcrypt('password'),
            'peran' => 'pemda',
        ]);

        Storage::fake('public');

        $this->actingAs($this->pengurus)
            ->post(route('proposal.store'), [
                'dinas_tujuan_id' => $pemda->id,
                'judul_kegiatan' => 'Proposal Valid',
                'deskripsi_kegiatan' => 'Test',
                'jenis_bantuan' => 'dana',
                'file_proposal' => UploadedFile::fake()->create('proposal.pdf', 100),
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('proposal', [
            'judul_kegiatan' => 'Proposal Valid',
        ]);
    }
}