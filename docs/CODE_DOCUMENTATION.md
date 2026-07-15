# Dokumentasi Kode Proyek Magang

## Overview
Proyek ini adalah aplikasi web berbasis Laravel untuk mengelola kegiatan ORMADA (Organisasi Mahasiswa Daerah). Sistem ini memiliki 3 role utama:
- **Admin**: Akses penuh ke semua fitur
- **Pemda**: Pemerintah daerah yang dapat mengelola agenda, volunteer, proposal, dan aspirasi
- **Pengurus Ormada**: Pengurus organisasi mahasiswa

---

## Models

### app/Models/User.php
**Kegunaan**: Model dasar untuk autentikasi pengguna (Authenticatable).

**Fitur**:
- Menggunakan trait `HasFactory` dan `Notifiable`
- Mass assignable: `name`, `email`, `password`
- Hidden fields: `password`, `remember_token`
- Casts: `email_verified_at` (datetime), `password` (hashed)

---

### app/Models/Admin.php
**Kegunaan**: Model untuk akun admin/pengurus dengan role-based access.

**Fitur**:
- Custom timestamps: `dibuat_pada`, `diperbarui_pata`
- Kolom: `nama`, `email`, `password`, `peran`, `terakhir_masuk`
- Relasi: `profilOrmada()` (HasOne), `profilOrmadas()` (HasMany ke ProfilOrmada)
- Helper methods: 
  - `isAdmin()` - cek role admin
  - `isPemda()` - cek role pemerintah daerah
  - `isPengurusOrmada()` - cek role pengurus ormada

---

### app/Models/Agenda.php
**Kegunaan**: Model untuk kegiatan/agenda yang dapat diadakan.

**Fitur**:
- Kolom: `admin_id`, `nama_agenda`, `deskripsi_agenda`, `gambar_poster`, `waktu_mulai`, `waktu_selesai`, `tempat`, `kategori`, `kuota_volunteer`, `deadline_pendaftaran`, `is_published`, `tanggal_publish`
- Relasi: `admin()` (BelongsTo), `volunteers()` (HasMany ke Volunteer)
- Scopes:
  - `scopePublished()` - agenda yang sudah dipublish
  - `scopeUpcoming()` - agenda yang akan datang (waktu_mulai >= now())
  - `scopeOpenVolunteer()` - agenda yang masih membuka pendaftaran volunteer
  - `scopeByKategori()` - filter by kategori

**Kategori**: kegiatan_ormada, kegiatan_pemda, baksos, pendidikan, kesehatan, lingkungan, lainnya

---

### app/Models/AnggotaOrmada.php
**Kegunaan**: Model untuk data anggota ormada (mahasiswa).

**Fitur**:
- Kolom: `profil_ormada_id`, `nama_lengkap`, `nim`, `program_studi`, `status_aktif`, `jabatan`, `is_pengurus`, `tanggal_masuk_kuliah`, `tanggal_lulus_kuliah`, `tanggal_mulai_jabatan`, `tanggal_akhir_jabatan`, `tanggal_demisioner`, `tanggal_lulus`, `no_hp`
- Relasi: `profilOrmada()` (BelongsTo ke ProfilOrmada)
- Scope: `scopeSearch()` - pencarian by nama, nim, program studi
- Status Aktif: fungsionaris, mahasiswa_biasa, demisioner, alumni

---

### app/Models/Aspirasi.php
**Kegunaan**: Model untuk aspirasi/keluhan dari masyarakat.

**Fitur**:
- Kolom: `profil_ormada_id`, `topik_aspirasi`, `detail_aspirasi`, `file`, `tanggapan_pemda`, `tanggal_tanggapan`, `status`
- Relasi: `profilOrmada()` (BelongsTo), `pengaju()` (BelongsTo ke Admin)
- Scopes:
  - `scopePublik()` - semua aspirasi dengan relasi profilOrmada
  - `scopeByStatus()` - filter by status

**Status**: belum_ditanggapi, sedang_diproses, selesai, ditolak

---

### app/Models/Postingan.php
**Kegunaan**: Model untuk postingan/artikel berita.

**Fitur**:
- Kolom: `admin_id`, `judul`, `isi_konten`, `foto`, `jenis_konten`, `is_published`, `tanggal_publish`
- Relasi: `admin()` (BelongsTo)
- Scopes:
  - `scopePublished()` - postingan yang sudah dipublish
  - `scopeByJenis()` - filter by jenis konten

**Jenis Konten**: berita, pengumuman, prestasi

---

### app/Models/ProfilOrmada.php
**Kegunaan**: Model untuk profil ormada (organisasi mahasiswa).

**Fitur**:
- Kolom: `admin_id`, `nama_universitas`, `alamat_universitas`, `total_mahasiswa_univ`, `logo`, `deskripsi`
- Relasi: `admin()` (BelongsTo), `anggota()` (HasMany ke AnggotaOrmada)
- Casts: `total_mahasiswa_univ` (integer)

---

### app/Models/Proposal.php
**Kegunaan**: Model untuk pengajuan proposal bantuan.

**Fitur**:
- Kolom: `admin_id`, `dinas_tujuan_id`, `judul_kegiatan`, `deskripsi_kegiatan`, `jenis_bantuan`, `anggaran_dibutuhkan`, `file_proposal`, `status`, `catatan_pemda`
- Relasi: `pengaju()` (BelongsTo ke Admin), `dinasTujuan()` (BelongsTo ke Admin sebagai pemda)
- Scope: `scopeFilter()` - filter by status dan jenis bantuan

**Status**: diajukan, diproses_pemda, dana_cair, ditolak

**Jenis Bantuan**: dana, izin, tempat, fasilitas

---

### app/Models/Volunteer.php
**Kegunaan**: Model untuk pendaftaran volunteer pada agenda.

**Fitur**:
- Kolom: `agenda_id`, `nama`, `email`, `no_hp`, `alasan`, `status`
- Relasi: `agenda()` (BelongsTo)
- Scope: `scopeByStatus()` - filter by status

**Status**: pending, diterima, ditolak

---

## Controllers

### app/Http/Controllers/AuthController.php
**Kegunaan**: Menangani proses autentikasi pengguna (login/logout).

**Methods**:
- `showLogin()` - Menampilkan halaman login
- `login()` - Proses login dengan validasi email/password, update `terakhir_masuk`
- `logout()` - Proses logout dengan invalidasi session

---

### app/Http/Controllers/AdminController.php
**Kegunaan**: Mengelola data admin/pengurus (CRUD).

**Methods**:
- `index()` - Menampilkan daftar admin
- `create()` - Menampilkan form buat admin baru
- `store()` - Menyimpan admin baru dengan validasi dan bcrypt password
- `edit()` - Menampilkan form edit admin
- `update()` - Update data admin (password opsional)
- `destroy()` - Hapus admin (tidak bisa hapus diri sendiri)

---

### app/Http/Controllers/AgendaController.php
**Kegunaan**: Mengelola kegiatan/agenda dan volunteer.

**Methods**:
- `index()` - Menampilkan daftar agenda (filter by role user)
- `create()` - Form buat agenda baru
- `store()` - Simpan agenda dengan upload poster, set publish status
- `show()` - Detail agenda dengan daftar volunteer (dengan pagination dan filter)
- `edit()` - Form edit agenda
- `update()` - Update agenda dengan handling upload poster baru
- `destroy()` - Hapus agenda
- `publish()` - Publish agenda (hanya Pemda/Admin)
- `daftarVolunteer()` - Pendaftaran volunteer untuk agenda (public, dengan validasi kuota dan deadline)
- `listVolunteer()` - Menampilkan daftar volunteer untuk agenda tertentu
- `updateStatusVolunteer()` - Update status volunteer (diterima/ditolak)
- `validateAgenda()` - Validasi input agenda
- `authorizeAgendaAccess()` - Authorization check akses agenda

**Fitur Khusus**:
- Upload poster agenda ke `storage/app/public/agenda/poster`
- Manajemen kuota volunteer dan deadline pendaftaran
- Scope-based volunteer list berdasarkan role

---

### app/Http/Controllers/PostinganController.php
**Kegunaan**: Mengelola postingan/artikel berita.

**Methods**:
- `index()` - Daftar postingan (filter by role)
- `create()` - Form buat postingan
- `store()` - Simpan postingan dengan upload foto
- `show()` - Detail postingan
- `edit()` - Form edit postingan
- `update()` - Update postingan dengan handling foto
- `destroy()` - Hapus postingan
- `publish()` - Publish postingan (hanya Pemda/Admin)
- `validatePostingan()` - Validasi input postingan
- `authorizePostinganAccess()` - Authorization check akses postingan

**Fitur**:
- Upload foto ke `storage/app/public/postingan/foto`
- Jenis konten: berita, pengumuman, prestasi

---

### app/Http/Controllers/AnggotaOrmadaController.php
**Kegunaan**: Mengelola data anggota ormada.

**Methods**:
- `index()` - Redirect ke profil ormada pengurus atau daftar profil
- `create()` - Form tambah anggota (filter profil by role)
- `store()` - Simpan anggota baru
- `show()` - Detail anggota (dengan load relasi)
- `edit()` - Form edit anggota (hanya admin/pengurus pemilik)
- `update()` - Update data anggota
- `destroy()` - Hapus anggota
- `validateAnggota()` - Validasi input anggota
- `authorizeAnggotaAccess()` - Authorization akses data
- `authorizeAnggotaMutation()` - Authorization mutasi data

**Fitur Khusus**:
- Pengurus hanya bisa manage anggota di profilnya sendiri
- Validasi status aktif (fungsionaris, mahasiswa_biasa, demisioner, alumni)
- Validasi tanggal demisioner/lulus sesuai status

---

### app/Http/Controllers/ProfilOrmadaController.php
**Kegunaan**: Mengelola profil organisasi mahasiswa.

**Methods**:
- `index()` - Daftar profil ormada dengan count anggota
- `create()` - Form buat profil (redirect jika pengurus sudah punya profil)
- `store()` - Simpan profil dengan upload logo
- `show()` - Detail profil dengan anggota ringkas dan list lengkap (dengan pagination, search, filter)
- `edit()` - Form edit profil
- `update()` - Update profil dengan handling logo
- `validateProfil()` - Validasi input profil
- `authorizeProfilAccess()` - Authorization akses profil
- `authorizeProfilMutation()` - Authorization edit profil

**Fitur**:
- Upload logo ke `storage/app/public/profil-ormada/logo`
- Count anggota by status (pengurus, alumni, demisioner)
- Search dan filter anggota by status

---

### app/Http/Controllers/ProposalController.php
**Kegunaan**: Mengelola proposal pengajuan bantuan.

**Methods**:
- `index()` - Daftar proposal (filter by role dan parameter query)
- `create()` - Form buat proposal dengan list dinas tujuan
- `store()` - Simpan proposal dengan upload file
- `show()` - Detail proposal
- `edit()` - Form edit proposal
- `update()` - Update proposal dengan handling file
- `updateStatus()` - Update status proposal (hanya Pemda/Admin)
- `destroy()` - Hapus proposal
- `validateProposal()` - Validasi input proposal
- `authorizeProposalAccess()` - Authorization akses proposal
- `authorizeProposalMutation()` - Authorization edit proposal

**Fitur**:
- Upload file proposal ke `storage/app/public/proposal`
- Jenis bantuan: dana, izin, tempat, fasilitas
- Status workflow: diajukan, diproses_pemda, dana_cair, ditolak
- Catatan dari Pemda

---

### app/Http/Controllers/AspirasiController.php
**Kegunaan**: Mengelola aspirasi/keluhan dari masyarakat.

**Methods**:
- `index()` - Daftar aspirasi (filter by role)
- `create()` - Form buat aspirasi
- `store()` - Simpan aspirasi dengan upload file lampiran
- `show()` - Detail aspirasi
- `edit()` - Form edit aspirasi
- `update()` - Update aspirasi dengan handling file
- `destroy()` - Hapus aspirasi
- `updateTanggapan()` - Update tanggapan dan status aspirasi (hanya Pemda/Admin)
- `validateAspirasi()` - Validasi input aspirasi
- `authorizeAspirasiAccess()` - Authorization akses aspirasi

**Fitur**:
- Upload file ke `storage/app/public/aspirasi`
- Status: belum_ditanggapi, sedang_diproses, selesai, ditolak
- Tanggapan dari Pemda

---

### app/Http/Controllers/DashboardController.php
**Kegunaan**: Menampilkan dashboard statistik sesuai role user.

**Methods**:
- `index()` - Dashboard dengan data statistik

**Data per Role**:
- **Admin**: total ormada, total anggota, total pengurus, total alumni, total demisioner
- **Pemda**: total ormada, total anggota aktif, agenda mendatang, proposal menunggu
- **Pengurus Ormada**: profil ormada, total anggota, total pengurus, total alumni, total proposal miliknya

---

### app/Http/Controllers/VolunteerController.php
**Kegunaan**: Manajemen volunteer (Pemda/Admin).

**Methods**:
- `index()` - Daftar semua volunteer (filter by role)
- `updateStatus()` - Update status volunteer (diterima/ditolak)

---

### app/Http/Controllers/PublicDashboardController.php
**Kegunaan**: Kontroler untuk halaman publik (tanpa auth).

**Methods**:
- `index()` - Homepage dengan data publik (agenda, ormada, postingan, aspirasi)
- `aspirasi()` - Halaman daftar aspirasi publik
- `postingan()` - Halaman daftar postingan publik (dengan filter jenis)
- `filterPostingan()` - API endpoint untuk filter postingan (AJAX)
- `agenda()` - Halaman daftar agenda publik
- `showAgenda()` - Detail agenda publik (hanya yang published)
- `showPostingan()` - Detail postingan publik (hanya yang published)
- `showAspirasi()` - Detail aspirasi publik
- `showOrmada()` - Detail profil ormada publik

**Fitur**:
- Data diolah untuk carousel dengan format khusus
- Akses hanya konten yang published

---

### app/Http/Controllers/StorageController.php
**Kegunaan**: Serve file dari storage dengan caching.

**Methods**:
- `serve()` - Melayani file dari `storage/app/public/` dengan headers caching

---

## Policies

### app/Policies/AgendaPolicy.php
**Kegunaan**: Authorization policy untuk Agenda.

**Methods**:
- `create()` - Admin, Pemda, Pengurus Ormada bisa buat agenda
- `update()` - Hanya Admin dan Pemda yang bisa edit
- `delete()` - Admin bisa hapus semua, pengurus bisa hapus miliknya
- `publish()` - Hanya Pemda/Admin yang bisa publish
- `manageVolunteer()` - Hanya Pemda/Admin yang bisa manage volunteer

---

### app/Policies/PostinganPolicy.php
**Kegunaan**: Authorization policy untuk Postingan.

**Methods**:
- `create()` - Pengurus Ormada, Pemda, Admin bisa buat postingan
- `update()` - Admin/Pemda bisa edit semua, pengurus bisa edit miliknya
- `delete()` - Admin bisa hapus semua, pengurus bisa hapus miliknya
- `publish()` - Hanya Pemda/Admin yang bisa publish

---

### app/Policies/AspirasiPolicy.php
**Kegunaan**: Authorization policy untuk Aspirasi.

**Methods**:
- `create()` - Pengurus Ormada dan Admin bisa buat aspirasi
- `update()` - Admin bisa edit semua, pengurus bisa edit milik profilnya
- `delete()` - Admin bisa hapus semua, pengurus bisa hapus milik profilnya
- `respond()` - Hanya Pemda/Admin yang bisa tanggapi aspirasi

---

### app/Policies/ProposalPolicy.php
**Kegunaan**: Authorization policy untuk Proposal.

**Methods**:
- `create()` - Pengurus Ormada dan Admin bisa buat proposal
- `update()` - Admin bisa edit semua, pengurus bisa edit miliknya
- `delete()` - Admin bisa hapus semua, pengurus bisa hapus miliknya

---

## Helpers

### app/Helpers/StorageHelper.php
**Kegunaan**: Helper class untuk manajemen file storage.

**Methods**:
- `url()` - Generate URL lengkap untuk file stored (`asset('storage/' . $path)`)
- `exists()` - Cek keberadaan file di disk public
- `delete()` - Hapus file dari disk public
- `agendaPoster()` - Get URL untuk poster agenda
- `postinganFoto()` - Get URL untuk foto postingan
- `profilLogo()` - Get URL untuk logo profil ormada

---

### app/Helpers/helpers.php
**Kegunaan**: Global helper functions untuk digunakan di view dan controller.

**Functions**:
- `storage_url()` - Alias untuk StorageHelper::url()
- `agenda_poster_url()` - Alias untuk StorageHelper::agendaPoster()
- `postingan_foto_url()` - Alias untuk StorageHelper::postinganFoto()
- `profil_logo_url()` - Alias untuk StorageHelper::profilLogo()
- `file_exists_storage()` - Alias untuk StorageHelper::exists()

---

## Providers

### app/Providers/AppServiceProvider.php
**Kegunaan**: Service provider utama aplikasi.

**Methods**:
- `register()` - Register services (kosong)
- `boot()` - Bootstrap services (kosong)

---

### app/Providers/AuthServiceProvider.php
**Kegunaan**: Service provider untuk autentikasi dan authorization policies.

**Fitur**:
- Mendaftarkan policies: Proposal, Aspirasi, Postingan, Agenda
- `boot()` - Memanggil `registerPolicies()`

---

### app/Providers/HelperServiceProvider.php
**Kegunaan**: Service provider untuk memuat helper functions.

**Methods**:
- `boot()` - Load file `app/Helpers/helpers.php` menggunakan `require_once`

---

## Middleware

### app/Http/Middleware/RoleMiddleware.php
**Kegunaan**: Middleware untuk authorize user berdasarkan role.

**Methods**:
- `handle()` - Cek apakah user memiliki role yang diizinkan

**Usage**:
```
Route::middleware('role:admin,pemda')->group(function () {
    // routes here
});
```

---

## Routes

### routes/web.php
**Kegunaan**: Definisi semua routes aplikasi.

**Public Routes**:
- GET `/` - Homepage publik (PublicDashboardController@index)
- GET `/storage/{path}` - Serve file storage
- GET `/publik/aspirasi` - Daftar aspirasi publik
- GET `/publik/postingan` - Daftar postingan publik
- GET `/publik/postingan/{postingan}` - Detail postingan publik
- GET `/publik/postingan/filter` - Filter postingan (AJAX)
- GET `/publik/agenda` - Daftar agenda publik
- GET `/publik/agenda/{agenda}` - Detail agenda publik
- GET `/publik/aspirasi/{aspirasi}` - Detail aspirasi publik
- GET `/publik/ormada/{profilOrmada}` - Detail ormada publik
- POST `/agenda/{agenda}/daftar-volunteer` - Pendaftaran volunteer (public)

**Authenticated Routes**:
- GET `/dashboard` - Dashboard (role-based)
- POST `/logout` - Logout

**Admin Routes** (role:admin):
- CRUD `/admin` - Manajemen admin

**Shared Routes** (role:pemda,admin,pengurus_ormada):
- CRUD `/agenda` - Manajemen agenda + publish + volunteer management
- CRUD `/postingan` - Manajemen postingan + publish
- CRUD `/proposal` - Manajemen proposal + update status
- CRUD `/aspirasi` - Manajemen aspirasi + update tanggapan

**Pengurus Routes**:
- CRUD `/anggota-ormada` - Manajemen anggota (kecuali index)

**All Authenticated**:
- GET `/anggota-ormada` - Index anggota (redirect to profil)

---

## Config Files

### config/app.php
**Kegunaan**: Konfigurasi utama aplikasi (timezone, locale, providers, aliases).

### config/auth.php
**Kegunaan**: Konfigurasi autentikasi (guard, password reset, providers).

### config/database.php
**Kegunaan**: Konfigurasi koneksi database (mysql, sqlite, pgsql).

### config/filesystems.php
**Kegunaan**: Konfigurasi filesystem (local, public, s3). Menggunakan disk 'public' untuk file upload.

### config/logging.php
**Kegunaan**: Konfigurasi logging aplikasi.

### config/mail.php
**Kegunaan**: Konfigurasi pengiriman email (SMTP, Mailgun, dll).

### config/cache.php
**Kegunaan**: Konfigurasi caching (file, redis, memcached).

### config/queue.php
**Kegunaan**: Konfigurasi job queue (database, redis, sqs).

### config/services.php
**Kegunaan**: Konfigurasi API keys untuk layanan eksternal.

### config/session.php
**Kegunaan**: Konfigurasi session management (driver, lifetime, encryption).

---

## Database Structure

### Tables Overview
1. **users** - Akun pengguna umum (default Laravel)
2. **admin** - Akun admin/pemda/pengurus ormada
3. **profil_ormada** - Profil organisasi mahasiswa
4. **anggota_ormada** - Data anggota ormada
5. **agenda** - Kegiatan/agenda
6. **volunteers** - Pendaftaran volunteer
7. **postingan** - Postingan/artikel berita
8. **proposal** - Proposal pengajuan bantuan
9. **aspirasi** - Aspirasi/keluhan masyarakat

### Key Relationships
- Admin `hasMany` ProfilOrmada
- Admin `hasMany` Agenda
- Admin `hasMany` Postingan
- Admin `hasMany` Proposal (as pengaju)
- Admin `hasMany` Proposal (as dinas_tujuan)
- ProfilOrmada `hasMany` AnggotaOrmada
- ProfilOrmada `belongsTo` Admin
- Agenda `belongsTo` Admin
- Agenda `hasMany` Volunteer
- AnggotaOrmada `belongsTo` ProfilOrmada
- Aspirasi `belongsTo` ProfilOrmada
- Aspirasi `belongsTo` Admin (as pengaju)
- Proposal `belongsTo` Admin (as pengaju)
- Proposal `belongsTo` Admin (as dinas_tujuan)
+ 


