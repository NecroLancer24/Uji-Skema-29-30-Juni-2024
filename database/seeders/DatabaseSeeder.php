<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // role::create([
        //     "role_name"=> "Admin",
        // ]);
        // role::create([
        //     "role_name"=> "Petugas",
        // ]);

        // User::create([
        //     "name"=> "Admin",
        //     "email"=> "Admin@gmail.com",
        //     "password"=> bcrypt("admin123"),
        //     "role_id" => 1
        // ]);
        // User::create([
        //     "name"=> "User",
        //     "email"=> "User@gmail.com",
        //     "password"=> bcrypt("user1234"),
        //     "role_id"=> 2
        // ]);
    }
}
