# Planning Implementasi Public Dashboard

## 1. Tujuan Implementasi

Public dashboard dibuat sebagai halaman utama yang dapat diakses masyarakat umum tanpa login. Halaman ini menjadi etalase informasi ormada dan aktivitas Pemda-Ormada, tetapi tetap menjaga agar data personal anggota tidak terbuka ke publik.

## 2. Scope Modul

Fitur public dashboard mencakup:

- Menampilkan ringkasan jumlah ormada terdaftar.
- Menampilkan total anggota terdata secara agregat.
- Menampilkan jumlah pengurus aktif secara agregat.
- Menampilkan daftar profil ormada secara ringkas.
- Menampilkan berita, pengumuman, dan prestasi terbaru bila modul postingan sudah tersedia.
- Menampilkan agenda ormada dan Pemda bila modul agenda sudah tersedia.
- Menampilkan aspirasi publik atau aspirasi yang sudah memiliki tanggapan Pemda bila modul aspirasi sudah tersedia.

Untuk MVP awal, public dashboard dapat difokuskan dulu pada data profil ormada dan anggota agregat karena modul profil dan anggota sudah tersedia.

## 3. Hak Akses

### 3.1 Masyarakat Umum

Masyarakat umum boleh:

- Membuka halaman utama publik tanpa login.
- Melihat statistik agregat ormada dan anggota.
- Melihat ringkasan profil ormada.
- Melihat konten publik seperti agenda, postingan, dan aspirasi yang layak tampil.

Masyarakat umum tidak boleh:

- Melihat daftar anggota internal.
- Melihat detail anggota per orang.
- Melihat NIM anggota.
- Melihat nomor HP anggota.
- Melihat status personal detail anggota.
- Melihat riwayat jabatan individu.
- Melihat tanggal personal anggota seperti tanggal masuk kuliah, lulus, demisioner, atau masa jabatan.

### 3.2 Pengguna Login

Pengguna yang sudah login tetap boleh membuka public dashboard. Namun tombol navigasi dapat menyesuaikan:

- Jika belum login, tampilkan tombol login.
- Jika sudah login, tampilkan tombol dashboard internal.

## 4. Data yang Ditampilkan

### 4.1 Statistik Utama

Data statistik:

- Total ormada terdaftar.
- Total anggota terdata.
- Total pengurus aktif.
- Total alumni bila diperlukan.

Query yang disarankan:

```php
$totalOrmada = ProfilOrmada::count();
$totalAnggota = AnggotaOrmada::count();
$totalPengurus = AnggotaOrmada::where('is_pengurus', 'YA')->count();
$totalAlumni = AnggotaOrmada::where('status_aktif', 'alumni')->count();
```

### 4.2 Ringkasan Profil Ormada

Data yang boleh tampil:

- Logo ormada.
- Nama universitas.
- Alamat universitas secara umum.
- Deskripsi singkat.
- Total mahasiswa universitas.
- Jumlah anggota terdata secara agregat.

Data yang tidak boleh tampil:

- Nama anggota.
- NIM.
- Nomor HP.
- Jabatan personal anggota.
- Status personal anggota.
- Tanggal personal anggota.

Query yang disarankan:

```php
$profilOrmadas = ProfilOrmada::query()
    ->withCount('anggota')
    ->latest('dibuat_pada')
    ->limit(8)
    ->get();
```

### 4.3 Postingan Publik

Bagian ini dapat dibuat setelah modul postingan tersedia.

Data yang tampil:

- Judul.
- Jenis konten: berita, pengumuman, atau prestasi.
- Ringkasan isi.
- Foto bila tersedia.
- Nama ormada atau pembuat.
- Tanggal publikasi.

Query yang disarankan:

```php
$postinganTerbaru = Postingan::query()
    ->with('admin.profilOrmada')
    ->latest('dibuat_pada')
    ->limit(6)
    ->get();
```

### 4.4 Agenda Publik

Bagian ini dapat dibuat setelah modul agenda tersedia.

Data yang tampil:

- Nama agenda.
- Kategori: ormada atau pemda.
- Waktu mulai.
- Waktu selesai.
- Tempat.
- Pembuat agenda.

Query yang disarankan:

```php
$agendaTerdekat = Agenda::query()
    ->where('waktu_selesai', '>=', now())
    ->orderBy('waktu_mulai')
    ->limit(6)
    ->get();
```

### 4.5 Aspirasi Publik

Bagian ini dapat dibuat setelah modul aspirasi tersedia.

Data yang tampil:

- Topik aspirasi.
- Nama ormada atau universitas.
- Ringkasan aspirasi.
- Ringkasan tanggapan Pemda bila ada.
- Tanggal aspirasi.

Untuk MVP, aspirasi yang tampil sebaiknya hanya aspirasi yang sudah memiliki tanggapan Pemda.

Query yang disarankan:

```php
$aspirasiPublik = Aspirasi::query()
    ->with('profilOrmada')
    ->whereNotNull('tanggapan_pemda')
    ->latest('dibuat_pada')
    ->limit(5)
    ->get();
```

## 5. Route

Route publik yang disarankan:

```php
Route::get('/', [PublicDashboardController::class, 'index'])->name('public.home');
Route::get('/publik/agenda', [PublicDashboardController::class, 'agenda'])->name('public.agenda');
Route::get('/publik/postingan/{postingan}', [PublicDashboardController::class, 'postingan'])->name('public.postingan.show');
```

Untuk MVP awal, cukup implementasi:

```php
Route::get('/', [PublicDashboardController::class, 'index'])->name('public.home');
```

Route internal seperti `/anggota-ormada` dan `/profil-ormada` tetap berada di dalam middleware `auth`.

## 6. Controller

Controller yang dibuat:

- `PublicDashboardController`

### 6.1 `PublicDashboardController@index`

Detail:

- Mengambil total ormada.
- Mengambil total anggota agregat.
- Mengambil total pengurus agregat.
- Mengambil profil ormada ringkas dengan `withCount('anggota')`.
- Mengirim data ke view public dashboard.
- Tidak mengambil daftar anggota individual.

Contoh struktur:

```php
class PublicDashboardController extends Controller
{
    public function index(): View
    {
        return view('public.dashboard', [
            'totalOrmada' => ProfilOrmada::count(),
            'totalAnggota' => AnggotaOrmada::count(),
            'totalPengurus' => AnggotaOrmada::where('is_pengurus', 'YA')->count(),
            'profilOrmadas' => ProfilOrmada::withCount('anggota')
                ->latest('dibuat_pada')
                ->limit(8)
                ->get(),
        ]);
    }
}
```

### 6.2 `PublicDashboardController@agenda`

Detail:

- Dibuat setelah modul agenda tersedia.
- Menampilkan daftar atau kalender agenda publik.
- Tidak membutuhkan login.

### 6.3 `PublicDashboardController@postingan`

Detail:

- Dibuat setelah modul postingan tersedia.
- Menampilkan detail postingan publik.
- Tidak membutuhkan login.

## 7. View

View yang dibuat untuk MVP awal:

- `resources/views/public/dashboard.blade.php`

Bagian halaman:

- Header publik dengan nama sistem dan tombol login/dashboard.
- Statistik utama.
- Daftar ringkasan profil ormada.
- Empty state bila belum ada profil ormada.
- Footer sederhana.

Jika modul lain sudah tersedia, tambahkan:

- Section postingan terbaru.
- Section agenda terdekat.
- Section aspirasi yang sudah ditanggapi.

## 8. Komponen UI

Komponen yang dibutuhkan:

- Public layout sederhana.
- Statistik ringkas.
- Card profil ormada.
- Badge jumlah anggota.
- Empty state.
- Tombol login atau dashboard internal.

Catatan desain:

- Halaman publik harus responsif.
- Jangan tampilkan tabel detail anggota.
- Profil ormada boleh berbentuk card ringkas.
- Jika logo tidak ada, tampilkan fallback inisial universitas.

## 9. Keamanan Data

Aturan keamanan utama:

- Controller publik tidak boleh melakukan query daftar `AnggotaOrmada::get()` untuk ditampilkan.
- View publik tidak boleh menerima variabel berisi koleksi anggota individual.
- Route detail anggota tetap berada di dalam middleware `auth`.
- Jangan membuat route publik seperti `/publik/anggota/{anggota}`.
- Jangan menampilkan NIM, nomor HP, jabatan personal, atau status personal anggota di halaman publik.

## 10. Testing

### 10.1 Feature Test Public Dashboard

Checklist:

- Masyarakat umum dapat membuka `/`.
- Public dashboard menampilkan total ormada.
- Public dashboard menampilkan total anggota agregat.
- Public dashboard menampilkan nama universitas dari profil ormada.
- Public dashboard tidak menampilkan nama anggota.
- Public dashboard tidak menampilkan NIM.
- Public dashboard tidak menampilkan nomor HP.
- Public dashboard tidak menampilkan jabatan personal anggota.
- Tombol login tampil untuk guest.
- Tombol dashboard tampil untuk user yang sudah login.

### 10.2 Feature Test Proteksi Data Anggota

Checklist:

- Guest tidak bisa membuka `/anggota-ormada`.
- Guest tidak bisa membuka `/anggota-ormada/{id}`.
- Guest diarahkan ke login atau mendapat status sesuai konfigurasi auth.
- Data personal anggota hanya muncul setelah login sebagai role yang berwenang.

## 11. Urutan Implementasi MVP

1. Buat `PublicDashboardController`.
2. Ubah route `/` dari view `welcome` ke `PublicDashboardController@index`.
3. Buat folder view `resources/views/public`.
4. Buat view `public/dashboard.blade.php`.
5. Tampilkan statistik agregat profil dan anggota.
6. Tampilkan daftar ringkas profil ormada.
7. Tambahkan tombol login/dashboard sesuai status auth.
8. Tambahkan empty state.
9. Tambahkan feature test public dashboard.
10. Tambahkan feature test proteksi route anggota untuk guest.

## 12. Urutan Implementasi Lanjutan

1. Tambahkan section postingan terbaru setelah modul postingan tersedia.
2. Tambahkan halaman detail postingan publik.
3. Tambahkan section agenda terdekat setelah modul agenda tersedia.
4. Tambahkan halaman kalender agenda publik.
5. Tambahkan section aspirasi publik setelah modul aspirasi tersedia.
6. Tambahkan filter atau pencarian profil ormada bila data sudah banyak.

## 13. Definition of Done

Public dashboard dianggap selesai untuk MVP jika:

- Route `/` menampilkan halaman publik, bukan halaman welcome bawaan Laravel.
- Halaman dapat diakses tanpa login.
- Statistik ormada dan anggota tampil dalam bentuk agregat.
- Ringkasan profil ormada tampil tanpa data anggota personal.
- Guest tidak bisa mengakses daftar atau detail anggota internal.
- Tidak ada NIM, nomor HP, atau detail personal anggota di HTML public dashboard.
- Feature test utama untuk akses publik dan proteksi data anggota lulus.

