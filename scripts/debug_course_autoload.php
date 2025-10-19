<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
Illuminate\Foundation\Application::setInstance($app);
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$path = __DIR__ . '/../app/Models/Course.php';
$contents = file_get_contents($path);
$first = substr($contents, 0, 8);
$hex = bin2hex($first);
echo "Course.php first bytes (hex): $hex\n";

echo "class_exists App\\Models\\Course: ";
var_export(class_exists('App\\Models\\Course'));
echo "\n\n";

echo "Declared classes (last 10):\n";
$decl = array_slice(get_declared_classes(), -10);
print_r($decl);
