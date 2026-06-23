<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Create admin user
User::updateOrCreate(
    ['email' => 'hblackmuyaka@gmail.com'],
    [
        'name' => 'Admin',
        'password' => Hash::make('Zoomtech-243'),
        'is_admin' => true,
    ]
);

echo "Admin account created/updated successfully with is_admin = true.\n";
