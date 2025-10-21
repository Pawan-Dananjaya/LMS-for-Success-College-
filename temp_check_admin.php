<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$u = App\Models\User::where('email', 'admin@admin.com')->first();
if ($u) {
    echo json_encode([
        'id' => $u->id,
        'name' => $u->name,
        'email' => $u->email,
        'role' => $u->role,
        'is_active' => $u->is_active,
    ]) . PHP_EOL;
} else {
    echo "NOT_FOUND\n";
}
