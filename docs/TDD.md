# Test Design Document (TDD)

## Sistem Informasi Ormada Temanggung

| Atribut | Nilai |
|---|---|
| Versi | 2.2 |
| Status | Dokumentasi testing terbaru |
| Terakhir diperbarui | 5 Agustus 2026 |
| Sumber acuan | Implementasi commit ce61f8e |
| Framework Testing | PHPUnit 11.5.50 + Laravel 12 Testing |
| Coverage Target | 80% untuk fitur utama |
| Current Test Files | 16 files (15 Feature + 1 Unit) |

## 1. Test Strategy

### 1.1 Tujuan Testing
Memastikan kualitas sistem melalui automated testing untuk:
- Functional correctness (fitur bekerja sesuai spesifikasi)
- Authorization & Access Control (role-based access)
- Data validation & integrity
- File upload/download operations
- Business logic edge cases
- Security vulnerabilities (XSS, CSRF, SQL injection)
- Rate limiting dan race conditions

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
- **PHPUnit 11.5.50**: Framework testing PHP (latest)
- **Laravel 12 Test Case**: `Illuminate\Foundation\Testing\RefreshDatabase`
- **Database**: SQLite in-memory (testing) atau MySQL dedicated test database
- **File Uploads**: `Storage::fake()` untuk testing upload
- **Laravel Pint**: Code style enforcement

### 2.2 Helpers & Traits
```php
use RefreshDatabase;          // Reset database setiap test
use WithFaker;                // Generate fake data
use DatabaseTransactions;     // Rollback setelah test
use Storage::fake();          // Fake file storage
```

## 3. Test Hierarchy

### 3.1 Directory Structure
```
tests/
├── Feature/
│   ├── AdminLoginTest.php
│   ├── AgendaTest.php
│   ├── AgendaUpcomingTest.php
│   ├── AspirasiTest.php
│   ├── ExampleTest.php
│   ├── PostinganTest.php
│   ├── PrivacyTest.php
│   ├── ProposalTest.php
│   ├── PublicDashboardTest.php
│   ├── RateLimitTest.php
│   ├── SessionSecurityTest.php
│   ├── SoftDeleteTest.php
│   ├── StateTransitionTest.php
│   ├── ValidationTest.php
│   ├── VolunteerRaceConditionTest.php
│   └── [Future]:
│       ├── Auth/
│       ├── Admin/
│       ├── Volunteer/
│       ├── Content/
│       ├── Api/
│       ├── Security/
│       └── E2E/
├── Unit/
│   ├── ExampleTest.php
│   └── [Future]:
│       ├── Models/
│       ├── Services/
│       ├── Policies/
│       └── Helpers/
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

| Modul | Feature Tests | Unit Tests | Priority | Target Coverage | Current Status |
|---|---|---|---|---|---|
| **Authentication** | AdminLoginTest | - | P0 | 100% | ✅ 4 tests |
| **Authorization** | PrivacyTest, SessionSecurityTest | - | P0 | 100% | ✅ Implemented |
| **Profil Ormada** | - | - | P0 | 90% | ⚠️ Needs tests |
| **Anggota Ormada** | - | - | P0 | 90% | ⚠️ Needs tests |
| **Proposal** | ProposalTest | - | P0 | 90% | ✅ Implemented |
| **Aspirasi** | AspirasiTest | - | P0 | 90% | ✅ Implemented |
| **Postingan** | PostinganTest | - | P0 | 85% | ✅ Implemented |
| **Agenda** | AgendaTest, AgendaUpcomingTest | - | P0 | 90% | ✅ Implemented |
| **Volunteer** | VolunteerRaceConditionTest | - | P0 | 95% | ✅ Implemented |
| **Dashboard** | PublicDashboardTest | - | P1 | 80% | ✅ Implemented |
| **Validation** | ValidationTest | - | P0 | 90% | ✅ Implemented |
| **State Transition** | StateTransitionTest | - | P1 | 85% | ✅ Implemented |
| **Soft Delete** | SoftDeleteTest | - | P1 | 85% | ✅ Implemented |
| **Rate Limiting** | RateLimitTest | - | P0 | 95% | ✅ Implemented |

### 4.2 Scenario Coverage

| Scenario | Description | Type | Priority | Status |
|---|---|---|---|---|
| Happy Path | User biasa melakukan aksi sesuai ekspektasi | Feature | P0 | ✅ Covered |
| Validation Error | Input invalid, missing field, format salah | Feature | P0 | ✅ ValidationTest |
| Authorization Denied | User akses resource milik orang lain | Feature | P0 | ✅ PrivacyTest |
| Guest Access | Tamu akses halaman yang butuh login | Feature | P0 | ✅ SessionSecurityTest |
| Role-based Access | Test setiap role punya access sesuai matriks | Feature | P0 | ✅ Multiple tests |
| File Upload | Success, invalid type, exceed size | Feature | P0 | ⚠️ Partial |
| Pagination | Kurang/page, lebih/page, edge case | Feature | P1 | ⚠️ Needs tests |
| Soft Delete | Data removed tapi bisa di-restore | Feature | P1 | ✅ SoftDeleteTest |
| Search & Filter | Query filter berfungsi | Feature | P1 | ⚠️ Needs tests |
| Race Condition | Concurrent requests causing quota overflow | Feature | P0 | ✅ VolunteerRaceConditionTest |
| State Transition | Valid/invalid status changes | Feature | P1 | ✅ StateTransitionTest |
| Rate Limiting | Throttle enforcement | Feature | P0 | ✅ RateLimitTest |

## 5. Existing Test Cases Analysis

### 5.1 AdminLoginTest.php
**Tests**: 4
- ✅ test_admin_can_login_using_email_and_password
- ✅ test_login_rejects_invalid_password
- ✅ test_login_rehashes_old_password
- ✅ test_admin_can_logout

**Coverage**: Authentication flow, password hashing, session management

### 5.2 AgendaTest.php
**Tests**: Multiple CRUD tests
- ✅ Agenda creation, update, delete
- ✅ Publish/unpublish workflow
- ✅ Authorization checks
- ✅ Calendar events API

**Coverage**: Agenda management, publish workflow, authorization

### 5.3 AgendaUpcomingTest.php
**Tests**: Upcoming agenda logic
- ✅ Filter upcoming agendas
- ✅ Date validation
- ✅ Public access to upcoming events

**Coverage**: Business logic for agenda display

### 5.4 AspirasiTest.php
**Tests**: Aspirasi management
- ✅ Create aspirasi
- ✅ View aspirasi (public & authenticated)
- ✅ Authorization checks
- ✅ Tanggapan workflow

**Coverage**: Aspirasi CRUD, response workflow, public access

### 5.5 PostinganTest.php
**Tests**: Postingan management
- ✅ Create, edit, delete postingan
- ✅ Draft/publish workflow
- ✅ Filter by kategori
- ✅ Authorization checks

**Coverage**: Postingan CRUD, publish workflow, categorization

### 5.6 ProposalTest.php
**Tests**: Proposal management
- ✅ Create proposal with file upload
- ✅ Status updates (diajukan → diproses_pemda → dana_cair/ditolak)
- ✅ Authorization (pengurus creates, pemda processes)
- ✅ File validation (type, size)

**Coverage**: Proposal workflow, file upload, status transitions

### 5.7 PublicDashboardTest.php
**Tests**: Public portal access
- ✅ View public dashboard
- ✅ Access published content
- ✅ Statistics display
- ✅ Navigation

**Coverage**: Public routes, content aggregation

### 5.8 RateLimitTest.php
**Tests**: Rate limiting
- ✅ Volunteer registration throttle (5 attempts/minute)
- ✅ IP-based limiting
- ✅ Proper error messages

**Coverage**: Rate limiting enforcement

### 5.9 SessionSecurityTest.php
**Tests**: Session security
- ✅ Session regeneration after login
- ✅ Logout clears session
- ✅ CSRF token validation

**Coverage**: Session security best practices

### 5.10 SoftDeleteTest.php
**Tests**: Soft delete functionality
- ✅ Soft delete models
- ✅ Restore deleted models
- ✅ Force delete
- ✅ Exclude from queries

**Coverage**: Soft delete for sensitive data

### 5.11 StateTransitionTest.php
**Tests**: State machine validation
- ✅ Valid status transitions
- ✅ Invalid transition rejection
- ✅ Business rules enforcement

**Coverage**: State machine for proposals, volunteer, etc.

### 5.12 ValidationTest.php
**Tests**: Form validation
- ✅ Required fields
- ✅ Email validation
- ✅ File upload validation
- ✅ Custom validation rules

**Coverage**: Server-side validation

### 5.13 VolunteerRaceConditionTest.php
**Tests**: Concurrency handling
- ✅ Quota overflow prevention
- ✅ Race condition handling
- ✅ Atomic operations

**Coverage**: Race condition prevention

### 5.14 PrivacyTest.php
**Tests**: Data privacy
- ✅ Sensitive data protection
- ✅ Role-based data visibility
- ✅ Personal data access control

**Coverage**: Privacy compliance

## 6. Test Data Management

### 6.1 Current Approach (Direct Creation)

```php
// Example from existing tests
$pengurus = Admin::create([
    'nama' => 'Pengurus Test',
    'email' => 'pengurus@test.com',
    'password' => bcrypt('password'),
    'peran' => 'pengurus_ormada',
]);

$profil = ProfilOrmada::create([
    'pengurus_id' => $pengurus->id,
    'nama_ormada' => 'Ormada Test',
    // ...
]);
```

**Pros**: Explicit, readable
**Cons**: Verbose, repetitive

### 6.2 Recommended: Factories (Future Enhancement)

```php
// database/factories/AdminFactory.php
$factory->define(Admin::class, function (Faker $faker) {
    return [
        'nama' => $faker->name(),
        'email' => $faker->unique()->safeEmail(),
        'password' => bcrypt('password'),
        'peran' => $faker->randomElement(['admin', 'pemda', 'pengurus_ormada']),
        'terakhir_masuk' => now(),
    ];
});

// Usage
$admin = Admin::factory()->create(['peran' => 'pemda']);
$agenda = Agenda::factory()->published()->create();
$volunteers = Volunteer::factory()->count(5)->create(['agenda_id' => $agenda->id]);
```

**Migration Strategy**: Gradually introduce factories while maintaining existing tests

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
          extensions: mbstring, bcmath, pdo_mysql, zip
          
      - name: Install Dependencies
        run: |
          cp .env.example .env
          composer install --no-interaction --prefer-dist
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
# Run all tests with coverage
php artisan test --coverage

# Run specific test file
php artisan test tests/Feature/AgendaTest.php

# Run with minimum coverage (fail if < 80%)
php artisan test --coverage --min=80

# Run tests in parallel (requires setup)
php artisan test --parallel
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

# 8. Run specific test with filter
php artisan test --filter=test_admin_can_login
```

### 8.2 Current Test Files Summary

| File | Tests | Description | Status |
|---|---|---|---|
| `AdminLoginTest.php` | 4 | Login, logout, password rehash | ✅ Complete |
| `AgendaTest.php` | 10+ | Agenda CRUD, publish, calendar | ✅ Complete |
| `AgendaUpcomingTest.php` | 5+ | Upcoming agenda logic | ✅ Complete |
| `AspirasiTest.php` | 8+ | Aspirasi CRUD, tanggapan | ✅ Complete |
| `PostinganTest.php` | 8+ | Postingan CRUD, publish | ✅ Complete |
| `ProposalTest.php` | 8+ | Proposal workflow, file upload | ✅ Complete |
| `PublicDashboardTest.php` | 6+ | Public portal access | ✅ Complete |
| `RateLimitTest.php` | 4+ | Volunteer registration throttle | ✅ Complete |
| `SessionSecurityTest.php` | 5+ | Session regeneration, CSRF | ✅ Complete |
| `SoftDeleteTest.php` | 6+ | Soft delete operations | ✅ Complete |
| `StateTransitionTest.php` | 6+ | Status transitions | ✅ Complete |
| `ValidationTest.php` | 10+ | Form validation | ✅ Complete |
| `VolunteerRaceConditionTest.php` | 5+ | Quota overflow prevention | ✅ Complete |
| `PrivacyTest.php` | 6+ | Data privacy, role access | ✅ Complete |
| `ExampleTest.php` | 1 | Placeholder | ⚠️ Can be removed |

**Total Estimated Tests**: 100+ test methods

### 8.3 Test Maintenance

**Before adding new feature**:
1. Write failing test (TDD approach)
2. Run test: `php artisan test` (should fail)
3. Implement feature
4. Run test: `php artisan test` (should pass)
5. Check coverage: `php artisan test --coverage`

**Refactoring**:
1. Run existing tests: `php artisan test`
2. Refactor code
3. Run tests again: `php artisan test`
4. Cover edge cases discovered during refactor

## 9. Test Standards & Best Practices

### 9.1 Naming Convention

```php
// Method: test_[subject]_[action]_[expected_result]
public function test_guest_cannot_create_proposal() { ... }
public function test_pengurus_can_update_own_postingan() { ... }
public function test_admin_can_delete_any_agenda() { ... }
public function test_volunteer_rejected_after_deadline() { ... }

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
$this->assertSoftDeleted('table', $data);

// 4. Session
$response->assertSessionHasErrors('field');
$response->assertSessionHas('key', 'value');
$response->assertSessionHasNoErrors();

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
- Reset state between tests

### 9.4 Edge Cases to Cover

```php
// Boundary values
- Empty strings
- NULL values
- Maximum length strings
- Zero values
- Negative values
- Boundary dates (deadline passed, future dates)

// Business rules
- Duplicate prevention (unique constraints)
- Status transitions (diajukan → diproses_pemda)
- Date/time boundaries (deadline passed)
- Quota limits
- Rate limiting thresholds

// Security
- SQL injection (Laravel handles, but test raw inputs)
- XSS in user input
- CSRF token validation
- Session fixation
- Authorization bypass attempts
- Race conditions

// Error handling
- Invalid file types
- File size exceeded
- Network timeouts (mocked)
- Concurrent modifications
```

## 10. Coverage Goals & Metrics

### 10.1 Current Status

| Metric | Target | Current (Est.) | Status |
|---|---|---|---|
| Overall Coverage | ≥ 80% | ~75% | ⚠️ Close |
| Feature Tests | ≥ 90% | ~85% | ✅ Good |
| Unit Tests | ≥ 75% | ~60% | ⚠️ Needs work |
| Critical Paths | 100% | ~95% | ✅ Good |

### 10.2 Priority Areas for New Tests

**High Priority (Add immediately)**:
1. Profil Ormada CRUD tests
2. Anggota Ormada CRUD tests
3. File upload edge cases
4. Pagination tests
5. Search & filter tests

**Medium Priority (Add this sprint)**:
1. Unit tests for Models
2. Policy tests
3. Helper tests
4. Integration tests for complex workflows

**Low Priority (Add next sprint)**:
1. Performance tests
2. Load tests
3. E2E tests with browser automation

## 11. Troubleshooting

### 11.1 Common Issues

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
// Option 1: Create manually (current approach)
$admin = Admin::create([...]);

// Option 2: Create factory (future)
$admin = Admin::factory()->create([...]);
```

**Issue**: Race condition in volunteer tests
```php
// Use DatabaseTransactions to prevent race conditions
use DatabaseTransactions;

// Or use lock() for atomic operations
DB::transaction(function () {
    // Your test code
});
```

## 12. TDD Workflow

### 12.1 Red-Green-Refactor Cycle

```
1. RED: Write failing test
   ├─ Write test method
   ├─ Run test: php artisan test
   └─ Verify it FAILS

2. GREEN: Write minimal code to pass
   ├─ Implement feature
   ├─ Run test: php artisan test
   └─ Verify it PASSES

3. REFACTOR: Clean up code
   ├─ Improve implementation
   ├─ Run test: php artisan test
   └─ Verify all tests still PASS

4. COMMIT: Save progress
   └─ git commit -m "feat: add volunteer registration with quota validation"
```

### 12.2 Example TDD Session

```php
// 1. RED - Write failing test
public function test_volunteer_rejected_when_quota_full()
{
    $agenda = Agenda::factory()->published()->create(['kuota' => 2]);
    
    Volunteer::factory()->count(2)->create([
        'agenda_id' => $agenda->id,
        'status' => 'diterima'
    ]);
    
    $this->post(route('agenda.volunteer.daftar', $agenda), [...])
        ->assertSessionHasErrors();
}

// 2. Run test (FAILS)
// php artisan test --filter=test_volunteer_rejected_when_quota_full

// 3. GREEN - Implement minimal code
// In AgendaController@daftarVolunteer:
if ($agenda->volunteers()->where('status', 'diterima')->count() >= $agenda->kuota) {
    return back()->withErrors(['email' => 'Kuota volunteer telah penuh']);
}

// 4. Run test (PASSES)
// php artisan test --filter=test_volunteer_rejected_when_quota_full

// 5. REFACTOR - Extract to service if needed
// Move quota check to AgendaService::checkQuotaAvailability()

// 6. Run all tests
// php artisan test
```

## 13. Future Enhancements

### 13.1 Planned Tests (Next Sprint)

```php
// Profile & Anggota Tests
tests/Feature/ProfilOrmadaTest.php
tests/Feature/AnggotaOrmadaTest.php

// Advanced Feature Tests
tests/Feature/PengumumanTest.php
tests/Feature/CalendarTest.php
tests/Feature/SearchFilterTest.php

// Security Tests
tests/Feature/Security/XssProtectionTest.php
tests/Feature/Security/SqlInjectionTest.php
tests/Feature/Security/UnauthorizedAccessTest.php

// Unit Tests
tests/Unit/Models/ProfilOrmadaModelTest.php
tests/Unit/Models/AnggotaOrmadaModelTest.php
tests/Unit/Policies/AgendaPolicyTest.php
tests/Unit/Services/AgendaServiceTest.php

// Integration Tests
tests/Feature/Integration/VolunteerRegistrationFlowTest.php
tests/Feature/Integration/ProposalApprovalFlowTest.php
```

### 13.2 Testing Improvements

1. **Add Factories**: Reduce boilerplate in test data creation
2. **Add Test Traits**: Reusable test methods for common scenarios
3. **Add Test Helpers**: Custom assertions for business logic
4. **Add Performance Tests**: Load testing for critical endpoints
5. **Add E2E Tests**: Browser automation with Laravel Dusk

## 14. Referensi

- **PRD**: `docs/PRD.md`
- **Laravel Testing Docs**: https://laravel.com/docs/testing
- **PHPUnit Docs**: https://phpunit.de/manual/current/en/
- **Current Tests**: `tests/Feature/*Test.php`
- **Test Base**: `tests/TestCase.php`
- **Latest Commit**: ce61f8e
- **Framework**: Laravel 12 with PHPUnit 11.5.50

## 15. Appendix

### 15.1 Useful Assertions

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

### 15.2 Test Helpers

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

// Without middleware
Route::withoutMiddleware([RateLimiter::class])->get('/');

// Mocking
Storage::fake('local');
Notification::fake();
Mail::fake();
```

### 15.3 Test Organization Tips

```
Group related tests in classes:
- AdminLoginTest: All login/logout scenarios
- AgendaTest: All agenda CRUD operations
- VolunteerTest: All volunteer-related tests

Use test methods for specific scenarios:
- test_[role]_can_[action]
- test_[role]_cannot_[action]
- test_[feature]_rejects_[invalid_input]

Add data providers for multiple scenarios:
/**
 * @dataProvider invalidEmailProvider
 */
public function test_login_rejects_invalid_email($email)
{
    // Test with multiple invalid emails
}