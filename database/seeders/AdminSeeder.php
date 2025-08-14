<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the owner account
        $owner = User::updateOrCreate(
            ['email' => 'eslamdev@outlook.de'],
            [
                'first_name' => 'Eslam',
                'last_name' => 'Developer',
                'name' => 'Eslam Developer',
                'username' => 'eslamdev',
                'email' => 'eslamdev@outlook.de',
                'password' => Hash::make('admin123'),
                'role' => 'owner',
                'status' => 'approved',
                'email_verified_at' => now(),
            ]
        );

        // Create owner permissions (full access to everything)
        UserPermission::createOwnerPermissions($owner);

        $this->command->info('Owner account created successfully!');
        $this->command->info('Email: eslamdev@outlook.de');
        $this->command->info('Password: admin123');
    }
}
