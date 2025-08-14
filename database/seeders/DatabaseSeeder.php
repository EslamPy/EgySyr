<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Call the AdminSeeder which has the proper user creation
        $this->call([
            AdminSeeder::class,
        ]);
    }
}
