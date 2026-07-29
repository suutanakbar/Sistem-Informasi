<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Agenda;
use App\Models\Proposal;
use App\Models\Volunteer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StateTransitionTest extends TestCase
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
    public function test_proposal_status_dana_cair_blocks_all_transitions()
    {
        $proposal = Proposal::create([
            'admin_id' => $this->pengurus->id,
            'dinas_tujuan_id' => $this->pemda->id,
            'judul_kegiatan' => 'Proposal Test',
            'deskripsi_kegiatan' => 'Test',
            'jenis_bantuan' => 'dana',
            'file_proposal' => 'proposal/dummy.pdf',
            'status' => Proposal::STATUS_DANA_CAIR,
        ]);

        $this->assertFalse($proposal->canTransitionTo(Proposal::STATUS_DIAJUKAN));
        $this->assertFalse($proposal->canTransitionTo(Proposal::STATUS_DIPROSES_PEMDA));
        $this->assertFalse($proposal->canTransitionTo(Proposal::STATUS_DITOLAK));
    }

    /** @test */
    public function test_proposal_status_ditolak_blocks_all_transitions()
    {
        $proposal = Proposal::create([
            'admin_id' => $this->pengurus->id,
            'dinas_tujuan_id' => $this->pemda->id,
            'judul_kegiatan' => 'Proposal Ditolak',
            'deskripsi_kegiatan' => 'Test',
            'jenis_bantuan' => 'dana',
            'file_proposal' => 'proposal/dummy.pdf',
            'status' => Proposal::STATUS_DITOLAK,
        ]);

        $this->assertFalse($proposal->canTransitionTo(Proposal::STATUS_DIAJUKAN));
        $this->assertFalse($proposal->canTransitionTo(Proposal::STATUS_DIPROSES_PEMDA));
        $this->assertFalse($proposal->canTransitionTo(Proposal::STATUS_DANA_CAIR));
    }

    /** @test */
    public function test_proposal_valid_transitions_from_diajukan()
    {
        $proposal = Proposal::create([
            'admin_id' => $this->pengurus->id,
            'dinas_tujuan_id' => $this->pemda->id,
            'judul_kegiatan' => 'Proposal Valid',
            'deskripsi_kegiatan' => 'Test',
            'jenis_bantuan' => 'dana',
            'file_proposal' => 'proposal/dummy.pdf',
            'status' => Proposal::STATUS_DIAJUKAN,
        ]);

        $this->assertTrue($proposal->canTransitionTo(Proposal::STATUS_DIPROSES_PEMDA));
        $this->assertTrue($proposal->canTransitionTo(Proposal::STATUS_DITOLAK));
        $this->assertFalse($proposal->canTransitionTo(Proposal::STATUS_DANA_CAIR));
    }

    /** @test */
    public function test_proposal_valid_transitions_from_diproses_pemda()
    {
        $proposal = Proposal::create([
            'admin_id' => $this->pengurus->id,
            'dinas_tujuan_id' => $this->pemda->id,
            'judul_kegiatan' => 'Proposal Processing',
            'deskripsi_kegiatan' => 'Test',
            'jenis_bantuan' => 'dana',
            'file_proposal' => 'proposal/dummy.pdf',
            'status' => Proposal::STATUS_DIPROSES_PEMDA,
        ]);

        $this->assertTrue($proposal->canTransitionTo(Proposal::STATUS_DANA_CAIR));
        $this->assertTrue($proposal->canTransitionTo(Proposal::STATUS_DITOLAK));
        $this->assertFalse($proposal->canTransitionTo(Proposal::STATUS_DIAJUKAN));
    }

    /** @test */
    public function test_proposal_controller_prevents_invalid_status_change()
    {
        $proposal = Proposal::create([
            'admin_id' => $this->pengurus->id,
            'dinas_tujuan_id' => $this->pemda->id,
            'judul_kegiatan' => 'Proposal Controller Test',
            'deskripsi_kegiatan' => 'Test',
            'jenis_bantuan' => 'dana',
            'file_proposal' => 'proposal/dummy.pdf',
            'status' => Proposal::STATUS_DANA_CAIR,
        ]);

        $response = $this->actingAs($this->pemda)
            ->patch(route('proposal.update-status', $proposal), [
                'status' => Proposal::STATUS_DIAJUKAN,
            ]);
        
        $response->assertRedirect();
        $this->assertEquals(Proposal::STATUS_DANA_CAIR, $proposal->fresh()->status);
    }

    /** @test */
    public function test_volunteer_cannot_change_from_diterima()
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

        $volunteer = Volunteer::create([
            'agenda_id' => $agenda->id,
            'nama' => 'Test Volunteer',
            'email' => 'test@example.com',
            'no_hp' => '081234567890',
            'status' => Volunteer::STATUS_DITERIMA,
        ]);

        $this->assertFalse($volunteer->canTransitionTo(Volunteer::STATUS_DITOLAK));
        $this->assertFalse($volunteer->canTransitionTo(Volunteer::STATUS_PENDING));
    }

    /** @test */
    public function test_volunteer_cannot_change_from_ditolak()
    {
        $agenda = Agenda::create([
            'admin_id' => $this->pemda->id,
            'nama_agenda' => 'Test Agenda 2',
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
            'nama' => 'Test Volunteer 2',
            'email' => 'test2@example.com',
            'no_hp' => '081234567891',
            'status' => Volunteer::STATUS_DITOLAK,
        ]);

        $this->assertFalse($volunteer->canTransitionTo(Volunteer::STATUS_DITERIMA));
        $this->assertFalse($volunteer->canTransitionTo(Volunteer::STATUS_PENDING));
    }

    /** @test */
    public function test_volunteer_can_transition_from_pending()
    {
        $agenda = Agenda::create([
            'admin_id' => $this->pemda->id,
            'nama_agenda' => 'Test Agenda 3',
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
            'nama' => 'Test Volunteer 3',
            'email' => 'test3@example.com',
            'no_hp' => '081234567892',
            'status' => Volunteer::STATUS_PENDING,
        ]);

        $this->assertTrue($volunteer->canTransitionTo(Volunteer::STATUS_DITERIMA));
        $this->assertTrue($volunteer->canTransitionTo(Volunteer::STATUS_DITOLAK));
    }
}