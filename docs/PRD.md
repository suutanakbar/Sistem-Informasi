# Product Requirements Document (PRD)

## Sistem Informasi Ormada Temanggung

| Atribut | Nilai |
|---|---|
| Versi | 2.2 |
| Status | Aktif - Update dokumentasi |
| Terakhir diperbarui | 5 Agustus 2026 |
| Sumber acuan | Implementasi commit ce61f8e |
| Platform | Aplikasi web responsif |
| Tech Stack | Laravel 12, PHP 8.2+, MySQL, Vite |

## 1. Ringkasan Produk

Sistem Informasi Ormada Temanggung adalah platform web-based yang menghubungkan Pemerintah Daerah, pengurus ormada, admin sistem, dan masyarakat. Sistem memusatkan profil ormada, data anggota, proposal bantuan, aspirasi, agenda, publikasi, serta pendaftaran volunteer berbasis agenda.

Portal publik menyediakan statistik agregat dan konten yang telah dipublikasikan. Area internal menyediakan dashboard dan operasi pengelolaan sesuai peran. Data sensitif anggota ditujukan untuk admin, Pemda, dan pengurus pemilik data.

## 2. Tujuan

1. Pusat data profil dan anggota ormada Temanggung.
2. Ruang kerja terpisah admin, Pemda, dan pengurus ormada.
3. Digitalisasi pengajuan dan tindak lanjut proposal bantuan.
4. Kanal aspirasi transparan dan dapat ditanggapi Pemda.
5. Penebaran agenda, berita, pengumuman, dan prestasi.
6. Pendaftaran volunteer publik pada agenda tertentu.
7. Perlindungan data personal melalui autentikasi, peran, dan kepemilikan data.
8. Sistem pengumuman untuk komunikasi internal dan publik.

## 3. Persona

- **Admin Sistem**: kelola akun dan akses seluruh modul.
- **Pemda**: pantau ormada, proses proposal dan aspirasi, kelola konten, proses volunteer.
- **Pengurus Ormada**: kelola satu profil ormada, anggota, proposal, aspirasi, agenda, postingan.
- **Masyarakat/Tamu**: akses portal publik dan daftar volunteer tanpa akun.
- **User (Authenticated)**: Melihat dashboard, mengajukan aspirasi/proposal.

## 4. Ruang Lingkup

### 4.1 Autentikasi
Login email + password, ingat saya, logout aman, login terakhir dicatat, password di-hash menggunakan bcrypt rounds 12. Role-based access dengan middleware `role:admin`, `role:pemda`, `role:pengurus_ormada`.

### 4.2 Dashboard Berbasis Peran
- **Admin**: total ormada, anggota, pengurus, alumni, demisioner.
- **Pemda**: ringkasan ormada, anggota aktif, agenda, proposal yang perlu diproses.
- **Pengurus**: ringkasan profil sendiri, anggota, proposal, agenda milik sendiri.

### 4.3 Profil Ormada
Satu akun pengurus bisa punya satu profil (relasi one-to-one). Data: nama universitas, alamat, jumlah mahasiswa, logo, deskripsi, hover image.
- Pengurus: kelola miliknya
- Admin: kelola semua
- Pemda: lihat semua
- Publik: lihat ringkas

### 4.4 Anggota Ormada
Data: nama, NIM, program studi, status, jabatan, pengurus, tanggal akademik, no HP, biodata lengkap.
- Status: `fungsionaris`, `mahasiswa_biasa`, `demisioner`, `alumni`
- Pengurus: boolean `YA/TIDAK`
- Status Aktif: enum khusus untuk tracking keanggotaan
- Admin dan pengurus kelola; pengurus hanya miliknya; pemda lihat detail.

### 4.5 Proposal Bantuan
Pengurus/admin buat proposal ke akun Pemda tujuan. Dokumen PDF/DOC/DOCX, maksimum 5 MB.
- Status: `diajukan`, `diproses_pemda`, `dana_cair`, `ditolak`
- Catatan penolakan opsional
- Pemda tujuan/admin ubah status dan catatan.

### 4.6 Aspirasi
Pengurus kirim aspirasi atas nama profilnya. File opsional.
- Tanggapan Pemda, tanggal tanggapan, status.
- Semua aspirasi ditampilkan di portal publik.
- Public dapat melihat detail aspirasi.

### 4.7 Postingan
Admin, Pemda, pengurus buat postingan.
- Jenis: `berita`, `pengumuman`, `prestasi`
- Foto opsional; status `draft`/`published`; tanggal publish.
- Hanya `published` yang tampil publik; Pemda/admin bisa publish.
- Filter by kategori di portal publik.

### 4.8 Agenda
Admin, Pemda, pengurus buat agenda.
- Data: nama, kategori, deskripsi, poster, waktu, tempat, kuota volunteer, deadline, publish.
- Kategori: `kegiatan_ormada`, `kegiatan_pemda`, `baksos`, `pendidikan`, `kesehatan`, `lingkungan`, `lainnya`.
- Hanya `published` + `upcoming` yang tampil publik; Pemda/admin bisa publish.
- Calendar view untuk admin/Pemda/pengurus.
- Volunteer registration dengan rate limiting.

### 4.9 Volunteer
Terikat agenda; pendaftaran publik tanpa akun.
- Syarat: published, ada kuota, deadline belum lewat.
- Status: `pending`, `diterima`, `ditolak`
- Satu email satu agenda; duplikasi dicegah.
- Kuota dihitung dari status `diterima` saja.
- Admin/Pemda dapat approve/reject dengan catatan penolakan.
- Public registration dengan throttle limit (5 attempts per menit).

### 4.10 Pengumuman
Sistem pengumuman untuk komunikasi.
- Admin, Pemda, pengurus dapat membuat pengumuman.
- Dapat ditampilkan di dashboard dan portal publik.

### 4.11 Portal Publik
Statistik agregat ormada, anggota, pengurus, alumni.
- Daftar/detail profil ormada, aspirasi, postingan published, agenda published.
- Filter jenis postingan; daftar agenda mendatang.
- Form daftar volunteer pada agenda ber-syarat.
- Calendar view untuk agenda publik.

## 5. Struktur Database

### 5.1 Tabel Utama

| Tabel | Kunci | Deskripsi |
|---|---|---|
| `users` | id | User authentication default Laravel |
| `admin` | id | Users dengan role (admin, pemda, pengurus_ormada) |
| `profil_ormada` | id | Profil ormada, relasi 1:1 dengan pengurus |
| `anggota_ormada` | id | Data anggota ormada |
| `proposal` | id | Proposal bantuan ke Pemda |
| `aspirasi` | id | Aspirasi dari pengurus ormada |
| `postingan` | id | Berita, pengumuman, prestasi |
| `agenda` | id | Agenda kegiatan |
| `volunteer` | id | Pendaftaran volunteer |
| `pengumuman` | id | Pengumuman sistem |
| `personal_access_tokens` | id | API tokens (untuk future API) |

### 5.2 Relasi Database
- **User** (default Laravel auth) - optional untuk future enhancement
- **Admin** → hasOne **ProfilOrmada** (jika pengurus)
- **AnggotaOrmada** → belongsTo **Admin** (pengurus)
- **AnggotaOrmada** → belongsTo **ProfilOrmada** (optional)
- **Proposal** → belongsTo **Admin** (pengurus)
- **Proposal** → belongsTo **Admin** (pemda tujuan)
- **Aspirasi** → belongsTo **Admin** (pengurus)
- **Aspirasi** → belongsTo **ProfilOrmada**
- **Postingan** → belongsTo **Admin** (penulis)
- **Agenda** → belongsTo **Admin** (penulis)
- **Volunteer** → belongsTo **Agenda**
- **Volunteer** → belongsTo **Admin** (pemroses, optional)
- **Pengumuman** → belongsTo **Admin** (penulis)

## 6. Matriks Akses

| Kapabilitas | Public | Pengurus | Pemda | Admin |
|---|---|---|---|---|
| Portal publik | Ya | Ya | Ya | Ya |
| Login/logout | Ya | Ya | Ya | Ya |
| Kelola akun admin | - | - | - | Ya |
| Lihat seluruh profil/anggota | Ringkas | Milik sendiri | Ya | Ya |
| Ubah profil/anggota | - | Milik sendiri | - | Ya |
| Ajukan proposal | - | Ya | - | Ya |
| Proses proposal | - | - | Tujuan sendiri | Ya |
| Ajukan aspirasi | - | Ya | - | Ya |
| Tanggapi aspirasi | - | - | Ya | Ya |
| Kelola postingan/agenda | - | Milik sendiri | Ya | Ya |
| Publikasi eksplisit | - | - | Ya | Ya |
| Daftar volunteer | Ya | Ya | Ya | Ya |
| Proses volunteer | - | Terbatas agenda terkait | Ya | Ya |
| Kelola pengumuman | - | Ya | Ya | Ya |
| Lihat calendar agenda | - | Ya | Ya | Ya |
| Manage agenda (publish/unpublish) | - | - | Ya | Ya |

## 7. Alur Utama

### 7.1 Onboarding Pengurus
Admin buat akun → pengurus login → buat profil → tambah anggota → ringkas tampil di portal publik.

### 7.2 Pengajuan Proposal
Pilih Pemda tujuan → unggah dokumen → status `diajukan` → Pemda proses → pengurus pantau.

### 7.3 Tindak Lanjut Aspirasi
Pengurus kirim → Pemda tanggapi → ada status dan catatan → publik baca.

### 7.4 Publikasi Konten
Buat draft → Pemda/admin publish dengan `tanggal_publikasi` → publik lihat.

### 7.5 Volunteer
Buka agenda published → cek syarat (kuota, deadline) → daftar → admin/Pemda setujui/tolak.

### 7.6 Dashboard
- **Admin**: statistik agregat seluruh ormada dan user
- **Pemda**: ringkasan ormada dan permintaan yang perlu diproses
- **Pengurus**: ringkasan profil dan data milik sendiri

### 7.7 Pengumuman
Admin/Pemda buat pengumuman → tampil di dashboard user → opsional tampil publik.

## 8. Nonfungsional

- Auth sesi + CSRF protection; role-based policy, ownership guard.
- Password hash menggunakan bcrypt rounds 12; upload tipe/ukuran terbatas.
- Pagination default 10-15 item; eager loading untuk relasi; portal limit 6-8 per section.
- Validasi server-side; cascade delete dengan foreign key constraints.
- Timestamp `dibuat_pada`/`diperbarui_pada`; file lama dihapus saat update.
- Health endpoint `/up`.
- Responsive design dengan Tailwind CSS.
- Volunteer registration rate limited (5 attempts per menit per IP).
- Soft delete untuk data sensitif (proposal, aspirasi, volunteer).
- Session regeneration setelah login untuk mencegah fixation.

## 9. API Endpoints

### Authentication
- `GET /login` - Form login
- `POST /login` - Proses login
- `POST /logout` - Logout

### Public Routes
- `GET /` - Portal publik (dashboard)
- `GET /publik/aspirasi` - Daftar aspirasi
- `GET /publik/aspirasi/{id}` - Detail aspirasi
- `GET /publik/postingan` - Daftar postingan published
- `GET /publik/postingan/{id}` - Detail postingan
- `GET /publik/postingan/filter` - Filter postingan by kategori
- `GET /publik/agenda` - Daftar agenda published/upcoming
- `GET /publik/agenda/{id}` - Detail agenda
- `GET /publik/agenda/calendar` - Calendar events (public)
- `GET /publik/ormada` - Daftar ormada
- `GET /publik/ormada/{id}` - Detail ormada
- `POST /agenda/{id}/daftar-volunteer` - Daftar volunteer (public, rate limited)

### Admin Routes
- `GET /dashboard` - Dashboard (authenticated)
- `GET /admin` - Resource index
- `GET /admin/create` - Form create
- `POST /admin` - Store
- `GET /admin/{id}` - Show
- `GET /admin/{id}/edit` - Form edit
- `PUT/PATCH /admin/{id}` - Update
- `DELETE /admin/{id}` - Delete
- `GET /api/agenda/calendar` - Calendar events (authenticated)
- `POST /logout` - Logout

### Profil Ormada Routes (Admin, Pemda, Pengurus)
- `GET /profil-ormada` - Index
- `GET /profil-ormada/create` - Create form
- `POST /profil-ormada` - Store
- `GET /profil-ormada/{id}` - Show
- `GET /profil-ormada/{id}/edit` - Edit form
- `PUT/PATCH /profil-ormada/{id}` - Update

### Anggota Ormada Routes (Admin, Pengurus)
- `GET /anggota-ormada` - Index
- `GET /anggota-ormada/create` - Create form
- `POST /anggota-ormada` - Store
- `GET /anggota-ormada/{id}` - Show
- `GET /anggota-ormada/{id}/edit` - Edit form
- `PUT/PATCH /anggota-ormada/{id}` - Update
- `DELETE /anggota-ormada/{id}` - Delete

### Agenda Routes (Pemda, Admin, Pengurus)
- `GET /agenda` - Index
- `GET /agenda/create` - Create form
- `POST /agenda` - Store
- `GET /agenda/{id}` - Show
- `GET /agenda/{id}/edit` - Edit form
- `PUT/PATCH /agenda/{id}` - Update
- `DELETE /agenda/{id}` - Delete
- `PATCH /agenda/{id}/publish` - Publish/unpublish
- `GET /agenda/{id}/volunteer` - List volunteers
- `GET /agenda/calendar` - Calendar events

### Volunteer Management Routes (Pemda, Admin, Pengurus)
- `GET /volunteer` - Index all volunteers
- `GET /volunteer/{id}/edit` - Edit form
- `PUT /volunteer/{id}` - Update volunteer
- `PATCH /volunteer/{id}/status` - Update status (approve/reject)

### Postingan Routes (Pemda, Admin, Pengurus)
- `GET /postingan` - Index
- `GET /postingan/create` - Create form
- `POST /postingan` - Store
- `GET /postingan/{id}` - Show
- `GET /postingan/{id}/edit` - Edit form
- `PUT/PATCH /postingan/{id}` - Update
- `DELETE /postingan/{id}` - Delete
- `PATCH /postingan/{id}/publish` - Publish/unpublish

### Proposal Routes (Pemda, Admin, Pengurus)
- `GET /proposal` - Index
- `GET /proposal/create` - Create form
- `POST /proposal` - Store
- `GET /proposal/{id}` - Show
- `GET /proposal/{id}/edit` - Edit form
- `PUT/PATCH /proposal/{id}` - Update
- `DELETE /proposal/{id}` - Delete
- `PATCH /proposal/{id}/status` - Update status (Pemda only)

### Aspirasi Routes (Pemda, Admin, Pengurus)
- `GET /aspirasi` - Index
- `GET /aspirasi/create` - Create form
- `POST /aspirasi` - Store
- `GET /aspirasi/{id}` - Show
- `GET /aspirasi/{id}/edit` - Edit form
- `PUT/PATCH /aspirasi/{id}` - Update
- `DELETE /aspirasi/{id}` - Delete
- `PATCH /aspirasi/{id}/tanggapan` - Add response (Pemda only)

## 10. Di Luar Ruang Lingkup

- Mobile native aplikasi
- Reset password UI (saat ini manual via admin)
- Notifikasi real-time
- Audit log lengkap
- Kolaborasi/MoU antar ormada
- Volunteer independen (non-agenda)
- API publik (REST API terpisah)
- Ekspor laporan PDF/Excel lanjutan
- Email/WhatsApp notification
- Payment gateway untuk proposal dana

## 11. Risiko

1. **Privasi detail anggota publik**: saat ini hanya ringkasan yang ditampilkan.
2. **Aspirasi sepenuhnya publik**: belum ada moderasi sebelum publish.
3. **Publish oleh pengurus**: perlu aturan moderasi yang jelas.
4. **Kuota volunteer**: status `pending` bisa melebihi kuota sebelum diproses.
5. **Cascade delete**: penghapusan data permanen tanpa soft delete untuk beberapa tabel.
6. **File upload**: batasan tipe dan ukuran perlu diperketat.
7. **Session fixation**: session ID di-regenerate setelah login.
8. **Volunteer race condition**: multiple requests bisa melebihi kuota.

## 12. Backlog

### P0 (Critical) - Sudah Diterapkan
- [x] Soft delete untuk data sensitif (proposal, aspirasi, volunteer)
- [x] Session regeneration setelah login
- [x] Volunteer rate limiting (5 attempts per menit)
- [x] Authorization policies untuk semua modul
- [x] Role-based middleware
- [x] Public dashboard dengan statistik
- [x] Volunteer registration dengan validasi kuota & deadline
- [x] Pengumuman module

### P1 (High)
- [ ] Email notification untuk status proposal/aspirasi/volunteer
- [ ] Audit trail/log activity
- [ ] Ekspor laporan (Excel/PDF)
- [ ] Dashboard metrik lanjutan (grafik, tren)
- [ ] Bulk import anggota (Excel)
- [ ] Advanced filtering dan search

### P2 (Medium)
- [ ] Kolaborasi/MoU antar ormada
- [ ] Volunteer independen (bukan dari agenda)
- [ ] REST API untuk mobile app
- [ ] Email/WhatsApp integration
- [ ] Payment gateway untuk proposal dana
- [ ] Multi-language support

### P3 (Low)
- [ ] Dark mode toggle
- [ ] Social media sharing
- [ ] QR code untuk agenda
- [ ] Plugin/widget untuk portal lain

## 13. Definition of Done

1. Perilaku sesuai PRD/TDD terbaru.
2. Test coverage minimum 80% untuk fitur utama.
3. Test untuk happy path, validation error, dan akses terlarang.
4. Tidak bocorkan data (test authorization untuk setiap role).
5. Upload/delete file diuji.
6. Dokumentasi kode (PHPDoc) untuk method publik.
7. Code review dan merge ke branch yang sesuai.
8. Semua test passing (green) sebelum merge.

## 14. Referensi

- **PRD Sebelumnya**: v2.1 (28 Juli 2026)
- **Latest Commit**: ce61f8e
- **Test Files**: `tests/Feature/*Test.php`, `tests/Unit/*Test.php`
- **Models**: `app/Models/*.php`
- **Controllers**: `app/Http/Controllers/*`
- **Policies**: `app/Policies/*`
- **Migrations**: `database/migrations/*`
- **TDD Document**: `docs/TDD.md`