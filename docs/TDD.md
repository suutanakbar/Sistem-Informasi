# Technical Design Document (TDD)

## Sistem Informasi Ormada Temanggung

| Atribut | Nilai |
|---|---|
| Versi | 2.0 |
| Status | As-built / baseline teknis terkini |
| Terakhir diperbarui | 14 Juli 2026 |
| Sumber acuan | Implementasi commit 996e563 |

> TDD ini mendokumentasikan arsitektur yang benar-benar tersedia di repository. Gap implementasi dicatat pada bagian technical debt.

## 1. Ringkasan Teknis

Aplikasi monolit Laravel berbasis server-rendered Blade. Request masuk melalui route web, middleware autentikasi/peran, controller, policy atau ownership guard, lalu Eloquent ke database. Aset frontend: Vite + Tailwind CSS. Upload via disk `public`.

## 2. Stack

- PHP ^8.2, Laravel ^12.0
- MySQL/MariaDB; test bisa pakai SQLite
- Blade + Tailwind CSS ^4.0 + Vite ^7.0.7
- Axios ^1.11.0
- PHPUnit ^11.5.50
- Laravel Pint ^1.24

## 3. Arsitektur

Browser -> routes/web.php -> web middleware -> RoleMiddleware/Policy/ownership guard -> Controller -> Eloquent Model -> Database -> Blade View/Redirect/JSON

Komponen utama:
- app/Http/Controllers: controller resource + dashboard
- app/Http/Middleware/RoleMiddleware.php: role check
- app/Policies: Agenda, Aspirasi, Postingan, Proposal
- app/Models: model + relasi
- resources/views: view publik + khusus peran
- database/migrations: skema Indonesia
- database/factories, database/seeders: data dummy
- tests/Feature: pengujian HTTP + otorisasi

Timestamp domain: dibuat_pada, diperbarui_pada. Tabel users bawaan ada tapi tidak dipakai untuk auth; auth pakai tabel admin.

## 4. Autentikasi & Otorisasi

Guard: web session
Provider: users model App\Models\Admin
Table: admin (email + password)
Peran: admin, pengurus_ormada, pemda
Helper model: isAdmin(), isPemda(), isPengurusOrmada()

Lapisan authorization: middleware role, Policy, ownership guard di controller

Ownership rules:
- pengurus -> profil_ormada.admin_id
- konten -> admin_id
- proposal -> admin_id pengaju / dinas_tujuan_id
- aspirasi -> profil_ormada.admin_id

## 5. Route

### Publik
GET / -> PublicDashboardController@index
GET /publik/aspirasi -> PublicDashboardController@aspirasi
GET /publik/aspirasi/{aspirasi} -> showAspirasi
GET /publik/postingan -> postingan
GET /publik/postingan/filter -> filterPostingan JSON
GET /publik/postingan/{postingan} -> showPostingan
GET /publik/agenda -> agenda
GET /publik/agenda/{agenda} -> showAgenda
GET /publik/ormada/{profilOrmada} -> showOrmada
POST /agenda/{agenda}/daftar-volunteer -> AgendaController@daftarVolunteer

### Internal
GET /dashboard -> DashboardController@index
POST /logout -> AuthController@logout
Resource admin -> AdminController
Resource profil-ormada -> ProfilOrmadaController
Resource anggota-ormada -> AnggotaOrmadaController
Resource agenda -> AgendaController
PATCH agenda/{agenda}/publish -> AgendaController@publish
GET agenda/{agenda}/volunteer -> AgendaController@listVolunteer
GET volunteer -> VolunteerController@index
PATCH volunteer/{volunteer}/status -> VolunteerController@updateStatus
Resource postingan -> PostinganController
PATCH postingan/{postingan}/publish -> PostinganController@publish
Resource proposal -> ProposalController
PATCH proposal/{proposal}/status -> ProposalController@updateStatus
Resource aspirasi -> AspirasiController
PATCH aspirasi/{aspirasi}/tanggapan -> AspirasiController@updateTanggapan

Catatan:
- Literal /publik/postingan/filter sebaiknya diletakkan sebelum {postingan}.
- Route update status volunteer mengacu ke VolunteerController@updateStatus.

## 6. Database

admin: id, nama, email unique, password, peran enum, terakhir_masuk nullable, remember_token, timestamps.
profil_ormada: id, admin_id unique FK cascade, nama_universitas, alamat_universitas, total_mahasiswa_univ, logo nullable, deskripsi nullable, timestamps.
anggota_ormada: id, profil_ormada_id FK cascade, nama_lengkap, nim, program_studi, status_aktif enum, jabatan nullable, is_pengurus varchar default TIDAK, tanggal akademik/organisasi, no_hp nullable, timestamps.
proposal: id, admin_id FK cascade, dinas_tujuan_id FK cascade, judul, deskripsi, jenis_bantuan enum, anggaran, file_proposal, status enum default diajukan, catatan_pemda nullable, timestamps.
aspirasi: id, profil_ormada_id FK cascade, topik, detail, file nullable, tanggapan_pemda nullable, tanggal_tanggapan nullable, status enum default belum_ditanggapi, timestamps.
postingan: id, admin_id FK cascade, judul, isi_konten, foto nullable, jenis_konten enum, is_published boolean default false, tanggal_publish nullable, timestamps.
agenda: id, admin_id FK cascade, nama, deskripsi, gambar_poster nullable, waktu mulai/selesai datetime, tempat, kategori enum, kuota_volunteer nullable, deadline_pendaftaran nullable, is_published boolean default false, tanggal_publish nullable, timestamps.
volunteers: id, agenda_id FK cascade, nama, email, no_hp, alasan nullable, status enum default pending, timestamps.

## 7. Model Relasi

Admin -> profilOrmada hasOne, profilOrmadas hasMany, proposals hasMany, postingan hasMany, agenda hasMany.
ProfilOrmada -> admin belongsTo, anggota hasMany, aspirasi hasMany.
AnggotaOrmada -> profilOrmada belongsTo, volunteerRegistrations hasMany.
Agenda -> admin belongsTo, volunteers hasMany.
Aspirasi -> profilOrmada belongsTo.
Postingan -> admin belongsTo.
Volunteer -> agenda belongsTo.

## 8. Controller

AuthController: login/logout + last login
DashboardController: agregasi per peran
AdminController: CRUD akun
ProfilOrmadaController: profil, anggota ringkas, list filter
AnggotaOrmadaController: CRUD anggota + ownership
ProposalController: CRUD proposal, filter, status Pemda
AspirasiController: CRUD aspirasi, tanggapan/status
PostinganController: CRUD, upload foto, publish
AgendaController: CRUD, poster, publish, daftar volunteer
VolunteerController: list, update status
PublicDashboardController: landing, listing/detail publik, JSON filter

Validasi ada di controller private method. Belum pakai Form Request.

## 9. Validasi

Profil: nama/alamat required max 255, total mahasiswa nullable integer min 0, logo nullable image max 2MB, deskripsi nullable.
Anggota: profil required, nama/NIM/program studi required, status/pengurus enum, jabatan required_if pengurus YA, tanggal demisioner/lulus required_if sesuai status, no_hp max 20.
Proposal: dinas tujuan exists admin, judul/deskripsi/jenis required, anggaran integer min 0, file required_on create pdf/doc/docx max 5MB.
Aspirasi: topik/detail required, file nullable pdf/doc/docx/jpg/jpeg/png max 5MB, tanggapan required saat update, status enum.
Postingan: judul/isi/jenis required, foto nullable image max 2MB, is_published boolean, tanggal_publish nullable datetime.
Agenda: nama/kategori/deskripsi/waktu/tempat required, kategori enum, poster nullable image max 2MB, waktu_selesai after waktu_mulai, kuota nullable integer min 1, deadline nullable before waktu_mulai, is_published boolean, tanggal_publish nullable datetime.
Volunteer: nama/email/no_hp required, alasan nullable.

## 10. Storage

Folder disk publik:
- profil-ormada/logo (2MB)
- proposal (5MB)
- aspirasi (5MB)
- postingan/foto (2MB)
- agenda/poster (2MB)

Path relatif disimpan. URL publik lewat asset('storage/' . $path). Saat update/delete record, controller menghapus file lama.

## 11. Query Publik

- Agenda: eager load admin, published + upcoming, limit 6/12.
- Postingan: eager load admin, published, by jenis opsional, limit 6/12.
- Profil: withCount anggota, terbaru, limit 8.
- Aspirasi: eager load profil terbatas, terbaru, limit 6/12.
- Carousel payload disiapkan di controller sebagai array/JSON.

## 12. Testing

PHPUnit + RefreshDatabase. Fitur test:
- Admin login
- Agenda + volunteer
- Aspirasi
- Postingan
- Proposal
- Public dashboard

Perintah: composer test atau php artisan test

Test wajib dipertahankan:
1. Login valid/invalid + tamu diblokir.
2. Matriks peran + ownership lintas ormada.
3. Validasi enum, tanggal, file, ukuran, field kondisional.
4. Draft tidak tampil publik; published tampil.
5. Proposal hanya diproses Pemda tujuan/admin.
6. Aspirasi hanya diedit pemilik, ditanggapi Pemda/admin.
7. Volunteer: agenda tertutup, deadline, kuota, duplikasi email.
8. Data sensitif tidak tampil di landing page publik.

Test yang perlu ditambahkan:
- update status volunteer 403 untuk role tidak berwenang
- konflik race condition kuota/duplikasi volunteer
- route filter postingan tidak tertangkap model binding
- detail ormada publik tidak bocorkan field terlarang
- validasi dinas tujuan berperan pemda
- penghapusan/gantian file semua modul
- kebijakan publish oleh pengurus

## 13. Build & Operasional

Setup:
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan storage:link

Dev: composer run dev

Production: APP_ENV=production, APP_DEBUG=false, APP_URL, koneksi DB, disk filesystem.

## 14. Keamanan

- CSRF, session regen, input validasi, mass assignment via fillable, parameter binding.
- Auth + role + policy + ownership.
- File hanya yang dipublikkan diakses publik.

Rekomendasi hardening:
- Admin::$hidden isi password, remember_token
- Rate limit login + volunteer
- Unique DB constraint (agenda_id, email)
- Transaksi/lock saat approve volunteer
- Simpan dokumen sensitif di private + download controller
- Sanitasi rich text sebelum render

## 15. Technical Debt

1. Route volunteer status belum konsisten; update status volunteer perlu audit ulang.
2. Detail ormada publik perlu kebijakan privasi anggota.
3. Aspirasi publik sepenuhnya tanpa moderasi.
4. Urutan route postingan filter berisiko tertangkap wildcard.
5. Field jenis konten postingan berpotensi inkonsisten dengan referensi jenis di beberapa controller.
6. Admin::$hidden kosong.
7. Validasi proposal belum cek peran Pemda tujuan.
8. Aturan publish tidak seragam antara pengurus dan Pemda/admin.
9. Otorisasi tersebar; perlu konsolidasi.
10. Migrasi redundant untuk kolom publish/volunteer.
11. Relasi Aspirasi::pengaju() perlu verifikasi.
12. Tabel users bawaan tidak dihapus.
13. Validasi di controller; sebaiknya pindah ke Form Request.
14. Tidak ada unique constraint untuk email volunteer per agenda.