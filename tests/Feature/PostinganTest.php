<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Postingan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostinganTest extends TestCase
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

    public function test_pengurus_bisa_membuat_postingan(): void
    {
        $this->actingAs($this->pengurus);

        $response = $this->post(route('postingan.store'), [
            'judul' => 'Test Postingan',
            'jenis_konten' => 'berita',
            'isi_konten' => 'Ini adalah test postingan.',
        ]);

        $response->assertRedirect(route('postingan.index'));
        $this->assertDatabaseHas('postingan', [
            'judul' => 'Test Postingan',
            'admin_id' => $this->pengurus->id,
        ]);
    }

    public function test_pengurus_bisa_melihat_postingan_miliknya(): void
    {
        $postingan = Postingan::factory()->create(['admin_id' => $this->pengurus->id]);

        $this->actingAs($this->pengurus);
        $response = $this->get(route('postingan.show', $postingan));

        $response->assertStatus(200);
        $response->assertSee($postingan->judul);
    }

    public function test_pengurus_tidak_bisa_melihat_postingan_ormada_lain(): void
    {
        $postingan = Postingan::factory()->create(['admin_id' => $this->pengurus->id]);

        $pengurusLain = Admin::factory()->create(['peran' => 'pengurus_ormada']);
        $this->actingAs($pengurusLain);

        $response = $this->get(route('postingan.show', $postingan));

        $response->assertStatus(403);
    }

    public function test_pemda_bisa_publish_postingan(): void
    {
        $postingan = Postingan::factory()->create(['admin_id' => $this->pengurus->id]);

        $this->actingAs($this->pemda);
        $response = $this->patch(route('postingan.publish', $postingan));

        $response->assertSessionHas('status');
        $this->assertDatabaseHas('postingan', [
            'id' => $postingan->id,
            'is_published' => true,
        ]);
    }

    public function test_public_bisa_melihat_postingan_yang_published(): void
    {
        $postingan = Postingan::factory()->published()->create();

        $response = $this->get(route('public.postingan'));

        $response->assertStatus(200);
        $response->assertSee($postingan->judul);
    }

    public function test_public_tidak_bisa_melihat_postingan_yang_unpublished(): void
    {
        $postingan = Postingan::factory()->create(['is_published' => false]);

        $response = $this->get(route('public.postingan'));

        $response->assertStatus(200);
        $response->assertDontSee($postingan->judul);
    }

    public function test_admin_bisa_mengelola_semua_postingan(): void
    {
        $this->actingAs($this->admin);

        $response = $this->get(route('postingan.index'));
        $response->assertStatus(200);

        $postingan = Postingan::factory()->create();
        $response = $this->get(route('postingan.show', $postingan));
        $response->assertStatus(200);

        $response = $this->get(route('postingan.edit', $postingan));
        $response->assertStatus(200);
    }

    public function test_pengurus_bisa_upload_foto(): void
    {
        Storage::fake('public');

        $this->actingAs($this->pengurus);

        $file = UploadedFile::fake()->image('foto.jpg');

        $response = $this->post(route('postingan.store'), [
            'judul' => 'Postingan dengan Foto',
            'jenis_konten' => 'prestasi',
            'isi_konten' => 'Konten postingan.',
            'foto' => $file,
        ]);

        $response->assertRedirect(route('postingan.index'));
        
        $postingan = Postingan::where('judul', 'Postingan dengan Foto')->first();
        $this->assertNotNull($postingan->foto);
        Storage::disk('public')->assertExists($postingan->foto);
    }
}