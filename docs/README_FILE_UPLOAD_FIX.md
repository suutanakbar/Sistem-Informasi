# Fix: Foto Tidak Muncul di Agenda, Berita, & Profil Ormada

## Ringkasan Masalah

Foto yang diupload melalui form **Agenda**, **Postingan (Berita)**, atau **Profil Ormada** tidak muncul di halaman aplikasi. Ini biasanya disebabkan oleh:

1. **Storage symlink belum dibuat** - Laravel memerlukan symlink untuk mengakses file yang diupload
2. **Permission folder storage** - Folder storage tidak memiliki permission yang tepat
3. **Konfigurasi .env** - APP_URL atau FILESYSTEM_DISK belum dikonfigurasi dengan benar

## Solusi Cepat

### Langkah 1: Jalankan Script Otomatis

```bash
bash scripts/fix-storage.sh
```

Script ini akan:
- ✅ Membuat storage symlink (`public/storage` → `storage/app/public`)
- ✅ Set permission folder (775 untuk storage, bootstrap/cache, public)
- ✅ Clear semua cache Laravel
- ✅ Verifikasi konfigurasi .env

### Langkah 2: Update .env

Pastikan file `.env` memiliki konfigurasi yang benar:

```env
APP_URL=http://your-actual-domain.com
FILESYSTEM_DISK=public
```

**Catatan:** Ganti `http://your-actual-domain.com` dengan URL aplikasi Anda yang sebenarnya.

### Langkah 3: Clear Cache

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### Langkah 4: Restart Web Server

```bash
# Apache
sudo service apache2 restart

# Nginx
sudo service nginx restart

# Jika menggunakan Laravel Valet
valet restart
```

### Langkah 5: Test Upload

1. Upload foto baru melalui form
2. Cek apakah file tersimpan di `storage/app/public/[folder]/`
3. Akses URL: `http://your-domain.com/storage/[folder]/[filename]`
4. Cek apakah foto muncul di halaman detail

## Struktur File yang Dibuat

```
project/
├── scripts/
│   └── fix-storage.sh              # Script otomatis untuk perbaikan
├── app/
│   └── Helpers/
│       ├── StorageHelper.php       # Helper class untuk storage operations
│       └── helpers.php             # Global helper functions
├── docs/
│   ├── TROUBLESHOOTING_FILE_UPLOAD.md  # Panduan troubleshooting lengkap
│   └── README_FILE_UPLOAD_FIX.md       # File ini
└── composer.json                   # Updated dengan autoload untuk helpers
```

## Helper Functions yang Tersedia

Setelah menjalankan `composer dump-autoload`, Anda dapat menggunakan helper functions di Blade views:

### Sebelum ( Lama ):
```blade
<img src="{{ asset('storage/' . $agenda->gambar_poster) }}" alt="Poster">
```

### Sesudah (Baru - Lebih Konsisten):
```blade
<img src="{{ agenda_poster_url($agenda->gambar_poster) }}" alt="Poster">
```

### Helper Functions yang Tersedia:

```php
// Generic storage URL
storage_url($path)

// Specific helpers
agenda_poster_url($gambar_poster)
postingan_foto_url($foto)
profil_logo_url($logo)

// Check if file exists
file_exists_storage($path)
```

### Contoh Penggunaan di Blade:

```blade
{{-- Agenda --}}
@if($agenda->gambar_poster)
    <img src="{{ agenda_poster_url($agenda->gambar_poster) }}" alt="{{ $agenda->nama_agenda }}">
@endif

{{-- Postingan --}}
@if($postingan->foto)
    <img src="{{ postingan_foto_url($postingan->foto) }}" alt="{{ $postingan->judul }}">
@endif

{{-- Profil Ormada --}}
@if($profilOrmada->logo)
    <img src="{{ profil_logo_url($profilOrmada->logo) }}" alt="Logo">
@endif
```

## Path Upload di Aplikasi

| Fitur | Folder Upload | Database Field | View Path |
|-------|---------------|----------------|-----------|
| Agenda | `agenda/poster/` | `gambar_poster` | `agenda_poster_url()` |
| Postingan | `postingan/foto/` | `foto` | `postingan_foto_url()` |
| Profil Ormada | `profil-ormada/logo/` | `logo` | `profil_logo_url()` |

## Troubleshooting Lanjutan

Jika foto masih tidak muncul setelah menjalankan script:

### 1. Cek Symlink
```bash
ls -la public/storage
# Harus menampilkan: storage -> ../storage/app/public
```

### 2. Cek File di Storage
```bash
ls -la storage/app/public/agenda/poster/
ls -la storage/app/public/postingan/foto/
ls -la storage/app/public/profil-ormada/logo/
```

### 3. Cek Permission
```bash
# Linux/Mac
ls -la storage/app/public/

# Windows (Git Bash)
ls -la storage/app/public/
```

### 4. Test URL Langsung
Buka browser dan akses:
```
http://your-domain.com/storage/agenda/poster/[nama-file].jpg
```

Jika 404, berarti symlink bermasalah. Jika 403, berarti permission salah.

### 5. Cek Laravel Log
```bash
tail -f storage/logs/laravel.log
```

### 6. Cek Browser Console
- F12 → Network tab
- Cek status code untuk request gambar
- Cek apakah URL yang di-generate benar

## Catatan Penting

1. **Jangan commit** folder `storage/app/public` ke Git
2. **Jangan commit** symlink `public/storage` ke Git (akan berbeda di setiap OS)
3. File upload disimpan di `storage/app/public/` yang **TIDAK** di-commit
4. Pastikan `.gitignore` sudah include `storage/`

## Update Views (Opsional)

Untuk konsistensi, Anda dapat mengganti semua `asset('storage/' . $model->field)` dengan helper functions yang sudah disediakan.

### Contoh Replace di Views:

**Lama:**
```blade
<img src="{{ asset('storage/' . $agenda->gambar_poster) }}" alt="Poster">
```

**Baru:**
```blade
<img src="{{ agenda_poster_url($agenda->gambar_poster) }}" alt="Poster">
```

## Kontribusi

Jika menemukan bug atau memiliki saran perbaikan, silakan buat issue atau pull request.

## License

MIT License