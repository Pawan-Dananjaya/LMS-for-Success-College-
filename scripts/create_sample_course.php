<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
Illuminate\Foundation\Application::setInstance($app);
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$u = App\Models\User::where('role','admin')->orWhere('role','teacher')->first();
if (!$u) {
    echo "No admin/teacher user found\n";
    exit(1);
}

$c = App\Models\Course::create([
    'title' => 'Sample Course',
    'description' => 'Auto-created sample',
    'grade_level' => '3',
    'subject' => 'Math',
    'teacher_id' => $u->id,
]);

echo "Created course id: {$c->id}\n";
