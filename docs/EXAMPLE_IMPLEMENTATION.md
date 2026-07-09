# Contoh Implementasi Helper Functions

## Overview

File ini menunjukkan contoh penggunaan helper functions yang telah dibuat untuk menampilkan foto di views.

## 1. Agenda (Poster)

### Sebelum (Lama):
```blade
{{-- resources/views/pengurus/agenda/show.blade.php --}}
@if($agenda->gambar_poster)
<img src="{{ asset('storage/' . $agenda->gambar_poster) }}" alt="{{ $agenda->nama_agenda }}" class="w-full h-96 object-cover rounded-lg mb-6">
@endif
```

### Sesudah (Baru):
```blade
{{-- resources/views/pengurus/agenda/show.blade.php --}}
@if($agenda->gambar_poster)
<img src="{{ agenda_poster_url($agenda->gambar_poster) }}" alt="{{ $agenda->nama_agenda }}" class="w-full h-96 object-cover rounded-lg mb-6">
@endif
```

### Contoh Lain - Index View:
```blade
{{-- resources/views/pengurus/agenda/index.blade.php --}}
@foreach($agendas as $agenda)
<div class="bg-white shadow rounded-lg overflow-hidden">
    @if($agenda->gambar_poster)
    <img src="{{ agenda_poster_url($agenda->gambar_poster) }}" alt="{{ $agenda->nama_agenda }}" class="w-full h-48 object-cover">
    @endif
    <div class="p-4">
        <h3 class="font-semibold text-lg">{{ $agenda->nama_agenda }}</h3>
        <p class="text-gray-600">{{ $agenda->kategori }}</p>
    </div>
</div>
@endforeach
```

---

## 2. Postingan/Berita (Foto)

### Sebelum (Lama):
```blade
{{-- resources/views/pengurus/postingan/show.blade.php --}}
@if($postingan->foto)
<img src="{{ asset('storage/' . $postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-96 object-cover rounded-lg mb-6">
@endif
```

### Sesudah (Baru):
```blade
{{-- resources/views/pengurus/postingan/show.blade.php --}}
@if($postingan->foto)
<img src="{{ postingan_foto_url($postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-96 object-cover rounded-lg mb-6">
@endif
```

### Contoh Lain - dengan Fallback:
```blade
{{-- resources/views/postingan/index.blade.php --}}
@foreach($postingans as $postingan)
<div class="bg-white shadow rounded-lg overflow-hidden">
    @if($postingan->foto)
        <img src="{{ postingan_foto_url($postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-48 object-cover">
    @else
        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
            <span class="text-gray-400">No Image</span>
        </div>
    @endif
    <div class="p-4">
        <h3 class="font-semibold text-lg">{{ $postingan->judul }}</h3>
        <p class="text-sm text-gray-500">{{ ucfirst($postingan->jenis_konten) }}</p>
    </div>
</div>
@endforeach
```

---

## 3. Profil Ormada (Logo)

### Sebelum (Lama):
```blade
{{-- resources/views/profil_ormada/show.blade.php --}}
@if($profilOrmada->logo)
<img src="{{ asset('storage/'.$profilOrmada->logo) }}" alt="Logo {{ $profilOrmada->nama_universitas }}" class="h-24 w-24 rounded-lg object-cover">
@endif
```

### Sesudah (Baru):
```blade
{{-- resources/views/profil_ormada/show.blade.php --}}
@if($profilOrmada->logo)
<img src="{{ profil_logo_url($profilOrmada->logo) }}" alt="Logo {{ $profilOrmada->nama_universitas }}" class="h-24 w-24 rounded-lg object-cover">
@endif
```

### Contoh Lain - dengan Default Logo:
```blade
{{-- resources/views/pengurus/profil_ormada/index.blade.php --}}
@foreach($profilOrmadas as $profil)
<div class="flex items-center gap-4">
    @if($profil->logo)
        <img src="{{ profil_logo_url($profil->logo) }}" alt="Logo {{ $profil->nama_universitas }}" class="h-14 w-14 rounded-md object-cover">
    @else
        <div class="h-14 w-14 rounded-md bg-gray-200 flex items-center justify-center">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
        </div>
    @endif
    <div>
        <h3 class="font-semibold">{{ $profil->nama_universitas }}</h3>
        <p class="text-sm text-gray-500">{{ $profil->alamat_universitas }}</p>
    </div>
</div>
@endforeach
```

---

## 4. Public Views

### Agenda Show (Public):
```blade
{{-- resources/views/public/agenda-show.blade.php --}}
<div class="bg-white shadow rounded-lg overflow-hidden">
    @if($agenda->gambar_poster)
    <img src="{{ agenda_poster_url($agenda->gambar_poster) }}" alt="{{ $agenda->nama_agenda }}" class="w-full h-96 object-cover rounded-lg mb-6">
    @endif
    
    <div class="p-6">
        <h1 class="text-3xl font-bold mb-4">{{ $agenda->nama_agenda }}</h1>
        <div class="prose max-w-none">
            {{ $agenda->deskripsi_agenda }}
        </div>
    </div>
</div>
```

### Postingan List (Public):
```blade
{{-- resources/views/public/postingan.blade.php --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($postingans as $postingan)
    <div class="bg-white shadow rounded-lg overflow-hidden">
        @if($postingan->foto)
        <img src="{{ postingan_foto_url($postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-48 object-cover">
        @endif
        <div class="p-4">
            <span class="text-sm text-blue-600 font-medium">{{ ucfirst($postingan->jenis_konten) }}</span>
            <h3 class="font-semibold text-lg mt-2">{{ $postingan->judul }}</h3>
            <p class="text-gray-600 text-sm mt-2 line-clamp-3">{{ $postingan->isi_konten }}</p>
        </div>
    </div>
    @endforeach
</div>
```

---

## 5. Edit Forms (Menampilkan File Saat Ini)

### Agenda Edit:
```blade
{{-- resources/views/pengurus/agenda/edit.blade.php --}}
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Poster Saat Ini</label>
    @if($agenda->gambar_poster)
        <div class="mt-2">
            <img src="{{ agenda_poster_url($agenda->gambar_poster) }}" alt="Poster" class="w-48 h-48 object-cover rounded-lg">
            <p class="mt-1 text-sm text-gray-600">
                <a href="{{ agenda_poster_url($agenda->gambar_poster) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                    Lihat Poster (new tab)
                </a>
            </p>
        </div>
    @else
        <p class="mt-2 text-sm text-gray-500">Belum ada poster</p>
    @endif
</div>

<div class="mb-4">
    <label for="gambar_poster" class="block text-sm font-medium text-gray-700">Ganti Poster</label>
    <input type="file" name="gambar_poster" id="gambar_poster" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG. Max: 2MB</p>
</div>
```

### Postingan Edit:
```blade
{{-- resources/views/pengurus/postingan/edit.blade.php --}}
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Foto Saat Ini</label>
    @if($postingan->foto)
        <div class="mt-2">
            <img src="{{ postingan_foto_url($postingan->foto) }}" alt="Foto" class="w-48 h-48 object-cover rounded-lg">
            <p class="mt-1 text-sm text-gray-600">
                <a href="{{ postingan_foto_url($postingan->foto) }}" target="_blank" class="text-orange-600 hover:text-orange-800">
                    Lihat Foto (new tab)
                </a>
            </p>
        </div>
    @else
        <p class="mt-2 text-sm text-gray-500">Belum ada foto</p>
    @endif
</div>

<div class="mb-4">
    <label for="foto" class="block text-sm font-medium text-gray-700">Ganti Foto</label>
    <input type="file" name="foto" id="foto" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG. Max: 2MB</p>
</div>
```

---

## 6. Multiple Images (Contoh Kompleks)

### Agenda dengan Multiple Info:
```blade
{{-- resources/views/admin/agenda/show.blade.php --}}
<div class="bg-white shadow rounded-lg">
    @if($agenda->gambar_poster)
    <img src="{{ agenda_poster_url($agenda->gambar_poster) }}" alt="{{ $agenda->nama_agenda }}" class="w-full h-96 object-cover rounded-t-lg">
    @endif
    
    <div class="p-6">
        <div class="flex items-center gap-2 mb-4">
            <span class="px-3 py-1 text-sm font-medium bg-purple-100 text-purple-800 rounded-full">
                {{ ucfirst(str_replace('_', ' ', $agenda->kategori)) }}
            </span>
            @if($agenda->is_published)
                <span class="px-3 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full">
                    Published
                </span>
            @else
                <span class="px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-800 rounded-full">
                    Draft
                </span>
            @endif
        </div>
        
        <h1 class="text-3xl font-bold mb-4">{{ $agenda->nama_agenda }}</h1>
        <p class="text-gray-700 whitespace-pre-line">{{ $agenda->deskripsi_agenda }}</p>
    </div>
</div>
```

---

## 7. Conditional Display dengan Helper

### Cek File Exists:
```blade
{{-- Menggunakan helper function untuk cek existence --}}
@if(file_exists_storage($agenda->gambar_poster))
    <img src="{{ agenda_poster_url($agenda->gambar_poster) }}" alt="Poster">
@else
    <div class="bg-gray-100 p-8 text-center">
        <p class="text-gray-500">Poster tidak ditemukan</p>
    </div>
@endif
```

### Multiple Conditions:
```blade
<div class="relative">
    @if($postingan->foto && file_exists_storage($postingan->foto))
        <img src="{{ postingan_foto_url($postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-64 object-cover">
    @else
        <div class="w-full h-64 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
            <div class="text-center text-white">
                <svg class="w-16 h-16 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p>No Image Available</p>
            </div>
        </div>
    @endif
</div>
```

---

## 8. Download Links

### File Proposal dengan Helper:
```blade
{{-- resources/views/admin/proposal/show.blade.php --}}
@if($proposal->file_proposal)
<div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
    <h3 class="text-lg font-medium text-blue-900 mb-2">File Proposal</h3>
    <a href="{{ storage_url($proposal->file_proposal) }}" target="_blank" 
       class="inline-flex items-center text-blue-600 hover:text-blue-800">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        Download Proposal
    </a>
</div>
@endif
```

---

## 9. Card Grid dengan Images

### Postingan Grid:
```blade
{{-- resources/views/admin/postingan/index.blade.php --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($postingans as $postingan)
    <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
        @if($postingan->foto)
        <div class="relative h-48 bg-gray-200">
            <img src="{{ postingan_foto_url($postingan->foto) }}" 
                 alt="{{ $postingan->judul }}" 
                 class="w-full h-full object-cover">
        </div>
        @endif
        
        <div class="p-4">
            <div class="flex items-center gap-2 mb-2">
                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                    {{ ucfirst($postingan->jenis_konten) }}
                </span>
                @if($postingan->is_published)
                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                        Published
                    </span>
                @endif
            </div>
            
            <h3 class="font-semibold text-lg mb-2 line-clamp-2">{{ $postingan->judul }}</h3>
            <p class="text-sm text-gray-500 line-clamp-3">{{ $postingan->isi_konten }}</p>
            
            <div class="mt-4 flex justify-between items-center">
                <span class="text-xs text-gray-400">
                    {{ $postingan->dibuat_pada->format('d M Y') }}
                </span>
                <a href="{{ route('postingan.show', $postingan) }}" 
                   class="text-sm text-blue-600 hover:text-blue-800">
                    Lihat Detail →
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
```

---

## 10. Migration Guide (Replace All)

### Script untuk Replace Semua Views:

Jika ingin mengganti semua `asset('storage/...)` dengan helper functions secara otomatis:

```bash
# Backup terlebih dahulu
git add -A
git commit -m "Backup before replacing asset() with helpers"

# Replace untuk agenda
find resources/views -name "*.blade.php" -exec sed -i 's/asset('\''storage\/'\'' \. $agenda->gambar_poster)/agenda_poster_url($agenda->gambar_poster)/g' {} +

# Replace untuk postingan
find resources/views -name "*.blade.php" -exec sed -i 's/asset('\''storage\/'\'' \. $postingan->foto)/postingan_foto_url($postingan->foto)/g' {} +

# Replace untuk profil
find resources/views -name "*.blade.php" -exec sed -i "s/asset('\''storage\/'\''\.\$profil->logo)/profil_logo_url($profil->logo)/g" {} +
find resources/views -name "*.blade.php" -exec sed -i "s/asset('\''storage\/'\''\.\$profilOrmada->logo)/profil_logo_url($profilOrmada->logo)/g" {} +
```

**Catatan:** Script di atas adalah contoh. Selalu test di environment development terlebih dahulu sebelum apply ke production.

---

## Testing Setelah Implementasi

1. **Clear cache:**
   ```bash
   php artisan view:clear
   php artisan cache:clear
   ```

2. **Test di browser:**
   - Upload foto baru
   - Cek apakah foto muncul
   - Cek browser console (F12) untuk error
   - Cek network tab untuk 404/403 errors

3. **Verify URLs:**
   ```bash
   # Cek generated URL
   {{ agenda_poster_url('agenda/poster/test.jpg') }}
   # Harus menghasilkan: http://your-domain.com/storage/agenda/poster/test.jpg
   ```

---

## Catatan Penting

1. **Jangan lupa** jalankan `composer dump-autoload` setelah menambahkan helper functions
2. **Test thoroughly** sebelum deploy ke production
3. **Backup views** sebelum melakukan mass replace
4. **Consistency** - Gunakan helper functions di semua views untuk konsistensi