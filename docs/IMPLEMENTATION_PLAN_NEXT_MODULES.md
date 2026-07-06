# Planning Implementasi Module Selanjutnya

## Status Saat Ini

### ✅ Sudah Selesai (Prioritas 1-4):
1. **Autentikasi & Otorisasi** - Login/logout dengan role-based access
2. **Profil Ormada** - CRUD lengkap dengan authorization
3. **Anggota Ormada** - Manajemen anggota dengan relasi ke profil
4. **Proposal Bantuan** - Module proposal dengan status tracking

### ⏳ Belum Diimplementasikan (Prioritas 5-7):
5. **Aspirasi** - Aspirasi ormada ke Pemda dengan tanggapan
6. **Postingan & Agenda** - Berita, pengumuman, prestasi, dan kalender
7. **Volunteer & Kolaborasi** - Program volunteer dan kolaborasi Pemda-ormada

---

## Prioritas 5: Aspirasi

### Tujuan
Memungkinkan ormada mengirim aspirasi kepada Pemda dan Pemda menanggapi aspirasi tersebut.

### Database Migration
**File**: `database/migrations/2026_07_06_000002_create_aspirasi_table.php`

**Tabel**: `aspirasi`
- `id`
- `profil_ormada_id` (foreign key ke profil_ormada)
- `topik_aspirasi` (string, required)
- `detail_aspirasi` (text, required)
- `file` (string, nullable) - path file pendukung
- `tanggapan_pemda` (text, nullable)
- `dibuat_pada` (timestamp)
- `diperbarui_pada` (timestamp)

**Indexes**:
- `profil_ormada_id`
- `created_at` untuk sorting

### Model
**File**: `app/Models/Aspirasi.php`

**Relasi**:
- `profilOrmada()` - belongsTo ProfilOrmada
- `pengaju()` - belongsTo Admin (through profilOrmada)

**Fillable**:
- `profil_ormada_id`
- `topik_aspirasi`
- `detail_aspirasi`
- `file`
- `tanggapan_pemda`

### Controller
**File**: `app/Http/Controllers/AspirasiController.php`

**Methods**:
1. `index()` - List aspirasi (filter by profil_ormada untuk pengurus, semua untuk pemda)
2. `create()` - Form buat aspirasi (hanya pengurus ormada)
3. `store()` - Simpan aspirasi baru
4. `show()` - Detail aspirasi
5. `edit()` - Form edit aspirasi (hanya pengurus ormada pemilik)
6. `update()` - Update aspirasi
7. `destroy()` - Hapus aspirasi
8. `updateTanggapan()` - Update tanggapan Pemda (hanya Pemda/Admin)

**Authorization**:
- Pengurus ormada: CRUD aspirasi milik profilnya
- Pemda: Read all + update tanggapan
- Admin: All access

### Views
**Files**:
- `resources/views/aspirasi/index.blade.php` - Daftar aspirasi
- `resources/views/aspirasi/create.blade.php` - Form buat aspirasi
- `resources/views/aspirasi/show.blade.php` - Detail aspirasi dengan form tanggapan
- `resources/views/aspirasi/edit.blade.php` - Form edit aspirasi

### Routes
```php
Route::resource('aspirasi', AspirasiController::class);
Route::patch('/aspirasi/{aspirasi}/tanggapan', [AspirasiController::class, 'updateTanggapan'])
    ->name('aspirasi.update-tanggapan');
```

### Policy
**File**: `app/Policies/AspirasiPolicy.php`

**Methods**:
- `create(Admin $user)` - pengurus_ormada atau admin
- `update(Admin $user, Aspirasi $aspirasi)` - admin atau pemilik profil
- `delete(Admin $user, Aspirasi $aspirasi)` - admin atau pemilik profil
- `respond(Admin $user, Aspirasi $aspirasi)` - pemda atau admin

### Testing
**File**: `tests/Feature/AspirasiTest.php`

**Test Cases**:
1. Pengurus bisa membuat aspirasi
2. Pengurus bisa melihat aspirasi miliknya
3. Pengurus bisa edit aspirasi miliknya
4. Pengurus tidak bisa melihat aspirasi ormada lain
5. Pemda bisa melihat semua aspirasi
6. Pemda bisa menambah tanggapan
7. Admin bisa mengelola semua aspirasi

### Estimasi Waktu: 2-3 jam

---

## Prioritas 6: Postingan & Agenda

### Tujuan
Membuat sistem konten informasi (berita, pengumuman, prestasi) dan agenda kegiatan.

### Database Migration
**File**: `database/migrations/2026_07_06_000003_create_postingan_table.php`

**Tabel**: `postingan`
- `id`
- `admin_id` (foreign key ke admin, pembuat postingan)
- `judul` (string, required)
- `isi_konten` (text, required)
- `foto` (string, nullable) - path foto
- `jenis_konten` (enum: berita, pengumuman, prestasi)
- `dibuat_pada` (timestamp)
- `diperbarui_pada` (timestamp)

**Indexes**:
- `admin_id`
- `jenis_konten`
- `created_at`

**File**: `database/migrations/2026_07_06_000004_create_agenda_table.php`

**Tabel**: `agenda`
- `id`
- `admin_id` (foreign key ke admin, pembuat agenda)
- `nama_agenda` (string, required)
- `deskripsi_agenda` (text, required)
- `gambar_poster` (string, nullable)
- `waktu_mulai` (datetime, required)
- `waktu_selesai` (datetime, required)
- `tempat` (string, required)
- `kategori` (enum: ormada, pemda)
- `dibuat_pada` (timestamp)
- `diperbarui_pada` (timestamp)

**Indexes**:
- `admin_id`
- `kategori`
- `waktu_mulai`
- `waktu_selesai`

### Models
**File**: `app/Models/Postingan.php`
- Relasi: `admin()` - belongsTo Admin
- Fillable: admin_id, judul, isi_konten, foto, jenis_konten

**File**: `app/Models/Agenda.php`
- Relasi: `admin()` - belongsTo Admin
- Fillable: admin_id, nama_agenda, deskripsi_agenda, gambar_poster, waktu_mulai, waktu_selesai, tempat, kategori

### Controllers
**File**: `app/Http/Controllers/PostinganController.php`
- CRUD untuk postingan
- Authorization: Admin dan Pemda bisa create, Pengurus ormada bisa create postingan untuk ormada-nya

**File**: `app/Http/Controllers/AgendaController.php`
- CRUD untuk agenda
- Authorization: Admin dan Pemda bisa create, Pengurus ormada bisa create agenda ormada

### Views
**Files**:
- `resources/views/postingan/index.blade.php`
- `resources/views/postingan/create.blade.php`
- `resources/views/postingan/show.blade.php`
- `resources/views/postingan/edit.blade.php`
- `resources/views/agenda/index.blade.php`
- `resources/views/agenda/create.blade.php`
- `resources/views/agenda/show.blade.php`
- `resources/views/agenda/edit.blade.php`
- `resources/views/agenda/calendar.blade.php` (opsional - kalender agenda)

### Routes
```php
Route::resource('postingan', PostinganController::class);
Route::resource('agenda', AgendaController::class);
```

### Policies
**File**: `app/Policies/PostinganPolicy.php`
**File**: `app/Policies/AgendaPolicy.php`

### Testing
**File**: `tests/Feature/PostinganTest.php`
**File**: `tests/Feature/AgendaTest.php`

### Estimasi Waktu: 3-4 jam

---

## Prioritas 7: Volunteer & Kolaborasi

### Tujuan
Membuat program volunteer dan kolaborasi antara Pemda dan ormada.

### Database Migration
**File**: `database/migrations/2026_07_06_000005_create_volunteer_table.php`

**Tabel**: `volunteer`
- `id`
- `admin_id` (foreign key ke admin, pembuat program)
- `nama_volunteer` (string, required)
- `deskripsi` (text, required)
- `kuota` (integer, required)
- `tenggat_pendaftaran` (date, required)
- `status` (enum: buka, tutup, default: buka)
- `dibuat_pada` (timestamp)
- `diperbarui_pada` (timestamp)

**File**: `database/migrations/2026_07_06_000006_create_anggota_volunteer_table.php`

**Tabel**: `anggota_volunteer`
- `id`
- `volunteer_id` (foreign key ke volunteer)
- `anggota_ormada_id` (foreign key ke anggota_ormada)
- `status` (enum: pending, diterima, ditolak, default: pending)
- `catatan` (text, nullable)
- `dibuat_pada` (timestamp)
- `diperbarui_pada` (timestamp)

**Unique**: `volunteer_id` + `anggota_ormada_id`

**File**: `database/migrations/2026_07_06_000007_create_kolaborasi_table.php`

**Tabel**: `kolaborasi`
- `id`
- `admin_id_pemda` (foreign key ke admin)
- `admin_id_ormada` (foreign key ke admin)
- `nama_program` (string, required)
- `deskripsi_kolaborasi` (text, required)
- `anggaran_bersama` (integer, nullable)
- `tanggal_pelaksanaan` (date, required)
- `tempat_pelaksanaan` (string, required)
- `file_mou` (string, nullable)
- `status` (enum: diajukan, disetujui, selesai, batal, default: diajukan)
- `dibuat_pada` (timestamp)
- `diperbarui_pada` (timestamp)

### Models
**File**: `app/Models/Volunteer.php`
- Relasi: `pembuat()` - belongsTo Admin
- Relasi: `pendaftar()` - hasMany AnggotaVolunteer

**File**: `app/Models/AnggotaVolunteer.php`
- Relasi: `volunteer()` - belongsTo Volunteer
- Relasi: `anggota()` - belongsTo AnggotaOrmada

**File**: `app/Models/Kolaborasi.php`
- Relasi: `pemda()` - belongsTo Admin (admin_id_pemda)
- Relasi: `ormada()` - belongsTo Admin (admin_id_ormada)

### Controllers
**File**: `app/Http/Controllers/VolunteerController.php`
- CRUD untuk program volunteer
- Authorization: Pemda/Admin bisa create, Pengurus ormada bisa view dan daftarkan anggota

**File**: `app/Http/Controllers/AnggotaVolunteerController.php`
- `store()` - Daftarkan anggota ke volunteer
- `updateStatus()` - Update status pendaftaran (hanya Pemda/Admin)
- `destroy()` - Batalkan pendaftaran

**File**: `app/Http/Controllers/KolaborasiController.php`
- CRUD untuk kolaborasi
- Authorization: Pemda dan Ormada bisa create kolaborasi bersama

### Views
**Files**:
- `resources/views/volunteer/index.blade.php`
- `resources/views/volunteer/create.blade.php`
- `resources/views/volunteer/show.blade.php`
- `resources/views/volunteer/edit.blade.php`
- `resources/views/kolaborasi/index.blade.php`
- `resources/views/kolaborasi/create.blade.php`
- `resources/views/kolaborasi/show.blade.php`
- `resources/views/kolaborasi/edit.blade.php`

### Routes
```php
Route::resource('volunteer', VolunteerController::class);
Route::post('/volunteer/{volunteer}/anggota', [AnggotaVolunteerController::class, 'store'])
    ->name('volunteer.anggota.store');
Route::patch('/volunteer-anggota/{anggotaVolunteer}/status', [AnggotaVolunteerController::class, 'updateStatus'])
    ->name('volunteer.anggota.update-status');
Route::resource('kolaborasi', KolaborasiController::class);
```

### Policies
**File**: `app/Policies/VolunteerPolicy.php`
**File**: `app/Policies/KolaborasiPolicy.php`

### Testing
**File**: `tests/Feature/VolunteerTest.php`
**File**: `tests/Feature/KolaborasiTest.php`

### Estimasi Waktu: 4-5 jam

---

## Urutan Implementasi yang Disarankan

### Phase 1: Aspirasi (Prioritas 5)
**Alasan**: 
- Sudah ada pola yang established dari module Proposal
- Fitur ini sering digunakan untuk komunikasi ormada-Pemda
- Relatif straightforward

### Phase 2: Postingan & Agenda (Prioritas 6)
**Alasan**:
- Public-facing content yang penting untuk halaman depan
- Agenda bisa digunakan untuk kalender publik
- Relatif independent dari module lain

### Phase 3: Volunteer & Kolaborasi (Prioritas 7)
**Alasan**:
- Lebih kompleks dengan multiple relasi
- Butuh integrasi dengan module Anggota
- Fitur advanced untuk kolaborasi

---

## Catatan Penting

### 1. **Public Dashboard**
Setelah module Postingan & Agenda selesai, perlu update `PublicDashboardController` untuk menampilkan:
- Postingan terbaru (berita, pengumuman, prestasi)
- Agenda yang akan datang
- Statistik publik

### 2. **File Upload**
Semua module menggunakan storage disk `public` dengan folder:
- `aspirasi/` - File pendukung aspirasi
- `postingan/foto` - Foto postingan
- `agenda/poster` - Poster agenda
- `kolaborasi/mou` - File MoU kolaborasi

### 3. **Authorization Pattern**
Semua module mengikuti pattern yang sama:
- Pengurus ormada: Hanya akses data miliknya
- Pemda: Baca semua, write tertentu
- Admin: Full access

### 4. **Testing**
Setiap module perlu:
- Feature test untuk CRUD operations
- Authorization test untuk role-based access
- File upload test (jika ada)

---

## Next Steps

1. **Implementasi Aspirasi** (Prioritas 5)
2. **Implementasi Postingan & Agenda** (Prioritas 6)
3. **Implementasi Volunteer & Kolaborasi** (Prioritas 7)
4. **Update Public Dashboard** dengan data dari module baru
5. **Final Testing** dan bug fixes
6. **Documentation** lengkap

---

## Total Estimasi Waktu: 9-12 jam

- Aspirasi: 2-3 jam
- Postingan & Agenda: 3-4 jam
- Volunteer & Kolaborasi: 4-5 jam
- Testing & Debugging: 2-3 jam
- Documentation: 1-2 jam

**Apakah kamu mau lanjut implementasi module Aspirasi sekarang?**