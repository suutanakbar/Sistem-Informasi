# Planning Implementasi Tampilan Berdasarkan Role Admin

## 1. Tujuan Implementasi

Membedakan tampilan halaman dashboard dan menu navigasi berdasarkan role admin yang login:
- **Admin**: Tampilan lengkap dengan akses penuh ke semua fitur
- **Pemda**: Pemerintah Daerah yang dapat membuat agenda, membuka volunteer, dan membuat postingan/berita
- **Pengurus Ormada**: Tampilan terbatas untuk melihat agenda dan mendaftar volunteer

## 2. Role yang Ada

Berdasarkan model `Admin`, terdapat 3 role:

| Role | Kode di Database | Deskripsi |
|------|-----------------|-----------|
| Admin | `admin` | Super admin dengan akses penuh |
| Pemda | `pemda` | Pemerintah Daerah, dapat membuat agenda dan mengelola volunteer |
| Pengurus Ormada | `pengurus_ormada` | Pengelola ormada tertentu |

Method helper sudah tersedia di model `Admin`:
- `isAdmin()`
- `isPemda()`
- `isPengurusOrmada()`

## 3. Struktur View yang Akan Dibuat

### 3.1 Layout Berdasarkan Role

```
resources/views/
├── layouts/
│   ├── app.blade.php (existing - untuk public)
│   ├── admin.blade.php (NEW - layout untuk admin)
│   ├── pemda.blade.php (NEW - layout untuk pemda)
│   └── pengurus.blade.php (NEW - layout untuk pengurus ormada)
```

### 3.2 Dashboard Berdasarkan Role

```
resources/views/
├── dashboard.blade.php (existing - akan diubah menjadi conditional)
├── dashboard/
│   ├── admin.blade.php (NEW - dashboard admin)
│   ├── pemda.blade.php (NEW - dashboard pemda)
│   └── pengurus.blade.php (NEW - dashboard pengurus)
```

### 3.3 Partial Components untuk Menu

```
resources/views/
├── components/
│   └── layouts/
│       ├── sidebar-admin.blade.php (NEW)
│       ├── sidebar-pemda.blade.php (NEW)
│       └── sidebar-pengurus.blade.php (NEW)
```

## 4. Spesifikasi Tampilan per Role

### 4.1 Admin

**Layout:**
- Sidebar dengan menu lengkap
- Warna tema: Biru (primary)
- Full width content area
- Access to semua modul

**Menu Navigasi:**
- Dashboard
- Profil Ormada (CRUD)
- Anggota Ormada (CRUD)
- Agenda (CRUD)
- Postingan (CRUD)
- Proposal (CRUD)
- Aspirasi (Read + Manage)
- Manajemen Admin (CRUD)

**Dashboard Content:**
- Statistik global semua ormada
- Total ormada, anggota, pengurus, alumni, demisioner
- Grafik tren pendaftaran
- Recent activities
- Quick actions untuk manage semua data

**Hak Akses:**
- Create, Read, Update, Delete semua data
- Approve/reject proposal
- Manage admin accounts
- View semua aspirasi

### 4.2 Pemda

**Layout:**
- Sidebar dengan menu untuk manage agenda dan volunteer
- Warna tema: Hijau (government)
- Badge showing "Pemerintah Daerah"
- Action buttons untuk create agenda dan volunteer

**Menu Navigasi:**
- Dashboard
- Buat Agenda (CREATE)
- Kelola Volunteer (CRUD - open/close, approve/reject)
- Daftar Ormada (Read-only)
- Detail Anggota (Read-only)
- Buat Postingan/Berita (CREATE)
- Proposal (Read + Approve/Reject)
- Aspirasi (Read-only)

**Dashboard Content:**
- Form/quick action untuk buat agenda baru
- Daftar volunteer yang sedang dibuka (dapat di-open/close)
- Statistik volunteer: total pendaftar, yang sudah di-approve, yang menunggu
- Agenda yang akan datang
- Postingan/berita yang sudah dibuat
- Proposal yang menunggu persetujuan
- Daftar ormada yang terdaftar

**Hak Akses:**
- CREATE agenda untuk kegiatan
- OPEN/CLOSE volunteer untuk agenda tertentu
- VIEW daftar volunteer dari seluruh mahasiswa (semua ormada)
- APPROVE/REJECT volunteer pendaftar
- CREATE postingan/berita
- Read-only untuk data ormada dan anggota
- Approve/reject proposal

### 4.3 Pengurus Ormada

**Layout:**
- Sidebar dengan menu terbatas (read-only access)
- Warna tema: Oranye (organization)
- Badge showing nama ormada
- No create buttons (read-only)

**Menu Navigasi:**
- Dashboard
- Daftar Agenda Pemda (Read-only)
- Daftar Volunteer (Read-only + Daftar)
- Profil Ormada Saya (CRUD)
- Anggota Ormada Saya (CRUD)
- Postingan/Berita Saya (CRUD)
- Proposal Saya (CRUD)
- Aspirasi untuk Ormada Saya (Read-only)

**Dashboard Content:**
- Daftar agenda yang dibuat pemda (dapat melihat detail)
- Volunteer yang tersedia untuk agenda tertentu (dapat mendaftar)
- Status volunteer yang sudah didaftarkan (pending/accepted/rejected)
- Statistik ormada miliknya
- Total anggota ormada
- Proposal yang diajukan
- Aspirasi yang masuk
- Postingan/berita yang dibuat oleh ormada sendiri
- Daftar postingan/berita dari ormada lain (untuk referensi)

**Hak Akses:**
- VIEW agenda yang dibuat pemda
- DAFTAR volunteer untuk agenda tertentu
- VIEW status volunteer (pending/accepted/rejected)
- CRUD untuk profil dan anggota ormada miliknya
- CRUD proposal
- View aspirasi untuk ormada miliknya
- CREATE postingan/berita untuk ormada miliknya
- VIEW postingan/berita dari pemda dan ormada lain
- TIDAK BISA membuat agenda
- TIDAK BISA akses data ormada lain

## 5. Implementasi Teknis

### 5.1 Controller Changes

**DashboardController@index** akan diubah:

```php
public function index(Request $request): View
{
    $user = $request->user();
    
    if ($user->isAdmin()) {
        // Return dashboard admin view
        return view('dashboard.admin', [...]);
    }
    
    if ($user->isPemda()) {
        // Return dashboard pemda view
        return view('dashboard.pemda', [...]);
    }
    
    if ($user->isPengurusOrmada()) {
        // Return dashboard pengurus view
        return view('dashboard.pengurus', [...]);
    }
}
```

### 5.2 Layout Implementation

Setiap layout akan memiliki:
- Sidebar dengan menu yang sesuai role
- Header dengan info user dan role badge
- Content area yang di-extend dari layout
- Role-specific CSS classes untuk theming

**Contoh struktur layout admin:**
```blade
<!-- layouts/admin.blade.php -->
<x-app-layout>
    <x-slot name="sidebar">
        @include('components.layouts.sidebar-admin')
    </x-slot>
    
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1>Admin Dashboard</h1>
            <span class="badge badge-admin">Admin</span>
        </div>
    </x-slot>
    
    {{ $slot }}
</x-app-layout>
```

### 5.3 Middleware untuk Role-Based Access

Buat middleware baru untuk memastikan user hanya bisa mengakses halaman yang sesuai role:

```php
// app/Http/Middleware/CheckRole.php
public function handle(Request $request, Closure $next, string $role)
{
    if (!$request->user()->is{$role}()) {
        abort(403, 'Unauthorized');
    }
    
    return $next($request);
}
```

Penggunaan di route:
```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin only routes
});
```

### 5.4 Conditional Menu Rendering

Menu akan dirender berdasarkan role:

```blade
@if(auth()->user()->isAdmin())
    @include('components.layouts.sidebar-admin')
@elseif(auth()->user()->isPemda())
    @include('components.layouts.sidebar-pemda')
@elseif(auth()->user()->isPengurusOrmada())
    @include('components.layouts.sidebar-pengurus')
@endif
```

### 5.5 CSS Theming per Role

Tambahkan class di body berdasarkan role:

```blade
<body class="{{ 
    auth()->check() ? (
        auth()->user()->isAdmin() ? 'theme-admin' :
        auth()->user()->isPemda() ? 'theme-pemda' :
        auth()->user()->isPengurusOrmada() ? 'theme-pengurus' : ''
    ) : ''
}}">
```

CSS variables untuk setiap theme:
```css
.theme-admin {
    --primary-color: #3b82f6;
    --sidebar-bg: #1e40af;
}

.theme-pemda {
    --primary-color: #10b981;
    --sidebar-bg: #065f46;
}

.theme-pengurus {
    --primary-color: #f97316;
    --sidebar-bg: #9a3412;
}
```

## 6. Perubahan File yang Akan Dilakukan

### 6.1 Files to Create (NEW)

1. `resources/views/layouts/admin.blade.php`
2. `resources/views/layouts/pemda.blade.php`
3. `resources/views/layouts/pengurus.blade.php`
4. `resources/views/components/layouts/sidebar-admin.blade.php`
5. `resources/views/components/layouts/sidebar-pemda.blade.php`
6. `resources/views/components/layouts/sidebar-pengurus.blade.php`
7. `resources/views/dashboard/admin.blade.php`
8. `resources/views/dashboard/pemda.blade.php`
9. `resources/views/dashboard/pengurus.blade.php`
10. `app/Http/Middleware/CheckRole.php`

### 6.2 Files to Modify (UPDATE)

1. `app/Http/Controllers/DashboardController.php` - Update untuk return view berdasarkan role
2. `resources/views/dashboard.blade.php` - Bisa dijadikan fallback atau dipecah
3. `routes/web.php` - Tambahkan middleware role-based jika diperlukan
4. `app/Http/Kernel.php` - Register middleware baru

## 7. Urutan Implementasi

### Phase 1: Setup Infrastructure
1. Buat middleware `CheckRole`
2. Register middleware di `Kernel.php`
3. Buat layout dasar untuk setiap role (admin, pemda, pengurus)

### Phase 2: Dashboard Views
4. Buat 3 view dashboard terpisah
5. Update `DashboardController@index` untuk return view sesuai role
6. Test setiap role melihat dashboard yang benar

### Phase 3: Sidebar Components
7. Buat 3 sidebar components dengan menu sesuai role
8. Integrasi sidebar ke layout masing-masing
9. Test navigasi untuk setiap role

### Phase 4: Theming
10. Tambahkan CSS theming untuk setiap role
11. Test visual appearance untuk setiap role
12. Responsive testing

### Phase 5: Route Protection
13. Update route dengan middleware role-based
14. Test unauthorized access untuk setiap role
15. Test 403 error handling

### Phase 6: Controller Updates
16. Update controllers lain untuk respect role-based access
17. Tambahkan conditional logic untuk show/hide actions
18. Test CRUD operations untuk setiap role

## 8. Testing Strategy

### 8.1 Unit Tests
- Test `isAdmin()`, `isPemda()`, `isPengurusOrmada()` methods
- Test `CheckRole` middleware

### 8.2 Feature Tests
- Test admin bisa akses semua halaman
- Test pemda tidak bisa akses halaman create/edit
- Test pengurus hanya bisa akses halaman ormada miliknya
- Test dashboard menampilkan data yang sesuai role

### 8.3 Browser Tests (Optional)
- Test visual appearance untuk setiap role
- Test responsive layout
- Test navigation flow

## 9. Definition of Done

Fitur dianggap selesai jika:

- [ ] Setiap role (admin, pemda, pengurus) memiliki layout dan dashboard yang berbeda
- [ ] Menu navigasi sesuai dengan hak akses masing-masing role
- [ ] Pemda bisa membuat agenda untuk kegiatan
- [ ] Pemda bisa membuka/menutup volunteer untuk agenda
- [ ] Pemda bisa melihat dan mengelola daftar volunteer pendaftar
- [ ] Pemda bisa approve/reject volunteer pendaftar
- [ ] Pemda bisa membuat postingan/berita
- [ ] Setiap ormada (pengurus) bisa membuat postingan/berita untuk ormada mereka
- [ ] Setiap ormada bisa melihat postingan/berita dari ormada lain
- [ ] Mahasiswa (pengurus ormada) bisa melihat agenda yang dibuat pemda
- [ ] Mahasiswa (pengurus ormada) bisa mendaftar volunteer untuk agenda tertentu
- [ ] Mahasiswa (pengurus ormada) bisa melihat status volunteer mereka
- [ ] Pengurus ormada tidak bisa membuat agenda
- [ ] Admin bisa mengakses semua fitur
- [ ] Tampilan visual berbeda untuk setiap role (warna tema, badge, dll)
- [ ] Route protection berhasil mencegah unauthorized access
- [ ] Semua test pass
- [ ] Dokumentasi updated

## 10. Future Enhancements

Yang bisa ditambahkan di kemudian hari:

1. **Role Management Page**: Halaman untuk manage role dan permissions
2. **Permission-based Access**: Lebih granular daripada role-based
3. **Activity Log**: Track what each role is doing
4. **Custom Dashboard Widgets**: Setiap role bisa customize dashboard mereka
5. **Role-specific Notifications**: Notifikasi yang sesuai dengan role
6. **Multi-role Support**: User bisa punya lebih dari satu role
7. **Audit Trail**: Log semua aksi penting untuk compliance

## 11. Catatan Penting

1. **Backward Compatibility**: Pastikan perubahan tidak break existing functionality
2. **Database Migration**: Tidak ada perubahan schema, hanya tampilan
3. **Performance**: Gunakan eager loading untuk menghindari N+1 queries
4. **Security**: Selalu validate role di controller, jangan hanya di view
5. **UX**: Berikan feedback yang jelas jika user mencoba akses yang tidak diizinkan
6. **Documentation**: Update README dan docs setelah implementasi

## 12. Referensi

- Existing implementation: `app/Models/Admin.php` (role methods)
- Existing dashboard: `app/Http/Controllers/DashboardController.php`
- Existing views: `resources/views/dashboard.blade.php`
- Auth config: `config/auth.php`
- Login implementation: `docs/IMPLEMENTATION_PLAN_LOGIN_ADMIN.md`