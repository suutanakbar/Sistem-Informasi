# Troubleshooting: File Upload & Image Display Issues

## Masalah Umum

Foto yang diupload di **Agenda**, **Postingan (Berita)**, atau **Profil Ormada** tidak muncul/tampil.

## Penyebab & Solusi

### 1. Storage Symlink Belum Dibuat (Penyebab Paling Umum)

**Gejala:** Foto tidak muncul, URL mengarah ke `/storage/...` tapi返回 404

**Solusi:**
```bash
# Jalankan script otomatis
bash scripts/fix-storage.sh

# Atau manual dengan artisan
php artisan storage:link
```

**Verifikasi:**
```bash
# Cek apakah symlink ada
ls -la public/storage

# Harus menampilkan:
# storage -> ../storage/app/public
```

---

### 2. Permission Folder Storage

**Gejala:** Upload berhasil tapi file tidak bisa diakses

**Solusi:**
```bash
# Set permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod -R 775 public

# Jika masih bermasalah, coba:
chown -R www-data:www-data storage bootstrap/cache public
```

---

### 3. Konfigurasi .env Belum Benar

**Gejala:** File tersimpan tapi URL salah

**Cek file .env:**
```env
APP_URL=http://your-actual-domain.com  # Harus sesuai dengan domain Anda
FILESYSTEM_DISK=public  # Harus di-set ke 'public'
```

**Setelah mengubah .env:**
```bash
php artisan config:clear
```

---

### 4. File Tidak Tersimpan di Storage

**Verifikasi:**
```bash
# Cek apakah file ada di storage
ls -la storage/app/public/agenda/poster/
ls -la storage/app/public/postingan/foto/
ls -la storage/app/public/profil-ormada/logo/
```

Jika folder kosong, berarti upload gagal. Cek:
- Validasi file di controller (max size, mime types)
- Log error di `storage/logs/laravel.log`

---

## Path Upload di Aplikasi

### Agenda
- **Upload:** `agenda/poster/` 
- **Database field:** `gambar_poster`
- **View path:** `asset('storage/' . $agenda->gambar_poster)`

### Postingan (Berita)
- **Upload:** `postingan/foto/`
- **Database field:** `foto`
- **View path:** `asset('storage/' . $postingan->foto)`

### Profil Ormada
- **Upload:** `profil-ormada/logo/`
- **Database field:** `logo`
- **View path:** `asset('storage/' . $profil->logo)`

---

## Testing

### Test Upload Manual:

1. **Upload foto baru** melalui form di aplikasi
2. **Cek database** - field harus terisi dengan path (misal: `agenda/poster/abc123.jpg`)
3. **Cek file system:**
   ```bash
   ls -la storage/app/public/agenda/poster/
   ```
4. **Akses URL langsung:**
   ```
   http://your-domain.com/storage/agenda/poster/abc123.jpg
   ```
5. **Cek view** - Foto harus muncul di halaman detail

### Common Issues:

| Masalah | Penyebab | Solusi |
|---------|----------|--------|
| 404 error | Symlink belum dibuat | `php artisan storage:link` |
| 403 error | Permission salah | `chmod -R 775 storage` |
| Foto broken | File tidak ada | Cek storage/app/public/[path] |
| URL salah | APP_URL salah | Update .env |

---

## Quick Fix Checklist

- [ ] Jalankan `bash scripts/fix-storage.sh`
- [ ] Pastikan `.env` memiliki `APP_URL` yang benar
- [ ] Pastikan `.env` memiliki `FILESYSTEM_DISK=public`
- [ ] Clear cache: `php artisan config:clear && php artisan cache:clear`
- [ ] Restart web server (Apache/Nginx)
- [ ] Clear browser cache (Ctrl+Shift+R)
- [ ] Test upload foto baru
- [ ] Verifikasi file ada di `storage/app/public/`
- [ ] Test akses URL: `http://domain.com/storage/[path]`

---

## Jika Masih Bermasalah

1. **Check Laravel logs:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. **Check web server logs:**
   - Apache: `/var/log/apache2/error.log`
   - Nginx: `/var/log/nginx/error.log`

3. **Debug di browser:**
   - F12 → Network tab
   - Cek status code untuk request gambar
   - Cek console untuk error JavaScript

4. **Verify symlink:**
   ```bash
   # Linux/Mac
   ls -la public/storage
   
   # Windows (Git Bash)
   ls -la public/storage
   ```

---

## Catatan Penting

- **Jangan** commit folder `storage/app/public` ke Git
- **Jangan** commit symlink `public/storage` ke Git (akan berbeda di setiap OS)
- File upload disimpan di `storage/app/public/` yang TIDAK di-commit
- Tambahkan `storage/` ke `.gitignore` jika belum ada