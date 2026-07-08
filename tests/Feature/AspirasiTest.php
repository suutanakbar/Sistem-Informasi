<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\ProfilOrmada;
use App\Models\Aspirasi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AspirasiTest extends TestCase
{
    use RefreshDatabase;

    private Admin $pengurus;
    private Admin $pemda;
    private Admin $admin;
    private ProfilOrmada $profilOrmada;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test accounts
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

        // Create profil ormada
        $this->profilOrmada = ProfilOrmada::create([
            'admin_id' => $this->pengurus->id,
            'nama_universitas' => 'Universitas Test',
            'alamat_universitas' => 'Jl. Test No. 1',
            'deskripsi' => 'Deskripsi test',
            'total_mahasiswa_univ' => 1000,
        ]);
    }

    public function test_pengurus_bisa_membuat_aspirasi(): void
    {
        $this->actingAs($this->pengurus);
        
        $response = $this->post(route('aspirasi.store'), [
            'topik_aspirasi' => 'Aspirasi Test',
            'detail_aspirasi' => 'Detail aspirasi test',
        ]);
        
        $response->assertRedirect();
        $this->assertDatabaseHas('aspirasi', ['topik_aspirasi' => 'Aspirasi Test']);
    }

    public function test_pengurus_bisa_melihat_aspirasi_miliknya(): void
    {
        $aspirasi = Aspirasi::create([
            'profil_ormada_id' => $this->profilOrmada->id,
            'topik_aspirasi' => 'Aspirasi Test',
            'detail_aspirasi' => 'Detail',
        ]);
        
        $this->actingAs($this->pengurus);
        
        $response = $this->get(route('aspirasi.show', $aspirasi));
        $response->assertStatus(200);
    }

    public function test_pengurus_tidak_bisa_melihat_aspirasi_ormada_lain(): void
    {
        $pengurusLain = Admin::create([
            'nama' => 'Pengurus Lain',
            'email' => 'pengurus_lain@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pengurus_ormada',
        ]);
        
        $profilLain = ProfilOrmada::create([
            'admin_id' => $pengurusLain->id,
            'nama_universitas' => 'Universitas Lain',
            'alamat_universitas' => 'Jl. Lain No. 1',
            'deskripsi' => 'Deskripsi lain',
            'total_mahasiswa_univ' => 500,
        ]);
        
        $aspirasi = Aspirasi::create([
            'profil_ormada_id' => $profilLain->id,
            'topik_aspirasi' => 'Aspirasi Lain',
            'detail_aspirasi' => 'Detail',
        ]);
        
        $this->actingAs($this->pengurus);
        
        $response = $this->get(route('aspirasi.show', $aspirasi));
        $response->assertStatus(403);
    }

    public function test_pemda_bisa_menanggapi_aspirasi(): void
    {
        $aspirasi = Aspirasi::create([
            'profil_ormada_id' => $this->profilOrmada->id,
            'topik_aspirasi' => 'Aspirasi Test',
            'detail_aspirasi' => 'Detail',
        ]);
        
        $this->actingAs($this->pemda);
        
        $response = $this->patch(route('aspirasi.update-tanggapan', $aspirasi), [
            'tanggapan_pemda' => 'Tanggapan dari Pemda',
            'status' => 'selesai',
        ]);
        
        $response->assertRedirect();
        $this->assertDatabaseHas('aspirasi', [
            'id' => $aspirasi->id,
            'tanggapan_pemda' => 'Tanggapan dari Pemda',
            'status' => 'selesai',
        ]);
    }

    public function test_public_bisa_melihat_aspirasi_publik(): void
    {
        // Test aspirasi yang belum ditanggapi
        $aspirasi1 = Aspirasi::create([
            'profil_ormada_id' => $this->profilOrmada->id,
            'topik_aspirasi' => 'Aspirasi Belum Ditanggapi',
            'detail_aspirasi' => 'Detail',
        ]);
        
        // Test aspirasi yang sudah ditanggapi
        $aspirasi2 = Aspirasi::create([
            'profil_ormada_id' => $this->profilOrmada->id,
            'topik_aspirasi' => 'Aspirasi Sudah Ditanggapi',
            'detail_aspirasi' => 'Detail',
            'tanggapan_pemda' => 'Tanggapan',
            'status' => 'selesai',
        ]);
        
        $response = $this->get(route('public.aspirasi'));
        $response->assertStatus(200);
        $response->assertSee('Aspirasi Belum Ditanggapi');
        $response->assertSee('Aspirasi Sudah Ditanggapi');
    }

    public function test_admin_bisa_mengelola_semua_aspirasi(): void
    {
        $aspirasi = Aspirasi::create([
            'profil_ormada_id' => $this->profilOrmada->id,
            'topik_aspirasi' => 'Aspirasi Test',
            'detail_aspirasi' => 'Detail',
        ]);
        
        $this->actingAs($this->admin);
        
        // Admin bisa edit
        $response = $this->get(route('aspirasi.edit', $aspirasi));
        $response->assertStatus(200);
        
        // Admin bisa update
        $response = $this->put(route('aspirasi.update', $aspirasi), [
            'topik_aspirasi' => 'Aspirasi Updated',
            'detail_aspirasi' => 'Detail updated',
        ]);
        $response->assertRedirect();
        $this->assertDatabaseHas('aspirasi', ['topik_aspirasi' => 'Aspirasi Updated']);
        
        // Admin bisa delete
        $response = $this->delete(route('aspirasi.destroy', $aspirasi));
        $response->assertRedirect();
        $this->assertDatabaseMissing('aspirasi', ['id' => $aspirasi->id]);
    }

    public function test_pengurus_bisa_mengupload_file(): void
    {
        Storage::fake('public');
        
        $this->actingAs($this->pengurus);
        
        $file = UploadedFile::fake()->create('document.pdf', 100);
        
        $response = $this->post(route('aspirasi.store'), [
            'topik_aspirasi' => 'Aspirasi dengan File',
            'detail_aspirasi' => 'Detail',
            'file' => $file,
        ]);
        
        $response->assertRedirect();
        $this->assertDatabaseHas('aspirasi', [
            'topik_aspirasi' => 'Aspirasi dengan File',
        ]);
        
        $aspirasi = Aspirasi::where('topik_aspirasi', 'Aspirasi dengan File')->first();
        $this->assertNotNull($aspirasi->file);
    }
}