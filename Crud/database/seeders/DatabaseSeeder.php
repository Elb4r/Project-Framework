<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Jhon',
            'email' => 'Jhon@example.com',
            'password' => bcrypt('123'),
        ]);

        // Tambahkan seeder untuk model Post
        Post::factory(20)->create();
    }
}
