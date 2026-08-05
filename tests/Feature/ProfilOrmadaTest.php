<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\AnggotaOrmada;
use App\Models\ProfilOrmada;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfilOrmadaTest extends TestCase
{
    use RefreshDatabase;

    // Helper: create pengurus with profil
    private function createPengurusWithProfil(array $profilData = []): array
    {
        $pengurus = Admin::create([
            'nama' => 'Pengurus Test',
            'email' => 'pengurus@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pengurus_ormada',
        ]);

        $profil = ProfilOrmada::create(array_merge([
            'admin_id' => $pengurus->id,
            'nama_universitas' => 'Universitas Test',
            'alamat_universitas' => 'Jl. Test No. 1',
            'total_mahasiswa_univ' => 1000,
            'deskripsi' => 'Deskripsi test',
        ], $profilData));

        return [$pengurus, $profil];
    }

    // Helper: create admin
    private function createAdmin(): Admin
    {
        return Admin::create([
            'nama' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'peran' => 'admin',
        ]);
    }

    // Helper: create pemda
    private function createPemda(): Admin
    {
        return Admin::create([
            'nama' => 'Pemda Test',
            'email' => 'pemda@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pemda',
        ]);
    }

    /** @test */
    public function pengurus_bisa_create_profil_miliknya_sendiri(): void
    {
        $pengurus = Admin::create([
            'nama' => 'Pengurus Baru',
            'email' => 'pengurus-baru@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pengurus_ormada',
        ]);

        $this->actingAs($pengurus)
            ->post(route('profil-ormada.store'), [
                'nama_universitas' => 'Universitas Negeri Semarang',
                'alamat_universitas' => 'Sekaran, Semarang',
                'total_mahasiswa_univ' => 40000,
                'deskripsi' => 'Ormada mahasiswa Temanggung di Semarang.',
            ])
            ->assertRedirect()
            ->assertSessionHas('status', 'Profil ormada berhasil dibuat.');

        $this->assertDatabaseHas('profil_ormada', [
            'admin_id' => $pengurus->id,
            'nama_universitas' => 'Universitas Negeri Semarang',
            'alamat_universitas' => 'Sekaran, Semarang',
        ]);
    }

    /** @test */
    public function pengurus_tidak_bisa_create_profil_kedua_jika_sudah_punya_satu(): void
    {
        [$pengurus, $profil] = $this->createPengurusWithProfil();

        $this->actingAs($pengurus)
            ->post(route('profil-ormada.store'), [
                'nama_universitas' => 'Universitas Kedua',
                'alamat_universitas' => 'Jl. Dua',
                'deskripsi' => 'Profil kedua',
            ])
            ->assertStatus(403);

        $this->assertDatabaseMissing('profil_ormada', [
            'admin_id' => $pengurus->id,
            'nama_universitas' => 'Universitas Kedua',
        ]);
    }

    /** @test */
    public function pengurus_tidak_bisa_edit_profil_pengurus_lain(): void
    {
        [$pengurus1, $profil1] = $this->createPengurusWithProfil();
        $pengurus2 = Admin::create([
            'nama' => 'Pengurus Lain',
            'email' => 'pengurus-lain@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pengurus_ormada',
        ]);

        $this->actingAs($pengurus2)
            ->put(route('profil-ormada.update', $profil1), [
                'nama_universitas' => 'Hacked Name',
                'alamat_universitas' => 'Hacked Address',
            ])
            ->assertStatus(403);

        $this->assertDatabaseHas('profil_ormada', [
            'id' => $profil1->id,
            'nama_universitas' => 'Universitas Test',
        ]);
    }

    /** @test */
    public function pengurus_tidak_bisa_lihat_profil_pengurus_lain(): void
    {
        [$pengurus1, $profil1] = $this->createPengurusWithProfil();
        $pengurus2 = Admin::create([
            'nama' => 'Pengurus Lain',
            'email' => 'pengurus-lain2@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pengurus_ormada',
        ]);

        $this->actingAs($pengurus2)
            ->get(route('profil-ormada.show', $profil1))
            ->assertStatus(403);
    }

    /** @test */
    public function admin_bisa_kelola_semua_profil(): void
    {
        $admin = $this->createAdmin();
        [$pengurus, $profil] = $this->createPengurusWithProfil();

        // Admin can view any profil
        $this->actingAs($admin)
            ->get(route('profil-ormada.show', $profil))
            ->assertStatus(200)
            ->assertSee('Universitas Test');

        // Admin can edit any profil
        $this->actingAs($admin)
            ->put(route('profil-ormada.update', $profil), [
                'nama_universitas' => 'Updated by Admin',
                'alamat_universitas' => 'Updated Address',
            ])
            ->assertRedirect(route('profil-ormada.show', $profil));

        $this->assertDatabaseHas('profil_ormada', [
            'id' => $profil->id,
            'nama_universitas' => 'Updated by Admin',
        ]);
    }

    /** @test */
    public function pemda_hanya_bisa_lihat_profil_tanpa_edit(): void
    {
        $pemda = $this->createPemda();
        [$pengurus, $profil] = $this->createPengurusWithProfil();

        // Pemda can view profil
        $this->actingAs($pemda)
            ->get(route('profil-ormada.show', $profil))
            ->assertStatus(200)
            ->assertSee('Universitas Test');

        // Pemda cannot edit profil
        $this->actingAs($pemda)
            ->put(route('profil-ormada.update', $profil), [
                'nama_universitas' => 'Hacked by Pemda',
                'alamat_universitas' => $profil->alamat_universitas,
            ])
            ->assertStatus(403);

        // Pemda cannot access edit form
        $this->actingAs($pemda)
            ->get(route('profil-ormada.edit', $profil))
            ->assertStatus(403);
    }

    /** @test */
    public function publik_bisa_lihat_versi_ringkas_via_ormada_route(): void
    {
        [$pengurus, $profil] = $this->createPengurusWithProfil();

        $this->get(route('public.ormada'))
            ->assertStatus(200)
            ->assertSee('Universitas Test');

        $this->get(route('public.ormada.show', $profil))
            ->assertStatus(200)
            ->assertSee('Universitas Test')
            ->assertSee('Deskripsi test');
    }

    /** @test */
    public function validation_error_field_wajib_kosong(): void
    {
        $pengurus = Admin::create([
            'nama' => 'Pengurus Validasi',
            'email' => 'pengurus-validasi@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pengurus_ormada',
        ]);

        $this->actingAs($pengurus)
            ->post(route('profil-ormada.store'), [
                'alamat_universitas' => 'Jl. Test',
                // nama_universitas missing
            ])
            ->assertSessionHasErrors('nama_universitas');

        $this->actingAs($pengurus)
            ->post(route('profil-ormada.store'), [
                'nama_universitas' => 'Test Univ',
                // alamat_universitas missing
            ])
            ->assertSessionHasErrors('alamat_universitas');
    }

    /** @test */
    public function validation_error_format_salah(): void
    {
        $pengurus = Admin::create([
            'nama' => 'Pengurus Format',
            'email' => 'pengurus-format@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pengurus_ormada',
        ]);

        // total_mahasiswa_univ should be integer, not string
        $this->actingAs($pengurus)
            ->post(route('profil-ormada.store'), [
                'nama_universitas' => 'Test Univ',
                'alamat_universitas' => 'Jl. Test',
                'total_mahasiswa_univ' => 'bukan angka',
            ])
            ->assertSessionHasErrors('total_mahasiswa_univ');
    }

    /** @test */
    public function upload_logo_tipe_file_salah(): void
    {
        $pengurus = Admin::create([
            'nama' => 'Pengurus Upload',
            'email' => 'pengurus-upload@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pengurus_ormada',
        ]);

        $file = UploadedFile::fake()->create('logo.exe', 100);

        $this->actingAs($pengurus)
            ->post(route('profil-ormada.store'), [
                'nama_universitas' => 'Test Univ',
                'alamat_universitas' => 'Jl. Test',
                'logo' => $file,
            ])
            ->assertSessionHasErrors('logo');
    }

    /** @test */
    public function upload_logo_ukuran_melebihi_batas(): void
    {
        if (!function_exists('imagecreatetruecolor')) {
            $this->markTestSkipped('GD extension is not installed.');
        }

        $pengurus = Admin::create([
            'nama' => 'Pengurus Upload',
            'email' => 'pengurus-upload2@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pengurus_ormada',
        ]);

        // Create file larger than 2048KB (2MB)
        $file = UploadedFile::fake()->image('logo.jpg')->size(3000);

        $this->actingAs($pengurus)
            ->post(route('profil-ormada.store'), [
                'nama_universitas' => 'Test Univ',
                'alamat_universitas' => 'Jl. Test',
                'logo' => $file,
            ])
            ->assertSessionHasErrors('logo');
    }

    /** @test */
    public function upload_logo_valid_berhasil(): void
    {
        if (!function_exists('imagecreatetruecolor')) {
            $this->markTestSkipped('GD extension is not installed.');
        }

        Storage::fake('public');

        $pengurus = Admin::create([
            'nama' => 'Pengurus Upload',
            'email' => 'pengurus-upload3@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pengurus_ormada',
        ]);

        $file = UploadedFile::fake()->image('logo.jpg', 500);

        $this->actingAs($pengurus)
            ->post(route('profil-ormada.store'), [
                'nama_universitas' => 'Test Univ',
                'alamat_universitas' => 'Jl. Test',
                'logo' => $file,
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('profil_ormada', [
            'admin_id' => $pengurus->id,
            'nama_universitas' => 'Test Univ',
        ]);

        // Verify file was stored
        $profil = ProfilOrmada::where('admin_id', $pengurus->id)->first();
        $this->assertNotNull($profil->logo);
    }
}