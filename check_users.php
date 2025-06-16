<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->boot();

echo "Usuários criados:\n";
foreach(App\Models\User::all(['name', 'email', 'role']) as $user) {
    echo "- {$user->name} ({$user->email}) - Role: {$user->role}\n";
}
