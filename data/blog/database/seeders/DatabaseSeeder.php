<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Create Admin
         */
         \App\Models\User::factory()->create([
             'name' => 'Admin',
             'email' => env('APP_EMAIL'),
         ]);
    }
}
