<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Agenda;
use App\Models\Aspirasi;
use App\Models\Postingan;
use App\Models\ProfilOrmada;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClearAndDummySeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate all tables
        \App\Models\Volunteer::truncate();
        \App\Models\Proposal::truncate();
        \App\Models\Aspirasi::truncate();
        \App\Models\Agenda::truncate();
        \App\Models\Postingan::truncate();
        \App\Models\Pengumuman::truncate();
        \App\Models\AnggotaOrmada::truncate();
        \App\Models\ProfilOrmada::truncate();
        \App\Models\Admin::truncate();
        \App\Models\User::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create 1 Admin
        $admin = Admin::factory()->create([
            'nama' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'peran' => 'admin',
            'terakhir_masuk' => now(),
        ]);

        // Create 1 Pemda
        $pemda = Admin::factory()->create([
            'nama' => 'Dinas Pemuda dan Olahraga',
            'email' => 'pemda@example.com',
            'password' => Hash::make('password'),
            'peran' => 'pemda',
            'terakhir_masuk' => now(),
        ]);

        // Create 5 Pengurus Ormada
        $pengurus = [];
        for ($i = 1; $i <= 5; $i++) {
            $pengurus[] = Admin::factory()->create([
                'nama' => "Pengurus Ormada $i",
                'email' => "pengurus$i@example.com",
                'password' => Hash::make('password'),
                'peran' => 'pengurus_ormada',
                'terakhir_masuk' => now(),
            ]);
        }

        // Create Profil Ormada, Agenda, Berita, dan Aspirasi untuk setiap pengurus
        foreach ($pengurus as $index => $pengurusAdmin) {
            // 1 Profil Ormada
            $profil = ProfilOrmada::factory()->create([
                'admin_id' => $pengurusAdmin->id,
                'nama_universitas' => "Universitas " . $this->getUniversityName($index),
                'alamat_universitas' => $this->getUniversityAddress($index),
                'total_mahasiswa_univ' => $this->getStudentCount($index),
                'logo' => 'logos/logo-universitas-' . ($index + 1) . '.png',
                'deskripsi' => $this->getUniversityDescription($index),
            ]);

            // 1 Agenda
            Agenda::factory()->create([
                'admin_id' => $pengurusAdmin->id,
                'nama_agenda' => $this->getAgendaName($index),
                'deskripsi_agenda' => $this->getAgendaDescription($index),
                'waktu_mulai' => now()->addDays(7 + ($index * 3)),
                'waktu_selesai' => now()->addDays(7 + ($index * 3))->addHours(4),
                'tempat' => $this->getAgendaPlace($index),
                'kategori' => $this->getAgendaCategory($index),
                'kuota_volunteer' => rand(30, 100),
                'deadline_pendaftaran' => now()->addDays(3 + ($index * 2)),
                'is_published' => true,
                'tanggal_publish' => now(),
            ]);

            // 1 Berita (Postingan)
            Postingan::factory()->create([
                'admin_id' => $pengurusAdmin->id,
                'judul' => $this->getBeritaTitle($index),
                'isi_konten' => $this->getBeritaContent($index),
                'jenis_konten' => 'berita',
                'is_published' => true,
                'tanggal_publish' => now()->subDays(rand(1, 7)),
            ]);

            // 1 Aspirasi
            Aspirasi::factory()->create([
                'profil_ormada_id' => $profil->id,
                'topik_aspirasi' => $this->getAspirasiTopic($index),
                'detail_aspirasi' => $this->getAspirasiDetail($index),
                'status' => 'belum_ditanggapi',
            ]);
        }
    }

    private function getUniversityName(int $index): string
    {
        $universities = [
            'Universitas Gadjah Mada',
            'Universitas Indonesia',
            'Universitas Negeri Semarang',
            'Universitas Diponegoro',
            'Institut Teknologi Sepuluh Nopember',
        ];
        return $universities[$index];
    }

    private function getUniversityAddress(int $index): string
    {
        $addresses = [
            'Jl. Kaliurang No. 1, Yogyakarta',
            'Jl. Margonda Raya, Depok',
            'Jl. Sekaran Gunungpati, Semarang',
            'Jl. Prof. Soedarto, SH, Semarang',
            'Jl. Raya ITS, Sukolilo, Surabaya',
        ];
        return $addresses[$index];
    }

    private function getStudentCount(int $index): int
    {
        $counts = [35000, 45000, 28000, 32000, 25000];
        return $counts[$index];
    }

    private function getUniversityDescription(int $index): string
    {
        $descriptions = [
            'Universitas Gadjah Mada adalah salah satu universitas terbaik di Indonesia yang dikenal dengan prestasi akademik dan non-akademik.',
            'Universitas Indonesia merupakan kampus terkemuka dengan berbagai program studi unggulan.',
            'Universitas Negeri Semarang dikenal sebagai pusat pendidikan guru dan teknologi pendidikan di Jawa Tengah.',
            'Universitas Diponegoro adalah universitas terbesar di Jawa Tengah dengan berbagai fakultas unggulan.',
            'Institut Teknologi Sepuluh Nopember merupakan institusi teknologi terkemuka di Indonesia dengan fokus pada sains dan teknologi.',
        ];
        return $descriptions[$index];
    }

    private function getAgendaName(int $index): string
    {
        $agendas = [
            'Workshop Kewirausahaan Mahasiswa',
            'Kegiatan Bakti Sosial',
            'Lomba Kreativitas Mahasiswa',
            'Seminar Teknologi Digital',
            'Donor Darah Bersama',
        ];
        return $agendas[$index];
    }

    private function getAgendaDescription(int $index): string
    {
        $descriptions = [
            'Workshop kewirausahaan untuk mahasiswa dengan narasumber praktisi bisnis sukses.',
            'Kegiatan bakti sosial membersihkan lingkungan sekitar kampus dan membantu masyarakat sekitar.',
            'Lomba kreativitas dalam bentuk video dan desain grafis untuk mengasahkan bakat mahasiswa.',
            'Seminar tentang transformasi digital dan teknologi informasi di era modern.',
            'Kegiatan donor darah bersama PMI untuk membantu sesama.',
        ];
        return $descriptions[$index];
    }

    private function getAgendaPlace(int $index): string
    {
        $places = [
            'Gedung Serbaguna Kampus',
            'Lapangan Kampus Utama',
            'Auditorium Universitas',
            'Aula Fakultas Teknik',
            'Puskesmas Kampus',
        ];
        return $places[$index];
    }

    private function getAgendaCategory(int $index): string
    {
        $categories = ['kegiatan_ormada', 'baksos', 'kegiatan_ormada', 'pendidikan', 'kesehatan'];
        return $categories[$index];
    }

    private function getBeritaTitle(int $index): string
    {
        $titles = [
            'Ormada Raih Juara 1 Lomba Antar Universitas',
            'Kegiatan Bakti Sosial Sukses diadakan',
            'Workshop Kewirausahaan Digelar dengan Masuk',
            'Pelantikan Pengurus Ormada Periode Baru',
            'Program Beasiswa Berkinerja Tinggi',
        ];
        return $titles[$index];
    }

    private function getBeritaContent(int $index): string
    {
        $contents = [
            'Tim Ormada berhasil meraih juara 1 dalam lomba antar universitas yang diselenggarakan pada bulan ini.',
            'Kegiatan bakti sosial berjalan dengan sukses dan mendapat apresiasi dari masyarakat sekitar.',
            'Workshop kewirausahaan dihadiri oleh 200 mahasiswa dari berbagai universitas dengan narasumber pengusaha sukses.',
            'Pelantikan pengurus ormada periode baru dilaksanakan dengan khidmat di hadiran seluruh anggota.',
            'Program beasiswa untuk mahasiswa berprestasi telah resmi dibuka dengan total 50 kuota tersedia.',
        ];
        return $contents[$index];
    }

    private function getAspirasiTopic(int $index): string
    {
        $topics = [
            'Peningkatan Fasilitas Kampus',
            'Beasiswa untuk Mahasiswa Berprestasi',
            'Program Magang di Perusahaan',
            'Pembangunan Laboratorium Komputer',
            'Kegiatan Olahraga Rutin',
        ];
        return $topics[$index];
    }

    private function getAspirasiDetail(int $index): string
    {
        $details = [
            'Kami berharap ada peningkatan fasilitas kampus terutama di area parkir dan ruang belajar bersama.',
            'Mahasiswa berprestasi membutuhkan beasiswa untuk mendukung studies mereka hingga lulus.',
            'Program magang yang kerjasama dengan perusahaan akan membantu mahasiswa mendapatkan pengalaman kerja.',
            'Laboratorium komputer dengan perangkat keras terbaru dibutuhkan untuk mata kuliah praktikum.',
            'Kegiatan olahraga rutin setiap minggu untuk menjaga kesehatan dan kebersamaan antar mahasiswa.',
        ];
        return $details[$index];
    }
}