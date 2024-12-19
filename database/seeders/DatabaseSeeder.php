<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        
        // Thêm các vai trò
        \App\Models\Role::create(['name' => 'admin']);
        \App\Models\Role::create(['name' => 'mod']);
        \App\Models\Role::create(['name' => 'user']);
        
    }
}
