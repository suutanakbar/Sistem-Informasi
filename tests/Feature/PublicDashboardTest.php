<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\AnggotaOrmada;
use App\Models\ProfilOrmada;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_public_dashboard_with_aggregate_data(): void
    {
        $pengurus = Admin::create([
            'nama' => 'Pengurus Ormada',
            'email' => 'pengurus-public@example.test',
            'kata_sandi' => 'password',
            'peran' => 'pengurus_ormada',
        ]);

        $profil = ProfilOrmada::create([
            'admin_id' => $pengurus->id,
            'nama_universitas' => 'Universitas Negeri Semarang',
            'alamat_universitas' => 'Sekaran, Semarang',
            'total_mahasiswa_univ' => 40000,
            'deskripsi' => 'Ormada mahasiswa Temanggung di Semarang.',
        ]);

        AnggotaOrmada::create([
            'profil_ormada_id' => $profil->id,
            'nama_lengkap' => 'Andika Pratama',
            'nim' => '2401419001',
            'program_studi' => 'Pendidikan Seni Rupa',
            'status_aktif' => 'fungsionaris',
            'jabatan' => 'Ketua Umum',
            'is_pengurus' => 'YA',
            'no_hp' => '081234567890',
        ]);

        $this->get(route('public.home'))
            ->assertOk()
            ->assertSee('SI Ormada Temanggung')
            ->assertSee('Universitas Negeri Semarang')
            ->assertSee('Ormada terdaftar')
            ->assertSee('Anggota terdata')
            ->assertSee('Login')
            ->assertDontSee('Andika Pratama')
            ->assertDontSee('2401419001')
            ->assertDontSee('081234567890')
            ->assertDontSee('Ketua Umum');
    }

    public function test_authenticated_user_sees_dashboard_link_on_public_dashboard(): void
    {
        $admin = Admin::create([
            'nama' => 'Admin',
            'email' => 'admin-public@example.test',
            'kata_sandi' => 'password',
            'peran' => 'admin',
        ]);

        $this->actingAs($admin)
            ->get(route('public.home'))
            ->assertOk()
            ->assertSee('Dashboard')
            ->assertDontSee('Login');
    }

    public function test_guest_cannot_access_internal_member_pages(): void
    {
        $pengurus = Admin::create([
            'nama' => 'Pengurus Ormada',
            'email' => 'pengurus-private@example.test',
            'kata_sandi' => 'password',
            'peran' => 'pengurus_ormada',
        ]);

        $profil = ProfilOrmada::create([
            'admin_id' => $pengurus->id,
            'nama_universitas' => 'Universitas Diponegoro',
            'alamat_universitas' => 'Tembalang, Semarang',
            'total_mahasiswa_univ' => 55000,
        ]);

        $anggota = AnggotaOrmada::create([
            'profil_ormada_id' => $profil->id,
            'nama_lengkap' => 'Bagus Wijaya',
            'nim' => '21060119120015',
            'program_studi' => 'Teknik Elektro',
            'status_aktif' => 'mahasiswa_biasa',
            'is_pengurus' => 'TIDAK',
            'no_hp' => '089999999999',
        ]);

        $this->get(route('anggota-ormada.index'))
            ->assertRedirect(route('login'));

        $this->get(route('anggota-ormada.show', $anggota))
            ->assertRedirect(route('login'));
    }
}
