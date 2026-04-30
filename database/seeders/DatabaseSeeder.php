<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@asabri.com',
            'password' => Hash::make('password123'),
            'role' => 'superadmin',
        ]);

        // Call other seeders
        $this->call([
            DocumentCategorySeeder::class,
        ]);
    }
}