<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Agenda;
use App\Models\AnggotaOrmada;
use App\Models\Aspirasi;
use App\Models\Pengumuman;
use App\Models\Postingan;
use App\Models\ProfilOrmada;
use App\Models\Proposal;
use App\Models\Volunteer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate tables to avoid duplicate entries
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Volunteer::truncate();
        Proposal::truncate();
        Aspirasi::truncate();
        AnggotaOrmada::truncate();
        Agenda::truncate();
        Postingan::truncate();
        ProfilOrmada::truncate();
        Admin::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create sample admins
        $admin = Admin::factory()->create([
            'nama' => 'Admin Utama',
            'email' => 'admin@example.com',
            'peran' => 'admin',
        ]);

        $pemda = Admin::factory()->create([
            'nama' => 'Pemda Temanggung',
            'email' => 'pemda@example.com',
            'peran' => 'pemda',
        ]);

        $pengurus1 = Admin::factory()->create([
            'nama' => 'Pengurus Ormada A',
            'email' => 'pengurus1@example.com',
            'peran' => 'pengurus_ormada',
        ]);

        $pengurus2 = Admin::factory()->create([
            'nama' => 'Pengurus Ormada B',
            'email' => 'pengurus2@example.com',
            'peran' => 'pengurus_ormada',
        ]);

        // Create profil ormada for each pengurus
        $profilOrmadaA = ProfilOrmada::factory()->create([
            'admin_id' => $pengurus1->id,
            'nama_universitas' => 'Universitas Gadjah Mada',
            'alamat_universitas' => 'Jl. Kaliurang No. 1, Yogyakarta',
            'total_mahasiswa_univ' => 35000,
            'logo' => 'logos/logo-universitas-gadjah-mada.png',
            'deskripsi' => 'Universitas Gadjah Mada adalah salah satu universitas terbaik di Indonesia yang dikenal dengan prestasi akademik dan non-akademik.',
        ]);

        $profilOrmadaB = ProfilOrmada::factory()->create([
            'admin_id' => $pengurus2->id,
            'nama_universitas' => 'Universitas Indonesia',
            'alamat_universitas' => 'Jl. Margonda Raya, Depok',
            'total_mahasiswa_univ' => 45000,
            'logo' => 'logos/logo-universitas-indonesia.png',
            'deskripsi' => 'Universitas Indonesia merupakan kampus terkemuka dengan berbagai program studi unggulan.',
        ]);

        // Create additional ormada profiles
        $profilOrmadaC = ProfilOrmada::factory()->create([
            'nama_universitas' => 'Universitas Negeri Semarang',
            'alamat_universitas' => 'Jl. Sekaran Gunungpati, Semarang',
            'total_mahasiswa_univ' => 28000,
            'logo' => 'logos/logo-unes-semarang.png',
            'deskripsi' => 'Universitas Negeri Semarang dikenal sebagai pusat pendidikan guru dan teknologi pendidikan di Jawa Tengah.',
        ]);

        $profilOrmadaD = ProfilOrmada::factory()->create([
            'nama_universitas' => 'Universitas Diponegoro',
            'alamat_universitas' => 'Jl. Prof. Soedarto, SH, Semarang',
            'total_mahasiswa_univ' => 32000,
            'logo' => 'logos/logo-undip.png',
            'deskripsi' => 'Universitas Diponegoro adalah universitas terbesar di Jawa Tengah dengan berbagai fakultas unggulan.',
        ]);

        $profilOrmadaE = ProfilOrmada::factory()->create([
            'nama_universitas' => 'Institut Teknologi Sepuluh Nopember',
            'alamat_universitas' => 'Jl. Raya ITS, Sukolilo, Surabaya',
            'total_mahasiswa_univ' => 25000,
            'logo' => 'logos/logo-its.png',
            'deskripsi' => 'ITS merupakan institusi teknologi terkemuka di Indonesia dengan fokus pada sains dan teknologi.',
        ]);

        $profilOrmadaF = ProfilOrmada::factory()->create([
            'nama_universitas' => 'Universitas Brawijaya',
            'alamat_universitas' => 'Jl. Veteran, Malang',
            'total_mahasiswa_univ' => 38000,
            'logo' => 'logos/logo-ub.png',
            'deskripsi' => 'Universitas Brawijaya dikenal sebagai universitas berbasis riset dengan berbagai inovasi teknologi.',
        ]);

        $profilOrmadaG = ProfilOrmada::factory()->create([
            'nama_universitas' => 'Universitas Padjadjaran',
            'alamat_universitas' => 'Jl. Raya Bandung Sumedang, Bandung',
            'total_mahasiswa_univ' => 42000,
            'logo' => 'logos/logo-unpad.png',
            'deskripsi' => 'Universitas Padjadjaran merupakan universitas favorit di Jawa Barat dengan berbagai program studi prestasi.',
        ]);

        $profilOrmadaH = ProfilOrmada::factory()->create([
            'nama_universitas' => 'Universitas Gadjah Mada',
            'alamat_universitas' => 'Jl. Kaliurang No. 1, Yogyakarta',
            'total_mahasiswa_univ' => 35000,
            'logo' => 'logos/logo-ugm.png',
            'deskripsi' => 'Kampus UGM yang dikenal dengan berbagai kegiatan sosial dan akademik yang berkelanjutan.',
        ]);

        // Create anggota ormada for each profile
        AnggotaOrmada::factory()->count(10)->create([
            'profil_ormada_id' => $profilOrmadaA->id,
        ]);

        AnggotaOrmada::factory()->count(8)->create([
            'profil_ormada_id' => $profilOrmadaB->id,
        ]);

        AnggotaOrmada::factory()->count(7)->create([
            'profil_ormada_id' => $profilOrmadaC->id,
        ]);

        AnggotaOrmada::factory()->count(9)->create([
            'profil_ormada_id' => $profilOrmadaD->id,
        ]);

        AnggotaOrmada::factory()->count(6)->create([
            'profil_ormada_id' => $profilOrmadaE->id,
        ]);

        AnggotaOrmada::factory()->count(8)->create([
            'profil_ormada_id' => $profilOrmadaF->id,
        ]);

        AnggotaOrmada::factory()->count(7)->create([
            'profil_ormada_id' => $profilOrmadaG->id,
        ]);

        AnggotaOrmada::factory()->count(5)->create([
            'profil_ormada_id' => $profilOrmadaH->id,
        ]);

        // Create sample postingan
        Postingan::factory()->published()->create([
            'admin_id' => $pengurus1->id,
            'judul' => 'Kegiatan Bakti Sosial Ormada A',
            'jenis_konten' => 'prestasi',
            'isi_konten' => 'Ormada A berhasil mengadakan kegiatan bakti sosial di desa sekitar kampus.',
            'tanggal_publish' => now()->subDays(2),
        ]);

        Postingan::factory()->published()->create([
            'admin_id' => $pemda->id,
            'judul' => 'Pengumuman Penting: Pendaftaran Volunteer',
            'jenis_konten' => 'pengumuman',
            'isi_konten' => 'Pendaftaran volunteer untuk kegiatan lingkungan hidup sudah dibuka.',
            'tanggal_publish' => now()->subDays(1),
        ]);

        Postingan::factory()->published()->create([
            'admin_id' => $pengurus2->id,
            'judul' => 'Ormada B Raih Juara 1 Lomba',
            'jenis_konten' => 'prestasi',
            'isi_konten' => 'Tim Ormada B berhasil meraih juara 1 dalam lomba antar ormada.',
            'tanggal_publish' => now(),
        ]);

        Postingan::factory()->published()->create([
            'admin_id' => $pengurus1->id,
            'judul' => 'Workshop Kewirausahaan Mahasiswa',
            'jenis_konten' => 'berita',
            'isi_konten' => 'Workshop kewirausahaan sukses dihadiri oleh 200 mahasiswa dari berbagai universitas.',
            'tanggal_publish' => now()->subDays(3),
        ]);

        Postingan::factory()->published()->create([
            'admin_id' => $pemda->id,
            'judul' => 'Program Beasiswa Ormada 2024',
            'jenis_konten' => 'pengumuman',
            'isi_konten' => 'Pendaftaran program beasiswa untuk anggota ormada sudah dibuka hingga akhir bulan.',
            'tanggal_publish' => now()->subDays(5),
        ]);

        // Create unpublished postingan
        Postingan::factory()->create([
            'admin_id' => $pengurus1->id,
            'judul' => 'Draft: Rencana Kegiatan Bulan Depan',
            'jenis_konten' => 'berita',
            'isi_konten' => 'Ini adalah draft postingan yang belum dipublish.',
            'is_published' => false,
            'tanggal_publish' => null,
        ]);

        // Create sample pengumuman
        Pengumuman::factory()->create([
            'admin_id' => $pemda->id,
            'judul' => 'Pengumuman Seleksi Ormada Baru',
            'isi' => 'Pendaftaran ormada baru untuk periode 2024/2025 sudah resmi dibuka. Silakan daftar melalui website ini.',
            'tanggal_publish' => now()->subDays(2),
        ]);

        Pengumuman::factory()->create([
            'admin_id' => $pengurus1->id,
            'judul' => 'Jadwal Pelantikan Pengurus Ormada',
            'isi' => 'Pelantikan pengurus ormada akan dilaksanakan pada tanggal 20 Juli 2024 di gedung serbaguna kampus.',
            'tanggal_publish' => now()->subDays(1),
        ]);

        Pengumuman::factory()->create([
            'admin_id' => $pengurus2->id,
            'judul' => 'Rapat Koordinasi Bulanan',
            'isi' => 'Rapat koordinasi bulanan akan digeser ke hari Jumat karena bentrok dengan kegiatan akademik.',
            'tanggal_publish' => now(),
        ]);

        // Create sample agenda
        $agenda1 = Agenda::factory()->published()->create([
            'admin_id' => $pemda->id,
            'nama_agenda' => 'Kegiatan Bakti Sosial',
            'kategori' => 'baksos',
            'deskripsi_agenda' => 'Kegiatan bakti sosial membersihkan lingkungan sekitar kampus.',
            'waktu_mulai' => now()->addDays(7),
            'waktu_selesai' => now()->addDays(7)->addHours(4),
            'tempat' => 'Kampus Universitas',
            'kuota_volunteer' => 50,
            'deadline_pendaftaran' => now()->addDays(3),
            'tanggal_publish' => now()->subDays(1),
        ]);

        $agenda2 = Agenda::factory()->published()->create([
            'admin_id' => $pengurus1->id,
            'nama_agenda' => 'Workshop Kepemimpinan',
            'kategori' => 'kegiatan_ormada',
            'deskripsi_agenda' => 'Workshop untuk mengembangkan kemampuan kepemimpinan anggota ormada.',
            'waktu_mulai' => now()->addDays(14),
            'waktu_selesai' => now()->addDays(14)->addHours(6),
            'tempat' => 'Gedung Serbaguna',
            'kuota_volunteer' => null,
            'deadline_pendaftaran' => null,
            'tanggal_publish' => now(),
        ]);

        $agenda3 = Agenda::factory()->published()->create([
            'admin_id' => $pemda->id,
            'nama_agenda' => 'Donor Darah',
            'kategori' => 'kesehatan',
            'deskripsi_agenda' => 'Kegiatan donor darah bersama PMI Kabupaten Temanggung.',
            'waktu_mulai' => now()->addDays(10),
            'waktu_selesai' => now()->addDays(10)->addHours(5),
            'tempat' => 'Puskesmas Daerah',
            'kuota_volunteer' => 30,
            'deadline_pendaftaran' => now()->addDays(5),
            'tanggal_publish' => now()->subDays(2),
        ]);

        $agenda4 = Agenda::factory()->published()->create([
            'admin_id' => $pengurus2->id,
            'nama_agenda' => 'Lomba Kreativitas Mahasiswa',
            'kategori' => 'kegiatan_ormada',
            'deskripsi_agenda' => 'Lomba kreativitas dalam bentuk video dan desain grafis.',
            'waktu_mulai' => now()->addDays(20),
            'waktu_selesai' => now()->addDays(20)->addHours(8),
            'tempat' => 'Auditorium Kampus',
            'kuota_volunteer' => 100,
            'deadline_pendaftaran' => now()->addDays(10),
            'tanggal_publish' => now()->subDays(3),
        ]);

        // Create unpublished agenda
        Agenda::factory()->create([
            'admin_id' => $pengurus2->id,
            'nama_agenda' => 'Draft: Rapat Koordinasi',
            'kategori' => 'kegiatan_ormada',
            'deskripsi_agenda' => 'Rapat koordinasi bulanan anggota ormada.',
            'waktu_mulai' => now()->addDays(5),
            'waktu_selesai' => now()->addDays(5)->addHours(2),
            'tempat' => 'Kantor Ormada',
            'is_published' => false,
            'tanggal_publish' => null,
        ]);

        // Create volunteers for agenda with kuota
        Volunteer::factory()->count(15)->create([
            'agenda_id' => $agenda1->id,
        ]);

        Volunteer::factory()->count(8)->create([
            'agenda_id' => $agenda3->id,
        ]);

        Volunteer::factory()->count(20)->create([
            'agenda_id' => $agenda4->id,
        ]);

        // Create sample aspirasi
        Aspirasi::factory()->count(6)->create([
            'profil_ormada_id' => $profilOrmadaA->id,
        ]);

        Aspirasi::factory()->count(4)->create([
            'profil_ormada_id' => $profilOrmadaB->id,
        ]);

        // Create sample proposal
        Proposal::factory()->count(3)->create([
            'admin_id' => $pengurus1->id,
            'dinas_tujuan_id' => $pemda->id,
            'status' => 'dana_cair',
        ]);

        Proposal::factory()->count(2)->create([
            'admin_id' => $pengurus2->id,
            'dinas_tujuan_id' => $pemda->id,
            'status' => 'diajukan',
        ]);

        Proposal::factory()->create([
            'admin_id' => $pengurus1->id,
            'dinas_tujuan_id' => $pemda->id,
            'status' => 'ditolak',
        ]);

        Proposal::factory()->create([
            'admin_id' => $pengurus2->id,
            'dinas_tujuan_id' => $pemda->id,
            'status' => 'diproses_pemda',
        ]);
    }
}