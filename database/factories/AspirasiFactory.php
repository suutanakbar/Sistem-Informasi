<?php

namespace Database\Factories;

use App\Models\ProfilOrmada;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aspirasi>
 */
class AspirasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $topikAspirasi = [
            'Fasilitas Perpustakaan',
            'Ketersediaan Parkir',
            'Kualitas Kantin',
            'Internet di Kampus',
            'Ketersediaan Ruang Kelas',
            'Fasilitas Toilet',
            'Ketersediaan Buku Referensi',
            'Jam Operasional Perpustakaan',
            'Ketersediaan Laboratorium',
            'Transportasi Kampus',
            'Ketersediaan Asrama',
            'Kantin 24 Jam',
            'Fasilitat Olahraga',
            'Ketersediaan Mushola',
            'Sistem Parkir Motor',
        ];

        $statusOptions = ['belum_ditanggapi', 'sedang_diproses', 'selesai', 'ditolak'];

        $topik = $this->faker->randomElement($topikAspirasi);
        $status = $this->faker->randomElement($statusOptions);
        $sudahDitanggapi = $this->faker->boolean(60); // 60% sudah ditanggapi

        $tanggalTanggapan = $sudahDitanggapi ? $this->faker->dateTimeBetween('-30 days', 'now') : null;
        $tanggapanPemda = $sudahDitanggapi ? $this->faker->randomElement([
            'Aspirasi sudah kami terima dan akan segera diproses.',
            'Kami sedang meninjau aspirasi ini untuk tindakan selanjutnya.',
            'Aspirasi telah disetujui dan akan dilaksanakan dalam bulan ini.',
            'Mohon maaf, aspirasi ini belum dapat kami penuhi saat ini.',
            'Terima kasih atas aspirasi yang diberikan, kami akan pertimbangkan.',
            'Aspirasi sudah dalam proses implementasi.',
        ]) : null;

        $filePath = $sudahDitanggapi ? 'aspirasi/placeholder.pdf' : null;

        return [
            'profil_ormada_id' => ProfilOrmada::factory(),
            'topik_aspirasi' => $topik,
            'detail_aspirasi' => $this->faker->paragraph(3),
            'file' => $filePath,
            'tanggapan_pemda' => $tanggapanPemda,
            'tanggal_tanggapan' => $tanggalTanggapan,
            'status' => $status,
        ];
    }
}