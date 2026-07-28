# Product Requirements Document (PRD)

## Sistem Informasi Ormada Temanggung

| Atribut | Nilai |
|---|---|
| Versi | 2.1 |
| Status | Update dokumentasi |
| Terakhir diperbarui | 28 Juli 2026 |
| Sumber acuan | Implementasi commit 8f93c5f |
| Platform | Aplikasi web responsif |
| Tech Stack | Laravel 11, PHP 8.2, MySQL, Vite |

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

## 3. Persona

- **Admin Sistem**: kelola akun dan akses seluruh modul.
- **Pemda**: pantau ormada, proses proposal dan aspirasi, kelola konten, proses volunteer.
- **Pengurus Ormada**: kelola satu profil ormada, anggota, proposal, aspirasi, agenda, postingan.
- **Masyarakat/Tamu**: akses portal publik dan daftar volunteer tanpa akun.

## 4. Ruang Lingkup

### 4.1 Autentikasi
Login email + password, ingat saya, logout aman, login terakhir dicatat, password di-hash menggunakan bcrypt.

### 4.2 Dashboard Berbasis Peran
- **Admin**: total ormada, anggota, pengurus, alumni, demisioner.
- **Pemda**: ringkasan ormada, anggota aktif, agenda, proposal.
- **Pengurus**: ringkasan profil sendiri, anggota, proposal, agenda.

### 4.3 Profil Ormada
Satu akun pengurus bisa punya satu profil (relasi one-to-one). Data: nama universitas, alamat, jumlah mahasiswa, logo, deskripsi. 
- Pengurus: kelola miliknya
- Admin: kelola semua
- Pemda: lihat semua
- Publik: lihat ringkas

### 4.4 Anggota Ormada
Data: nama, NIM, program studi, status, jabatan, pengurus, tanggal akademik, no HP.
- Status: `fungsionaris`, `mahasiswa_biasa`, `demisioner`, `alumni`
- Pengurus: boolean `YA/TIDAK`
- Admin dan pengurus kelola; pengurus hanya miliknya; pemda lihat detail.

### 4.5 Proposal Bantuan
Pengurus/admin buat proposal ke akun Pemda tujuan. Dokumen PDF/DOC/DOCX, maksimum 5 MB.
- Status: `diajukan`, `diproses_pemda`, `dana_cair`, `ditolak`
- Pemda tujuan/admin ubah status dan catatan.

### 4.6 Aspirasi
Pengurus kirim aspirasi atas nama profilnya. File opsional.
- Tanggapan Pemda, tanggal tanggapan, status.
- Semua aspirasi ditampilkan di portal publik.

### 4.7 Postingan
Admin, Pemda, pengurus buat postingan.
- Jenis: `berita`, `pengumuman`, `prestasi`
- Foto opsional; status `draft`/`published`; tanggal publish.
- Hanya `published` yang tampil publik; Pemda/admin bisa publish.

### 4.8 Agenda
Admin, Pemda, pengurus buat agenda.
- Data: nama, kategori, deskripsi, poster, waktu, tempat, kuota volunteer, deadline, publish.
- Kategori: `kegiatan_ormada`, `kegiatan_pemda`, `baksos`, `pendidikan`, `kesehatan`, `lingkungan`, `lainnya`.
- Hanya `published` + `upcoming` yang tampil publik; Pemda/admin bisa publish.

### 4.9 Volunteer
Terikat agenda; pendaftaran publik tanpa akun.
- Syarat: published, ada kuota, deadline belum lewat.
- Status: `pending`, `diterima`, `ditolak`
- Satu email satu agenda; duplikasi dicegah.
- Kuota dihitung dari status `diterima`.

### 4.10 Portal Publik
Statistik agregat ormada, anggota, pengurus, alumni.
- Daftar/detail profil ormada, aspirasi, postingan published, agenda published.
- Filter jenis postingan; daftar agenda mendatang.
- Form daftar volunteer pada agenda ber-syarat.

## 5. Struktur Database

### 5.1 Tabel Utama

| Tabel | Kunci | Deskripsi |
|---|---|---|
| `admin` | id | Users dengan role (admin, pemda, pengurus_ormada) |
| `profil_ormada` | id | Profil ormada, relasi 1:1 dengan pengurus |
| `anggota_ormada` | id | Data anggota ormada |
| `proposal` | id | Proposal bantuan ke Pemda |
| `aspirasi` | id | Aspirasi dari pengurus ormada |
| `postingan` | id | Berita, pengumuman, prestasi |
| `agenda` | id | Agenda kegiatan |
| `volunteer` | id | Pendaftaran volunteer |

### 5.2 Relasi Database
- **Profil Ormada** → belongsTo **Admin** (pengurus)
- **Anggota Ormada** → belongsTo **Admin** (pengurus)
- **Anggota Ormada** → belongsTo **Profil Ormada** (optional)
- **Proposal** → belongsTo **Admin** (pengurus)
- **Proposal** → belongsTo **Admin** (pemda tujuan)
- **Aspirasi** → belongsTo **Admin** (pengurus)
- **Aspirasi** → belongsTo **Profil Ormada**
- **Postingan** → belongsTo **Admin** (penulis)
- **Agenda** → belongsTo **Admin** (penulis)
- **Volunteer** → belongsTo **Agenda**
- **Volunteer** → belongsTo **Admin** (pemroses, optional)

## 6. Matriks Akses

| Kapabilitas | Public | Pengurus | Pemda | Admin |
|---|---|---|---|---|
| Portal publik | Ya | Ya | Ya | Ya |
| Login/logout | Ya | Ya | Ya | Ya |
| Kelola akun | - | - | - | Ya |
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

## 8. Nonfungsional

- Auth sesi + CSRF protection; role-based policy, ownership guard.
- Password hash menggunakan bcrypt rounds 12; upload tipe/ukuran terbatas.
- Pagination default 10-15 item; eager loading untuk relasi; portal limit 6-8 per section.
- Validasi server-side; cascade delete dengan foreign key constraints.
- Timestamp `dibuat_pada`/`diperbarui_pada`; file lama dihapus saat update.
- Health endpoint `/up`.
- Responsive design dengan Tailwind CSS.

## 9. API Endpoints

### Authentication
- `POST /login`
- `POST /logout`

### Admin
- `GET /admin/dashboard`
- `GET/POST /admin/akun` - kelola akun pengguna
- `GET /admin/ormada` - daftar ormada
- `GET /admin/anggota` - daftar anggota
- `GET /admin/proposal` - daftar proposal
- `GET /admin/volunteer` - daftar volunteer

### Pemda
- `GET /pemda/dashboard`
- `GET /pemda/proposal` - proposal yang ditujukan
- `POST /pemda/proposal/{id}/proses` - ubah status proposal
- `GET /pemda/aspirasi` - aspirasi ormada
- `POST /pemda/aspirasi/{id}/tanggapi` - tanggapi aspirasi
- `GET/POST /pemda/postingan` - kelola postingan
- `GET/POST /pemda/agenda` - kelola agenda
- `GET /pemda/volunteer` - proses volunteer

### Pengurus
- `GET /pengurus/dashboard`
- `GET/POST /pengurus/profil` - profil ormada
- `GET/POST /pengurus/anggota` - CRUD anggota
- `GET/POST /pengurus/proposal` - buat dan lihat proposal
- `GET/POST /pengurus/aspirasi` - buat dan lihat aspirasi
- `GET/POST /pengurus/postingan` - buat postingan (draft)
- `GET/POST /pengurus/agenda` - buat agenda (draft)

### Publik
- `GET /` - portal publik
- `GET /ormada` - daftar ormada
- `GET /ormada/{id}` - detail ormada
- `GET /aspirasi` - daftar aspirasi
- `GET /postingan` - postingan published
- `GET /agenda` - agenda published/upcoming
- `POST /agenda/{id}/volunteer/daftar` - daftar volunteer

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
5. **Cascade delete**: penghapusan data permanen tanpa soft delete.
6. **File upload**: batasan tipe dan ukuran perlu diperketat.
7. **Session fixation**: perlu regenerate session ID setelah login.

## 12. Backlog

### P0 (Critical)
- Kebijakan data anggota publik (PRIVASI)
- Moderasi aspirasi sebelum publish
- Konsolidasi publish postingan/agenda (workflow approval)
- Otorisasi update status volunteer (mencegah override kuota)
- Soft delete untuk data sensitif

### P1 (High)
- Email notification untuk status proposal/aspirasi/volunteer
- Audit trail/log activity
- Ekspor laporan (Excel/PDF)
- Dashboard metrik lanjutan (grafik, tren)
- Bulk import anggota (Excel)

### P2 (Medium)
- Kolaborasi/MoU antar ormada
- Volunteer independen (bukan dari agenda)
- REST API untuk mobile app
- Email/WhatsApp integration
- Payment gateway untuk proposal dana
- Advanced filtering dan search

### P3 (Low)
- Dark mode toggle
- Multi-language support
- Social media sharing
- QR code untuk agenda
- Plugin/widget untuk portal lain

## 13. Definition of Done

1. Perilaku sesuai PRD/TDD terbaru.
2. Test coverage minimum 80% untuk fitur utama.
3. Test untuk happy path, validation error, dan akses terlarang.
4. Tidak bocorkan data (test authorization untuk setiap role).
5. Upload/delete file diuji.
6. Dokumentasi kode (PHPDoc) untuk method publik.
7. Code review dan merge ke branch yang sesuai.

## 14. Referensi

- **PRD Sebelumnya**: v1.0 (14 Juli 2026)
- **Latest Commit**: 8f93c5f
- **Test Files**: `tests/Feature/*Test.php`
- **Models**: `app/Models/*.php`
- **Controllers**: `app/Http/Controllers/*`
- **Policies**: `app/Policies/*`