<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'hblackmuyaka@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Zoomtech-243'),
                'is_admin' => true,
                'role' => 'admin',
                'approval_status' => 'approved',
            ]
        );

        $this->command->info('Admin user created successfully!');
    }
}
