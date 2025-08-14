<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create an owner user for testing
        User::updateOrCreate(
            ['email' => 'owner@egysyr.com'],
            [
                'first_name' => 'System',
                'last_name' => 'Owner',
                'name' => 'System Owner',
                'username' => 'owner',
                'email' => 'owner@egysyr.com',
                'password' => Hash::make('Password123!'),
                'role' => 'owner',
                'status' => 'approved',
                'email_verified_at' => now(),
            ]
        );

        // Create an admin user for testing
        User::updateOrCreate(
            ['email' => 'admin@egysyr.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'name' => 'Admin User',
                'username' => 'admin',
                'email' => 'admin@egysyr.com',
                'password' => Hash::make('Password123!'),
                'role' => 'admin',
                'status' => 'approved',
                'email_verified_at' => now(),
            ]
        );

        // Create a pending user for testing
        User::updateOrCreate(
            ['email' => 'pending@egysyr.com'],
            [
                'first_name' => 'Pending',
                'last_name' => 'User',
                'name' => 'Pending User',
                'username' => 'pending',
                'email' => 'pending@egysyr.com',
                'password' => Hash::make('Password123!'),
                'role' => 'admin',
                'status' => 'pending',
                'email_verified_at' => now(),
            ]
        );

        echo "✅ Admin users created successfully!\n";
        echo "Owner: owner@egysyr.com / Password123!\n";
        echo "Admin: admin@egysyr.com / Password123!\n";
        echo "Pending: pending@egysyr.com / Password123!\n";
    }
}
