<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Admin;
use App\Models\Agenda;
use App\Models\Postingan;
use App\Models\Proposal;
use App\Models\Aspirasi;

// Create test users
$admin = Admin::factory()->create(['peran' => 'admin']);
$pengurus = Admin::factory()->create(['peran' => 'pengurus_ormada']);

echo "Testing Delete Authorization:\n";
echo "================================\n\n";

// Test 1: Admin can delete any agenda
$agenda = Agenda::factory()->create(['admin_id' => $pengurus->id]);
$canDelete = $admin->can('delete', $agenda);
echo "1. Admin can delete pengurus's agenda: " . ($canDelete ? "✓ PASS" : "✗ FAIL") . "\n";

// Test 2: Pengurus can delete their own agenda
$canDeleteOwn = $pengurus->can('delete', $agenda);
echo "2. Pengurus can delete own agenda: " . ($canDeleteOwn ? "✓ PASS" : "✗ FAIL") . "\n";

// Test 3: Admin can delete any postingan
$postingan = Postingan::factory()->create(['admin_id' => $pengurus->id]);
$canDelete = $admin->can('delete', $postingan);
echo "3. Admin can delete pengurus's postingan: " . ($canDelete ? "✓ PASS" : "✗ FAIL") . "\n";

// Test 4: Pengurus can delete their own postingan
$canDeleteOwn = $pengurus->can('delete', $postingan);
echo "4. Pengurus can delete own postingan: " . ($canDeleteOwn ? "✓ PASS" : "✗ FAIL") . "\n";

// Test 5: Admin can delete any proposal
$proposal = Proposal::create([
    'admin_id' => $pengurus->id,
    'dinas_tujuan_id' => $admin->id,
    'judul_kegiatan' => 'Test Proposal',
    'deskripsi_kegiatan' => 'Test description',
    'jenis_bantuan' => 'dana',
    'file_proposal' => 'proposal/test.pdf',
    'status' => 'diajukan',
]);
$canDelete = $admin->can('delete', $proposal);
echo "5. Admin can delete pengurus's proposal: " . ($canDelete ? "✓ PASS" : "✗ FAIL") . "\n";

// Test 6: Pengurus can delete their own proposal
$canDeleteOwn = $pengurus->can('delete', $proposal);
echo "6. Pengurus can delete own proposal: " . ($canDeleteOwn ? "✓ PASS" : "✗ FAIL") . "\n";

// Test 7: Admin can delete any aspirasi
$profilOrmada = \App\Models\ProfilOrmada::create([
    'admin_id' => $pengurus->id,
    'nama_ormada' => 'Test Ormada',
    'nama_universitas' => 'Test University',
]);
$aspirasi = Aspirasi::create([
    'topik_aspirasi' => 'Test Aspirasi',
    'detail_aspirasi' => 'Test detail',
    'profil_ormada_id' => $profilOrmada->id,
    'status' => 'belum_ditanggapi',
]);
$canDelete = $admin->can('delete', $aspirasi);
echo "7. Admin can delete any aspirasi: " . ($canDelete ? "✓ PASS" : "✗ FAIL") . "\n";

echo "\n================================\n";
echo "Delete authorization test complete!\n";