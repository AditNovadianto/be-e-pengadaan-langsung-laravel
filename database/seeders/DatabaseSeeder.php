<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Panitia (User) and Vendor (Penyedia) demo accounts
        $this->call(TestUserSeeder::class);
    }
}