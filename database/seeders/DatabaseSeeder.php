<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Owner account
        User::updateOrCreate(
            ['email' => 'eslamdev@outlook.de'],
            [
                'name' => 'Site Owner',
                'password' => Hash::make('admin123'),
                'status' => 'owner',
            ]
        );
    }
}
