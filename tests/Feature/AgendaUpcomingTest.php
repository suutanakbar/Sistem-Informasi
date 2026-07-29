<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Agenda;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AgendaUpcomingTest extends TestCase
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
    public function test_upcoming_agenda_scope_excludes_past_agenda()
    {
        // Create past agenda
        $pastAgenda = Agenda::create([
            'admin_id' => $this->pemda->id,
            'nama_agenda' => 'Past Agenda',
            'kategori' => 'kegiatan_ormada',
            'deskripsi_agenda' => 'Test',
            'waktu_mulai' => now()->subDays(5),
            'waktu_selesai' => now()->subDays(4),
            'tempat' => 'Test',
            'is_published' => true,
            'tanggal_publish' => now()->subDays(10),
        ]);

        // Create future agenda
        $futureAgenda = Agenda::create([
            'admin_id' => $this->pemda->id,
            'nama_agenda' => 'Future Agenda',
            'kategori' => 'kegiatan_ormada',
            'deskripsi_agenda' => 'Test',
            'waktu_mulai' => now()->addDays(5),
            'waktu_selesai' => now()->addDays(6),
            'tempat' => 'Test',
            'is_published' => true,
            'tanggal_publish' => now(),
        ]);

        // Test upcoming scope
        $upcomingAgendas = Agenda::upcoming()->get();

        // Should only contain future agenda
        $this->assertCount(1, $upcomingAgendas);
        $this->assertEquals('Future Agenda', $upcomingAgendas->first()->nama_agenda);
    }

    /** @test */
    public function test_published_scope_works_correctly()
    {
        // Create unpublished agenda
        $unpublishedAgenda = Agenda::create([
            'admin_id' => $this->pemda->id,
            'nama_agenda' => 'Unpublished Agenda',
            'kategori' => 'kegiatan_ormada',
            'deskripsi_agenda' => 'Test',
            'waktu_mulai' => now()->addDays(5),
            'waktu_selesai' => now()->addDays(6),
            'tempat' => 'Test',
            'is_published' => false,
            'tanggal_publish' => null,
        ]);

        // Create published agenda
        $publishedAgenda = Agenda::create([
            'admin_id' => $this->pemda->id,
            'nama_agenda' => 'Published Agenda',
            'kategori' => 'kegiatan_ormada',
            'deskripsi_agenda' => 'Test',
            'waktu_mulai' => now()->addDays(5),
            'waktu_selesai' => now()->addDays(6),
            'tempat' => 'Test',
            'is_published' => true,
            'tanggal_publish' => now(),
        ]);

        // Test published scope
        $publishedAgendas = Agenda::published()->get();

        // Should only contain published agenda
        $this->assertCount(1, $publishedAgendas);
        $this->assertEquals('Published Agenda', $publishedAgendas->first()->nama_agenda);
    }

    /** @test */
    public function test_public_agenda_page_only_shows_upcoming_agenda()
    {
        // Create past agenda
        $pastAgenda = Agenda::create([
            'admin_id' => $this->pemda->id,
            'nama_agenda' => 'Past Agenda',
            'kategori' => 'kegiatan_ormada',
            'deskripsi_agenda' => 'Test',
            'waktu_mulai' => now()->subDays(5),
            'waktu_selesai' => now()->subDays(4),
            'tempat' => 'Test',
            'is_published' => true,
            'tanggal_publish' => now()->subDays(10),
        ]);

        // Create future agenda
        $futureAgenda = Agenda::create([
            'admin_id' => $this->pemda->id,
            'nama_agenda' => 'Future Agenda',
            'kategori' => 'kegiatan_ormada',
            'deskripsi_agenda' => 'Test',
            'waktu_mulai' => now()->addDays(5),
            'waktu_selesai' => now()->addDays(6),
            'tempat' => 'Test',
            'is_published' => true,
            'tanggal_publish' => now(),
        ]);

        // Visit public agenda page
        $response = $this->get(route('public.agenda'));

        $response->assertStatus(200);
        
        // Should show future agenda
        $response->assertSee('Future Agenda');
        
        // Should NOT show past agenda
        $response->assertDontSee('Past Agenda');
    }

    /** @test */
    public function test_agenda_show_page_blocks_past_agenda()
    {
        // Create past agenda
        $pastAgenda = Agenda::create([
            'admin_id' => $this->pemda->id,
            'nama_agenda' => 'Past Agenda',
            'kategori' => 'kegiatan_ormada',
            'deskripsi_agenda' => 'Test',
            'waktu_mulai' => now()->subDays(5),
            'waktu_selesai' => now()->subDays(4),
            'tempat' => 'Test',
            'is_published' => true,
            'tanggal_publish' => now()->subDays(10),
        ]);

        // Try to access past agenda detail page
        $response = $this->get(route('public.agenda.show', $pastAgenda));

        // Should return 404 even though it's published
        $response->assertStatus(404);
    }
}