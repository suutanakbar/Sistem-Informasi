<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\AnggotaOrmada;
use App\Models\ProfilOrmada;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfilAnggotaOrmadaTest extends TestCase
{
    use RefreshDatabase;

    public function test_pengurus_can_create_profile_and_member(): void
    {
        $pengurus = Admin::create([
            'nama' => 'Pengurus Ormada',
            'email' => 'pengurus@example.test',
            'kata_sandi' => 'password',
            'peran' => 'pengurus_ormada',
        ]);

        $this->actingAs($pengurus)
            ->post(route('profil-ormada.store'), [
                'nama_universitas' => 'Universitas Negeri Semarang',
                'alamat_universitas' => 'Sekaran, Semarang',
                'total_mahasiswa_univ' => 40000,
                'deskripsi' => 'Ormada mahasiswa Temanggung.',
            ])
            ->assertRedirect();

        $profil = ProfilOrmada::firstOrFail();

        $this->actingAs($pengurus)
            ->post(route('anggota-ormada.store'), [
                'profil_ormada_id' => $profil->id,
                'nama_lengkap' => 'Andika Pratama',
                'nim' => '2401419001',
                'program_studi' => 'Pendidikan Seni Rupa',
                'status_aktif' => 'fungsionaris',
                'jabatan' => 'Ketua Umum',
                'is_pengurus' => 'YA',
                'no_hp' => '081234567890',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('anggota_ormada', [
            'profil_ormada_id' => $profil->id,
            'nama_lengkap' => 'Andika Pratama',
        ]);
    }

    public function test_pemda_can_view_member_detail_but_cannot_edit(): void
    {
        $pengurus = Admin::create([
            'nama' => 'Pengurus Ormada',
            'email' => 'pengurus@example.test',
            'kata_sandi' => 'password',
            'peran' => 'pengurus_ormada',
        ]);

        $pemda = Admin::create([
            'nama' => 'Pemda',
            'email' => 'pemda@example.test',
            'kata_sandi' => 'password',
            'peran' => 'pemda',
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
            'status_aktif' => 'fungsionaris',
            'jabatan' => 'Wakil Ketua',
            'is_pengurus' => 'YA',
        ]);

        $this->actingAs($pemda)
            ->get(route('anggota-ormada.show', $anggota))
            ->assertOk()
            ->assertSee('Bagus Wijaya');

        $this->actingAs($pemda)
            ->get(route('anggota-ormada.edit', $anggota))
            ->assertForbidden();
    }

    public function test_pengurus_cannot_view_other_ormada_member(): void
    {
        $owner = Admin::create([
            'nama' => 'Owner',
            'email' => 'owner@example.test',
            'kata_sandi' => 'password',
            'peran' => 'pengurus_ormada',
        ]);

        $other = Admin::create([
            'nama' => 'Other',
            'email' => 'other@example.test',
            'kata_sandi' => 'password',
            'peran' => 'pengurus_ormada',
        ]);

        $profil = ProfilOrmada::create([
            'admin_id' => $owner->id,
            'nama_universitas' => 'Universitas Gadjah Mada',
            'alamat_universitas' => 'Bulaksumur, Yogyakarta',
            'total_mahasiswa_univ' => 50000,
        ]);

        $anggota = AnggotaOrmada::create([
            'profil_ormada_id' => $profil->id,
            'nama_lengkap' => 'Fajar Nugroho',
            'nim' => '23/514321/TK/54321',
            'program_studi' => 'Teknik Sipil',
            'status_aktif' => 'mahasiswa_biasa',
            'is_pengurus' => 'TIDAK',
        ]);

        $this->actingAs($other)
            ->get(route('anggota-ormada.show', $anggota))
            ->assertForbidden();
    }
}
