# Planning Implementasi Profil Ormada dan Anggota Ormada

## 1. Tujuan Implementasi

Modul ini dibuat agar pengurus ormada dapat mengelola identitas organisasi dan data anggota, sedangkan Pemda dapat melihat data ormada serta persebaran mahasiswa yang sudah terdata.

## 2. Scope Modul

### 2.1 Profil Ormada

Fitur profil ormada mencakup:

- Melihat profil ormada.
- Membuat profil ormada untuk akun pengurus yang belum punya profil.
- Mengubah profil ormada milik sendiri.
- Mengunggah atau mengganti logo ormada.
- Menampilkan profil ormada ke Pemda.

### 2.2 Anggota Ormada

Fitur anggota ormada mencakup:

- Melihat daftar anggota.
- Menambah anggota.
- Melihat detail anggota.
- Mengubah data anggota.
- Menghapus anggota.
- Filter anggota berdasarkan status aktif.
- Filter anggota berdasarkan status pengurus.
- Pencarian berdasarkan nama, NIM, atau program studi.

## 3. Hak Akses

### 3.1 Pengurus Ormada

Pengurus ormada boleh:

- Membuat profil ormada untuk akun sendiri.
- Mengubah profil ormada milik sendiri.
- Melihat anggota dari profil ormada milik sendiri.
- Menambah, mengubah, dan menghapus anggota dari profil ormada milik sendiri.

Pengurus ormada tidak boleh:

- Mengakses profil ormada milik akun lain untuk diedit.
- Mengubah anggota milik ormada lain.
- Membuat lebih dari satu profil ormada untuk akun yang sama.

### 3.2 Pemda

Pemda boleh:

- Melihat daftar semua profil ormada.
- Melihat detail profil ormada.
- Melihat daftar anggota per ormada.
- Melihat detail anggota ormada.
- Melakukan pencarian dan filter data anggota.

Pemda tidak boleh:

- Mengubah profil ormada.
- Menambah, mengubah, atau menghapus anggota ormada.

### 3.3 Admin Sistem

Admin sistem boleh:

- Melihat semua data.
- Mengubah data bila dibutuhkan untuk koreksi administratif.

### 3.4 Masyarakat Umum

Masyarakat umum boleh:

- Melihat halaman utama publik.
- Melihat ringkasan jumlah ormada.
- Melihat total anggota secara agregat.
- Melihat ringkasan profil ormada yang bersifat publik.

Masyarakat umum tidak boleh:

- Melihat daftar anggota internal.
- Melihat detail anggota per orang.
- Melihat NIM, nomor HP, status personal detail, atau riwayat jabatan individu.

## 4. Database dan Model

### 4.1 Tabel `profil_ormada`

Kolom yang digunakan:

- `id`
- `admin_id`
- `nama_universitas`
- `alamat_universitas`
- `total_mahasiswa_univ`
- `logo`
- `deskripsi`
- `dibuat_pada`
- `diperbarui_pada`

### 4.2 Tabel `anggota_ormada`

Kolom yang digunakan:

- `id`
- `profil_ormada_id`
- `nama_lengkap`
- `nim`
- `program_studi`
- `status_aktif`
- `jabatan`
- `is_pengurus`
- `tanggal_masuk_kuliah`
- `tanggal_lulus_kuliah`
- `tanggal_mulai_jabatan`
- `tanggal_akhir_jabatan`
- `tanggal_demisioner`
- `tanggal_lulus`
- `no_hp`
- `dibuat_pada`
- `diperbarui_pada`

### 4.3 Model `ProfilOrmada`

Detail implementasi:

- Set nama tabel ke `profil_ormada`.
- Set primary key default `id`.
- Set `CREATED_AT = 'dibuat_pada'`.
- Set `UPDATED_AT = 'diperbarui_pada'`.
- Isi `$fillable` untuk kolom yang boleh diisi mass-assignment.
- Tambahkan relasi `admin()`.
- Tambahkan relasi `anggota()`.
- Tambahkan relasi `aspirasi()` bila modul aspirasi sudah dibuat.

### 4.4 Model `AnggotaOrmada`

Detail implementasi:

- Set nama tabel ke `anggota_ormada`.
- Set `CREATED_AT = 'dibuat_pada'`.
- Set `UPDATED_AT = 'diperbarui_pada'`.
- Isi `$fillable`.
- Tambahkan cast tanggal ke `date`.
- Tambahkan relasi `profilOrmada()`.
- Tambahkan relasi `volunteerRegistrations()` bila modul volunteer sudah dibuat.

## 5. Route

### 5.1 Route Profil Ormada

```php
Route::resource('profil-ormada', ProfilOrmadaController::class);
```

Route yang dipakai:

- `GET /profil-ormada`
- `GET /profil-ormada/create`
- `POST /profil-ormada`
- `GET /profil-ormada/{profil_ormada}`
- `GET /profil-ormada/{profil_ormada}/edit`
- `PUT/PATCH /profil-ormada/{profil_ormada}`

Delete profil ormada sebaiknya tidak dibuka di MVP karena efek cascade dapat menghapus anggota dan aspirasi.

### 5.2 Route Anggota Ormada

```php
Route::resource('anggota-ormada', AnggotaOrmadaController::class);
```

Route yang dipakai:

- `GET /anggota-ormada`
- `GET /anggota-ormada/create`
- `POST /anggota-ormada`
- `GET /anggota-ormada/{anggota_ormada}`
- `GET /anggota-ormada/{anggota_ormada}/edit`
- `PUT/PATCH /anggota-ormada/{anggota_ormada}`
- `DELETE /anggota-ormada/{anggota_ormada}`

## 6. Controller

### 6.1 `ProfilOrmadaController@index`

Detail:

- Jika user Pemda atau admin, tampilkan semua profil ormada.
- Jika user pengurus ormada, redirect ke detail profil miliknya bila sudah ada.
- Jika user pengurus ormada belum punya profil, redirect ke form create.

### 6.2 `ProfilOrmadaController@create`

Detail:

- Hanya untuk pengurus ormada yang belum punya profil.
- Jika sudah punya profil, redirect ke halaman edit/detail.

### 6.3 `ProfilOrmadaController@store`

Detail:

- Validasi input.
- Set `admin_id` dari user login.
- Upload logo bila ada.
- Simpan data profil.
- Redirect ke halaman detail profil.

### 6.4 `ProfilOrmadaController@show`

Detail:

- Pemda/admin dapat melihat semua profil.
- Pengurus hanya boleh melihat profil miliknya sendiri.
- Tampilkan ringkasan jumlah anggota, jumlah pengurus, jumlah alumni, dan jumlah demisioner.

### 6.5 `ProfilOrmadaController@edit`

Detail:

- Hanya pengurus pemilik profil atau admin.
- Tampilkan form edit profil.

### 6.6 `ProfilOrmadaController@update`

Detail:

- Validasi input.
- Jika ada logo baru, simpan logo baru.
- Update profil.
- Redirect ke detail profil.

### 6.7 `AnggotaOrmadaController@index`

Detail:

- Pengurus melihat anggota dari profil miliknya.
- Pemda/admin dapat melihat semua anggota atau filter per profil ormada.
- Support query:
  - `search`
  - `status_aktif`
  - `is_pengurus`
  - `profil_ormada_id`

### 6.8 `AnggotaOrmadaController@create`

Detail:

- Hanya pengurus ormada atau admin.
- Pengurus wajib sudah punya profil ormada.
- Tampilkan form anggota.

### 6.9 `AnggotaOrmadaController@store`

Detail:

- Validasi input.
- Untuk pengurus, `profil_ormada_id` otomatis dari profil miliknya.
- Untuk admin, `profil_ormada_id` dapat dipilih.
- Simpan anggota.
- Redirect ke daftar anggota.

### 6.10 `AnggotaOrmadaController@show`

Detail:

- Pengurus hanya boleh melihat anggota milik profilnya.
- Pemda/admin boleh melihat semua detail anggota.
- Masyarakat umum tidak boleh mengakses halaman ini.

### 6.11 `AnggotaOrmadaController@edit`

Detail:

- Hanya pengurus pemilik anggota atau admin.
- Tampilkan form edit anggota.

### 6.12 `AnggotaOrmadaController@update`

Detail:

- Validasi input.
- Pastikan user punya akses ke anggota tersebut.
- Update anggota.
- Redirect ke detail atau daftar anggota.

### 6.13 `AnggotaOrmadaController@destroy`

Detail:

- Hanya pengurus pemilik anggota atau admin.
- Hapus anggota setelah konfirmasi.
- Redirect ke daftar anggota.

## 7. Validasi Form

### 7.1 Validasi Profil Ormada

Rules:

```php
[
    'nama_universitas' => ['required', 'string', 'max:255'],
    'alamat_universitas' => ['required', 'string', 'max:255'],
    'total_mahasiswa_univ' => ['nullable', 'integer', 'min:0'],
    'logo' => ['nullable', 'image', 'max:2048'],
    'deskripsi' => ['nullable', 'string'],
]
```

### 7.2 Validasi Anggota Ormada

Rules:

```php
[
    'nama_lengkap' => ['required', 'string', 'max:255'],
    'nim' => ['required', 'string', 'max:50'],
    'program_studi' => ['required', 'string', 'max:255'],
    'status_aktif' => ['required', 'in:fungsionaris,mahasiswa_biasa,demisioner,alumni'],
    'jabatan' => ['nullable', 'string', 'max:255'],
    'is_pengurus' => ['required', 'in:YA,TIDAK'],
    'tanggal_masuk_kuliah' => ['nullable', 'date'],
    'tanggal_lulus_kuliah' => ['nullable', 'date'],
    'tanggal_mulai_jabatan' => ['nullable', 'date'],
    'tanggal_akhir_jabatan' => ['nullable', 'date'],
    'tanggal_demisioner' => ['nullable', 'date'],
    'tanggal_lulus' => ['nullable', 'date'],
    'no_hp' => ['nullable', 'string', 'max:20'],
]
```

Validasi tambahan:

- Jika `is_pengurus = YA`, kolom `jabatan` sebaiknya wajib.
- Jika `status_aktif = alumni`, kolom tanggal lulus sebaiknya diisi.
- Jika `status_aktif = demisioner`, kolom tanggal demisioner sebaiknya diisi.

## 8. Tampilan Halaman

### 8.1 Halaman Daftar Profil Ormada

Isi halaman:

- Tabel profil ormada.
- Kolom nama universitas.
- Kolom alamat universitas.
- Kolom total mahasiswa.
- Kolom jumlah anggota terdata.
- Tombol detail.

Target pengguna:

- Pemda.
- Admin.

Catatan publik:

- Masyarakat umum tidak memakai halaman internal ini.
- Ringkasan publik ditampilkan lewat dashboard umum terpisah.

### 8.2 Halaman Detail Profil Ormada

Isi halaman:

- Logo ormada.
- Nama universitas.
- Alamat universitas.
- Deskripsi.
- Total mahasiswa universitas.
- Jumlah anggota terdata.
- Jumlah pengurus aktif.
- Jumlah alumni.
- Tombol edit untuk pemilik profil/admin.
- Tabel ringkas anggota.

### 8.3 Halaman Form Profil Ormada

Field:

- Nama universitas.
- Alamat universitas.
- Total mahasiswa universitas.
- Logo.
- Deskripsi.

### 8.4 Halaman Daftar Anggota

Isi halaman:

- Search input.
- Filter status aktif.
- Filter pengurus.
- Filter profil ormada untuk Pemda/admin.
- Tabel anggota.
- Tombol tambah anggota untuk pengurus/admin.

Kolom tabel:

- Nama lengkap.
- NIM.
- Program studi.
- Status aktif.
- Jabatan.
- Pengurus.
- Nomor HP.
- Aksi.

### 8.5 Halaman Detail Anggota

Isi halaman:

- Nama lengkap.
- NIM.
- Program studi.
- Status aktif.
- Jabatan.
- Status pengurus.
- Tanggal masuk kuliah.
- Tanggal lulus kuliah.
- Tanggal mulai jabatan.
- Tanggal akhir jabatan.
- Tanggal demisioner.
- Tanggal lulus.
- Nomor HP.

### 8.6 Halaman Form Anggota

Field:

- Nama lengkap.
- NIM.
- Program studi.
- Status aktif.
- Jabatan.
- Status pengurus.
- Tanggal masuk kuliah.
- Tanggal lulus kuliah.
- Tanggal mulai jabatan.
- Tanggal akhir jabatan.
- Tanggal demisioner.
- Tanggal lulus.
- Nomor HP.

### 8.7 Halaman Utama Publik Masyarakat

Isi halaman:

- Total ormada terdaftar.
- Total anggota terdata secara agregat.
- Total pengurus aktif secara agregat.
- Banyak profil ormada dalam bentuk ringkas.
- Berita, pengumuman, dan prestasi terbaru dari setiap ormada.
- Aspirasi yang bersifat publik atau sudah memiliki tanggapan Pemda.
- Kalender agenda ormada dan Pemda.

Bagian profil ormada publik:

- Logo ormada.
- Nama universitas.
- Alamat universitas secara umum.
- Deskripsi singkat.
- Jumlah anggota agregat.
- Tombol atau link lihat ringkasan, bukan detail anggota.

Bagian berita ormada:

- Judul postingan.
- Jenis konten.
- Nama ormada atau universitas pembuat.
- Foto bila tersedia.
- Ringkasan isi.
- Tanggal publikasi.

Bagian aspirasi publik:

- Topik aspirasi.
- Nama ormada atau universitas.
- Ringkasan aspirasi.
- Ringkasan tanggapan Pemda bila ada.
- Tanggal aspirasi.

Bagian kalender agenda:

- Tampilan bulan atau daftar agenda per tanggal.
- Nama agenda.
- Kategori agenda `ormada` atau `pemda`.
- Waktu mulai dan selesai.
- Tempat.
- Pembuat agenda.

Data yang tidak ditampilkan:

- Nama anggota per orang.
- NIM.
- Nomor HP.
- Detail status personal.
- Riwayat jabatan individu.
- Tanggal personal anggota.

Route publik yang disarankan:

- `GET /` untuk halaman utama publik.
- `GET /publik/agenda` untuk kalender agenda penuh.
- `GET /publik/postingan/{postingan}` untuk detail berita/pengumuman/prestasi.

Controller publik yang disarankan:

- `PublicDashboardController@index`
- `PublicDashboardController@agenda`
- `PublicDashboardController@postingan`

## 9. Komponen UI

Komponen yang dibutuhkan:

- Layout dashboard.
- Sidebar menu.
- Table dengan empty state.
- Form input.
- Select enum.
- Upload logo.
- Badge status aktif.
- Badge pengurus.
- Modal konfirmasi hapus anggota.
- Alert sukses/error.
- Pagination.

## 10. Query dan Filtering

### 10.1 Search Anggota

Search mencari ke:

- `nama_lengkap`
- `nim`
- `program_studi`

### 10.2 Filter Status Aktif

Nilai filter:

- Semua
- Fungsionaris
- Mahasiswa biasa
- Demisioner
- Alumni

### 10.3 Filter Pengurus

Nilai filter:

- Semua
- Pengurus
- Bukan pengurus

### 10.4 Filter Profil Ormada

Khusus Pemda/admin:

- Semua ormada.
- Per profil ormada.

## 11. Testing

### 11.1 Test Profil Ormada

Checklist:

- Pengurus yang belum punya profil dapat membuka halaman create.
- Pengurus yang sudah punya profil tidak bisa membuat profil kedua.
- Pengurus dapat update profil miliknya.
- Pengurus tidak bisa update profil milik akun lain.
- Pemda dapat melihat daftar semua profil.
- Pemda tidak bisa membuka form edit profil.

### 11.2 Test Anggota Ormada

Checklist:

- Pengurus dapat menambah anggota ke profil miliknya.
- Pengurus tidak bisa menambah anggota ke profil lain.
- Pengurus dapat update anggota miliknya.
- Pengurus tidak bisa update anggota ormada lain.
- Pengurus dapat menghapus anggota miliknya.
- Pemda dapat melihat semua anggota.
- Pemda dapat melihat detail anggota ormada.
- Pemda tidak bisa membuat, mengubah, atau menghapus anggota.
- Masyarakat umum tidak bisa melihat daftar/detail anggota.
- Search anggota mengembalikan hasil berdasarkan nama, NIM, atau program studi.
- Filter status aktif berjalan benar.
- Filter pengurus berjalan benar.

## 12. Urutan Implementasi

1. Buat migration `profil_ormada`.
2. Buat migration `anggota_ormada`.
3. Buat model `ProfilOrmada`.
4. Buat model `AnggotaOrmada`.
5. Buat relasi antar model.
6. Buat middleware role bila belum ada.
7. Buat `ProfilOrmadaController`.
8. Buat `AnggotaOrmadaController`.
9. Tambahkan route resource.
10. Buat view daftar/detail/form profil ormada.
11. Buat view daftar/detail/form anggota ormada.
12. Tambahkan upload logo.
13. Tambahkan search dan filter anggota.
14. Tambahkan authorization check.
15. Tambahkan feature test.

## 13. Definition of Done

Modul dianggap selesai jika:

- Pengurus dapat membuat dan mengubah profil ormada miliknya.
- Pengurus hanya dapat mengelola anggota milik profilnya.
- Pemda dapat melihat semua profil, daftar anggota, dan detail anggota tanpa dapat mengubahnya.
- Masyarakat umum hanya dapat melihat halaman utama publik berisi data agregat tanpa detail anggota.
- Search dan filter anggota berjalan.
- Upload logo profil berjalan.
- Semua validasi utama aktif.
- Feature test untuk akses dan CRUD utama lulus.
