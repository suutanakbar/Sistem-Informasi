<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Agenda;
use App\Models\Postingan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
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

        // Create unpublished postingan
        Postingan::factory()->create([
            'admin_id' => $pengurus1->id,
            'judul' => 'Draft: Rencana Kegiatan Bulan Depan',
            'jenis_konten' => 'berita',
            'isi_konten' => 'Ini adalah draft postingan yang belum dipublish.',
            'is_published' => false,
            'tanggal_publish' => null,
        ]);

        // Create sample agenda
        Agenda::factory()->published()->create([
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

        Agenda::factory()->published()->create([
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

        Agenda::factory()->published()->create([
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
    }
}