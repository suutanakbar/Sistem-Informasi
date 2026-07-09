# Dokumentasi: Fix Foto Tidak Muncul

## 📋 Daftar Isi

1. [README_FILE_UPLOAD_FIX.md](./README_FILE_UPLOAD_FIX.md) - **Panduan Utama** (Baca ini terlebih dahulu)
2. [TROUBLESHOOTING_FILE_UPLOAD.md](./TROUBLESHOOTING_FILE_UPLOAD.md) - Panduan Troubleshooting Lengkap
3. [EXAMPLE_IMPLEMENTATION.md](./EXAMPLE_IMPLEMENTATION.md) - Contoh Implementasi Helper Functions

---

## 🚀 Quick Start

### Masalah:
Foto yang diupload di **Agenda**, **Postingan (Berita)**, atau **Profil Ormada** tidak muncul.

### Solusi Cepat (3 Langkah):

```bash
# 1. Jalankan script perbaikan otomatis
bash scripts/fix-storage.sh

# 2. Update composer autoload
composer dump-autoload

# 3. Clear cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

**Lebih detail:** Baca [README_FILE_UPLOAD_FIX.md](./README_FILE_UPLOAD_FIX.md)

---

## 📁 Struktur Solusi

```
project/
├── scripts/
│   └── fix-storage.sh              # Script otomatis perbaikan storage
├── app/
│   └── Helpers/
│       ├── StorageHelper.php       # Class helper untuk storage operations
│       └── helpers.php             # Global helper functions (agenda_poster_url, postingan_foto_url, dll)
├── docs/
│   ├── INDEX.md                    # File ini - navigasi dokumentasi
│   ├── README_FILE_UPLOAD_FIX.md   # Panduan utama solusi
│   ├── TROUBLESHOOTING_FILE_UPLOAD.md  # Troubleshooting lengkap
│   └── EXAMPLE_IMPLEMENTATION.md   # Contoh penggunaan helper functions
└── composer.json                   # Updated dengan autoload untuk helpers
```

---

## 🔧 File yang Dibuat/Dimodifikasi

### 1. Script Perbaikan Otomatis
**File:** `scripts/fix-storage.sh`

Script bash yang otomatis:
- Membuat storage symlink
- Set permission folder
- Clear cache Laravel
- Verifikasi konfigurasi

**Cara pakai:**
```bash
bash scripts/fix-storage.sh
```

---

### 2. Helper Functions
**File:** `app/Helpers/StorageHelper.php` & `app/Helpers/helpers.php`

Helper functions untuk konsistensi URL generation:

```php
// Generic
storage_url($path)

// Specific
agenda_poster_url($gambar_poster)
postingan_foto_url($foto)
profil_logo_url($logo)

// Utility
file_exists_storage($path)
```

**Cara pakai di Blade:**
```blade
<img src="{{ agenda_poster_url($agenda->gambar_poster) }}" alt="Poster">
```

---

### 3. Dokumentasi
- **README_FILE_UPLOAD_FIX.md** - Panduan lengkap solusi
- **TROUBLESHOOTING_FILE_UPLOAD.md** - Troubleshooting berbagai masalah
- **EXAMPLE_IMPLEMENTATION.md** - 10+ contoh implementasi di views

---

## 🎯 Penyebab Masalah

Foto tidak muncul karena:

1. ❌ **Storage symlink belum dibuat** - `public/storage` tidak link ke `storage/app/public`
2. ❌ **Permission folder salah** - Web server tidak bisa akses file
3. ❌ **Konfigurasi .env salah** - APP_URL atau FILESYSTEM_DISK tidak benar
4. ❌ **Cache belum di-clear** - Laravel masih serve cached views

---

## ✅ Checklist Solusi

- [ ] Jalankan `bash scripts/fix-storage.sh`
- [ ] Jalankan `composer dump-autoload`
- [ ] Clear cache: `php artisan config:clear && php artisan cache:clear && php artisan view:clear`
- [ ] Pastikan `.env` memiliki:
  - `APP_URL=http://your-actual-domain.com`
  - `FILESYSTEM_DISK=public`
- [ ] Restart web server (Apache/Nginx)
- [ ] Clear browser cache (Ctrl+Shift+R)
- [ ] Test upload foto baru
- [ ] Verifikasi file ada di `storage/app/public/`
- [ ] Test akses URL: `http://domain.com/storage/[path]`

---

## 📚 Referensi Cepat

### Path Upload:
| Fitur | Folder | Database Field |
|-------|--------|----------------|
| Agenda | `agenda/poster/` | `gambar_poster` |
| Postingan | `postingan/foto/` | `foto` |
| Profil Ormada | `profil-ormada/logo/` | `logo` |

### Helper Functions:
```blade
{{-- Agenda --}}
<img src="{{ agenda_poster_url($agenda->gambar_poster) }}">

{{-- Postingan --}}
<img src="{{ postingan_foto_url($postingan->foto) }}">

{{-- Profil --}}
<img src="{{ profil_logo_url($profilOrmada->logo) }}">
```

---

## 🆘 Jika Masih Bermasalah

1. Cek [TROUBLESHOOTING_FILE_UPLOAD.md](./TROUBLESHOOTING_FILE_UPLOAD.md)
2. Cek Laravel logs: `tail -f storage/logs/laravel.log`
3. Cek browser console (F12) untuk error
4. Test URL langsung: `http://your-domain.com/storage/[path-to-file]`

---

## 📝 Catatan Penting

- ⚠️ **Jangan commit** `storage/app/public` ke Git
- ⚠️ **Jangan commit** `public/storage` symlink ke Git
- ✅ File upload ada di `storage/app/public/` (tidak di-commit)
- ✅ Setelah ubah helper, jalankan `composer dump-autoload`

---

## 🔄 Update Views (Opsional)

Untuk konsistensi, ganti semua:
```blade
{{-- Lama --}}
<img src="{{ asset('storage/' . $agenda->gambar_poster) }}">

{{-- Baru --}}
<img src="{{ agenda_poster_url($agenda->gambar_poster) }}">
```

Lihat contoh lengkap di [EXAMPLE_IMPLEMENTATION.md](./EXAMPLE_IMPLEMENTATION.md)

---

## 📞 Support

Jika masih ada masalah:
1. Baca dokumentasi lengkap di [TROUBLESHOOTING_FILE_UPLOAD.md](./TROUBLESHOOTING_FILE_UPLOAD.md)
2. Check logs di `storage/logs/laravel.log`
3. Verify symlink: `ls -la public/storage`

---

**Dibuat:** 2026-06-09  
**Laravel Version:** 12.0  
**Purpose:** Fix foto tidak muncul di Agenda, Berita/Postingan, & Profil Ormada