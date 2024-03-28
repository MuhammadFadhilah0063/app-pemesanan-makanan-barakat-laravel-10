<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'phone' => '081245678901',
            'role' => 'admin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        \App\Models\User::factory(100)->create();

        \App\Models\Category::factory()->create([
            'name' => 'Makanan',
            'slug' => 'makanan',
        ]);

        \App\Models\Category::factory()->create([
            'name' => 'Minuman',
            'slug' => 'minuman',
        ]);

        \App\Models\Category::factory()->create([
            'name' => 'Lainnya',
            'slug' => 'lainnya',
        ]);
    }
}
