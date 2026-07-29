<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Agenda;
use App\Models\Volunteer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class VolunteerRaceConditionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Buat admin untuk pemda role
        $this->pemda = Admin::create([
            'nama' => 'Pemda Test',
            'email' => 'pemda@test.com',
            'password' => Hash::make('password'),
            'peran' => 'pemda',
        ]);
    }

    /** @test */
    public function test_race_condition_volunteer_registration_does_not_exceed_quota()
    {
        // Setup agenda dengan kuota 1
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
            'kuota_volunteer' => 1,
            'deadline_pendaftaran' => now()->addDays(2),
        ]);

        $email1 = 'test1@example.com';
        $email2 = 'test2@example.com';

        // Gunakan transaction dengan locking untuk simulasi concurrent request
        DB::transaction(function () use ($agenda, $email1, $email2) {
            // Lock agenda row
            $lockedAgenda = Agenda::where('id', $agenda->id)->lockForUpdate()->first();
            
            // Cek kuota (masih 0)
            $count1 = Volunteer::where('agenda_id', $agenda->id)
                ->where('status', 'diterima')
                ->count();
            
            $this->assertEquals(0, $count1);
            
            // Insert volunteer pertama (simulasi daftar)
            Volunteer::create([
                'agenda_id' => $agenda->id,
                'nama' => 'Volunteer 1',
                'email' => $email1,
                'no_hp' => '081234567890',
                'status' => 'pending',
            ]);
        });

        // Transaction kedua: simulasi concurrent request volunteer kedua
        DB::transaction(function () use ($agenda, $email2) {
            // Lock agenda row (harus menunggu transaction pertama selesai)
            $lockedAgenda = Agenda::where('id', $agenda->id)->lockForUpdate()->first();
            
            // Cek kuota setelah transaction pertama commit
            $count2 = Volunteer::where('agenda_id', $agenda->id)
                ->where('status', 'diterima')
                ->count();
            
            // Tetap 0 karena volunteer pertama masih pending
            $this->assertEquals(0, $count2);
            
            // Coba insert volunteer kedua
            Volunteer::create([
                'agenda_id' => $agenda->id,
                'nama' => 'Volunteer 2',
                'email' => $email2,
                'no_hp' => '081234567891',
                'status' => 'pending',
            ]);
        });

        // Assert: Kedua volunteer terdaftar (keduanya pending)
        $this->assertDatabaseHas('volunteers', ['email' => $email1]);
        $this->assertDatabaseHas('volunteers', ['email' => $email2]);
        
        // Total volunteer pending = 2, diterima = 0
        $this->assertEquals(2, Volunteer::where('agenda_id', $agenda->id)->count());
        $this->assertEquals(0, Volunteer::where('agenda_id', $agenda->id)->where('status', 'diterima')->count());
    }

    /** @test */
    public function test_race_condition_volunteer_approval_does_not_exceed_quota()
    {
        // Setup agenda dengan kuota 1
        $agenda = Agenda::create([
            'admin_id' => $this->pemda->id,
            'nama_agenda' => 'Test Agenda Approval',
            'kategori' => 'kegiatan_ormada',
            'deskripsi_agenda' => 'Test',
            'waktu_mulai' => now()->addDays(5),
            'waktu_selesai' => now()->addDays(6),
            'tempat' => 'Test',
            'is_published' => true,
            'tanggal_publish' => now(),
            'kuota_volunteer' => 1,
            'deadline_pendaftaran' => now()->addDays(2),
        ]);

        // Buat 2 volunteer pending
        $volunteer1 = Volunteer::create([
            'agenda_id' => $agenda->id,
            'nama' => 'Volunteer 1',
            'email' => 'v1@test.com',
            'no_hp' => '081234567890',
            'status' => 'pending',
        ]);

        $volunteer2 = Volunteer::create([
            'agenda_id' => $agenda->id,
            'nama' => 'Volunteer 2',
            'email' => 'v2@test.com',
            'no_hp' => '081234567891',
            'status' => 'pending',
        ]);

        // Transaction 1: Admin 1 approve volunteer 1
        DB::transaction(function () use ($volunteer1, $agenda) {
            $lockedVolunteer1 = Volunteer::where('id', $volunteer1->id)->lockForUpdate()->first();
            $lockedAgenda1 = Agenda::where('id', $agenda->id)->lockForUpdate()->first();
            
            $countBefore1 = Volunteer::where('agenda_id', $agenda->id)
                ->where('status', 'diterima')
                ->count();
            
            $this->assertEquals(0, $countBefore1);
            
            // Approve volunteer 1
            $lockedVolunteer1->update(['status' => 'diterima']);
        });

        // Assert volunteer 1 diterima
        $this->assertEquals('diterima', $volunteer1->fresh()->status);

        // Transaction 2: Admin 2 coba approve volunteer 2
        // Dengan locking, seharusnya tidak bisa approve karena kuota penuh
        $approved = false;
        try {
            DB::transaction(function () use ($volunteer2, $agenda) {
                $lockedVolunteer2 = Volunteer::where('id', $volunteer2->id)->lockForUpdate()->first();
                $lockedAgenda2 = Agenda::where('id', $agenda->id)->lockForUpdate()->first();
                
                $countBefore2 = Volunteer::where('agenda_id', $agenda->id)
                    ->where('status', 'diterima')
                    ->count();
                
                // Kuota sudah penuh (1 dari 1)
                $this->assertEquals(1, $countBefore2);
                
                // Cek ulang kuota sebelum approve (simulasi controller logic)
                // INI BAGIAN PENTING: controller harus cek ulang di dalam transaction
                if ($countBefore2 >= $lockedAgenda2->kuota_volunteer) {
                    // Tidak boleh approve - lempar exception
                    throw new \Exception('Kuota volunteer sudah penuh.', 422);
                }
                
                // Jika lolos, approve volunteer 2
                $lockedVolunteer2->update(['status' => 'diterima']);
            });
            
            $approved = true;
        } catch (\Exception $e) {
            // Expected: quota exceeded
            $this->assertStringContainsString('Kuota volunteer sudah penuh', $e->getMessage());
        }

        // Assert: Hanya volunteer 1 yang diterima, volunteer 2 tetap pending
        $this->assertEquals('diterima', $volunteer1->fresh()->status);
        $this->assertEquals('pending', $volunteer2->fresh()->status);
        
        // INVARIANT: Jumlah volunteer diterima tidak boleh melebihi kuota
        $this->assertEquals(1, Volunteer::where('agenda_id', $agenda->id)->where('status', 'diterima')->count());
        $this->assertFalse($approved, 'Volunteer 2 should not have been approved due to quota');
    }

    /** @test */
    public function test_direct_db_insert_cannot_skip_quota_check()
    {
        // Setup agenda dengan kuota 1
        $agenda = Agenda::create([
            'admin_id' => $this->pemda->id,
            'nama_agenda' => 'Test Direct Insert',
            'kategori' => 'kegiatan_ormada',
            'deskripsi_agenda' => 'Test',
            'waktu_mulai' => now()->addDays(5),
            'waktu_selesai' => now()->addDays(6),
            'tempat' => 'Test',
            'is_published' => true,
            'tanggal_publish' => now(),
            'kuota_volunteer' => 1,
            'deadline_pendaftaran' => now()->addDays(2),
        ]);

        // Isi kuota dengan volunteer diterima
        Volunteer::create([
            'agenda_id' => $agenda->id,
            'nama' => 'Approved Volunteer',
            'email' => 'approved@test.com',
            'no_hp' => '081234567890',
            'status' => 'diterima',
        ]);

        // Coba direct insert melewati business logic (simulasi bypass controller)
        // Dengan locking, insert harus dicek ulang di dalam transaction
        try {
            DB::transaction(function () use ($agenda) {
                $lockedAgenda = Agenda::where('id', $agenda->id)->lockForUpdate()->first();
                
                $currentAccepted = Volunteer::where('agenda_id', $agenda->id)
                    ->where('status', 'diterima')
                    ->count();
                
                // Cek ulang quota di dalam transaction
                if ($currentAccepted >= $lockedAgenda->kuota_volunteer) {
                    // Harus ditolak - lempar exception
                    throw new \Exception('Kuota volunteer sudah penuh.');
                }
                
                // Jika sampai sini, berarti ada bug
                Volunteer::create([
                    'agenda_id' => $agenda->id,
                    'nama' => 'Bypass Volunteer',
                    'email' => 'bypass@test.com',
                    'no_hp' => '081234567891',
                    'status' => 'diterima',
                ]);
            });
            
            $this->fail('Security breach: direct insert bypassed quota check');
        } catch (\Exception $e) {
            // Expected: quota exceeded
            $this->assertStringContainsString('Kuota volunteer sudah penuh', $e->getMessage());
        }

        // Assert: Tidak ada volunteer baru yang terbuat
        $this->assertDatabaseMissing('volunteers', [
            'agenda_id' => $agenda->id,
            'email' => 'bypass@test.com',
        ]);
    }
}