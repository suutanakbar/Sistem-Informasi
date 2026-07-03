# Planning Implementasi Login Admin

## 1. Tujuan Implementasi

Fitur login dibuat agar akun pada tabel `admin` dapat masuk ke sistem menggunakan kombinasi `email` dan `kata_sandi`, lalu sistem membedakan akses berdasarkan kolom `peran`.

Peran yang digunakan:

- `admin`
- `pengurus_ormada`
- `pemda`

## 2. Scope Fitur

Fitur login mencakup:

- Halaman login.
- Proses autentikasi menggunakan `email` dan `kata_sandi`.
- Penyimpanan waktu terakhir masuk ke kolom `terakhir_masuk`.
- Logout.
- Redirect setelah login ke dashboard.
- Pembatasan akses halaman internal menggunakan middleware `auth`.
- Pembatasan fitur berdasarkan `peran`.

Fitur yang belum masuk scope awal:

- Register akun mandiri.
- Reset password.
- Verifikasi email.
- Manajemen akun admin lengkap.
- Multi-guard terpisah.

## 3. Struktur Database

Login memakai tabel `admin`.

Kolom utama:

- `id`
- `nama`
- `email`
- `kata_sandi`
- `peran`
- `terakhir_masuk`
- `dibuat_pada`
- `diperbarui_pada`

Catatan:

- `email` wajib unik.
- `kata_sandi` wajib disimpan dalam bentuk hash.
- `peran` menentukan menu dan hak akses setelah login.
- `terakhir_masuk` diperbarui setiap login berhasil.

## 4. Model

Model yang digunakan adalah `Admin`.

Detail implementasi:

- Model extend `Illuminate\Foundation\Auth\User`.
- Set nama tabel ke `admin`.
- Set kolom timestamp:
  - `CREATED_AT = 'dibuat_pada'`
  - `UPDATED_AT = 'diperbarui_pada'`
- Set hidden:
  - `kata_sandi`
- Tambahkan cast:
  - `kata_sandi` sebagai `hashed`
  - `terakhir_masuk` sebagai `datetime`
- Override `getAuthPassword()` agar Laravel membaca password dari kolom `kata_sandi`.

Method helper peran:

- `isAdmin()`
- `isPemda()`
- `isPengurusOrmada()`

## 5. Auth Configuration

Konfigurasi `config/auth.php` diarahkan ke model `Admin`.

Provider:

```php
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\Admin::class,
    ],
],
```

Guard tetap memakai guard default `web`.

Alasan:

- Sistem masih memakai session web standar Laravel.
- Belum perlu guard terpisah karena semua akun internal berada di tabel `admin`.

## 6. Route

Route publik:

```php
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
```

Route internal:

```php
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
```

## 7. Controller

Controller yang dibuat:

- `AuthController`
- `DashboardController`

### 7.1 `AuthController@showLogin`

Tugas:

- Menampilkan halaman login.
- Jika user sudah login, redirect ke dashboard.

### 7.2 `AuthController@login`

Tugas:

- Validasi `email`.
- Validasi `kata_sandi`.
- Jalankan `Auth::attempt()`.
- Jika gagal, tampilkan pesan error.
- Jika berhasil:
  - regenerate session
  - update `terakhir_masuk`
  - redirect ke dashboard atau intended URL

### 7.3 `AuthController@logout`

Tugas:

- Logout user.
- Invalidate session.
- Regenerate CSRF token.
- Redirect ke halaman login.

### 7.4 `DashboardController@index`

Tugas:

- Menampilkan dashboard setelah login.
- Isi dashboard menyesuaikan peran:
  - Admin melihat ringkasan global.
  - Pemda melihat ringkasan global untuk monitoring.
  - Pengurus ormada melihat ringkasan ormada miliknya.

## 8. Validasi Login

Rules:

```php
[
    'email' => ['required', 'email'],
    'kata_sandi' => ['required', 'string'],
]
```

Pesan error:

- Jika email atau kata sandi salah, tampilkan pesan umum: `Email atau kata sandi tidak sesuai.`

Catatan keamanan:

- Jangan memberi tahu apakah email yang salah atau password yang salah.
- Gunakan session regeneration setelah login berhasil.

## 9. Tampilan Halaman Login

Field:

- Email.
- Kata sandi.
- Checkbox `Ingat saya`.
- Tombol masuk.

Konten halaman:

- Nama sistem.
- Judul login.
- Pesan error validasi.
- Pesan status logout.

Target pengguna:

- Admin sistem.
- Pengurus ormada.
- Pemda.

## 10. Redirect Berdasarkan Peran

Untuk MVP, semua role diarahkan ke:

- `/dashboard`

Di dashboard, isi data disesuaikan berdasarkan role.

Alternatif pengembangan berikutnya:

- `admin` diarahkan ke dashboard admin.
- `pemda` diarahkan ke dashboard Pemda.
- `pengurus_ormada` diarahkan ke dashboard ormada.

## 11. Authorization Setelah Login

Halaman internal wajib memakai middleware:

- `auth`

Fitur tertentu memakai role check:

- Admin dapat akses semua data.
- Pemda dapat melihat data ormada dan detail anggota, tetapi tidak mengubah anggota.
- Pengurus ormada hanya mengelola profil dan anggota miliknya.

## 12. Testing

Test minimal:

- Login berhasil dengan `email` dan `kata_sandi` valid.
- Login gagal jika password salah.
- Login gagal jika email tidak terdaftar.
- Setelah login berhasil, user redirect ke dashboard.
- Kolom `terakhir_masuk` terisi setelah login.
- User dapat logout.
- Guest tidak bisa mengakses halaman internal.
- User yang sudah login tidak perlu membuka halaman login lagi.

## 13. Urutan Implementasi

1. Pastikan migration tabel `admin` sudah tersedia.
2. Pastikan model `Admin` extend `Authenticatable`.
3. Override password auth agar memakai kolom `kata_sandi`.
4. Arahkan provider auth ke model `Admin`.
5. Buat `AuthController`.
6. Buat view login.
7. Tambahkan route login dan logout.
8. Buat dashboard awal.
9. Proteksi route internal memakai middleware `auth`.
10. Tambahkan tombol logout pada layout internal.
11. Tambahkan feature test login/logout.
12. Jalankan test.

## 14. Definition of Done

Fitur dianggap selesai jika:

- Akun pada tabel `admin` bisa login memakai `email` dan `kata_sandi`.
- Password hash tetap bekerja.
- Role tersimpan dan dapat dipakai untuk authorization.
- `terakhir_masuk` diperbarui setelah login.
- Logout berhasil menghapus session.
- Halaman internal tidak bisa diakses tanpa login.
- Test login utama lulus.

