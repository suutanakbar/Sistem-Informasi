<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Volunteer;
use App\Models\Agenda;
use Illuminate\Support\Facades\DB;

echo "=== VOLUNTEER DIAGNOSTIC ===\n\n";

// 1. Cek recent volunteers
echo "1. Recent volunteers (last 5):\n";
$volunteers = Volunteer::orderBy('dibuat_pada', 'desc')->limit(5)->get();
foreach ($volunteers as $v) {
    echo "   ID: {$v->id}, Agenda: {$v->agenda_id}, Email: {$v->email}, Status: {$v->status}, Created: {$v->dibuat_pada}\n";
}

// 2. Cek status counts
echo "\n2. Status counts:\n";
$statusCounts = Volunteer::select('status', DB::raw('count(*) as count'))->groupBy('status')->get();
foreach ($statusCounts as $sc) {
    echo "   {$sc->status}: {$sc->count}\n";
}

// 3. Cek agenda yang open
echo "\n3. Published agendas with volunteer quota:\n";
$agendas = Agenda::where('is_published', true)->whereNotNull('kuota_volunteer')->get();
foreach ($agendas as $a) {
    $count = $a->volunteers()->count();
    echo "   Agenda ID: {$a->id}, Kuota: {$a->kuota_volunteer}, Total Pendaftar: {$count}\n";
}

// 4. Cek apakah ada record yang statusnya ditolak baru-baru ini
echo "\n4. Recently rejected volunteers (last 3):\n";
$rejected = Volunteer::where('status', 'ditolak')->orderBy('dibuat_pada', 'desc')->limit(3)->get();
foreach ($rejected as $r) {
    echo "   ID: {$r->id}, Email: {$r->email}, Agenda: {$r->agenda_id}, Created: {$r->dibuat_pada}\n";
}

// 5. Cek table structure
echo "\n5. Volunteers table structure:\n";
$columns = DB::select("DESCRIBE volunteers");
foreach ($columns as $col) {
    echo "   {$col->Field} ({$col->Type}) Default: {$col->Default}\n";
}

// 6. Cek apakah ada foreign key
echo "\n6. Foreign keys on volunteers:\n";
$fks = DB::select("SELECT COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'volunteers' AND REFERENCED_TABLE_NAME IS NOT NULL");
foreach ($fks as $fk) {
    echo "   {$fk->COLUMN_NAME} -> {$fk->REFERENCED_TABLE_NAME}({$fk->REFERENCED_COLUMN_NAME})\n";
}

echo "\n=== DIAGNOSTIC COMPLETE ===\n";