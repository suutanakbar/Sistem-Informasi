# 📋 Dokumentasi: Hak Akses Agenda

## Ringkasan

Sistem agenda telah diperbarui dengan pemisahan hak akses yang jelas antara **Admin**, **Pemda**, dan **Pengurus Ormada**.

---

## 🎯 Hak Akses per Role

### **Admin**
- ✅ Buat agenda baru
- ✅ Edit agenda (milik sendiri & semua agenda)
- ✅ Hapus agenda
- ✅ Publish agenda
- ✅ Manage volunteer (terima/tolak pendaftar)
- ✅ Lihat semua agenda

**Panel:** `admin.agenda.*`

---

### **Pemda (Pemerintah Daerah)**
- ✅ Buat agenda baru
- ✅ Edit agenda (semua agenda)
- ✅ Hapus agenda
- ✅ Publish agenda
- ✅ Manage volunteer (terima/tolak pendaftar)
- ✅ Lihat semua agenda

**Panel:** `pemda.agenda.*`

---

### **Pengurus Ormada**
- ❌ **TIDAK BISA** buat agenda
- ❌ **TIDAK BISA** edit agenda
- ❌ **TIDAK BISA** hapus agenda
- ❌ **TIDAK BISA** publish agenda
- ❌ **TIDAK BISA** manage volunteer
- ✅ Lihat agenda miliknya (read-only)
- ✅ Daftar volunteer (jika agenda membuka pendaftaran)

**Panel:** `pengurus.agenda.*` (read-only)

---

## 📁 Struktur Views

### Admin Views
```
resources/views/admin/agenda/
├── index.blade.php      # Daftar semua agenda
├── create.blade.php     # Form buat agenda
├── edit.blade.php       # Form edit agenda
├── show.blade.php       # Detail agenda + manage volunteer
└── volunteer.blade.php  # Daftar volunteer
```

### Pemda Views
```
resources/views/pemda/agenda/
├── index.blade.php      # Daftar semua agenda
├── create.blade.php     # Form buat agenda
├── edit.blade.php       # Form edit agenda
├── show.blade.php       # Detail agenda + manage volunteer
└── volunteer.blade.php  # Daftar volunteer
```

### Pengurus Views (Read-Only)
```
resources/views/pengurus/agenda/
├── index.blade.php      # Daftar agenda miliknya (tanpa tombol buat/edit)
├── show.blade.php       # Detail agenda (tanpa tombol edit)
└── [NO create/edit views]
```

---

## 🔒 Implementasi Authorization

### 1. **AgendaPolicy.php**
```php
public function create(Admin $user): bool
{
    // Hanya Admin dan Pemda yang bisa membuat agenda
    return $user->isAdmin() || $user->isPemda();
}

public function update(Admin $user, Agenda $agenda): bool
{
    // Hanya Admin dan Pemda yang bisa edit agenda
    return $user->isAdmin() || $user->isPemda();
}

public function delete(Admin $user, Agenda $agenda): bool
{
    // Hanya Admin dan Pemda yang bisa hapus agenda
    return $user->isAdmin() || $user->isPemda();
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
```

### 2. **AgendaController.php**
```php
// CREATE & STORE
public function create(Request $request): View
{
    $user = $request->user();
    $this->authorize('create', Agenda::class);  // ← Authorization check
    
    if ($user->isPemda()) {
        $view = 'pemda.agenda.create';
    } else {
        $view = 'admin.agenda.create';
    }
    
    return view($view);
}

public function store(Request $request): RedirectResponse
{
    $user = $request->user();
    $this->authorize('create', Agenda::class);  // ← Authorization check
    // ...
}

// EDIT & UPDATE
public function edit(Request $request, Agenda $agenda): View
{
    $user = $request->user();
    $this->authorize('update', $agenda);  // ← Authorization check
    
    if ($user->isPemda()) {
        $view = 'pemda.agenda.edit';
    } else {
        $view = 'admin.agenda.edit';
    }
    
    return view($view, compact('agenda'));
}

public function update(Request $request, Agenda $agenda): RedirectResponse
{
    $user = $request->user();
    $this->authorize('update', $agenda);  // ← Authorization check
    // ...
}

// DELETE
public function destroy(Request $request, Agenda $agenda): RedirectResponse
{
    $user = $request->user();
    $this->authorize('delete', $agenda);  // ← Authorization check
    // ...
}
```

### 3. **Pengurus Views (Read-Only)**
```blade
{{-- resources/views/pengurus/agenda/index.blade.php --}}
{{-- TIDAK ada tombol "Buat Agenda" --}}
{{-- TIDAK ada tombol "Edit" di setiap card --}}

{{-- resources/views/pengurus/agenda/show.blade.php --}}
{{-- TIDAK ada tombol "Edit Agenda" --}}
{{-- Hanya bisa lihat detail dan daftar volunteer --}}
```

---

## 🔄 Flow Authorization

### Buat Agenda
```
User klik "Buat Agenda"
    ↓
Controller: create()
    ↓
Policy: create() - Cek isAdmin() || isPemda()
    ↓
✅ Admin/Pemda → Tampilkan form create
❌ Pengurus → 403 Forbidden
```

### Edit Agenda
```
User klik "Edit"
    ↓
Controller: edit()
    ↓
Policy: update() - Cek isAdmin() || isPemda()
    ↓
✅ Admin/Pemda → Tampilkan form edit
❌ Pengurus → 403 Forbidden
```

### Lihat Agenda
```
User buka halaman agenda
    ↓
Controller: index() / show()
    ↓
Query filter by role:
- Admin: Lihat SEMUA agenda
- Pemda: Lihat SEMUA agenda
- Pengurus: Lihat agenda MILIKNYA saja
    ↓
Tampilkan view sesuai role:
- Admin → admin.agenda.index/show
- Pemda → pemda.agenda.index/show
- Pengurus → pengurus.agenda.index/show (read-only)
```

---

## 📊 Summary Table

| Action | Admin | Pemda | Pengurus |
|--------|-------|-------|----------|
| Buat Agenda | ✅ | ✅ | ❌ |
| Edit Agenda | ✅ | ✅ | ❌ |
| Hapus Agenda | ✅ | ✅ | ❌ |
| Publish Agenda | ✅ | ✅ | ❌ |
| Manage Volunteer | ✅ | ✅ | ❌ |
| Lihat Semua Agenda | ✅ | ✅ | ❌ |
| Lihat Agenda Miliknya | ✅ | ✅ | ✅ |
| Daftar Volunteer | ✅ | ✅ | ✅ |

---

## 🧪 Testing

### Test 1: Pengurus coba buat agenda
```
1. Login sebagai pengurus
2. Buka /agenda/create
3. Expected: 403 Forbidden
```

### Test 2: Pengurus lihat daftar agenda
```
1. Login sebagai pengurus
2. Buka /agenda
3. Expected: 
   - Hanya lihat agenda miliknya
   - TIDAK ada tombol "Buat Agenda"
   - TIDAK ada tombol "Edit" di setiap card
```

### Test 3: Pengurus lihat detail agenda
```
1. Login sebagai pengurus
2. Buka /agenda/{id}
3. Expected:
   - Baca detail agenda
   - TIDAK ada tombol "Edit Agenda"
   - Bisa daftar volunteer (jika ada kuota)
```

### Test 4: Admin/Pemda buat agenda
```
1. Login sebagai admin/pemda
2. Buka /agenda/create
3. Expected: Form create muncul
```

---

## 🚀 Cara Kerja Sistem

### 1. **Authorization Check**
Setiap action yang sensitif (create, edit, delete) menggunakan Laravel Policy:
```php
$this->authorize('create', Agenda::class);
$this->authorize('update', $agenda);
$this->authorize('delete', $agenda);
```

### 2. **View Separation**
Setiap role mendapatkan view yang sesuai:
- Admin & Pemda: Full CRUD interface
- Pengurus: Read-only interface

### 3. **Query Filter**
Data yang ditampilkan difilter berdasarkan role:
- Admin & Pemda: Lihat semua agenda
- Pengurus: Hanya agenda miliknya

---

## 📝 Catatan Penting

1. **Pengurus TIDAK PERNAH** bisa akses create/edit/delete agenda
2. **Admin & Pemda** punya hak yang sama untuk agenda
3. **View separation** memastikan UI yang sesuai dengan role
4. **Policy check** di controller memastikan security di level backend
5. **Query filter** memastikan data yang ditampilkan sesuai dengan role

---

## 🔧 Troubleshooting

### Jika pengurus masih bisa melihat tombol edit:
1. Clear cache: `php artisan view:clear`
2. Cek view file: `resources/views/pengurus/agenda/index.blade.php`
3. Pastikan tidak ada tombol edit di view

### Jika pengurus bisa akses /agenda/create:
1. Cek Policy: `app/Policies/AgendaPolicy.php`
2. Cek Controller: `app/Http/Controllers/AgendaController.php`
3. Pastikan `$this->authorize('create', Agenda::class)` ada di method create()

---

**Dibuat:** 2026-06-09  
**Laravel Version:** 12.62.0  
**Status:** ✅ COMPLETE