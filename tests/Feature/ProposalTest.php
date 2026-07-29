<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\ProfilOrmada;
use App\Models\Proposal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProposalTest extends TestCase
{
    use RefreshDatabase;

    private Admin $pengurus;
    private Admin $pemda;
    private Admin $admin;
    private ProfilOrmada $profilOrmada;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::create([
            'nama' => 'Admin Sistem',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'peran' => 'admin',
        ]);

        $this->pemda = Admin::create([
            'nama' => 'Pemda Test',
            'email' => 'pemda@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pemda',
        ]);

        $this->pengurus = Admin::create([
            'nama' => 'Pengurus Ormada',
            'email' => 'pengurus@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pengurus_ormada',
        ]);

        $this->profilOrmada = ProfilOrmada::create([
            'admin_id' => $this->pengurus->id,
            'nama_universitas' => 'Universitas Test',
            'alamat_universitas' => 'Jl. Test No. 1',
            'total_mahasiswa_univ' => 100,
        ]);
    }

    public function test_pengurus_bisa_melihat_daftar_proposal(): void
    {
        $this->actingAs($this->pengurus);

        $response = $this->get(route('proposal.index'));

        $response->assertStatus(200);
        $response->assertViewIs('pengurus.proposal.index');
    }

    public function test_pengurus_bisa_membuat_proposal(): void
    {
        Storage::fake('public');

        $this->actingAs($this->pengurus);

        $response = $this->post(route('proposal.store'), [
            'dinas_tujuan_id' => $this->pemda->id,
            'judul_kegiatan' => 'Kegiatan Test',
            'deskripsi_kegiatan' => 'Deskripsi kegiatan test',
            'jenis_bantuan' => 'dana',
            'anggaran_dibutuhkan' => 1000000,
            'file_proposal' => UploadedFile::fake()->create('proposal.pdf', 1000),
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('proposal', [
            'judul_kegiatan' => 'Kegiatan Test',
            'admin_id' => $this->pengurus->id,
            'dinas_tujuan_id' => $this->pemda->id,
            'status' => 'diajukan',
        ]);
    }

    public function test_pengurus_bisa_melihat_detail_proposal_miliknya(): void
    {
        $proposal = Proposal::create([
            'admin_id' => $this->pengurus->id,
            'dinas_tujuan_id' => $this->pemda->id,
            'judul_kegiatan' => 'Kegiatan Test',
            'deskripsi_kegiatan' => 'Deskripsi',
            'jenis_bantuan' => 'dana',
            'anggaran_dibutuhkan' => 1000000,
            'file_proposal' => 'proposal/test.pdf',
            'status' => 'diajukan',
        ]);

        $this->actingAs($this->pengurus);

        $response = $this->get(route('proposal.show', $proposal));

        $response->assertStatus(200);
        $response->assertViewIs('pengurus.proposal.show');
        $response->assertSee('Kegiatan Test');
    }

    public function test_pemda_bisa_melihat_proposal_yang_ditujukan_kepadanya(): void
    {
        $proposal = Proposal::create([
            'admin_id' => $this->pengurus->id,
            'dinas_tujuan_id' => $this->pemda->id,
            'judul_kegiatan' => 'Kegiatan Test',
            'deskripsi_kegiatan' => 'Deskripsi',
            'jenis_bantuan' => 'dana',
            'anggaran_dibutuhkan' => 1000000,
            'file_proposal' => 'proposal/test.pdf',
            'status' => 'diajukan',
        ]);

        $this->actingAs($this->pemda);

        $response = $this->get(route('proposal.show', $proposal));

        $response->assertStatus(200);
        $response->assertSee('Kegiatan Test');
    }

    public function test_pemda_bisa_update_status_proposal(): void
    {
        $proposal = Proposal::create([
            'admin_id' => $this->pengurus->id,
            'dinas_tujuan_id' => $this->pemda->id,
            'judul_kegiatan' => 'Kegiatan Test',
            'deskripsi_kegiatan' => 'Deskripsi',
            'jenis_bantuan' => 'dana',
            'anggaran_dibutuhkan' => 1000000,
            'file_proposal' => 'proposal/test.pdf',
            'status' => 'diajukan',
        ]);

        $this->actingAs($this->pemda);

        $response = $this->patch(route('proposal.update-status', $proposal), [
            'status' => 'diproses_pemda',
            'catatan_pemda' => 'Sedang diproses',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('proposal', [
            'id' => $proposal->id,
            'status' => 'diproses_pemda',
            'catatan_pemda' => 'Sedang diproses',
        ]);
    }

    public function test_pengurus_bisa_edit_proposal_miliknya(): void
    {
        $proposal = Proposal::create([
            'admin_id' => $this->pengurus->id,
            'dinas_tujuan_id' => $this->pemda->id,
            'judul_kegiatan' => 'Kegiatan Lama',
            'deskripsi_kegiatan' => 'Deskripsi lama',
            'jenis_bantuan' => 'dana',
            'anggaran_dibutuhkan' => 1000000,
            'file_proposal' => 'proposal/test.pdf',
            'status' => 'diajukan',
        ]);

        $this->actingAs($this->pengurus);

        $response = $this->get(route('proposal.edit', $proposal));

        $response->assertStatus(200);
        $response->assertViewIs('pengurus.proposal.edit');
    }

    public function test_pengurus_bisa_update_proposal_miliknya(): void
    {
        $proposal = Proposal::create([
            'admin_id' => $this->pengurus->id,
            'dinas_tujuan_id' => $this->pemda->id,
            'judul_kegiatan' => 'Kegiatan Lama',
            'deskripsi_kegiatan' => 'Deskripsi lama',
            'jenis_bantuan' => 'dana',
            'anggaran_dibutuhkan' => 1000000,
            'file_proposal' => 'proposal/test.pdf',
            'status' => 'diajukan',
        ]);

        $this->actingAs($this->pengurus);

        $response = $this->put(route('proposal.update', $proposal), [
            'dinas_tujuan_id' => $this->pemda->id,
            'judul_kegiatan' => 'Kegiatan Baru',
            'deskripsi_kegiatan' => 'Deskripsi baru',
            'jenis_bantuan' => 'izin',
            'anggaran_dibutuhkan' => 2000000,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('proposal', [
            'id' => $proposal->id,
            'judul_kegiatan' => 'Kegiatan Baru',
            'deskripsi_kegiatan' => 'Deskripsi baru',
        ]);
    }

    public function test_pengurus_tidak_bisa_melihat_proposal_ormada_lain(): void
    {
        $pengurusLain = Admin::create([
            'nama' => 'Pengurus Lain',
            'email' => 'pengurus_lain@test.com',
            'password' => bcrypt('password'),
            'peran' => 'pengurus_ormada',
        ]);

        ProfilOrmada::create([
            'admin_id' => $pengurusLain->id,
            'nama_universitas' => 'Universitas Lain',
            'alamat_universitas' => 'Jl. Lain No. 1',
        ]);

        $proposal = Proposal::create([
            'admin_id' => $pengurusLain->id,
            'dinas_tujuan_id' => $this->pemda->id,
            'judul_kegiatan' => 'Kegiatan Ormada Lain',
            'deskripsi_kegiatan' => 'Deskripsi',
            'jenis_bantuan' => 'dana',
            'anggaran_dibutuhkan' => 1000000,
            'file_proposal' => 'proposal/test.pdf',
            'status' => 'diajukan',
        ]);

        $this->actingAs($this->pengurus);

        $response = $this->get(route('proposal.show', $proposal));

        $response->assertStatus(403);
    }

    public function test_admin_bisa_melihat_semua_proposal(): void
    {
        Proposal::create([
            'admin_id' => $this->pengurus->id,
            'dinas_tujuan_id' => $this->pemda->id,
            'judul_kegiatan' => 'Kegiatan Test',
            'deskripsi_kegiatan' => 'Deskripsi',
            'jenis_bantuan' => 'dana',
            'anggaran_dibutuhkan' => 1000000,
            'file_proposal' => 'proposal/test.pdf',
            'status' => 'diajukan',
        ]);

        $this->actingAs($this->admin);

        $response = $this->get(route('proposal.index'));

        $response->assertStatus(200);
        $response->assertSee('Kegiatan Test');
    }
}