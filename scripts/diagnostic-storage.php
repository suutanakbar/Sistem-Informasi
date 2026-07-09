<?php

// Simple diagnostic script to check storage configuration
// Run with: php scripts/diagnostic-storage.php

// Bootstrap Laravel
require_once __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=========================================\n";
echo "  Storage Diagnostic Tool\n";
echo "=========================================\n\n";

// Check 1: Symlink
echo "1. Checking storage symlink...\n";
$publicStorage = public_path('storage');
if (is_link($publicStorage)) {
    echo "   ✅ Symlink exists: public/storage\n";
    $target = readlink($publicStorage);
    echo "   📁 Target: $target\n";
} else {
    echo "   ❌ Symlink NOT found!\n";
    echo "   💡 Run: php artisan storage:link\n";
}

// Check 2: Storage directories
echo "\n2. Checking storage directories...\n";
$directories = [
    'agenda/poster',
    'postingan/foto',
    'profil-ormada/logo'
];

foreach ($directories as $dir) {
    $path = storage_path("app/public/$dir");
    if (is_dir($path)) {
        $files = glob("$path/*");
        $count = count($files);
        echo "   📁 $dir: $count files\n";
        if ($count > 0) {
            echo "      Recent files:\n";
            foreach (array_slice($files, 0, 3) as $file) {
                echo "      - " . basename($file) . "\n";
            }
        }
    } else {
        echo "   ⚠️  $dir: Directory not found\n";
    }
}

// Check 3: .env configuration
echo "\n3. Checking .env configuration...\n";
$envFile = base_path('.env');
if (file_exists($envFile)) {
    $content = file_get_contents($envFile);
    
    // Check APP_URL
    if (preg_match('/APP_URL=(.+)/', $content, $matches)) {
        $appUrl = trim($matches[1]);
        echo "   🔗 APP_URL: $appUrl\n";
        if ($appUrl === 'http://localhost') {
            echo "   ⚠️  WARNING: APP_URL is still localhost!\n";
            echo "   💡 Update to your actual domain\n";
        }
    }
    
    // Check FILESYSTEM_DISK
    if (preg_match('/FILESYSTEM_DISK=(.+)/', $content, $matches)) {
        $disk = trim($matches[1]);
        echo "   💾 FILESYSTEM_DISK: $disk\n";
        if ($disk !== 'public') {
            echo "   ⚠️  WARNING: Should be 'public'\n";
        }
    }
} else {
    echo "   ❌ .env file not found!\n";
}

// Check 4: Permissions
echo "\n4. Checking permissions...\n";
$folders = [
    storage_path(),
    public_path('storage'),
    storage_path('app/public')
];

foreach ($folders as $folder) {
    if (is_dir($folder)) {
        $perms = substr(sprintf('%o', fileperms($folder)), -4);
        echo "   📂 $folder: $perms\n";
        if ($perms !== '0775' && $perms !== '0755') {
            echo "      ⚠️  Might need permission fix\n";
        }
    }
}

// Check 5: Helper functions
echo "\n5. Checking helper functions...\n";
$helpers = [
    'agenda_poster_url',
    'postingan_foto_url',
    'profil_logo_url',
    'storage_url',
    'file_exists_storage'
];

foreach ($helpers as $helper) {
    if (function_exists($helper)) {
        echo "   ✅ $helper()\n";
    } else {
        echo "   ❌ $helper() NOT FOUND\n";
    }
}

// Check 6: Sample database records
echo "\n6. Checking database records...\n";
try {
    require_once __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    // Check Agenda
    $agendaCount = \App\Models\Agenda::whereNotNull('gambar_poster')->count();
    echo "   📊 Agenda with images: $agendaCount\n";
    
    // Check Postingan
    $postinganCount = \App\Models\Postingan::whereNotNull('foto')->count();
    echo "   📊 Postingan with images: $postinganCount\n";
    
    // Check Profil
    $profilCount = \App\Models\ProfilOrmada::whereNotNull('logo')->count();
    echo "   📊 Profil with logos: $profilCount\n";
    
} catch (Exception $e) {
    echo "   ⚠️  Could not check database: " . $e->getMessage() . "\n";
}

echo "\n=========================================\n";
echo "  Diagnostic Complete\n";
echo "=========================================\n";
echo "\nNext steps:\n";
echo "1. If symlink missing: php artisan storage:link\n";
echo "2. If no files in storage: Re-upload images\n";
echo "3. If permissions wrong: chmod -R 775 storage\n";
echo "4. Clear cache: php artisan config:clear\n";
echo "\n";