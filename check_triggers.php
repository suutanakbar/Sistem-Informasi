<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    $triggers = DB::select("SHOW TRIGGERS WHERE `Table` = 'volunteers'");
    
    if (empty($triggers)) {
        echo "Tidak ada trigger di tabel volunteers.\n";
    } else {
        echo "Ditemukan trigger di tabel volunteers:\n";
        foreach ($triggers as $trigger) {
            echo "Nama: " . $trigger->Trigger . "\n";
            echo "Event: " . $trigger->Event . "\n";
            echo "Timing: " . $trigger->Timing . "\n";
            echo "Statement: " . $trigger->Statement . "\n";
            echo "------------------------\n";
        }
    }
    
    // Cek juga trigger lain yang mungkin ngubah volunteers
    $allTriggers = DB::select("SHOW TRIGGERS");
    echo "\nSemua trigger di database:\n";
    foreach ($allTriggers as $trigger) {
        echo "- " . $trigger->Trigger . " pada tabel " . $trigger->Table . "\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}