# Planning Implementasi Module Aspirasi

## Overview

Module Aspirasi memungkinkan ormada mengirim aspirasi kepada Pemda, dan Pemda dapat menanggapi aspirasi tersebut. **Aspirasi akan ditampilkan di dashboard publik untuk transparansi**, baik yang sudah ditanggapi maupun belum - sebagai bentuk ruang menyuarakan aspirasi mahasiswa kepada masyarakat umum.

---

## Database Design

### Migration: `database/migrations/2026_07_06_000002_create_aspirasi_table.php`

**Tabel: `aspirasi`**

```php
Schema::create('aspirasi', function (Blueprint $table) {
    $table->id();
    $table->foreignId('profil_ormada_id')->constrained('profil_ormada')->cascadeOnDelete();
    $table->string('topik_aspirasi');
    $table->text('detail_aspirasi');
    $table->string('file')->nullable(); // File pendukung aspirasi
    $table->text('tanggapan_pemda')->nullable(); // Tanggapan dari Pemda
    $table->timestamp('tanggal_tanggapan')->nullable(); // Kapan ditanggapi
    $table->enum('status', ['belum_ditanggapi', 'sedang_diproses', 'selesai', 'ditolak'])->default('belum_ditanggapi');
    $table->timestamp('dibuat_pada')->useCurrent();
    $table->timestamp('diperbarui_pada')->useCurrent()->useCurrentOnUpdate();

    $table->index('profil_ormada_id');
    $table->index('status');
    $table->index('tanggal_tanggapan');
});
```

**Indexes Explanation:**
- `profil_ormada_id` - Untuk filter aspirasi by ormada
- `status` - Untuk filter aspirasi yang sudah/dibelum ditanggapi
- `tanggal_tanggapan` - Untuk sorting aspirasi publik

---

## Model: `app/Models/Aspirasi.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aspirasi extends Model
{
    public const CREATED_AT = 'dibuat_pada';
    public const UPDATED_AT = 'diperbarui_pada';

    protected $table = 'aspirasi';

    protected $fillable = [
        'profil_ormada_id',
        'topik_aspirasi',
        'detail_aspirasi',
        'file',
        'tanggapan_pemda',
        'tanggal_tanggapan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_tanggapan' => 'datetime',
        ];
    }

    // Relasi ke Profil Ormada
    public function profilOrmada(): BelongsTo
    {
        return $this->belongsTo(ProfilOrmada::class);
    }

    // Relasi ke Admin (pengaju) melalui profil ormada
    public function pengaju(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id')->through('profilOrmada');
    }

    // Scope untuk aspirasi publik (SEMUA aspirasi untuk transparansi)
    public function scopePublik(Builder $query): Builder
    {
        return $query->with('profilOrmada')
            ->orderByDesc('dibuat_pada');
    }

    // Scope untuk filter by status
    public function scopeByStatus(Builder $query, ?string $status): Builder
    {
        return $query->when($status, fn (Builder $query, string $status) => $query->where('status', $status));
    }
}
```

---

## Controller: `app/Http/Controllers/AspirasiController.php`

### Methods:

#### 1. `index(Request $request): View`
**Purpose**: List aspirasi dengan filter

**Logic**:
```php
public function index(Request $request): View
{
    $user = $request->user();
    $query = Aspirasi::query()->with(['profilOrmada', 'profilOrmada.admin']);

    // Filter berdasarkan role
    if ($user->isPengurusOrmada()) {
        // Pengurus hanya melihat aspirasi dari profilnya
        $profil = $user->profilOrmada()->first();
        if (!$profil) {
            abort(403, 'Anda belum memiliki profil ormada');
        }
        $query->where('profil_ormada_id', $profil->id);
    } elseif ($user->isPemda()) {
        // Pemda melihat semua aspirasi
        // Bisa filter by status
        $status = $request->query('status');
        if ($status) {
            $query->where('status', $status);
        }
    }
    // Admin melihat semua

    $aspirasis = $query->latest('dibuat_pada')->paginate(12);

    return view('aspirasi.index', compact('aspirasis'));
}
```

#### 2. `create(Request $request): View`
**Purpose**: Form buat aspirasi baru

**Authorization**: Hanya pengurus ormada dan admin

```php
public function create(Request $request): View
{
    $user = $request->user();
    abort_unless($user->isPengurusOrmada() || $user->isAdmin(), 403);

    // Jika pengurus, ambil profil ormada-nya
    if ($user->isPengurusOrmada()) {
        $profil = $user->profilOrmada()->first();
        if (!$profil) {
            abort(403, 'Anda belum memiliki profil ormada');
        }
    }

    return view('aspirasi.create');
}
```

#### 3. `store(Request $request): RedirectResponse`
**Purpose**: Simpan aspirasi baru

```php
public function store(Request $request): RedirectResponse
{
    $user = $request->user();
    abort_unless($user->isPengurusOrmada() || $user->isAdmin(), 403);

    $validated = $this->validateAspirasi($request);
    
    // Set profil ormada
    if ($user->isPengurusOrmada()) {
        $profil = $user->profilOrmada()->first();
        $validated['profil_ormada_id'] = $profil->id;
    } else {
        // Admin bisa pilih profil ormada (opsional)
        $validated['profil_ormada_id'] = $request->input('profil_ormada_id');
    }

    // Handle file upload
    if ($request->hasFile('file')) {
        $validated['file'] = $request->file('file')->store('aspirasi', 'public');
    }

    $aspirasi = Aspirasi::create($validated);

    return redirect()
        ->route('aspirasi.show', $aspirasi)
        ->with('status', 'Aspirasi berhasil diajukan.');
}
```

#### 4. `show(Request $request, Aspirasi $aspirasi): View`
**Purpose**: Detail aspirasi

```php
public function show(Request $request, Aspirasi $aspirasi): View
{
    $user = $request->user();
    
    // Authorization
    $this->authorizeAspirasiAccess($user, $aspirasi);

    $aspirasi->load('profilOrmada', 'profilOrmada.admin');

    return view('aspirasi.show', compact('aspirasi'));
}
```

#### 5. `edit(Request $request, Aspirasi $aspirasi): View`
**Purpose**: Form edit aspirasi

```php
public function edit(Request $request, Aspirasi $aspirasi): View
{
    $user = $request->user();
    
    // Hanya pemilik atau admin yang bisa edit
    abort_unless(
        $user->isAdmin() || 
        ($user->isPengurusOrmada() && $aspirasi->profil_ormada_id === $user->profilOrmada()->first()?->id),
        403
    );

    return view('aspirasi.edit', compact('aspirasi'));
}
```

#### 6. `update(Request $request, Aspirasi $aspirasi): RedirectResponse`
**Purpose**: Update aspirasi

```php
public function update(Request $request, Aspirasi $aspirasi): RedirectResponse
{
    $user = $request->user();
    
    // Hanya pemilik atau admin yang bisa edit
    abort_unless(
        $user->isAdmin() || 
        ($user->isPengurusOrmada() && $aspirasi->profil_ormada_id === $user->profilOrmada()->first()?->id),
        403
    );

    $validated = $this->validateAspirasi($request, $aspirasi);

    // Handle file upload
    if ($request->hasFile('file')) {
        if ($aspirasi->file) {
            Storage::disk('public')->delete($aspirasi->file);
        }
        $validated['file'] = $request->file('file')->store('aspirasi', 'public');
    }

    $aspirasi->update($validated);

    return redirect()
        ->route('aspirasi.show', $aspirasi)
        ->with('status', 'Aspirasi berhasil diperbarui.');
}
```

#### 7. `destroy(Request $request, Aspirasi $aspirasi): RedirectResponse`
**Purpose**: Hapus aspirasi

```php
public function destroy(Request $request, Aspirasi $aspirasi): RedirectResponse
{
    $user = $request->user();
    
    // Hanya pemilik atau admin yang bisa hapus
    abort_unless(
        $user->isAdmin() || 
        ($user->isPengurusOrmada() && $aspirasi->profil_ormada_id === $user->profilOrmada()->first()?->id),
        403
    );

    // Delete file if exists
    if ($aspirasi->file) {
        Storage::disk('public')->delete($aspirasi->file);
    }

    $aspirasi->delete();

    return redirect()
        ->route('aspirasi.index')
        ->with('status', 'Aspirasi berhasil dihapus.');
}
```

#### 8. `updateTanggapan(Request $request, Aspirasi $aspirasi): RedirectResponse`
**Purpose**: Update tanggapan Pemda (HANYA PEMDA/ADMIN)

```php
public function updateTanggapan(Request $request, Aspirasi $aspirasi): RedirectResponse
{
    $user = $request->user();
    
    // Hanya Pemda atau Admin yang bisa menanggapi
    abort_unless($user->isPemda() || $user->isAdmin(), 403);

    $validated = $request->validate([
        'tanggapan_pemda' => ['required', 'string'],
        'status' => ['required', 'in:belum_ditanggapi,sedang_diproses,selesai,ditolak'],
    ]);

    $validated['tanggal_tanggapan'] = now();

    $aspirasi->update($validated);

    return back()->with('status', 'Tanggapan berhasil disimpan.');
}
```

#### 9. `validateAspirasi(Request $request, ?Aspirasi $aspirasi = null): array`
**Purpose**: Validasi input

```php
private function validateAspirasi(Request $request, ?Aspirasi $aspirasi = null): array
{
    $rules = [
        'topik_aspirasi' => ['required', 'string', 'max:255'],
        'detail_aspirasi' => ['required', 'string'],
        'file' => [$aspirasi ? 'nullable' : 'nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:5120'],
    ];

    return $request->validate($rules);
}
```

#### 10. `authorizeAspirasiAccess(Admin $user, Aspirasi $aspirasi): void`
**Purpose**: Authorization helper

```php
private function authorizeAspirasiAccess(Admin $user, Aspirasi $aspirasi): void
{
    $profilId = $aspirasi->profil_ormada_id;
    $userProfilId = $user->profilOrmada()->first()?->id;

    abort_unless(
        $user->isAdmin() ||
        $user->isPemda() ||
        ($user->isPengurusOrmada() && $profilId === $userProfilId),
        403
    );
}
```

---

## Policy: `app/Policies/AspirasiPolicy.php`

```php
<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Aspirasi;

class AspirasiPolicy
{
    public function create(Admin $user): bool
    {
        return $user->isPengurusOrmada() || $user->isAdmin();
    }

    public function update(Admin $user, Aspirasi $aspirasi): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Pengurus ormada bisa edit aspirasi milik profilnya
        if ($user->isPengurusOrmada()) {
            $profilId = $user->profilOrmada()->first()?->id;
            return $aspirasi->profil_ormada_id === $profilId;
        }

        return false;
    }

    public function delete(Admin $user, Aspirasi $aspirasi): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Pengurus ormada bisa hapus aspirasi milik profilnya
        if ($user->isPengurusOrmada()) {
            $profilId = $user->profilOrmada()->first()?->id;
            return $aspirasi->profil_ormada_id === $profilId;
        }

        return false;
    }

    public function respond(Admin $user, Aspirasi $aspirasi): bool
    {
        // Hanya Pemda atau Admin yang bisa menanggapi
        return $user->isPemda() || $user->isAdmin();
    }
}
```

---

## Views

### 1. `resources/views/aspirasi/index.blade.php`

**Features**:
- Daftar aspirasi dengan filter by status
- Badge warna untuk status aspirasi
- Tombol "Buat Aspirasi" untuk pengurus
- Link ke detail aspirasi

**Layout**: `<x-layouts.app title="Daftar Aspirasi">`

### 2. `resources/views/aspirasi/create.blade.php`

**Form Fields**:
- Topik Aspirasi (text, required)
- Detail Aspirasi (textarea, required)
- File Pendukung (file upload, optional)
- Submit button

**Layout**: `<x-layouts.app title="Buat Aspirasi">`

### 3. `resources/views/aspirasi/show.blade.php`

**Content**:
- Informasi aspirasi (topik, detail, file)
- Informasi pengaju (nama ormada, universitas)
- Status aspirasi dengan badge
- Form tanggapan (hanya muncul untuk Pemda/Admin)
- Tanggapan Pemda (jika ada)
- Tombol Edit/Delete (hanya untuk pemilik)

**Layout**: `<x-layouts.app title="Detail Aspirasi">`

### 4. `resources/views/aspirasi/edit.blade.php`

**Form Fields**:
- Topik Aspirasi (text, required)
- Detail Aspirasi (textarea, required)
- File Pendukung (file upload, optional)
- Submit button

**Layout**: `<x-layouts.app title="Edit Aspirasi">`

---

## Routes

```php
// routes/web.php

use App\Http\Controllers\AspirasiController;

Route::middleware('auth')->group(function () {
    Route::resource('aspirasi', AspirasiController::class);
    Route::patch('/aspirasi/{aspirasi}/tanggapan', [AspirasiController::class, 'updateTanggapan'])
        ->name('aspirasi.update-tanggapan');
});
```

**Generated Routes**:
- `GET /aspirasi` - index
- `GET /aspirasi/create` - create
- `POST /aspirasi` - store
- `GET /aspirasi/{aspirasi}` - show
- `GET /aspirasi/{aspirasi}/edit` - edit
- `PUT /aspirasi/{aspirasi}` - update
- `DELETE /aspirasi/{aspirasi}` - destroy
- `PATCH /aspirasi/{aspirasi}/tanggapan` - updateTanggapan

---

## Public Dashboard Integration

### Tujuan Utama:
**Aspirasi ditampilkan di dashboard publik untuk transparansi dan ruang menyuarakan aspirasi mahasiswa kepada masyarakat umum.**

### Update `PublicDashboardController`

**File**: `app/Http/Controllers/PublicDashboardController.php`

**Add method**:
```php
public function aspirasi(): View
{
    // Ambil SEMUA aspirasi untuk transparansi publik
    // Baik yang sudah ditanggapi maupun belum
    $aspirasis = Aspirasi::query()
        ->with(['profilOrmada' => fn ($query) => $query->select('id', 'nama_universitas', 'logo')])
        ->latest('dibuat_pada') // Tampilkan yang terbaru
        ->limit(10)
        ->get();

    return view('public.aspirasi', compact('aspirasis'));
}
```

**Add route**:
```php
Route::get('/publik/aspirasi', [PublicDashboardController::class, 'aspirasi'])->name('public.aspirasi');
```

### Update Public Dashboard View

**File**: `resources/views/public/dashboard.blade.php`

**Add section**:
```blade
<section class="mt-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">Aspirasi Ormada</h2>
    <p class="text-sm text-gray-600 mb-4">Ruang aspirasi mahasiswa daerah untuk menyampaikan suara mereka kepada Pemda Temanggung.</p>
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach($aspirasis as $aspirasi)
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start gap-3">
                @if($aspirasi->profilOrmada->logo)
                <img src="{{ asset('storage/' . $aspirasi->profilOrmada->logo) }}" 
                     alt="{{ $aspirasi->profilOrmada->nama_universitas }}" 
                     class="w-12 h-12 rounded-full object-cover flex-shrink-0">
                @endif
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <h3 class="font-semibold text-gray-900 truncate">{{ $aspirasi->topik_aspirasi }}</h3>
                        @if(!$aspirasi->tanggapan_pemda)
                        <span class="px-2 py-0.5 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full flex-shrink-0">
                            Menunggu
                        </span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600 mt-1">
                        {{ $aspirasi->profilOrmada->nama_universitas }}
                    </p>
                    <p class="text-sm text-gray-500 mt-2 line-clamp-3">
                        {{ Str::limit($aspirasi->detail_aspirasi, 120) }}
                    </p>
                    @if($aspirasi->tanggapan_pemda)
                    <div class="mt-3 bg-blue-50 border-l-4 border-blue-400 p-3">
                        <p class="text-xs font-semibold text-blue-800 mb-1">Tanggapan Pemda:</p>
                        <p class="text-sm text-gray-700">
                            {{ Str::limit($aspirasi->tanggapan_pemda, 150) }}
                        </p>
                    </div>
                    @endif
                    <div class="mt-3 text-xs text-gray-400">
                        {{ $aspirasi->dibuat_pada->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-6 text-center">
        <a href="{{ route('public.aspirasi') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
            Lihat Semua Aspirasi dan Tanggapan →
        </a>
    </div>
</section>
```

### Create Public Aspirasi Page

**File**: `resources/views/public/aspirasi.blade.php`

**Content**:
- Daftar SEMUA aspirasi (yang sudah dan belum ditanggapi)
- Filter by ormada (opsional)
- Pagination
- Detail aspirasi dengan tanggapan (jika ada)
- Badge status untuk aspirasi yang belum ditanggapi

**Layout**: `<x-layouts.app title="Aspirasi Ormada">`

**Features**:
```blade
@foreach($aspirasis as $aspirasi)
<div class="bg-white rounded-lg shadow p-6">
    <!-- Header dengan logo ormada dan badge status -->
    <div class="flex items-start gap-3">
        <img src="{{ asset('storage/' . $aspirasi->profilOrmada->logo) }}" 
             alt="{{ $aspirasi->profilOrmada->nama_universitas }}" 
             class="w-12 h-12 rounded-full object-cover">
        <div class="flex-1">
            <div class="flex items-center gap-2">
                <h3>{{ $aspirasi->topik_aspirasi }}</h3>
                @if(!$aspirasi->tanggapan_pemda)
                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">
                    Menunggu Tanggapan
                </span>
                @else
                <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">
                    Sudah Ditanggapi
                </span>
                @endif
            </div>
            <p class="text-sm text-gray-600">{{ $aspirasi->profilOrmada->nama_universitas }}</p>
            <p class="text-sm text-gray-500 mt-2">{{ $aspirasi->detail_aspirasi }}</p>
            
            @if($aspirasi->tanggapan_pemda)
            <div class="mt-4 bg-blue-50 border-l-4 border-blue-400 p-4">
                <p class="text-sm font-semibold text-blue-800">Tanggapan Pemda:</p>
                <p class="text-sm text-gray-700 mt-1">{{ $aspirasi->tanggapan_pemda }}</p>
                <p class="text-xs text-gray-500 mt-2">
                    {{ $aspirasi->tanggal_tanggapan->format('d F Y H:i') }}
                </p>
            </div>
            @endif
            
            <div class="mt-3 text-xs text-gray-400">
                Diajukan: {{ $aspirasi->dibuat_pada->format('d F Y') }}
            </div>
        </div>
    </div>
</div>
@endforeach
```

---

## Navigation Updates

### 1. Dashboard Internal (`resources/views/dashboard.blade.php`)

**Add button**:
```blade
<x-button-link href="{{ route('aspirasi.index') }}" variant="secondary">Aspirasi</x-button-link>
```

### 2. Navigation Bar (`resources/views/components/layouts/app.blade.php`)

**Add menu**:
```blade
<a href="{{ route('aspirasi.index') }}" class="rounded-md px-3 py-2 hover:bg-zinc-100">Aspirasi</a>
```

---

## Testing

### File: `tests/Feature/AspirasiTest.php`

**Test Cases**:

1. **Pengurus bisa membuat aspirasi**
```php
public function test_pengurus_bisa_membuat_aspirasi(): void
{
    $this->actingAs($this->pengurus);
    
    $response = $this->post(route('aspirasi.store'), [
        'topik_aspirasi' => 'Aspirasi Test',
        'detail_aspirasi' => 'Detail aspirasi test',
    ]);
    
    $response->assertRedirect();
    $this->assertDatabaseHas('aspirasi', ['topik_aspirasi' => 'Aspirasi Test']);
}
```

2. **Pengurus bisa melihat aspirasi miliknya**
```php
public function test_pengurus_bisa_melihat_aspirasi_miliknya(): void
{
    $aspirasi = Aspirasi::create([
        'profil_ormada_id' => $this->profilOrmada->id,
        'topik_aspirasi' => 'Aspirasi Test',
        'detail_aspirasi' => 'Detail',
    ]);
    
    $this->actingAs($this->pengurus);
    
    $response = $this->get(route('aspirasi.show', $aspirasi));
    $response->assertStatus(200);
}
```

3. **Pengurus tidak bisa melihat aspirasi ormada lain**
```php
public function test_pengurus_tidak_bisa_melihat_aspirasi_ormada_lain(): void
{
    $pengurusLain = Admin::create([...]);
    $profilLain = ProfilOrmada::create([...]);
    $aspirasi = Aspirasi::create(['profil_ormada_id' => $profilLain->id, ...]);
    
    $this->actingAs($this->pengurus);
    
    $response = $this->get(route('aspirasi.show', $aspirasi));
    $response->assertStatus(403);
}
```

4. **Pemda bisa menanggapi aspirasi**
```php
public function test_pemda_bisa_menanggapi_aspirasi(): void
{
    $aspirasi = Aspirasi::create([...]);
    
    $this->actingAs($this->pemda);
    
    $response = $this->patch(route('aspirasi.update-tanggapan', $aspirasi), [
        'tanggapan_pemda' => 'Tanggapan dari Pemda',
        'status' => 'selesai',
    ]);
    
    $response->assertRedirect();
    $this->assertDatabaseHas('aspirasi', [
        'id' => $aspirasi->id,
        'tanggapan_pemda' => 'Tanggapan dari Pemda',
        'status' => 'selesai',
    ]);
}
```

5. **Public bisa melihat aspirasi (transparansi)**
```php
public function test_public_bisa_melihat_aspirasi_publik(): void
{
    // Test aspirasi yang belum ditanggapi
    $aspirasi1 = Aspirasi::create([
        'profil_ormada_id' => $this->profilOrmada->id,
        'topik_aspirasi' => 'Aspirasi Belum Ditanggapi',
        'detail_aspirasi' => 'Detail',
    ]);
    
    // Test aspirasi yang sudah ditanggapi
    $aspirasi2 = Aspirasi::create([
        'profil_ormada_id' => $this->profilOrmada->id,
        'topik_aspirasi' => 'Aspirasi Sudah Ditanggapi',
        'detail_aspirasi' => 'Detail',
        'tanggapan_pemda' => 'Tanggapan',
        'status' => 'selesai',
    ]);
    
    $response = $this->get(route('public.aspirasi'));
    $response->assertStatus(200);
    $response->assertSee('Aspirasi Belum Ditanggapi');
    $response->assertSee('Aspirasi Sudah Ditanggapi');
}
```

---

## Authorization Rules

### Pengurus Ormada:
- ✅ Create aspirasi untuk profilnya
- ✅ Read aspirasi milik profilnya
- ✅ Update aspirasi milik profilnya
- ✅ Delete aspirasi milik profilnya
- ❌ Tidak bisa melihat aspirasi ormada lain
- ❌ Tidak bisa menanggapi aspirasi

### Pemda:
- ✅ Read semua aspirasi
- ✅ Update tanggapan aspirasi
- ❌ Tidak bisa create aspirasi
- ❌ Tidak bisa delete aspirasi
- ❌ Tidak bisa edit detail aspirasi

### Admin:
- ✅ Full access ke semua aspirasi
- ✅ Bisa create, read, update, delete
- ✅ Bisa menanggapi aspirasi

### Public (Guest):
- ✅ Baca SEMUA aspirasi (transparansi publik)
- ✅ Melihat aspirasi yang belum ditanggapi (dengan badge "Menunggu")
- ✅ Melihat aspirasi yang sudah ditanggapi (dengan tanggapan Pemda)
- ❌ Tidak bisa create/update/delete
- ❌ Tidak bisa melihat data sensitif (NIM, no HP, dll)

---

## File Upload

**Storage**: `storage/app/public/aspirasi/`

**Allowed Types**:
- PDF
- DOC, DOCX
- JPG, JPEG, PNG

**Max Size**: 5MB

**Path disimpan di database**: Relative path dari storage/public (contoh: `aspirasi/abc123.pdf`)

---

## Status Flow

```
belum_ditanggapi → sedang_diproses → selesai
                              ↘ ditolak
```

**Status Definitions**:
- `belum_ditanggapi` - Aspirasi baru, belum dibaca Pemda
- `sedang_diproses` - Pemda sedang menangani aspirasi
- `selesai` - Aspirasi sudah selesai ditangani
- `ditolak` - Aspirasi ditolak oleh Pemda

---

## Estimasi Waktu

| Task | Estimasi |
|------|----------|
| Migration & Model | 15 menit |
| Controller | 45 menit |
| Views (4 files) | 1 jam |
| Routes & Policy | 15 menit |
| Public Dashboard Integration | 30 menit |
| Testing | 45 menit |
| Bug Fixes | 30 menit |
| **Total** | **3.5 - 4 jam** |

---

## Dependencies

### Existing Modules:
- ✅ Admin (authentication)
- ✅ Profil Ormada (relasi)
- ✅ Auth & Authorization (policy pattern)

### Future Modules:
- ⏳ Postingan (akan menambahkan konten publik)
- ⏳ Agenda (akan menambahkan kalender)

---

## Checklist Implementasi

### Phase 1: Core Functionality
- [ ] Create migration `create_aspirasi_table`
- [ ] Create model `Aspirasi.php`
- [ ] Create controller `AspirasiController.php`
- [ ] Create policy `AspirasiPolicy.php`
- [ ] Register policy di `AuthServiceProvider`
- [ ] Add routes

### Phase 2: Views
- [ ] Create `aspirasi/index.blade.php`
- [ ] Create `aspirasi/create.blade.php`
- [ ] Create `aspirasi/show.blade.php`
- [ ] Create `aspirasi/edit.blade.php`

### Phase 3: Navigation
- [ ] Add menu di navigation bar
- [ ] Add quick access di dashboard

### Phase 4: Public Dashboard (TRANSPARANSI)
- [ ] Update `PublicDashboardController`
- [ ] Add method `aspirasi()`
- [ ] Update `public/dashboard.blade.php` - Tambah section "Aspirasi Ormada"
- [ ] Create `public/aspirasi.blade.php` - Halaman publik aspirasi
- [ ] Add route `public.aspirasi`
- [ ] Tampilkan SEMUA aspirasi (yang sudah & belum ditanggapi)
- [ ] Badge "Menunggu" untuk aspirasi yang belum ditanggapi
- [ ] Badge "Sudah Ditanggapi" untuk aspirasi yang sudah ditanggapi

### Phase 5: Testing
- [ ] Create `AspirasiTest.php`
- [ ] Test CRUD operations
- [ ] Test authorization
- [ ] Test public access (transparansi)
- [ ] Test file upload

### Phase 6: Seeder
- [ ] Add sample aspirasi ke `DatabaseSeeder`

---

## Next Steps

1. **Implementasi module Aspirasi** sesuai plan di atas
2. **Testing** dengan akun yang berbeda
3. **Deploy** ke staging untuk user testing
4. **Gather feedback** dan iterasi

---

## Catatan Penting

### 1. **Transparansi & Privacy**
- **SEMUA aspirasi** boleh ditampilkan di public untuk transparansi
- Aspirasi yang belum ditanggapi ditampilkan dengan badge "Menunggu Tanggapan"
- Aspirasi yang sudah ditanggapi menampilkan tanggapan Pemda
- Data sensitif (seperti NIM, no HP, detail anggota) **TIDAK** boleh ditampilkan di public
- Hanya menampilkan: topik, detail aspirasi, nama ormada, logo, dan tanggapan (jika ada)

### 2. **Notification** (Future Enhancement)
- Saat ini belum ada sistem notifikasi
- Di fase berikutnya, bisa ditambahkan:
  - Email notification ke Pemda saat ada aspirasi baru
  - Email notification ke pengurus saat aspirasi ditanggapi
  - Push notification di dashboard

### 3. **File Management**
- File aspirasi disimpan di `storage/app/public/aspirasi/`
- Saat aspirasi dihapus, file juga harus dihapus
- Gunakan Storage::disk('public')->delete() untuk cleanup

### 4. **Performance**
- Gunakan pagination untuk list aspirasi
- Eager load relasi untuk menghindari N+1 query
- Cache public aspirasi jika perlu

### 5. **Ruang Menyuarakan**
- Module ini berfungsi sebagai channel komunikasi antara ormada dan Pemda
- Masyarakat umum bisa melihat aspirasi dan tanggapan untuk transparansi
- Mendorong partisipasi aktif mahasiswa dalam mengaspirasi kebutuhan mereka

---

**Apakah plan ini sudah sesuai dengan visi transparansi yang kamu inginkan? Mau lanjut implementasi sekarang?**