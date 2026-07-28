# Test Design Document (TDD)

## Sistem Informasi Ormada Temanggung

| Atribut | Nilai |
|---|---|
| Versi | 1.0 |
| Status | Dokumentasi testing terbaru |
| Terakhir diperbarui | 28 Juli 2026 |
| Sumber acuan | Implementasi commit 8f93c5f |
| Framework Testing | PHPUnit 10.x + Laravel Testing |
| Coverage Target | 80% untuk fitur utama |

## 1. Test Strategy

### 1.1 Tujuan Testing
Memastikan kualitas sistem melalui automated testing untuk:
- Functional correctness (fitur bekerja sesuai spesifikasi)
- Authorization & Access Control (role-based access)
- Data validation & integrity
- File upload/download operations
- Business logic edge cases

### 1.2 Testing Pyramid
```
        /\
       /  \     E2E/Integration Tests (20%)
      /____\
     /      \   Feature Tests (50%)
    /________\
   /          \ Unit Tests (30%)
  /____________\
```

### 1.3 Jenis Test
- **Feature Tests**: Simulasi user interaction lengkap (HTTP requests, session, database)
- **Unit Tests**: Test logic bisnis terpisah (helpers, form requests, policies)

## 2. Test Tools & Stack

### 2.1 Core Tools
- **PHPUnit 10.x**: Framework testing PHP
- **Laravel Test Case**: `Illuminate\Foundation\Testing\RefreshDatabase`
- **Database**: SQLite memory (testing) atau MySQL dedicated test database
- **File Uploads**: `Storage::fake()` untuk testing upload

### 2.2 Helpers & Traits
```php
use RefreshDatabase;          // Reset database setiap test
use WithFaker;                // Generate fake data
use DatabaseTransactions;     // Rollback setelah test
```

## 3. Test Hierarchy

### 3.1 Directory Structure
```
tests/
├── Feature/
│   ├── AdminLoginTest.php
│   ├── AdminAkunTest.php
│   ├── AgendaTest.php
│   ├── AspirasiTest.php
│   ├── ProfilOrmadaTest.php
│   ├── AnggotaOrmadaTest.php
│   ├── ProposalTest.php
│   ├── PostinganTest.php
│   ├── PublicDashboardTest.php
│   ├── VolunteerTest.php
│   └── AuthorizationTest.php
├── Unit/
│   ├── HelperTest.php
│   ├── PolicyTest.php
│   └── ValidationTest.php
├── TestCase.php
└── CreatesApplication.php
```

### 3.2 Base TestCase
```php
class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase; // Global reset
}
```

## 4. Test Coverage Matrix

### 4.1 Module Coverage

| Modul | Feature Tests | Unit Tests | Priority | Target Coverage |
|---|---|---|---|---|
| **Authentication** | LoginTest, LogoutTest | PasswordHashTest | P0 | 100% |
| **Authorization** | RoleAccessTest, PolicyTest | GateTest | P0 | 100% |
| **Profil Ormada** | CRUDTest, ViewTest | - | P0 | 90% |
| **Anggota Ormada** | CRUDTest, StatusTest, OwnerTest | - | P0 | 90% |
| **Proposal** | CreateTest, StatusUpdateTest, FileUploadTest | - | P0 | 90% |
| **Aspirasi** | CreateTest, TanggapanTest, PublicViewTest | - | P0 | 90% |
| **Postingan** | CreateTest, PublishTest, DraftTest | - | P0 | 85% |
| **Agenda** | CreateTest, PublishTest, KuotaTest | - | P0 | 90% |
| **Volunteer** | DaftarTest, DuplicateTest, KuotaTest, StatusTest | - | P0 | 95% |
| **Dashboard** | AdminTest, PemdaTest, PengurusTest | StatisticTest | P1 | 80% |
| **Portal Publik** | ListTest, FilterTest, DetailTest | - | P1 | 80% |

### 4.2 Scenario Coverage

| Scenario | Description | Type | Priority |
|---|---|---|---|
| Happy Path | User biasa melakukan aksi sesuai ekspektasi | Feature | P0 |
| Validation Error | Input invalid, missing field, format salah | Feature | P0 |
| Authorization Denied | User akses resource milik orang lain | Feature | P0 |
| Guest Access | Tamu akses halaman yang butuh login | Feature | P0 |
| Role-based Access | Test setiap role punya access sesuai matriks | Feature | P0 |
| File Upload | Success, invalid type, exceed size | Feature | P0 |
| Pagination | Kurang/page, lebih/page, edge case | Feature | P1 |
| Soft Delete | Data removed tapi bisa di-restore | Feature | P1 |
| Search & Filter | Query filter berfungsi | Feature | P1 |

## 5. Test Cases Detail

### 5.1 Authentication

**File**: `tests/Feature/AdminLoginTest.php`

```php
class AdminLoginTest extends TestCase
{
    use RefreshDatabase;
    
    // Test 1: Login sukses
    public function test_admin_can_login_using_email_and_password()
    {
        // Create user
        $admin = Admin::create([...]);
        
        // Post login
        $response = $this->post(route('login'), [
            'email' => $admin->email,
            'password' => 'password'
        ]);
        
        // Assertions
        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($admin);
        $this->assertNotNull($admin->fresh()->terakhir_masuk);
    }
    
    // Test 2: Invalid password
    public function test_login_rejects_invalid_password()
    {
        // Create user
        Admin::create([...]);
        
        // Post wrong password
        $response = $this->from(route('login'))
            ->post(route('login'), [
                'email' => 'test@example.com',
                'password' => 'wrong'
            ]);
        
        // Assertions
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
    
    // Test 3: Password rehash
    public function test_login_rehashes_old_password()
    {
        // Create with old rounds
        Hash::setRounds(10);
        $admin = Admin::create(['password' => bcrypt('pass')]);
        
        // Set new rounds
        Hash::setRounds(12);
        
        // Login
        $this->post(route('login'), [...]);

        // Assert rehashed
        $this->assertTrue(Hash::needsRehash($admin->password));
        $this->assertFalse(Hash::needsRehash($admin->fresh()->password));
    }
    
    // Test 4: Logout
    public function test_admin_can_logout()
    {
        $admin = Admin::create([...]);
        $this->actingAs($admin)
            ->post(route('logout'))
            ->assertRedirect(route('login'));
        $this->assertGuest();
    }
}
```

### 5.2 Authorization

**File**: `tests/Feature/AuthorizationTest.php`

```php
class AuthorizationTest extends TestCase
{
    use RefreshDatabase;
    
    // Test: Pengurus tidak bisa akses dashboard Pemda
    public function test_pengurus_cannot_access_pemda_dashboard()
    {
        $pengurus = Admin::create(['peran' => 'pengurus_ormada', ...]);
        $this->actingAs($pengurus)
            ->get(route('pemda.dashboard'))
            ->assertStatus(403);
    }
    
    // Test: Pengurus tidak bisa edit proposal orang lain
    public function test_pengurus_cannot_edit_others_proposal()
    {
        $owner = Admin::create(['peran' => 'pengurus_ormada']);
        $other = Admin::create(['peran' => 'pengurus_ormada']);
        $proposal = Proposal::create(['pengurus_id' => $owner->id, ...]);
        
        $this->actingAs($other)
            ->put(route('pengurus.proposal.update', $proposal))
            ->assertStatus(403);
    }
    
    // Test: Guest bisa lihat postingan published
    public function test_guest_can_view_published_postingan()
    {
        $postingan = Postingan::create(['status' => 'published', ...]);
        $this->get(route('postingan.show', $postingan))
            ->assertStatus(200);
    }
    
    // Test: Guest tidak bisa create postingan
    public function test_guest_cannot_create_postingan()
    {
        $this->get(route('pengurus.postingan.create'))
            ->assertRedirect(route('login'));
    }
}
```

### 5.3 CRUD Operations

**File**: `tests/Feature/ProfilOrmadaTest.php`

```php
class ProfilOrmadaTest extends TestCase
{
    use RefreshDatabase;
    
    // Create
    public function test_pengurus_can_create_profil()
    {
        $pengurus = Admin::create(['peran' => 'pengurus_ormada']);
        $this->actingAs($pengurus)
            ->post(route('pengurus.profil.store'), [
                'nama_ormada' => 'Ormada A',
                'alamat' => 'Jl. Test',
                // ...
            ])
            ->assertRedirect();
        
        $this->assertDatabaseHas('profil_ormada', [
            'pengurus_id' => $pengurus->id,
            'nama_ormada' => 'Ormada A'
        ]);
    }
    
    // Unique constraint (one profil per pengurus)
    public function test_pengurus_cannot_have_multiple_profil()
    {
        $pengurus = Admin::create(['peran' => 'pengurus_ormada']);
        ProfilOrmada::create(['pengurus_id' => $pengurus->id]);
        
        $this->actingAs($pengurus)
            ->post(route('pengurus.profil.store'), [...])
            ->assertSessionHasErrors();
    }
    
    // Read (own)
    public function test_pengurus_can_view_own_profil()
    {
        $profil = ProfilOrmada::factory()->create();
        $this->actingAs($profil->pengurus)
            ->get(route('pengurus.profil.show', $profil))
            ->assertStatus(200);
    }
    
    // Read (public)
    public function test_guest_can_view_published_profil()
    {
        $profil = ProfilOrmada::factory()->create();
        $this->get(route('ormada.show', $profil))
            ->assertStatus(200);
    }
    
    // Update (own)
    public function test_pengurus_can_update_own_profil()
    {
        $profil = ProfilOrmada::factory()->create();
        $this->actingAs($profil->pengurus)
            ->put(route('pengurus.profil.update', $profil), [
                'nama_ormada' => 'Updated Name'
            ])
            ->assertRedirect();
        
        $this->assertEquals('Updated Name', $profil->fresh()->nama_ormada);
    }
    
    // Cannot update others
    public function test_pengurus_cannot_update_others_profil()
    {
        $profil = ProfilOrmada::factory()->create();
        $other = Admin::factory()->create(['peran' => 'pengurus_ormada']);
        
        $this->actingAs($other)
            ->put(route('pengurus.profil.update', $profil), [...])
            ->assertStatus(403);
    }
}
```

### 5.4 File Upload

**File**: `tests/Feature/ProposalTest.php`

```php
class ProposalTest extends TestCase
{
    use RefreshDatabase;
    
    // Success upload
    public function test_pengurus_can_upload_proposal_with_valid_document()
    {
        Storage::fake('documents');
        $pengurus = Admin::create(['peran' => 'pengurus_ormada']);
        $pemda = Admin::create(['peran' => 'pemda']);
        
        $file = UploadedFile::fake()->create('proposal.pdf', 100);
        
        $this->actingAs($pengurus)
            ->post(route('pengurus.proposal.store'), [
                'pemda_tujuan_id' => $pemda->id,
                'judul' => 'Proposal Bantuan',
                'dokumen' => $file,
                // ...
            ])
            ->assertRedirect();
        
        $this->assertDatabaseHas('proposal', [
            'pengurus_id' => $pengurus->id,
            'pemda_tujuan_id' => $pemda->id,
        ]);
        
        Storage::disk('documents')->assertExists($file->hashName());
    }
    
    // Invalid type
    public function test_proposal_rejects_invalid_file_type()
    {
        $pengurus = Admin::create(['peran' => 'pengurus_ormada']);
        $file = UploadedFile::fake()->create('proposal.exe', 100);
        
        $this->actingAs($pengurus)
            ->post(route('pengurus.proposal.store'), [
                'dokumen' => $file,
                // ...
            ])
            ->assertSessionHasErrors('dokumen');
    }
    
    // Exceed size
    public function test_proposal_rejects_file_exceeds_max_size()
    {
        $pengurus = Admin::create(['peran' => 'pengurus_ormada']);
        $file = UploadedFile::fake()->create('proposal.pdf', 6000); // 6MB
        
        $this->actingAs($pengurus)
            ->post(route('pengurus.proposal.store'), [
                'dokumen' => $file,
                // ...
            ])
            ->assertSessionHasErrors('dokumen');
    }
    
    // Status workflow
    public function test_pemda_can_update_proposal_status()
    {
        $pengurus = Admin::create(['peran' => 'pengurus_ormada']);
        $pemda = Admin::create(['peran' => 'pemda']);
        $proposal = Proposal::create([
            'pengurus_id' => $pengurus->id,
            'pemda_tujuan_id' => $pemda->id,
            'status' => 'diajukan'
        ]);
        
        $this->actingAs($pemda)
            ->post(route('pemda.proposal.proses', $proposal), [
                'status' => 'diproses_pemda',
                'catatan' => 'Sedang ditinjau'
            ])
            ->assertRedirect();
        
        $this->assertEquals('diproses_pemda', $proposal->fresh()->status);
    }
}
```

### 5.5 Volunteer Logic

**File**: `tests/Feature/VolunteerTest.php`

```php
class VolunteerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_guest_can_register_volunteer_for_published_agenda()
    {
        $agenda = Agenda::create([
            'status_publish' => true,
            'tanggal_mulai' => now()->addDays(5),
            'kuota' => 10,
            'deadline_pendaftaran' => now()->addDays(2),
            // ...
        ]);
        
        $response = $this->post(route('agenda.volunteer.daftar', $agenda), [
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'no_hp' => '081234567890',
        ]);
        
        $response->assertRedirect();
        $this->assertDatabaseHas('volunteer', [
            'agenda_id' => $agenda->id,
            'email' => 'john@example.com',
            'status' => 'pending'
        ]);
    }
    
    // Prevent duplicate
    public function test_guest_cannot_register_twice_for_same_agenda()
    {
        $agenda = Agenda::factory()->published()->create();
        
        // First registration
        $this->post(route('agenda.volunteer.daftar', $agenda), [
            'email' => 'test@example.com',
            // ...
        ]);
        
        // Duplicate attempt
        $this->post(route('agenda.volunteer.daftar', $agenda), [
            'email' => 'test@example.com',
            // ...
        ])
        ->assertSessionHasErrors();
    }
    
    // Kuota check
    public function test_volunteer_rejected_when_quota_full()
    {
        $agenda = Agenda::factory()->published()->create(['kuota' => 2]);
        
        // Fill quota
        Volunteer::factory()->count(2)->create([
            'agenda_id' => $agenda->id,
            'status' => 'diterima'
        ]);
        
        // Try to register
        $this->post(route('agenda.volunteer.daftar', $agenda), [
            'nama' => 'New Volunteer',
            'email' => 'new@example.com',
            'no_hp' => '081234567890',
        ]);
        
        $this->assertDatabaseMissing('volunteer', [
            'email' => 'new@example.com'
        ]);
    }
    
    // Only accepted counts toward quota
    public function test_only_accepted_volunteers_count_toward_quota()
    {
        $agenda = Agenda::factory()->published()->create(['kuota' => 1]);
        
        // Pending volunteer (shouldn't count)
        Volunteer::factory()->create([
            'agenda_id' => $agenda->id,
            'status' => 'pending'
        ]);
        
        // Should still be able to register
        $this->post(route('agenda.volunteer.daftar', $agenda), [
            'nama' => 'John',
            'email' => 'john@example.com',
            'no_hp' => '081234567890',
        ])
        ->assertSessionHasNoErrors();
    }
    
    // Age check (deadline)
    public function test_volunteer_rejected_after_deadline()
    {
        $agenda = Agenda::create([
            'status_publish' => true,
            'deadline_pendaftaran' => now()->subDay(), // yesterday
            // ...
        ]);
        
        $this->post(route('agenda.volunteer.daftar', $agenda), [...])
            ->assertSessionHasErrors();
    }
}
```

## 6. Test Data Management

### 6.1 Factories (Recommended Future)

```php
// database/factories/AdminFactory.php
$factory->define(Admin::class, function (Faker $faker) {
    return [
        'nama' => $faker->name(),
        'email' => $faker->unique()->safeEmail(),
        'password' => bcrypt('password'),
        'peran' => $faker->randomElement(['admin', 'pemda', 'pengurus_ormada']),
    ];
});
```

**Usage**:
```php
$admin = Admin::factory()->create(['peran' => 'pengurus_ormada']);
$profil = ProfilOrmada::factory()->create(['pengurus_id' => $admin->id]);
```

### 6.2 Direct Creation (Current Approach)

```php
$pengurus = Admin::create([
    'nama' => 'Pengurus Test',
    'email' => 'pengurus@test.com',
    'password' => bcrypt('password'),
    'peran' => 'pengurus_ormada',
]);
```

**Trade-off**: More explicit but verbose. Factories recommended untuk refactor.

## 7. CI/CD Integration

### 7.1 GitHub Actions Workflow

**File**: `.github/workflows/tests.yml`

```yaml
name: Tests

on: [push, pull_request]

jobs:
  test:
    runs-on: ubuntu-latest
    
    services:
      mysql:
        image: mysql:8.0
        env:
          MYSQL_ROOT_PASSWORD: root
          MYSQL_DATABASE: testing
        ports:
          - 3306:3306
    
    steps:
      - uses: actions/checkout@v4
      
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
          extensions: mbstring, bcmath, pdo_mysql
      
      - name: Install Dependencies
        run: |
          cp .env.example .env
          composer install --no-interaction
          npm install
      
      - name: Generate Key
        run: php artisan key:generate
      
      - name: Run Migrations
        run: php artisan migrate --force --env=testing
        env:
          DB_CONNECTION: mysql
          DB_HOST: 127.0.0.1
          DB_PORT: 3306
          DB_DATABASE: testing
          DB_USERNAME: root
          DB_PASSWORD: root
      
      - name: Run Tests
        run: php artisan test --coverage --min=80
```

### 7.2 Coverage Enforcement

```bash
# Run tests with coverage
php artisan test --coverage

# Run specific test file
php artisan test tests/Feature/ProposalTest.php

# Run with minimum coverage (fail if < 80%)
php artisan test --coverage --min=80
```

## 8. Test Execution Guide

### 8.1 Local Setup

```bash
# 1. Clone & install
git clone https://github.com/suutanakbar/magang.git
cd magang
composer install
npm install

# 2. Setup .env
cp .env.example .env
php artisan key:generate

# 3. Setup database
# Edit .env: DB_DATABASE=testing, DB_USERNAME=root, DB_PASSWORD=

# 4. Run migrations
php artisan migrate --env=testing

# 5. Run all tests
php artisan test

# 6. Run specific test
php artisan test tests/Feature/ProposalTest.php

# 7. Run with coverage
php artisan test --coverage
```

### 8.2 Current Test Files

| File | Test Count | Description |
|---|---|---|
| `tests/Feature/AdminLoginTest.php` | 4 | Login, logout, password rehash |
| `tests/Feature/AgendaTest.php` | - | Agenda CRUD & publish |
| `tests/Feature/AspirasiTest.php` | - | Aspirasi creation & response |
| `tests/Feature/PostinganTest.php` | - | Postingan CRUD & publish |
| `tests/Feature/ProposalTest.php` | - | Proposal workflow |
| `tests/Feature/PublicDashboardTest.php` | - | Public access to portal |
| `tests/Feature/ExampleTest.php` | - | Placeholder |

### 8.3 Test Maintenance

**Before adding new feature**:
1. Write failing test (TDD approach)
2. Run test: `php artisan test` (should fail)
3. Implement feature
4. Run test: `php artisan test` (should pass)
5. Check coverage: `php artisan test --coverage`

**Refactoring**:
1. Run existing tests
2. Refactor code
3. Run tests again
4. Cover edge cases discovered during refactor

## 9. Best Practices

### 9.1 Naming Convention

```php
// Method: test_[subject]_[action]_[expected_result]
public function test_guest_cannot_create_proposal() { ... }
public function test_pengurus_can_update_own_postingan() { ... }
public function test_admin_can_delete_any_agenda() { ... }

// Avoid vague names
// ❌ public function test_creation() { ... }
// ✅ public function test_pengurus_can_create_profil_ormada() { ... }
```

### 9.2 Assertions Priority

```php
// 1. HTTP status
$response->assertStatus(200);
$response->assertRedirect();
$response->assertForbidden(); // 403

// 2. Authentication
$this->assertAuthenticatedAs($user);
$this->assertGuest();

// 3. Database
$this->assertDatabaseHas('table', ['column' => 'value']);
$this->assertDatabaseMissing('table', [...]);

// 4. Session
$response->assertSessionHasErrors('field');
$response->assertSessionHas('key', 'value');

// 5. View/JSON
$response->assertViewHas('data', $value);
$response->assertJsonFragment([...]);

// 6. File
Storage::fake()->assertExists('file.pdf');
Storage::fake()->assertMissing('file.pdf');
```

### 9.3 Test Isolation

- Each test should be independent (use RefreshDatabase)
- Don't depend on execution order
- Clean up after uploads (use Storage::fake())
- Use database transactions where possible

### 9.4 Edge Cases to Cover

```php
// Boundary values
- Empty strings
- NULL values
- Maximum length strings
- Zero values
- Negative values

// Business rules
- Duplicate prevention (unique constraints)
- Status transitions (diajukan → diproses_pemda)
- Date/time boundaries (deadline passed)
- Quota limits

// Security
- SQL injection (Laravel handles, but test raw inputs)
- XSS in user input
- CSRF token validation
- Session fixation
- Authorization bypass attempts
```

## 10. Troubleshooting

### 10.1 Common Issues

**Issue**: `RefreshDatabase` not working
```php
// Ensure .env has testing database configured
// DB_CONNECTION=mysql
// DB_DATABASE=testing
// Run: php artisan migrate --env=testing
```

**Issue**: File upload test failing
```php
// Use Storage::fake() before test
protected function setUp(): void
{
    parent::setUp();
    Storage::fake('documents');
}
```

**Issue**: Authentication not persisting
```php
// Use actingAs() for authenticated user
$this->actingAs($admin, 'admin'); // 'admin' = guard name
```

**Issue**: Factory not defined
```php
// Create via admin factory
// Option 1: Create manually (current)
$admin = Admin::create([...]);

// Option 2: Create factory
$admin = Admin::factory()->create([...]);
```

## 11. Test Metrics

### 11.1 Coverage Goals

| Module | Line Coverage | Branch Coverage |
|---|---|---|
| Authentication | 100% | 100% |
| Authorization | 95% | 95% |
| CRUD Operations | 90% | 85% |
| Business Logic | 85% | 80% |
| **Overall Target** | **≥80%** | **≥75%** |

### 11.2 Success Criteria

- [ ] All tests pass (green)
- [ ] Coverage ≥ 80% overall
- [ ] No skipped tests
- [ ] No test flakiness (run 3x, all pass)
- [ ] PRD critical paths fully covered

## 12. Appendix

### 12.1 Useful Assertions

```php
// HTTP
assertOk()
assertStatus($code)
assertRedirect($uri)
assertForbidden()
assertNotFound()
assertDontSee('text') // not in HTML

// Session
assertSessionHas('key', $value)
assertSessionHasErrors('field')
assertSessionHasNoErrors()

// Database
assertDatabaseHas('table', $data)
assertDatabaseMissing('table', $data)
assertSoftDeleted('table', $data)

// JSON
assertJson($data)
assertJsonFragment($fragment)
assertJsonPath('path', $value)

// View
assertViewIs('view.name')
assertViewHas('key', $value)
assertViewHasAll(['key1', 'key2'])

// Others
assertAuthenticated()
assertGuest()
assertAuthenticatedAs($user)
assertValid($validator)
```

### 12.2 Test Helpers

```php
// Acting as user
$this->actingAs($admin);
$this->actingAs($admin, 'admin-guard');

// JSON requests
$this->json('GET', '/api/users');
$this->json('POST', '/api/users', $data);

// With headers
$this->withHeaders([...])->get('/');

// Following redirects
$response->assertFollowsRedirects();
```

## 13. Referensi

- **PRD**: `docs/PRD.md`
- **Laravel Testing Docs**: https://laravel.com/docs/testing
- **PHPUnit Docs**: https://phpunit.de/manual/current/en/
- **Current Tests**: `tests/Feature/*Test.php`
- **Test Base**: `tests/TestCase.php`