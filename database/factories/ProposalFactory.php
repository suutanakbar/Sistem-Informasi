<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proposal>
 */
class ProposalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenisBantuan = ['dana', 'izin', 'tempat', 'fasilitas'];

        $statusOptions = ['diajukan', 'diproses_pemda', 'dana_cair', 'ditolak'];

        $judulKegiatan = [
            'Pembangunan Gedung Serbaguna',
            'Pelatihan Kewirausahaan Mahasiswa',
            'Program Beasiswa Prestasi',
            'Pembangunan Laboratorium Komputer',
            'Workshop Digital Marketing',
            'Program Mentoring Karir',
            'Pengembangan Aplikasi Kampus',
            'Kegiatan Bakti Sosial',
            'Program Literasi Digital',
            'Pelatihan Soft Skills',
        ];

        $judul = $this->faker->randomElement($judulKegiatan);
        $status = $this->faker->randomElement($statusOptions);
        $anggaran = $this->faker->numberBetween(5000000, 500000000);

        $catatanPemda = match ($status) {
            'diproses_pemda' => $this->faker->randomElement([
                'Proposal sedang diproses oleh tim kami.',
                'Proposal dalam tahap review.',
            ]),
            'dana_cair' => $this->faker->randomElement([
                'Dana sudah dicairkan, silakan lakukan pelaksanaan.',
                'Proposal disetujui dan dana telah disalurkan.',
            ]),
            'ditolak' => $this->faker->randomElement([
                'Proposal ditolak karena tidak sesuai dengan prioritas anggaran.',
                'Mohon perbaiki proposal dan ajukan kembali.',
                'Anggaran yang diajukan melebihi kapasitas kami.',
            ]),
            default => null,
        };

        return [
            'admin_id' => Admin::factory(),
            'dinas_tujuan_id' => Admin::factory(),
            'judul_kegiatan' => $judul,
            'deskripsi_kegiatan' => $this->faker->paragraph(4),
            'jenis_bantuan' => $this->faker->randomElement($jenisBantuan),
            'anggaran_dibutuhkan' => $anggaran,
            'file_proposal' => 'proposal/placeholder.pdf',
            'status' => $status,
            'catatan_pemda' => $catatanPemda,
        ];
    }
}