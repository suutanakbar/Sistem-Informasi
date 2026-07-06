# Planning Implementasi Module Postingan & Agenda

## Overview

Module Postingan & Agenda menyediakan sistem konten informasi untuk:
1. **Postingan**: Berita, pengumuman, dan prestasi ormada (dapat sampai ke kampus masing-masing)
2. **Agenda**: Kalender kegiatan ormada dan Pemda yang dapat membuka volunteer untuk publik

Kedua module ini akan ditampilkan di dashboard publik untuk informasi masyarakat umum.

### Konsep Baru:
- **Postingan Ormada**: Ormada dapat membuat berita tentang kegiatan ormada di kampus mereka
- **Agenda dengan Volunteer**: Pemda dapat membuat agenda kegiatan yang membuka pendaftaran volunteer untuk masyarakat umum
- **Seleksi Volunteer**: Pemda melakukan seleksi dan approve volunteer yang mendaftar
- **Kategori Acara**: Setiap agenda dapat dikategorikan untuk memudahkan filtering

---

## Database Design

### Migration 1: `database/migrations/2026_07_06_000003_create_postingan_table.php`

**Tabel: `postingan`**

```php
Schema::create('postingan', function (Blueprint $table) {
    $table->id();
    $table->foreignId('admin_id')->constrained('admin')->cascadeOnDelete();
    $table->string('judul');
    $table->text('isi_konten');
    $table->string('foto')->nullable(); // Foto postingan
    $table->enum('jenis_konten', ['berita', 'pengumuman', 'prestasi']); // Jenis konten
    $table->boolean('is_published')->default(false); // Status publish
    $table->timestamp('tanggal_publish')->nullable(); // Kapan dipublish
    $table->timestamp('dibuat_pada')->useCurrent();
    $table->timestamp('diperbarui_pada')->useCurrent()->useCurrentOnUpdate();

    $table->index('admin_id');
    $table->index('jenis_konten');
    $table->index('is_published');
    $table->index('tanggal_publish');
});
```

**Indexes Explanation:**
- `admin_id` - Untuk filter postingan by pembuat
- `jenis_konten` - Untuk filter by tipe (berita/pengumuman/prestasi)
- `is_published` - Untuk filter postingan yang sudah/belum dipublish
- `tanggal_publish` - Untuk sorting postingan publik

### Migration 2: `database/migrations/2026_07_06_000004_create_agenda_table.php`

**Tabel: `agenda`**

```php
Schema::create('agenda', function (Blueprint $table) {
    $table->id();
    $table->foreignId('admin_id')->constrained('admin')->cascadeOnDelete();
    $table->string('nama_agenda');
    $table->text('deskripsi_agenda');
    $table->string('gambar_poster')->nullable(); // Poster agenda
    $table->dateTime('waktu_mulai'); // Waktu mulai agenda
    $table->dateTime('waktu_selesai'); // Waktu selesai agenda
    $table->string('tempat'); // Lokasi pelaksanaan
    $table->enum('kategori', ['kegiatan_ormada', 'kegiatan_pemda', 'baksos', 'pendidikan', 'kesehatan', 'lingkungan', 'lainnya']); // Kategori acara
    $table->integer('kuota_volunteer')->nullable(); // Kuota volunteer (jika ada)
    $table->dateTime('deadline_pendaftaran')->nullable(); // Deadline pendaftaran volunteer
    $table->boolean('is_published')->default(false); // Status publish
    $table->timestamp('tanggal_publish')->nullable(); // Kapan dipublish
    $table->timestamp('dibuat_pada')->useCurrent();
    $table->timestamp('diperbarui_pada')->useCurrent()->useCurrentOnUpdate();

    $table->index('admin_id');
    $table->index('kategori');
    $table->index('waktu_mulai');
    $table->index('is_published');
    $table->index('kuota_volunteer');
});
```

**Indexes Explanation:**
- `admin_id` - Untuk filter agenda by pembuat
- `kategori` - Untuk filter agenda by kategori acara
- `waktu_mulai` - Untuk sorting dan filter agenda yang akan datang
- `is_published` - Untuk filter agenda yang sudah/belum dipublish
- `kuota_volunteer` - Untuk filter agenda yang membuka volunteer

**Keterangan:**
- `kuota_volunteer`: Jika diisi (nullable), agenda membuka pendaftaran volunteer
- `deadline_pendaftaran`: Batas waktu pendaftaran volunteer

---

## Models

### Model 1: `app/Models/Postingan.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Postingan extends Model
{
    public const CREATED_AT = 'dibuat_pada';
    public const UPDATED_AT = 'diperbarui_pada';

    protected $table = 'postingan';

    protected $fillable = [
        'admin_id',
        'judul',
        'isi_konten',
        'foto',
        'jenis_konten',
        'is_published',
        'tanggal_publish',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_publish' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    // Relasi ke Admin (pembuat postingan)
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    // Scope untuk postingan yang sudah dipublish
    public function scopePublished($query): $query
    {
        return $query->where('is_published', true)
            ->whereNotNull('tanggal_publish')
            ->orderByDesc('tanggal_publish');
    }

    // Scope untuk filter by jenis konten
    public function scopeByJenis($query, ?string $jenis): $query
    {
        return $query->when($jenis, fn ($query, $jenis) => $query->where('jenis_konten', $jenis));
    }
}
```

### Model 2: `app/Models/Agenda.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agenda extends Model
{
    public const CREATED_AT = 'dibuat_pada';
    public const UPDATED_AT = 'diperbarui_pada';

    protected $table = 'agenda';

    protected $fillable = [
        'admin_id',
        'nama_agenda',
        'deskripsi_agenda',
        'gambar_poster',
        'waktu_mulai',
        'waktu_selesai',
        'tempat',
        'kategori',
        'kuota_volunteer',
        'deadline_pendaftaran',
        'is_published',
        'tanggal_publish',
    ];

    protected function casts(): array
    {
        return [
            'waktu_mulai' => 'datetime',
            'waktu_selesai' => 'datetime',
            'deadline_pendaftaran' => 'datetime',
            'tanggal_publish' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    // Relasi ke Admin (pembuat agenda)
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    // Relasi ke Volunteer pendaftar
    public function volunteers(): HasMany
    {
        return $this->hasMany(Volunteer::class, 'agenda_id');
    }

    // Scope untuk agenda yang sudah dipublish
    public function scopePublished($query): $query
    {
        return $query->where('is_published', true)
            ->whereNotNull('tanggal_publish')
            ->orderByDesc('waktu_mulai');
    }

    // Scope untuk agenda yang akan datang
    public function scopeUpcoming($query): $query
    {
        return $query->where('waktu_mulai', '>=', now())
            ->orderBy('waktu_mulai');
    }

    // Scope untuk agenda yang membuka volunteer
    public function scopeOpenVolunteer($query): $query
    {
        return $query->whereNotNull('kuota_volunteer')
            ->where('deadline_pendaftaran', '>=', now())
            ->where('is_published', true);
    }

    // Scope untuk filter by kategori
    public function scopeByKategori($query, ?string $kategori): $query
    {
        return $query->when($kategori, fn ($query, $kategori) => $query->where('kategori', $kategori));
    }
}
```

---

## Controllers

### Controller 1: `app/Http/Controllers/PostinganController.php`

**Methods:**

1. **`index(Request $request): View`**
   - List postingan dengan filter by jenis_konten
   - Admin/Pemda: Lihat semua postingan (published & unpublished)
   - Pengurus: Lihat postingan miliknya
   - Public: Hanya postingan yang published

2. **`create(Request $request): View`**
   - Form buat postingan baru
   - Authorization: Admin, Pemda, Pengurus ormada

3. **`store(Request $request): RedirectResponse`**
   - Simpan postingan baru
   - Handle upload foto
   - Set admin_id = user yang login

4. **`show(Request $request, Postingan $postingan): View`**
   - Detail postingan
   - Public bisa lihat jika published

5. **`edit(Request $request, Postingan $postingan): View`**
   - Form edit postingan
   - Hanya pemilik atau admin

6. **`update(Request $request, Postingan $postingan): RedirectResponse`**
   - Update postingan
   - Handle upload foto baru (delete yang lama)

7. **`destroy(Request $request, Postingan $postingan): RedirectResponse`**
   - Hapus postingan
   - Delete foto jika ada

8. **`publish(Request $request, Postingan $postingan): RedirectResponse`**
   - Publish postingan (hanya admin/pemda)
   - Set is_published = true, tanggal_publish = now()

**Authorization:**
- Pengurus ormada: CRUD postingan miliknya
- Pemda: CRUD semua postingan + publish
- Admin: Full access
- Public: Read published only

### Controller 2: `app/Http/Controllers/AgendaController.php`

**Methods:**

1. **`index(Request $request): View`**
   - List agenda dengan filter by kategori & tanggal
   - Admin/Pemda: Lihat semua agenda
   - Pengurus: Lihat agenda miliknya
   - Public: Hanya agenda yang published & akan datang
   - Filter by kategori acara
   - Filter by agenda yang membuka volunteer

2. **`create(Request $request): View`**
   - Form buat agenda baru
   - Authorization: Admin, Pemda, Pengurus ormada
   - Form include field untuk kuota volunteer & deadline

3. **`store(Request $request): RedirectResponse`**
   - Simpan agenda baru
   - Handle upload poster
   - Validasi waktu_mulai < waktu_selesai
   - Validasi deadline_pendaftaran < waktu_mulai (jika ada volunteer)

4. **`show(Request $request, Agenda $agenda): View`**
   - Detail agenda
   - Public bisa lihat jika published
   - Tampilkan informasi volunteer (kuota, deadline, jumlah pendaftar)
   - Form pendaftaran volunteer (untuk public)

5. **`edit(Request $request, Agenda $agenda): View`**
   - Form edit agenda
   - Hanya pemilik atau admin

6. **`update(Request $request, Agenda $agenda): RedirectResponse`**
   - Update agenda
   - Handle upload poster baru

7. **`destroy(Request $request, Agenda $agenda): RedirectResponse`**
   - Hapus agenda
   - Delete poster jika ada

8. **`publish(Request $request, Agenda $agenda): RedirectResponse`**
   - Publish agenda (hanya admin/pemda)

9. **`daftarVolunteer(Request $request, Agenda $agenda): RedirectResponse`**
   - Pendaftaran volunteer untuk agenda (public/authenticated)
   - Cek kuota masih tersedia
   - Cek deadline belum terlewat
   - Buat record volunteer dengan status 'pending'

10. **`listVolunteer(Request $request, Agenda $agenda): View`**
    - List volunteer yang mendaftar (hanya admin/pemda)
    - Tampilkan data volunteer dengan status
    - Fitur approve/reject volunteer

11. **`updateStatusVolunteer(Request $request, Volunteer $volunteer): RedirectResponse`**
    - Update status volunteer (diterima/ditolak)
    - Hanya admin/pemda yang bisa approve

**Authorization:**
- Pengurus ormada: CRUD agenda miliknya
- Pemda: CRUD semua agenda + publish + manage volunteer
- Admin: Full access
- Public: Read published & upcoming + daftar volunteer

---

## Views

### Postingan Views:

1. **`resources/views/postingan/index.blade.php`**
   - Daftar postingan dengan filter by jenis_konten
   - Card layout dengan foto thumbnail
   - Badge untuk jenis konten (berita/pengumuman/prestasi)
   - Tombol "Buat Postingan" untuk authorized users
   - Pagination

2. **`resources/views/postingan/create.blade.php`**
   - Form dengan fields:
     - Judul (text, required)
     - Jenis Konten (select: berita/pengumuman/prestasi)
     - Isi Konten (textarea, required)
     - Foto (file upload, optional)
     - Publish (checkbox, optional)
   - Preview foto sebelum upload

3. **`resources/views/postingan/show.blade.php`**
   - Detail postingan dengan foto full
   - Informasi pembuat dan tanggal
   - Badge jenis konten
   - Tombol Edit/Delete (untuk pemilik)
   - Tombol Publish (untuk admin/pemda)

4. **`resources/views/postingan/edit.blade.php`**
   - Sama seperti create, tapi pre-filled
   - Tampilkan foto saat ini

### Agenda Views:

1. **`resources/views/agenda/index.blade.php`**
   - Daftar agenda dengan filter by kategori & bulan
   - Card layout dengan poster thumbnail
   - Badge kategori (kegiatan_ormada, kegiatan_pemda, baksos, pendidikan, kesehatan, lingkungan, lainnya)
   - Tanggal dan waktu agenda
   - Indikator jika agenda membuka volunteer (kuota)
   - Tombol "Buat Agenda" untuk authorized users
   - Pagination

2. **`resources/views/agenda/create.blade.php`**
   - Form dengan fields:
     - Nama Agenda (text, required)
     - Kategori (select: kegiatan_ormada, kegiatan_pemda, baksos, pendidikan, kesehatan, lingkungan, lainnya)
     - Deskripsi (textarea, required)
     - Poster (file upload, optional)
     - Waktu Mulai (datetime, required)
     - Waktu Selesai (datetime, required)
     - Tempat (text, required)
     - Kuota Volunteer (number, optional) - jika diisi, agenda membuka volunteer
     - Deadline Pendaftaran (datetime, optional) - jika ada kuota
     - Publish (checkbox, optional)
   - Validasi waktu_mulai < waktu_selesai
   - Validasi deadline_pendaftaran < waktu_mulai (jika ada volunteer)

3. **`resources/views/agenda/show.blade.php`**
   - Detail agenda dengan poster
   - Informasi lengkap: waktu, tempat, kategori
   - Countdown atau status (akan datang/sedang berlangsung/selesai)
   - **Section Volunteer** (jika kuota diisi):
     - Tampilkan kuota dan jumlah pendaftar
     - Tampilkan deadline pendaftaran
     - Form pendaftaran volunteer (untuk public)
     - List volunteer dengan status (hanya admin/pemda)
   - Tombol Edit/Delete (untuk pemilik)
   - Tombol Publish (untuk admin/pemda)
   - Tombol Manage Volunteer (hanya admin/pemda)

4. **`resources/views/agenda/edit.blade.php`**
   - Sama seperti create, tapi pre-filled

5. **`resources/views/agenda/volunteer.blade.php`** (NEW)
   - List volunteer untuk agenda tertentu
   - Tampilkan nama, email, no HP, status
   - Tombol Approve/Reject (hanya admin/pemda)
   - Filter by status (pending/diterima/ditolak)

### Public Views:

1. **`resources/views/public/postingan.blade.php`**
   - Daftar postingan published
   - Filter by jenis_konten
   - Card layout dengan foto
   - Pagination

2. **`resources/views/public/agenda.blade.php`**
   - Daftar agenda published & akan datang
   - Filter by kategori & bulan
   - Card layout dengan poster
   - Indikator volunteer opportunity
   - Pagination

---

## Routes

```php
// routes/web.php

use App\Http\Controllers\PostinganController;
use App\Http\Controllers\AgendaController;

Route::middleware('auth')->group(function () {
    // Postingan Routes
    Route::resource('postingan', PostinganController::class);
    Route::patch('/postingan/{postingan}/publish', [PostinganController::class, 'publish'])
        ->name('postingan.publish');

    // Agenda Routes
    Route::resource('agenda', AgendaController::class);
    Route::patch('/agenda/{agenda}/publish', [AgendaController::class, 'publish'])
        ->name('agenda.publish');
    Route::post('/agenda/{agenda}/daftar-volunteer', [AgendaController::class, 'daftarVolunteer'])
        ->name('agenda.daftar-volunteer');
    Route::get('/agenda/{agenda}/volunteer', [AgendaController::class, 'listVolunteer'])
        ->name('agenda.volunteer');
    Route::patch('/volunteer/{volunteer}/status', [AgendaController::class, 'updateStatusVolunteer'])
        ->name('volunteer.update-status');
});

// Public Routes
Route::get('/publik/postingan', [PublicDashboardController::class, 'postingan'])->name('public.postingan');
Route::get('/publik/agenda', [PublicDashboardController::class, 'agenda'])->name('public.agenda');
```

**Generated Routes:**
- `GET /postingan` - index
- `GET /postingan/create` - create
- `POST /postingan` - store
- `GET /postingan/{postingan}` - show
- `GET /postingan/{postingan}/edit` - edit
- `PUT /postingan/{postingan}` - update
- `DELETE /postingan/{postingan}` - destroy
- `PATCH /postingan/{postingan}/publish` - publish

- `GET /agenda` - index
- `GET /agenda/create` - create
- `POST /agenda` - store
- `GET /agenda/{agenda}` - show
- `GET /agenda/{agenda}/edit` - edit
- `PUT /agenda/{agenda}` - update
- `DELETE /agenda/{agenda}` - destroy
- `PATCH /agenda/{agenda}/publish` - publish
- `POST /agenda/{agenda}/daftar-volunteer` - daftarVolunteer
- `GET /agenda/{agenda}/volunteer` - listVolunteer
- `PATCH /volunteer/{volunteer}/status` - updateStatusVolunteer

---

## Policies

### Policy 1: `app/Policies/PostinganPolicy.php`

```php
<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Postingan;

class PostinganPolicy
{
    public function create(Admin $user): bool
    {
        return $user->isPengurusOrmada() || $user->isPemda() || $user->isAdmin();
    }

    public function update(Admin $user, Postingan $postingan): bool
    {
        if ($user->isAdmin() || $user->isPemda()) {
            return true;
        }

        // Pengurus ormada bisa edit postingan miliknya
        return $postingan->admin_id === $user->id;
    }

    public function delete(Admin $user, Postingan $postingan): bool
    {
        if ($user->isAdmin() || $user->isPemda()) {
            return true;
        }

        // Pengurus ormada bisa hapus postingan miliknya
        return $postingan->admin_id === $user->id;
    }

    public function publish(Admin $user, Postingan $postingan): bool
    {
        // Hanya Pemda atau Admin yang bisa publish
        return $user->isPemda() || $user->isAdmin();
    }
}
```

### Policy 2: `app/Policies/AgendaPolicy.php`

```php
<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Agenda;

class AgendaPolicy
{
    public function create(Admin $user): bool
    {
        return $user->isPengurusOrmada() || $user->isPemda() || $user->isAdmin();
    }

    public function update(Admin $user, Agenda $agenda): bool
    {
        if ($user->isAdmin() || $user->isPemda()) {
            return true;
        }

        // Pengurus ormada bisa edit agenda miliknya
        return $agenda->admin_id === $user->id;
    }

    public function delete(Admin $user, Agenda $agenda): bool
    {
        if ($user->isAdmin() || $user->isPemda()) {
            return true;
        }

        // Pengurus ormada bisa hapus agenda miliknya
        return $agenda->admin_id === $user->id;
    }

    public function publish(Admin $user, Agenda $agenda): bool
    {
        // Hanya Pemda atau Admin yang bisa publish
        return $user->isPemda() || $user->isAdmin();
    }

    public function manageVolunteer(Admin $user, Agenda $agenda): bool
    {
        // Hanya Pemda atau Admin yang bisa manage volunteer
        return $user->isPemda() || $user->isAdmin();
    }
}
```

---

## Public Dashboard Integration

### Update `PublicDashboardController`

**File**: `app/Http/Controllers/PublicDashboardController.php`

**Add methods**:
```php
public function postingan(): View
{
    $postingans = Postingan::query()
        ->with('admin')
        ->published()
        ->limit(6)
        ->get();

    return view('public.postingan', compact('postingans'));
}

public function agenda(): View
{
    $agendas = Agenda::query()
        ->with('admin')
        ->published()
        ->upcoming()
        ->limit(6)
        ->get();

    return view('public.agenda', compact('agendas'));
}
```

**Update `index()` method**:
```php
public function index(): View
{
    return view('public.dashboard', [
        'totalOrmada' => ProfilOrmada::count(),
        'totalAnggota' => AnggotaOrmada::count(),
        'totalPengurus' => AnggotaOrmada::where('is_pengurus', 'YA')->count(),
        'totalAlumni' => AnggotaOrmada::where('status_aktif', 'alumni')->count(),
        'profilOrmadas' => ProfilOrmada::query()
            ->withCount('anggota')
            ->latest('dibuat_pada')
            ->limit(8)
            ->get(),
        'aspirasis' => Aspirasi::query()
            ->with(['profilOrmada' => fn ($query) => $query->select('id', 'nama_universitas', 'logo')])
            ->latest('dibuat_pada')
            ->limit(6)
            ->get(),
        'postingans' => Postingan::query()
            ->with('admin')
            ->published()
            ->limit(6)
            ->get(),
        'agendas' => Agenda::query()
            ->with('admin')
            ->published()
            ->upcoming()
            ->limit(6)
            ->get(),
    ]);
}
```

### Update Public Dashboard View

**File**: `resources/views/public/dashboard.blade.php`

**Add sections**:
```blade
{{-- Section Postingan --}}
@if($postingans->isNotEmpty())
<section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h2 class="text-2xl font-semibold">Berita & Pengumuman</h2>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-zinc-600">Informasi terbaru dari ormada dan Pemda Temanggung.</p>
        </div>
        <a href="{{ route('public.postingan') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
            Lihat Semua →
        </a>
    </div>

    <div class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach($postingans as $postingan)
        <article class="rounded-lg border border-zinc-200 bg-white overflow-hidden hover:shadow-md transition-shadow">
            @if($postingan->foto)
            <img src="{{ asset('storage/'.$postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-48 object-cover">
            @endif
            <div class="p-5">
                <div class="flex items-center gap-2 mb-2">
                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                        {{ ucfirst($postingan->jenis_konten) }}
                    </span>
                </div>
                <h3 class="font-semibold text-sm leading-6">{{ $postingan->judul }}</h3>
                <p class="mt-2 text-sm text-zinc-600 line-clamp-2">
                    {{ Str::limit($postingan->isi_konten, 100) }}
                </p>
                <p class="mt-3 text-xs text-zinc-400">
                    {{ $postingan->tanggal_publish->diffForHumans() }}
                </p>
            </div>
        </article>
        @endforeach
    </div>
</section>
@endif

{{-- Section Agenda --}}
@if($agendas->isNotEmpty())
<section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h2 class="text-2xl font-semibold">Agenda Kegiatan</h2>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-zinc-600">Jadwal kegiatan yang akan datang.</p>
        </div>
        <a href="{{ route('public.agenda') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
            Lihat Semua →
        </a>
    </div>

    <div class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach($agendas as $agenda)
        <article class="rounded-lg border border-zinc-200 bg-white p-5 hover:shadow-md transition-shadow">
            @if($agenda->gambar_poster)
            <img src="{{ asset('storage/'.$agenda->gambar_poster) }}" alt="{{ $agenda->nama_agenda }}" class="w-full h-40 object-cover rounded-lg mb-3">
            @endif
            <div class="flex items-center gap-2 mb-2">
                <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                    {{ ucfirst($agenda->kategori) }}
                </span>
                <span class="text-xs text-zinc-500">
                    {{ $agenda->waktu_mulai->format('d M Y H:i') }}
                </span>
            </div>
            <h3 class="font-semibold text-sm leading-6">{{ $agenda->nama_agenda }}</h3>
            <p class="mt-2 text-sm text-zinc-600 line-clamp-2">
                {{ Str::limit($agenda->deskripsi_agenda, 100) }}
            </p>
            <div class="mt-3 flex items-center text-xs text-zinc-500">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                {{ $agenda->tempat }}
            </div>
        </article>
        @endforeach
    </div>
</section>
@endif
```

### Create Public Views

**File**: `resources/views/public/postingan.blade.php`
- Daftar postingan published
- Filter by jenis_konten
- Card layout dengan foto
- Pagination

**File**: `resources/views/public/agenda.blade.php`
- Daftar agenda published & akan datang
- Filter by kategori & bulan
- Card layout dengan poster
- Indikator volunteer opportunity
- Pagination

---

## Navigation Updates

### 1. Dashboard Internal
**Add buttons**:
```blade
<x-button-link href="{{ route('postingan.index') }}" variant="secondary">Postingan</x-button-link>
<x-button-link href="{{ route('agenda.index') }}" variant="secondary">Agenda</x-button-link>
```

### 2. Navigation Bar
**Add menus**:
```blade
<a href="{{ route('postingan.index') }}" class="rounded-md px-3 py-2 hover:bg-zinc-100">Postingan</a>
<a href="{{ route('agenda.index') }}" class="rounded-md px-3 py-2 hover:bg-zinc-100">Agenda</a>
```

---

## Testing

### File 1: `tests/Feature/PostinganTest.php`

**Test Cases**:
1. Pengurus bisa membuat postingan 
2. Pengurus bisa melihat postingan miliknya
3. Pengurus bisa melihat postingan ormada lain 
4. Pemda bisa publish postingan
5. Public bisa melihat postingan yang published
6. Public tidak bisa melihat postingan yang unpublished
7. Admin bisa mengelola semua postingan
8. Pengurus bisa upload foto

### File 2: `tests/Feature/AgendaTest.php`

**Test Cases**:
1. Pengurus bisa membuat agenda 
2. Pengurus bisa melihat agenda miliknya
3. Pengurus bisa melihat agenda ormada lain 
4. Pemda bisa publish agenda
5. Public bisa melihat agenda yang published & akan datang
6. Public tidak bisa melihat agenda yang unpublished
7. Admin bisa mengelola semua agenda
8. Pengurus bisa upload poster
9. Validasi waktu_mulai < waktu_selesai
10. Public bisa daftar volunteer (jika kuota tersedia)
11. Pemda bisa approve/reject volunteer
12. Validasi kuota volunteer tidak melebihi kapasitas

---

## Authorization Rules

### Postingan:

**Pengurus Ormada:**
- ✅ Create postingan
- ✅ Read postingan miliknya
- ✅ Update postingan miliknya
- ✅ Delete postingan miliknya
- ❌ Tidak bisa publish (hanya bisa create draft)
- ❌ Tidak bisa melihat postingan ormada lain

**Pemda:**
- ✅ Create postingan
- ✅ Read semua postingan
- ✅ Update semua postingan
- ✅ Delete semua postingan
- ✅ Publish postingan
- ✅ Unpublish postingan

**Admin:**
- ✅ Full access

**Public:**
- ✅ Read published postingan only
- ❌ Tidak bisa create/update/delete

### Agenda:

**Pengurus Ormada:**
- ✅ Create agenda
- ✅ Read agenda miliknya
- ✅ Update agenda miliknya
- ✅ Delete agenda miliknya
- ✅ bisa publish
- ✅ bisa melihat agenda ormada lain

**Pemda:**
- ✅ Create agenda
- ✅ Read semua agenda
- ✅ Update semua agenda
- ✅ Delete semua agenda
- ✅ Publish agenda
- ✅ Manage volunteer (approve/reject)

**Admin:**
- ✅ Full access

**Public:**
- ✅ Read published & upcoming agenda only
- ✅ Daftar volunteer (jika kuota tersedia)
- ❌ Tidak bisa create/update/delete agenda

---

## File Upload

### Postingan:
**Storage**: `storage/app/public/postingan/foto/`
**Allowed Types**: JPG, JPEG, PNG
**Max Size**: 2MB
**Path**: `postingan/foto/abc123.jpg`

### Agenda:
**Storage**: `storage/app/public/agenda/poster/`
**Allowed Types**: JPG, JPEG, PNG
**Max Size**: 2MB
**Path**: `agenda/poster/abc123.jpg`

---

## Estimasi Waktu

| Task | Estimasi |
|------|----------|
| Migration & Models (2 files) | 20 menit |
| Controllers (2 files) | 1.5 jam |
| Views (7 files) | 2 jam |
| Policies (2 files) | 15 menit |
| Routes & Navigation | 15 menit |
| Public Dashboard Integration | 30 menit |
| Testing (2 files) | 1.5 jam |
| Bug Fixes | 30 menit |
| **Total** | **6.5 - 7.5 jam** |

---

## Dependencies

### Existing Modules:
- ✅ Admin (authentication)
- ✅ Auth & Authorization (policy pattern)
- ✅ Public Dashboard

### Future Modules:
- ⏳ Volunteer & Kolaborasi (akan menggunakan agenda)

---

## Checklist Implementasi

### Phase 1: Core Functionality
- [ ] Create migration `create_postingan_table`
- [ ] Create migration `create_agenda_table`
- [ ] Create model `Postingan.php`
- [ ] Create model `Agenda.php`
- [ ] Create controller `PostinganController.php`
- [ ] Create controller `AgendaController.php`
- [ ] Create policy `PostinganPolicy.php`
- [ ] Create policy `AgendaPolicy.php`
- [ ] Register policies di `AuthServiceProvider`
- [ ] Add routes

### Phase 2: Views
- [ ] Create `postingan/index.blade.php`
- [ ] Create `postingan/create.blade.php`
- [ ] Create `postingan/show.blade.php`
- [ ] Create `postingan/edit.blade.php`
- [ ] Create `agenda/index.blade.php`
- [ ] Create `agenda/create.blade.php`
- [ ] Create `agenda/show.blade.php`
- [ ] Create `agenda/edit.blade.php`
- [ ] Create `agenda/volunteer.blade.php` (manage volunteer list)

### Phase 3: Public Dashboard
- [ ] Update `PublicDashboardController`
- [ ] Add method `postingan()`
- [ ] Add method `agenda()`
- [ ] Update `public/dashboard.blade.php`
- [ ] Create `public/postingan.blade.php`
- [ ] Create `public/agenda.blade.php`
- [ ] Add routes `public.postingan` & `public.agenda`

### Phase 4: Navigation
- [ ] Add menu di navigation bar
- [ ] Add quick access di dashboard

### Phase 5: Testing
- [ ] Create `PostinganTest.php`
- [ ] Create `AgendaTest.php`
- [ ] Test CRUD operations
- [ ] Test authorization
- [ ] Test public access
- [ ] Test file upload
- [ ] Test publish/unpublish
- [ ] Test volunteer registration
- [ ] Test volunteer approval/rejection

### Phase 6: Seeder
- [ ] Add sample postingan ke `DatabaseSeeder`
- [ ] Add sample agenda ke `DatabaseSeeder`

### Phase 7: Volunteer Integration (Future)
- [ ] Create migration `create_volunteer_table`
- [ ] Create model `Volunteer.php`
- [ ] Update AgendaController dengan methods volunteer
- [ ] Create volunteer management views

---

## Next Steps

1. **Implementasi module Postingan & Agenda** sesuai plan di atas
2. **Testing** dengan akun yang berbeda
3. **Deploy** ke staging untuk user testing
4. **Gather feedback** dan iterasi

---

## Catatan Penting

### 1. **Publishing Workflow**
- Postingan/Agenda dibuat dalam status draft (is_published = false)
- Hanya Pemda/Admin yang bisa publish
- Setelah publish, tanggal_publish diisi dengan waktu sekarang
- Public hanya melihat yang published

### 2. **Volunteer System**
- Agenda dapat memiliki kuota volunteer (opsional)
- Jika kuota diisi, publik dapat mendaftar sebagai volunteer
- Pendaftaran volunteer memiliki status: pending/diterima/ditolak
- Pemda melakukan seleksi dan approve volunteer
- Deadline pendaftaran harus sebelum waktu mulai agenda
- Sistem volunteer akan fully implemented di Phase 7

### 3. **Kategori Acara**
- Kategori agenda: kegiatan_ormada, kegiatan_pemda, baksos, pendidikan, kesehatan, lingkungan, lainnya
- Memudahkan filtering dan pencarian agenda
- Public dapat filter agenda by kategori

### 4. **File Management**
- Foto postingan disimpan di `storage/app/public/postingan/foto/`
- Poster agenda disimpan di `storage/app/public/agenda/poster/`
- Saat edit, jika ada foto/poster baru, yang lama dihapus
- Gunakan Storage::disk('public')->delete() untuk cleanup

### 5. **Performance**
- Gunakan pagination untuk list postingan dan agenda
- Eager load relasi admin untuk menghindari N+1 query
- Cache public postingan dan agenda jika perlu

### 6. **Future Enhancement**
- Calendar view untuk agenda
- Rich text editor untuk isi konten
- Comment system untuk postingan
- Share to social media
- Email notification untuk postingan baru dan agenda
- Notifikasi volunteer yang diterima/ditolak

---

**Apakah plan ini sudah sesuai dengan kebutuhan kamu? Mau lanjut implementasi sekarang?**