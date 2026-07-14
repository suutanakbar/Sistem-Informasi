# Product Requirements Document (PRD)

## Sistem Informasi Ormada Temanggung

| Atribut | Nilai |
|---|---|
| Versi | 2.0 |
| Status | Baseline implementasi saat ini |
| Terakhir diperbarui | 14 Juli 2026 |
| Sumber acuan | Implementasi commit 996e563 |
| Platform | Aplikasi web responsif |

## 1. Ringkasan Produk

Sistem Informasi Ormada Temanggung menghubungkan Pemerintah Daerah, pengurus ormada, admin sistem, dan masyarakat. Sistem memusatkan profil ormada, data anggota, proposal bantuan, aspirasi, agenda, publikasi, serta pendaftaran volunteer berbasis agenda.

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

- Admin Sistem: kelola akun dan akses seluruh modul.
- Pemda: pantau ormada, proses proposal dan aspirasi, kelola konten, proses volunteer.
- Pengurus Ormada: kelola satu profil ormada, anggota, proposal, aspirasi, agenda, postingan.
- Masyarakat/Tamu: akses portal publik dan daftar volunteer tanpa akun.

## 4. Ruang Lingkup

### 4.1 Autentikasi
Login email + password, ingat saya, logout aman, login terakhir dicatat, password di-hash.

### 4.2 Dashboard Berbasis Peran
Admin: total ormada, anggota, pengurus, alumni, demisioner. Pemda: ringkasan ormada, anggota aktif, agenda, proposal. Pengurus: ringkasan profil sendiri, anggota, proposal.

### 4.3 Profil Ormada
Satu akun pengurus bisa punya satu profil. Nama universitas, alamat, jumlah mahasiswa, logo, deskripsi. Pengurus kelola miliknya; admin kelola semua; pemda lihat semua; publik lihat ringkas.

### 4.4 Anggota Ormada
Admin dan pengurus kelola; pengurus hanya miliknya; pemda lihat detail. Nama, NIM, program studi, status, jabatan, pengurus, tanggal akademik, no HP. Status: fungsionaris, mahasiswa_biasa, demisioner, alumni. Pengurus: YA/TIDAK.

### 4.5 Proposal
Pengurus/admin buat proposal ke akun Pemda tujuan. Dokumen PDF/DOC/DOCX, maksimum 5 MB. Status: diajukan, diproses_pemda, dana_cair, ditolak. Pemda tujuan/admin ubah status dan catatan.

### 4.6 Aspirasi
Pengurus kirim aspirasi atas nama profilnya. File opsional, tanggapan Pemda, tanggal tanggapan, status. Semua aspirasi ditampilkan di portal publik.

### 4.7 Postingan
Admin, Pemda, pengurus buat postingan. Jenis: berita, pengumuman, prestasi. Foto opsional; status draft/published; tanggal publish. Hanya published yang tampil publik; Pemda/admin bisa publish.

### 4.8 Agenda
Admin, Pemda, pengurus buat agenda. Data: nama, kategori, deskripsi, poster, waktu, tempat, kuota volunteer, deadline, publish. Kategori: kegiatan_ormada, kegiatan_pemda, baksos, pendidikan, kesehatan, lingkungan, lainnya. Hanya published + upcoming yang tampil publik; Pemda/admin bisa publish.

### 4.9 Volunteer
Terikat agenda; pendaftaran publik tanpa akun. Syarat: published, ada kuota, deadline belum lewat. Status: pending, diterima, ditolak. Satu email satu agenda; duplikasi dicegah. Kuota dihitung dari status diterima.

### 4.10 Portal Publik
Statistik agregat ormada, anggota, pengurus, alumni. Daftar/detail profil ormada, aspirasi, postingan published, agenda published. Filter jenis postingan; daftar agenda mendatang. Form daftar volunteer pada agenda ber-syarat.

## 5. Matriks Akses

| Kapabilitas | Public | Pengurus | Pemda | Admin |
|---|:---:|:---:|:---:|:---:|
| Portal publik | Ya | Ya | Ya | Ya |
| Login/logout | Ya | Ya | Ya | Ya |
| Kelola akun | - | - | - | Ya |
| Lihat seluruh profil/anggota | Ringkas | Milik sendiri | Ya | Ya |
| Ubah profil/anggota | - | Milik sendiri | - | Ya |
| Ajukan proposal | - | Ya | - | Ya |
| Proses proposal | - | - | Tujuan sendiri | Ya |
| Ajukan aspirasi | - | Ya | - | Ya |
| Tanggapi aspirasi | - | - | Ya | Ya |
| Kelola agenda/postingan | - | Milik sendiri | Ya | Ya |
| Publikasi eksplisit | - | - | Ya | Ya |
| Daftar volunteer | Ya | Ya | Ya | Ya |
| Proses volunteer | - | Terbatas agenda terkait | Ya | Ya |

## 6. Alur Utama

### 6.1 Onboarding Pengurus
Admin buat akun -> pengurus login -> buat profil -> tambah anggota -> ringkas tampil di portal publik.

### 6.2 Pengajuan Proposal
Pilih Pemda tujuan -> unggah dokumen -> status diajukan -> Pemda proses -> pengurus pantau.

### 6.3 Tindak Lanjut Aspirasi
Pengurus kirim -> Pemda tanggapi -> ada status dan catatan -> publik baca.

### 6.4 Publikasi Konten
Buat draft -> Pemda/admin publish -> publik lihat.

### 6.5 Volunteer
Buka agenda published -> cek syarat -> daftar -> admin/Pemda setujui/tolak.

## 7. Nonfungsional

- Auth sesi + CSRF; role, policy, ownership guard.
- Password hash; upload tipe/ukuran terbatas.
- Pagination; eager loading; portal limit 6-8 per section.
- Validasi server; cascade delete hati-hati.
- Timestamp dibuat_pada/diperbarui_pada; file lama dihapus.
- Health endpoint /up.

## 8. Di Luar Ruang Lingkup

- Mobile native, reset password UI, notifikasi, audit log.
- Kolaborasi/MoU, volunteer independen, API publik, ekspor lanjutan.

## 9. Risiko

1. Privasi detail ormada publik: tampil beberapa data anggota baru.
2. Aspirasi sepenuhnya publik: belum ada moderasi.
3. Publish pengurus: aturan moderasi perlu diseragamkan.
4. Kuota volunteer: pending bisa melebihi kuota.
5. Cascade delete: penghapusan data permanen.

## 10. Backlog

### P0
- Kebijakan data anggota publik.
- Moderasi aspirasi.
- Konsolidasi publish postingan/agenda.
- Otorisasi update status volunteer.

### P1
- Notifikasi status.
- Audit trail.
- Ekspor laporan.
- Dashboard metrik lanjutan.

### P2
- Kolaborasi/MoU.
- Volunteer independen.
- API + mobile.
- Email/WhatsApp.

## 11. Definition of Done

1. Perilaku sesuai PRD/TDD.
2. Test untuk sukses, validation error, akses terlarang.
3. Tidak bocorkan data.
4. Upload/delete file diuji.
5. Dokumentasi diperbarui.