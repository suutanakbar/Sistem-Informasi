# Product Requirements Document

## Nama Produk

Sistem Informasi Ormada dan Sinergi Pemda Temanggung

## Ringkasan

Produk ini adalah aplikasi web untuk mengelola data organisasi mahasiswa daerah (ormada), anggota, pengurus, aspirasi, proposal bantuan, agenda, publikasi, program volunteer, dan kolaborasi antara ormada dengan Pemerintah Daerah Temanggung.

Aplikasi dirancang agar Pemda dapat memantau persebaran mahasiswa Temanggung di berbagai universitas, menindaklanjuti aspirasi, menerima proposal, mempublikasikan informasi, dan membuka ruang kolaborasi. Pengurus ormada dapat mengelola profil organisasi, data anggota, proposal kegiatan, agenda, postingan, aspirasi, serta pendaftaran volunteer.

## Latar Belakang

Data ormada dan mahasiswa daerah sering tersebar di banyak tempat, sehingga Pemda sulit mendapatkan gambaran terkini tentang jumlah mahasiswa, kepengurusan, kebutuhan organisasi, agenda, dan peluang kolaborasi. Di sisi lain, ormada membutuhkan kanal formal untuk menyampaikan aspirasi, mengajukan proposal, dan mengikuti program yang disediakan Pemda.

## Tujuan Produk

1. Menyediakan pusat data ormada dan mahasiswa Temanggung lintas universitas.
2. Mempermudah pengurus ormada mengelola profil, anggota, pengurus, agenda, dan postingan.
3. Mempermudah Pemda menerima, memproses, dan memberi tanggapan terhadap proposal serta aspirasi.
4. Mendukung kolaborasi program antara Pemda dan ormada.
5. Menyediakan kanal informasi agenda, berita, pengumuman, prestasi, dan volunteer.

## Pengguna

### Admin Sistem

Admin sistem mengelola akun, data master, dan akses aplikasi secara keseluruhan.

### Pengurus Ormada

Pengurus ormada mengelola profil ormada, data anggota, agenda ormada, postingan, aspirasi, proposal, serta pendaftaran anggota ke program volunteer.

### Pemda

Pemda melihat data ormada sampai detail anggota, menindaklanjuti aspirasi, memproses proposal, membuat agenda/pengumuman, membuka volunteer, dan membuat program kolaborasi.

### Masyarakat Umum

Masyarakat umum dapat melihat halaman utama publik berisi ringkasan informasi ormada, agenda, berita, pengumuman, dan prestasi tanpa mengakses detail data personal anggota.

## Ruang Lingkup Fitur

### Autentikasi dan Otorisasi

Pengguna dapat login menggunakan email dan kata sandi. Sistem membedakan hak akses berdasarkan peran `admin`, `pengurus_ormada`, dan `pemda`.

Kebutuhan utama:

- Login dan logout.
- Penyimpanan waktu terakhir masuk.
- Pembatasan menu berdasarkan peran.
- Password tersimpan dalam bentuk hash.

### Manajemen Profil Ormada

Pengurus ormada dapat mengelola profil organisasi berdasarkan universitas.

Kebutuhan utama:

- Membuat dan memperbarui profil ormada.
- Mengisi nama universitas, alamat universitas, jumlah mahasiswa, logo, dan deskripsi.
- Pemda dapat melihat daftar profil ormada.
- Masyarakat umum dapat melihat ringkasan profil ormada yang bersifat publik.

### Manajemen Anggota Ormada

Pengurus ormada dapat mengelola anggota dan pengurus organisasi.

Kebutuhan utama:

- Menambah, mengubah, menghapus, dan melihat anggota.
- Mencatat NIM, program studi, nomor HP, status aktif, jabatan, dan masa jabatan.
- Menandai anggota sebagai pengurus dengan nilai `YA` atau `TIDAK`.
- Mencatat status `fungsionaris`, `mahasiswa_biasa`, `demisioner`, atau `alumni`.
- Pemda dapat melihat daftar dan detail anggota ormada untuk kebutuhan pendataan.
- Masyarakat umum hanya dapat melihat statistik agregat anggota, bukan detail anggota.

### Proposal Bantuan

Pengurus ormada dapat mengajukan proposal bantuan kepada Pemda atau dinas tujuan.

Kebutuhan utama:

- Membuat proposal kegiatan.
- Mengunggah file proposal.
- Memilih jenis bantuan: dana, izin, tempat, atau fasilitas.
- Melihat status proposal: diajukan, diproses Pemda, dana cair, atau ditolak.
- Pemda dapat memperbarui status dan memberi catatan.

### Volunteer

Pemda atau admin terkait dapat membuka program volunteer. Anggota ormada dapat didaftarkan sebagai peserta volunteer.

Kebutuhan utama:

- Membuat program volunteer.
- Mengatur kebutuhan posisi, kuota, tenggat pendaftaran, dan status buka/tutup.
- Mendaftarkan anggota ormada.
- Mengelola status seleksi: pending, diterima, atau ditolak.

### Kolaborasi

Pemda dan ormada dapat mencatat program kolaborasi bersama.

Kebutuhan utama:

- Membuat program kolaborasi.
- Mencatat nama program, deskripsi, anggaran bersama, tanggal, tempat, dan file MoU.
- Mengelola status: diajukan, disetujui, selesai, atau batal.

### Aspirasi

Ormada dapat menyampaikan aspirasi kepada Pemda.

Kebutuhan utama:

- Membuat aspirasi berdasarkan profil ormada.
- Menyertakan topik, detail aspirasi, dan file pendukung.
- Pemda dapat memberi tanggapan.

### Postingan

Pengguna berwenang dapat membuat konten informasi.

Kebutuhan utama:

- Membuat berita, pengumuman, atau prestasi.
- Menyertakan judul, isi konten, dan foto.
- Menampilkan daftar postingan untuk pengguna.

### Agenda

Pengguna berwenang dapat membuat agenda kegiatan.

Kebutuhan utama:

- Membuat agenda dengan nama, deskripsi, poster, waktu mulai, waktu selesai, tempat, dan kategori.
- Kategori agenda terdiri dari `ormada` dan `pemda`.
- Agenda dapat ditampilkan dalam daftar atau kalender sederhana.

### Halaman Utama Publik

Masyarakat umum dapat membuka halaman publik tanpa login.

Kebutuhan utama:

- Menampilkan jumlah ormada terdaftar.
- Menampilkan total anggota terdata secara agregat.
- Menampilkan ringkasan persebaran ormada per universitas.
- Menampilkan daftar beberapa profil ormada dalam bentuk ringkas.
- Menampilkan berita, pengumuman, dan prestasi dari setiap ormada.
- Menampilkan aspirasi yang bersifat publik atau sudah layak ditampilkan.
- Menampilkan kalender agenda berisi agenda ormada dan Pemda.
- Tidak menampilkan NIM, nomor HP, detail status personal, riwayat jabatan personal, atau detail anggota per orang.

Konten profil ormada yang tampil untuk masyarakat umum:

- Nama universitas.
- Logo ormada.
- Alamat universitas secara umum.
- Deskripsi singkat.
- Total mahasiswa universitas atau total anggota secara agregat.

Konten profil ormada yang tidak tampil untuk masyarakat umum:

- Daftar anggota.
- Detail anggota.
- Nomor HP anggota.
- NIM anggota.
- Riwayat jabatan anggota.

## Kebutuhan Non-Fungsional

- Aplikasi berbasis web dan responsif.
- Backend menggunakan Laravel 12.
- Database menggunakan MySQL/MariaDB.
- File upload disimpan di storage publik Laravel.
- Setiap data utama memiliki timestamp dibuat dan diperbarui.
- Akses data dibatasi sesuai peran.
- Validasi input dilakukan di server.
- Operasi hapus harus mempertimbangkan relasi data karena foreign key memakai `ON DELETE CASCADE`.
- Data personal anggota hanya dapat diakses oleh pengurus pemilik data, Pemda, dan admin sistem.

## Alur Utama

### Pengurus Ormada Mengajukan Proposal

1. Pengurus login.
2. Pengurus membuka menu proposal.
3. Pengurus mengisi judul kegiatan, deskripsi, jenis bantuan, anggaran, dinas tujuan, dan file proposal.
4. Sistem menyimpan proposal dengan status `diajukan`.
5. Pemda melihat proposal masuk.
6. Pemda memperbarui status dan memberi catatan.
7. Pengurus melihat hasil tindak lanjut.

### Pengurus Ormada Mengelola Anggota

1. Pengurus login.
2. Pengurus membuka menu anggota.
3. Pengurus menambah atau memperbarui data anggota.
4. Sistem memvalidasi data wajib.
5. Sistem menyimpan anggota sesuai profil ormada milik pengurus.

### Pemda Menanggapi Aspirasi

1. Pemda login.
2. Pemda membuka daftar aspirasi.
3. Pemda membaca detail aspirasi dan file pendukung.
4. Pemda mengisi tanggapan.
5. Sistem menyimpan tanggapan agar dapat dibaca pengurus ormada.

## Kriteria Keberhasilan

- Pengurus ormada dapat mengelola profil dan anggota tanpa mengakses data ormada lain.
- Proposal dapat diajukan, diproses, diberi catatan, dan dipantau statusnya.
- Aspirasi dapat dikirim oleh ormada dan ditanggapi oleh Pemda.
- Pemda dapat melihat ringkasan dan detail data ormada serta anggota.
- Masyarakat umum dapat melihat halaman utama publik tanpa detail personal anggota.
- Sistem memiliki validasi dan pembatasan akses untuk setiap peran.

## Batasan dan Asumsi

- Satu akun pengurus ormada memiliki satu profil ormada.
- Akun dengan peran `pemda` dapat menjadi tujuan proposal dan pembuat kolaborasi.
- Kolom `dinas_tujuan_id` pada proposal mengarah ke tabel `admin`, sehingga dinas tujuan direpresentasikan sebagai akun admin berperan Pemda.
- Belum ada tabel khusus untuk mahasiswa umum di luar `anggota_ormada`.
- Belum ada tabel notifikasi, sehingga pemberitahuan status dapat ditambahkan pada fase berikutnya.

## Prioritas MVP

1. Autentikasi dan otorisasi peran.
2. Profil ormada.
3. Anggota ormada.
4. Proposal dan tindak lanjut Pemda.
5. Aspirasi dan tanggapan Pemda.
6. Postingan dan agenda.
7. Volunteer dan kolaborasi.
