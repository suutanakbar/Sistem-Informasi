<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\AnggotaOrmada;
use App\Models\ProfilOrmada;
use App\Models\Proposal;
use App\Models\Aspirasi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SoftDeleteTest extends TestCase
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
    }

    /** @test */
    public function test_anggota_ormada_can_be_soft_deleted()
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

        // Verify anggota exists
        $this->assertDatabaseHas('anggota_ormada', [
            'id' => $anggota->id,
            'nama_lengkap' => 'John Doe',
        ]);

        // Soft delete the anggota
        $anggota->delete();

        // Verify anggota is soft deleted
        $this->assertSoftDeleted('anggota_ormada', [
            'id' => $anggota->id,
        ]);

        // Verify anggota doesn't appear in default query
        $this->assertNull(AnggotaOrmada::find($anggota->id));
        
        // Verify anggota can be found with trashed
        $this->assertNotNull(AnggotaOrmada::withTrashed()->find($anggota->id));
    }

    /** @test */
    public function test_profil_ormada_can_be_soft_deleted()
    {
        $profil = ProfilOrmada::create([
            'admin_id' => $this->pengurus->id,
            'nama_universitas' => 'Universitas Test',
            'alamat_universitas' => 'Test Address',
        ]);

        // Verify profil exists
        $this->assertDatabaseHas('profil_ormada', [
            'id' => $profil->id,
            'nama_universitas' => 'Universitas Test',
        ]);

        // Soft delete the profil
        $profil->delete();

        // Verify profil is soft deleted
        $this->assertSoftDeleted('profil_ormada', [
            'id' => $profil->id,
        ]);

        // Verify profil doesn't appear in default query
        $this->assertNull(ProfilOrmada::find($profil->id));
    }

    /** @test */
    public function test_proposal_can_be_soft_deleted()
    {
        // Create a second admin for dinas_tujuan_id (required field)
        $adminPemda = Admin::create([
            'nama' => 'Pemda Test',
            'email' => 'pemda@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pemda',
        ]);

        $proposal = Proposal::create([
            'admin_id' => $this->pengurus->id,
            'dinas_tujuan_id' => $adminPemda->id,
            'judul_kegiatan' => 'Test Proposal',
            'deskripsi_kegiatan' => 'Test description',
            'jenis_bantuan' => 'dana',
            'file_proposal' => 'test.pdf',
            'status' => 'diajukan',
        ]);

        // Verify proposal exists
        $this->assertDatabaseHas('proposal', [
            'id' => $proposal->id,
            'judul_kegiatan' => 'Test Proposal',
        ]);

        // Soft delete the proposal
        $proposal->delete();

        // Verify proposal is soft deleted
        $this->assertSoftDeleted('proposal', [
            'id' => $proposal->id,
        ]);

        // Verify proposal doesn't appear in default query
        $this->assertNull(Proposal::find($proposal->id));
    }

    /** @test */
    public function test_aspirasi_can_be_soft_deleted()
    {
        $profil = ProfilOrmada::create([
            'admin_id' => $this->pengurus->id,
            'nama_universitas' => 'Universitas Test',
            'alamat_universitas' => 'Test Address',
        ]);

        $aspirasi = Aspirasi::create([
            'profil_ormada_id' => $profil->id,
            'topik_aspirasi' => 'Test Aspirasi',
            'detail_aspirasi' => 'Test detail',
            'status' => 'belum_ditanggapi',
        ]);

        // Verify aspirasi exists
        $this->assertDatabaseHas('aspirasi', [
            'id' => $aspirasi->id,
            'topik_aspirasi' => 'Test Aspirasi',
        ]);

        // Soft delete the aspirasi
        $aspirasi->delete();

        // Verify aspirasi is soft deleted
        $this->assertSoftDeleted('aspirasi', [
            'id' => $aspirasi->id,
        ]);

        // Verify aspirasi doesn't appear in default query
        $this->assertNull(Aspirasi::find($aspirasi->id));
    }

    /** @test */
    public function test_soft_deleted_anggota_not_shown_in_public_views()
    {
        $profil = ProfilOrmada::create([
            'admin_id' => $this->pengurus->id,
            'nama_universitas' => 'Universitas Test',
            'alamat_universitas' => 'Test Address',
        ]);

        $anggota1 = AnggotaOrmada::create([
            'profil_ormada_id' => $profil->id,
            'nama_lengkap' => 'John Doe',
            'nim' => '12345678',
            'no_hp' => '081234567890',
            'program_studi' => 'Teknik Informatika',
            'status_aktif' => 'mahasiswa_biasa',
        ]);

        $anggota2 = AnggotaOrmada::create([
            'profil_ormada_id' => $profil->id,
            'nama_lengkap' => 'Jane Smith',
            'nim' => '87654321',
            'no_hp' => '089876543210',
            'program_studi' => 'Sistem Informasi',
            'status_aktif' => 'mahasiswa_biasa',
        ]);

        // Soft delete one anggota
        $anggota1->delete();

        // Verify only one anggota is visible in default query
        $visibleAnggota = AnggotaOrmada::where('profil_ormada_id', $profil->id)->get();
        $this->assertCount(1, $visibleAnggota);
        $this->assertEquals('Jane Smith', $visibleAnggota->first()->nama_lengkap);

        // Verify both are visible with trashed
        $allAnggota = AnggotaOrmada::withTrashed()->where('profil_ormada_id', $profil->id)->get();
        $this->assertCount(2, $allAnggota);
    }

    /** @test */
    public function test_soft_deleted_profil_not_shown_in_public_ormada_list()
    {
        $admin1 = Admin::create([
            'nama' => 'Admin 1',
            'email' => 'admin1@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pengurus_ormada',
        ]);

        $admin2 = Admin::create([
            'nama' => 'Admin 2',
            'email' => 'admin2@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pengurus_ormada',
        ]);

        $profil1 = ProfilOrmada::create([
            'admin_id' => $admin1->id,
            'nama_universitas' => 'Universitas Test 1',
            'alamat_universitas' => 'Test Address 1',
        ]);

        $profil2 = ProfilOrmada::create([
            'admin_id' => $admin2->id,
            'nama_universitas' => 'Universitas Test 2',
            'alamat_universitas' => 'Test Address 2',
        ]);

        // Soft delete one profil
        $profil1->delete();

        // Verify only one profil is visible
        $visibleProfil = ProfilOrmada::all();
        $this->assertCount(1, $visibleProfil);
        $this->assertEquals('Universitas Test 2', $visibleProfil->first()->nama_universitas);
    }
}