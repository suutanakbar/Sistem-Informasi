<?php

namespace Database\Factories;

use App\Models\ProfilOrmada;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AnggotaOrmada>
 */
class AnggotaOrmadaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $programStudi = [
            'Teknik Informatika',
            'Sistem Informasi',
            'Teknik Elektro',
            'Teknik Mesin',
            'Teknik Sipil',
            'Manajemen',
            'Akuntansi',
            'Ilmu Hukum',
            'Pendidikan Matematika',
            'Pendidikan Bahasa Inggris',
        ];

        $jabatan = [
            'Ketua',
            'Wakil Ketua',
            'Sekretaris',
            'Bendahara',
            'Kepala Divisi',
            'Wakil Kepala Divisi',
            'Staff Divisi',
        ];

        $namaDepan = $this->faker->firstName();
        $namaBelakang = $this->faker->lastName();
        $namaLengkap = $namaDepan . ' ' . $namaBelakang;

        // Generate NIM (Nomor Induk Mahasiswa) format: tahun masuk + 8 digit random
        $tahunMasuk = $this->faker->numberBetween(2020, 2024);
        $nim = $tahunMasuk . $this->faker->unique()->numerify('########');

        $tanggalMasukKuliah = $this->faker->dateTimeBetween('-5 years', '-1 year');
        $tanggalLulusKuliah = $this->faker->boolean(50) ? $this->faker->dateTimeBetween($tanggalMasukKuliah, 'now') : null;

        $isPengurus = $tanggalLulusKuliah ? false : $this->faker->boolean(70);

        $statusAktif = $isPengurus ? 'fungsionaris' : 'mahasiswa';

        $tanggalMulaiJabatan = $isPengurus ? $this->faker->dateTimeBetween('-2 years', 'now') : null;
        $tanggalAkhirJabatan = $isPengurus ? $this->faker->dateTimeBetween('now', '+1 year') : null;

        return [
            'profil_ormada_id' => ProfilOrmada::factory(),
            'nama_lengkap' => $namaLengkap,
            'nim' => $nim,
            'program_studi' => $this->faker->randomElement($programStudi),
            'status_aktif' => $statusAktif,
            'jabatan' => $isPengurus ? $this->faker->randomElement($jabatan) : 'Anggota',
            'is_pengurus' => $isPengurus,
            'tanggal_masuk_kuliah' => $tanggalMasukKuliah,
            'angkatan' => date_format($tanggalMasukKuliah, 'Y'),
            'tanggal_lulus_kuliah' => $tanggalLulusKuliah,
            'tanggal_mulai_jabatan' => $tanggalMulaiJabatan,
            'tanggal_akhir_jabatan' => $tanggalAkhirJabatan,
            'no_hp' => $this->faker->phoneNumber(),
        ];
    }
}