# Technical Design Document

## Nama Sistem

Sistem Informasi Ormada dan Sinergi Pemda Temanggung

## Ringkasan Teknis

Aplikasi dibangun menggunakan Laravel 12 dengan database MySQL/MariaDB. Desain data mengikuti SQL yang tersedia, dengan modul utama untuk autentikasi berbasis peran, profil ormada, anggota ormada, proposal, volunteer, kolaborasi, aspirasi, postingan, dan agenda.

## Stack

- Backend: Laravel 12, PHP 8.2+
- Database: MySQL atau MariaDB
- Frontend awal: Blade, Vite, Tailwind CSS bawaan Laravel bila diperlukan
- Testing: PHPUnit melalui `php artisan test`
- File storage: Laravel filesystem disk `public`

## Arsitektur Aplikasi

Aplikasi memakai pola MVC Laravel:

- Model menyimpan representasi tabel dan relasi.
- Controller menangani request, validasi, authorization, dan response.
- View Blade menampilkan halaman web.
- Form Request dapat digunakan untuk validasi input modul yang kompleks.
- Policy atau middleware digunakan untuk pembatasan akses per peran.

## Peran dan Akses

### `admin`

- Mengelola akun pengguna.
- Mengakses seluruh data untuk kebutuhan administrasi.

### `pengurus_ormada`

- Mengelola profil ormada miliknya.
- Mengelola anggota ormada miliknya.
- Membuat proposal, aspirasi, postingan, dan agenda kategori ormada.
- Mendaftarkan anggota ke volunteer.
- Melihat status proposal, aspirasi, volunteer, dan kolaborasi terkait.

### `pemda`

- Melihat data seluruh ormada.
- Memproses proposal.
- Menanggapi aspirasi.
- Membuat volunteer, kolaborasi, agenda kategori pemda, dan postingan.

## Desain Database

### `admin`

Menyimpan akun pengguna aplikasi.

Kolom utama:

- `id`
- `nama`
- `email`
- `kata_sandi`
- `peran`
- `terakhir_masuk`
- `dibuat_pada`
- `diperbarui_pada`

Catatan implementasi Laravel:

- Model dapat dinamai `Admin`.
- Jika memakai auth bawaan Laravel, pertimbangkan rename kolom `kata_sandi` ke `password`, atau override accessor auth password pada model.

### `profil_ormada`

Menyimpan profil organisasi mahasiswa daerah berdasarkan universitas.

Relasi:

- `profil_ormada.admin_id` belongs to `admin.id`
- Satu admin pengurus ormada idealnya punya satu profil ormada.

### `anggota_ormada`

Menyimpan data anggota, pengurus, demisioner, dan alumni.

Relasi:

- `anggota_ormada.profil_ormada_id` belongs to `profil_ormada.id`

Catatan:

- Kolom `is_pengurus` saat ini bertipe `VARCHAR(5)` dengan nilai `YA` atau `TIDAK`.
- Secara teknis bisa dipertahankan sesuai SQL, tetapi boolean lebih ideal untuk implementasi baru.

### `proposal`

Menyimpan proposal kegiatan atau bantuan.

Relasi:

- `proposal.admin_id` belongs to pengaju pada `admin.id`
- `proposal.dinas_tujuan_id` belongs to tujuan pada `admin.id`

Status:

- `diajukan`
- `diproses_pemda`
- `dana_cair`
- `ditolak`

### `volunteer`

Menyimpan program volunteer.

Relasi:

- `volunteer.admin_id` belongs to pembuat pada `admin.id`
- `volunteer` has many `anggota_volunteer`

### `anggota_volunteer`

Menyimpan pendaftaran anggota ormada pada program volunteer.

Relasi:

- belongs to `volunteer`
- belongs to `anggota_ormada`

Status:

- `pending`
- `diterima`
- `ditolak`

### `kolaborasi`

Menyimpan program kolaborasi Pemda dan ormada.

Relasi:

- `admin_id_pemda` belongs to `admin.id`
- `admin_id_ormada` belongs to `admin.id`

Status:

- `diajukan`
- `disetujui`
- `selesai`
- `batal`

### `aspirasi`

Menyimpan aspirasi dari ormada untuk Pemda.

Relasi:

- belongs to `profil_ormada`

### `postingan`

Menyimpan konten berita, pengumuman, dan prestasi.

Relasi:

- belongs to `admin`

Jenis konten:

- `berita`
- `pengumuman`
- `prestasi`

### `agenda`

Menyimpan agenda kegiatan ormada atau Pemda.

Relasi:

- belongs to `admin`

Kategori:

- `ormada`
- `pemda`

## Relasi Model Laravel

### `Admin`

```php
public function profilOrmada()
{
    return $this->hasOne(ProfilOrmada::class);
}

public function proposals()
{
    return $this->hasMany(Proposal::class);
}

public function postingan()
{
    return $this->hasMany(Postingan::class);
}

public function agenda()
{
    return $this->hasMany(Agenda::class);
}
```

### `ProfilOrmada`

```php
public function admin()
{
    return $this->belongsTo(Admin::class);
}

public function anggota()
{
    return $this->hasMany(AnggotaOrmada::class);
}

public function aspirasi()
{
    return $this->hasMany(Aspirasi::class);
}
```

### `AnggotaOrmada`

```php
public function profilOrmada()
{
    return $this->belongsTo(ProfilOrmada::class);
}

public function volunteerRegistrations()
{
    return $this->hasMany(AnggotaVolunteer::class);
}
```

## Modul Controller

Rekomendasi controller:

- `AuthController`
- `DashboardController`
- `ProfilOrmadaController`
- `AnggotaOrmadaController`
- `ProposalController`
- `VolunteerController`
- `AnggotaVolunteerController`
- `KolaborasiController`
- `AspirasiController`
- `PostinganController`
- `AgendaController`

## Rancangan Route Web

```php
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('profil-ormada', ProfilOrmadaController::class);
    Route::resource('anggota-ormada', AnggotaOrmadaController::class);
    Route::resource('proposal', ProposalController::class);
    Route::resource('volunteer', VolunteerController::class);
    Route::resource('kolaborasi', KolaborasiController::class);
    Route::resource('aspirasi', AspirasiController::class);
    Route::resource('postingan', PostinganController::class);
    Route::resource('agenda', AgendaController::class);

    Route::patch('/proposal/{proposal}/status', [ProposalController::class, 'updateStatus'])
        ->name('proposal.update-status');

    Route::patch('/aspirasi/{aspirasi}/tanggapan', [AspirasiController::class, 'updateTanggapan'])
        ->name('aspirasi.update-tanggapan');

    Route::post('/volunteer/{volunteer}/anggota', [AnggotaVolunteerController::class, 'store'])
        ->name('volunteer.anggota.store');

    Route::patch('/volunteer-anggota/{anggotaVolunteer}/status', [AnggotaVolunteerController::class, 'updateStatus'])
        ->name('volunteer.anggota.update-status');
});
```

## Middleware dan Authorization

Tambahkan middleware peran, misalnya `role:admin,pemda`.

Aturan akses utama:

- Pengurus ormada hanya boleh mengubah profil dan anggota milik admin yang sedang login.
- Pemda boleh melihat semua profil dan anggota, tetapi tidak mengubah data internal ormada kecuali fitur memang diizinkan.
- Pemda boleh mengubah status proposal dan tanggapan aspirasi.
- Pengurus ormada boleh membuat proposal dan aspirasi.
- Admin sistem boleh mengakses semua modul.

## Validasi Input

### Profil Ormada

- `nama_universitas`: required, max 255
- `alamat_universitas`: required, max 255
- `total_mahasiswa_univ`: integer, min 0
- `logo`: nullable, image
- `deskripsi`: nullable

### Anggota Ormada

- `nama_lengkap`: required, max 255
- `nim`: required, max 50
- `program_studi`: required, max 255
- `status_aktif`: required, in daftar enum
- `is_pengurus`: required, in `YA,TIDAK`
- `no_hp`: nullable, max 20
- tanggal: nullable, date

### Proposal

- `dinas_tujuan_id`: required, exists admin
- `judul_kegiatan`: required, max 255
- `deskripsi_kegiatan`: required
- `jenis_bantuan`: required, in `dana,izin,tempat,fasilitas`
- `anggaran_dibutuhkan`: integer, min 0
- `file_proposal`: required, file, mimes pdf/doc/docx

### Volunteer

- `nama_volunteer`: required, max 255
- `deskripsi`: required
- `kuota`: integer, min 0
- `tenggat_pendaftaran`: required, date
- `status`: in `buka,tutup`

### Kolaborasi

- `admin_id_pemda`: required, exists admin
- `admin_id_ormada`: required, exists admin
- `nama_program`: required, max 255
- `deskripsi_kolaborasi`: required
- `anggaran_bersama`: integer, min 0
- `tanggal_pelaksanaan`: required, date
- `tempat_pelaksanaan`: required, max 255
- `file_mou`: nullable, file

### Aspirasi

- `topik_aspirasi`: required, max 255
- `detail_aspirasi`: required
- `file`: nullable, file
- `tanggapan_pemda`: nullable

### Postingan

- `judul`: required, max 255
- `isi_konten`: required
- `foto`: nullable, image
- `jenis_konten`: required, in `berita,pengumuman,prestasi`

### Agenda

- `nama_agenda`: required, max 255
- `deskripsi_agenda`: required
- `gambar_poster`: nullable, image
- `waktu_mulai`: required, date
- `waktu_selesai`: required, date, after_or_equal waktu_mulai
- `tempat`: required, max 255
- `kategori`: required, in `ormada,pemda`

## File Upload

File disimpan menggunakan disk `public`.

Rekomendasi folder:

- `profil-ormada/logo`
- `proposal`
- `aspirasi`
- `postingan/foto`
- `agenda/poster`
- `kolaborasi/mou`

Path file yang disimpan ke database cukup path relatif dari storage publik.

## Dashboard

### Dashboard Pengurus Ormada

Data yang ditampilkan:

- Jumlah anggota.
- Jumlah pengurus aktif.
- Jumlah proposal berdasarkan status.
- Jumlah aspirasi.
- Agenda terdekat.
- Volunteer yang masih buka.

### Dashboard Pemda

Data yang ditampilkan:

- Jumlah ormada.
- Total anggota terdata.
- Proposal masuk berdasarkan status.
- Aspirasi belum ditanggapi.
- Agenda Pemda terdekat.
- Program kolaborasi aktif.

## Data Migration

SQL awal dapat dikonversi menjadi migration Laravel:

- `create_admin_table`
- `create_profil_ormada_table`
- `create_anggota_ormada_table`
- `create_proposal_table`
- `create_volunteer_table`
- `create_anggota_volunteer_table`
- `create_kolaborasi_table`
- `create_aspirasi_table`
- `create_postingan_table`
- `create_agenda_table`

Catatan:

- Laravel default timestamp memakai `created_at` dan `updated_at`. SQL memakai `dibuat_pada` dan `diperbarui_pada`. Pilih salah satu strategi:
  - Pertahankan nama Indonesia dan set konstanta `CREATED_AT` serta `UPDATED_AT` pada model.
  - Atau ubah kolom ke standar Laravel agar lebih minim konfigurasi.

## Seeder

Seeder awal perlu memuat:

- Satu akun Pemda.
- Beberapa akun pengurus ormada.
- Profil ormada.
- Anggota ormada.
- Aspirasi contoh.

Password dummy pada SQL memakai hash Laravel untuk nilai umum `password`.

## Testing

### Feature Test

Minimal test:

- User bisa login dengan kredensial valid.
- User tidak bisa login dengan kredensial salah.
- Pengurus ormada bisa membuat anggota pada profilnya.
- Pengurus ormada tidak bisa mengubah anggota milik ormada lain.
- Pengurus ormada bisa mengajukan proposal.
- Pemda bisa mengubah status proposal.
- Pengurus ormada tidak bisa mengubah status proposal.
- Pengurus ormada bisa membuat aspirasi.
- Pemda bisa memberi tanggapan aspirasi.
- Pemda bisa membuat volunteer.
- Anggota ormada bisa didaftarkan ke volunteer.

### Unit Test

Minimal test:

- Relasi `Admin` ke `ProfilOrmada`.
- Relasi `ProfilOrmada` ke `AnggotaOrmada`.
- Relasi `Proposal` ke pengaju dan dinas tujuan.
- Relasi `Volunteer` ke `AnggotaVolunteer`.

## Risiko Teknis

- Nama tabel dan kolom berbahasa Indonesia berbeda dari konvensi Laravel, sehingga model perlu konfigurasi ekstra.
- Tabel `admin` menggantikan tabel default `users`, sehingga auth bawaan Laravel perlu disesuaikan.
- Banyak foreign key memakai `ON DELETE CASCADE`; penghapusan akun admin dapat menghapus profil, proposal, agenda, postingan, volunteer, dan kolaborasi terkait.
- Kolom `is_pengurus` bertipe string, sehingga perlu validasi konsisten agar tidak ada nilai selain `YA` dan `TIDAK`.
- `dinas_tujuan_id` mengarah ke tabel `admin`, sehingga validasi perlu memastikan akun tujuan punya peran Pemda.

## Rencana Implementasi

1. Buat migration sesuai SQL atau ubah ke konvensi Laravel.
2. Buat model dan relasi.
3. Konfigurasi authentication memakai model `Admin`.
4. Tambahkan middleware role.
5. Implementasi dashboard.
6. Implementasi CRUD profil ormada dan anggota.
7. Implementasi proposal dan update status.
8. Implementasi aspirasi dan tanggapan.
9. Implementasi postingan dan agenda.
10. Implementasi volunteer dan kolaborasi.
11. Tambahkan feature test dan unit test.

