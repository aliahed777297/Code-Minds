<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$admins = User::where('is_admin', true)->get();
if ($admins->isEmpty()) {
    echo "No admin users found\n";
    exit(0);
}
foreach ($admins as $a) {
    echo $a->id . ' | ' . $a->name . ' | ' . $a->email . PHP_EOL;
}
