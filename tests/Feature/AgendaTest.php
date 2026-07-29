<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Agenda;
use App\Models\Volunteer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AgendaTest extends TestCase
{
    use RefreshDatabase;

    private Admin $admin;
    private Admin $pemda;
    private Admin $pengurus;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = Admin::factory()->create(['peran' => 'admin']);
        $this->pemda = Admin::factory()->create(['peran' => 'pemda']);
        $this->pengurus = Admin::factory()->create(['peran' => 'pengurus_ormada']);
    }

    public function test_pengurus_bisa_membuat_agenda(): void
    {
        $this->actingAs($this->pengurus);

        $response = $this->post(route('agenda.store'), [
            'nama_agenda' => 'Test Agenda',
            'kategori' => 'kegiatan_ormada',
            'deskripsi_agenda' => 'Ini adalah test agenda.',
            'waktu_mulai' => '2024-12-01T08:00',
            'waktu_selesai' => '2024-12-01T12:00',
            'tempat' => 'Gedung Serbaguna',
        ]);

        $response->assertRedirect(route('agenda.index'));
        $this->assertDatabaseHas('agenda', [
            'nama_agenda' => 'Test Agenda',
            'admin_id' => $this->pengurus->id,
        ]);
    }

    public function test_pengurus_bisa_melihat_agenda_miliknya(): void
    {
        $agenda = Agenda::factory()->create(['admin_id' => $this->pengurus->id]);

        $this->actingAs($this->pengurus);
        $response = $this->get(route('agenda.show', $agenda));

        $response->assertStatus(200);
        $response->assertSee($agenda->nama_agenda);
    }

    public function test_pengurus_tidak_bisa_melihat_agenda_ormada_lain(): void
    {
        $agenda = Agenda::factory()->create(['admin_id' => $this->pengurus->id]);

        $pengurusLain = Admin::factory()->create(['peran' => 'pengurus_ormada']);
        $this->actingAs($pengurusLain);

        $response = $this->get(route('agenda.show', $agenda));

        $response->assertStatus(403);
    }

    public function test_pemda_bisa_publish_agenda(): void
    {
        $agenda = Agenda::factory()->create(['admin_id' => $this->pengurus->id]);

        $this->actingAs($this->pemda);
        $response = $this->patch(route('agenda.publish', $agenda));

        $response->assertSessionHas('status');
        $this->assertDatabaseHas('agenda', [
            'id' => $agenda->id,
            'is_published' => true,
        ]);
    }

    public function test_public_bisa_melihat_agenda_yang_published(): void
    {
        $agenda = Agenda::factory()->published()->create();

        $response = $this->get(route('public.agenda'));

        $response->assertStatus(200);
        $response->assertSee($agenda->nama_agenda);
    }

    public function test_public_tidak_bisa_melihat_agenda_yang_unpublished(): void
    {
        $agenda = Agenda::factory()->create(['is_published' => false]);

        $response = $this->get(route('public.agenda'));

        $response->assertStatus(200);
        $response->assertDontSee($agenda->nama_agenda);
    }

    public function test_admin_bisa_mengelola_semua_agenda(): void
    {
        $this->actingAs($this->admin);

        $response = $this->get(route('agenda.index'));
        $response->assertStatus(200);

        $agenda = Agenda::factory()->create();
        $response = $this->get(route('agenda.show', $agenda));
        $response->assertStatus(200);

        $response = $this->get(route('agenda.edit', $agenda));
        $response->assertStatus(200);
    }

    public function test_pengurus_bisa_upload_poster(): void
    {
        if (!function_exists('imagecreatetruecolor')) {
            $this->markTestSkipped('GD extension is not installed.');
        }

        Storage::fake('public');

        $this->actingAs($this->pengurus);

        $file = UploadedFile::fake()->image('poster.jpg');

        $response = $this->post(route('agenda.store'), [
            'nama_agenda' => 'Agenda dengan Poster',
            'kategori' => 'baksos',
            'deskripsi_agenda' => 'Kegiatan bakti sosial.',
            'waktu_mulai' => '2024-12-01T08:00',
            'waktu_selesai' => '2024-12-01T12:00',
            'tempat' => 'Lapangan Umum',
            'gambar_poster' => $file,
        ]);

        $response->assertRedirect(route('agenda.index'));
        
        $agenda = Agenda::where('nama_agenda', 'Agenda dengan Poster')->first();
        $this->assertNotNull($agenda->gambar_poster);
        Storage::disk('public')->assertExists($agenda->gambar_poster);
    }

    public function test_validasi_waktu_mulai_harus_sebelum_waktu_selesai(): void
    {
        $this->actingAs($this->pengurus);

        $response = $this->post(route('agenda.store'), [
            'nama_agenda' => 'Test Agenda',
            'kategori' => 'kegiatan_ormada',
            'deskripsi_agenda' => 'Test agenda.',
            'waktu_mulai' => '2024-12-02T08:00',
            'waktu_selesai' => '2024-12-01T12:00',
            'tempat' => 'Gedung Serbaguna',
        ]);

        $response->assertSessionHasErrors('waktu_selesai');
    }

    public function test_public_bisa_daftar_volunteer_jika_kuota_tersedia(): void
    {
        $agenda = Agenda::factory()->create([
            'kuota_volunteer' => 10,
            'deadline_pendaftaran' => now()->addDays(7),
            'is_published' => true,
            'tanggal_publish' => now(),
        ]);

        $response = $this->post(route('agenda.daftar-volunteer', $agenda), [
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'no_hp' => '081234567890',
            'alasan' => 'Ingin membantu kegiatan ini.',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('volunteers', [
            'agenda_id' => $agenda->id,
            'email' => 'john@example.com',
            'status' => 'pending',
        ]);
    }

    public function test_public_tidak_bisa_daftar_volunteer_jika_kuota_penuh(): void
    {
        $agenda = Agenda::factory()->create([
            'kuota_volunteer' => 1,
            'deadline_pendaftaran' => now()->addDays(7),
            'is_published' => true,
            'tanggal_publish' => now(),
        ]);

        Volunteer::factory()->create(['agenda_id' => $agenda->id, 'status' => 'diterima']);

        $response = $this->post(route('agenda.daftar-volunteer', $agenda), [
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'no_hp' => '081234567890',
            'alasan' => 'Ingin membantu.',
        ]);

        $response->assertSessionHas('error');
    }

    public function test_pemda_bisa_approve_volunteer(): void
    {
        $agenda = Agenda::factory()->create();
        $volunteer = Volunteer::factory()->create(['agenda_id' => $agenda->id, 'status' => 'pending']);

        $this->actingAs($this->pemda);
        $response = $this->patch(route('volunteer.update-status', $volunteer), [
            'status' => 'diterima',
        ]);

        $response->assertSessionHas('status');
        $this->assertDatabaseHas('volunteers', [
            'id' => $volunteer->id,
            'status' => 'diterima',
        ]);
    }

    public function test_validasi_kuota_volunteer_tidak_melebihi_kapasitas(): void
    {
        $this->actingAs($this->pengurus);

        $response = $this->post(route('agenda.store'), [
            'nama_agenda' => 'Test Agenda',
            'kategori' => 'kegiatan_ormada',
            'deskripsi_agenda' => 'Test agenda.',
            'waktu_mulai' => '2024-12-01T08:00',
            'waktu_selesai' => '2024-12-01T12:00',
            'tempat' => 'Gedung Serbaguna',
            'kuota_volunteer' => 0,
        ]);

        $response->assertSessionHasErrors('kuota_volunteer');
    }
}