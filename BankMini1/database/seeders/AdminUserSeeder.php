<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@123.com',
                'password' => Hash::make('admin123'),  // Using Hash::make instead of bcrypt
                'role' => 'admin',
            ],
            [
                'name' => 'BankMini',
                'email' => 'bank@123.com',
                'password' => Hash::make('bankmini123'), // Using Hash::make instead of bcrypt
                'role' => 'bank_mini',
            ],
            [
                'name' => 'Siswa',
                'email' => 'siswa@123.com',
                'password' => Hash::make('siswa123'),   // Using Hash::make instead of bcrypt
                'role' => 'siswa',
            ],
            [
                'name' => 'Siswa2',
                'email' => 'siswa2@example.com',
                'password' => Hash::make('siswa1234'),  // Using Hash::make instead of bcrypt
                'role' => 'siswa',
            ],
        ];

        // Iterate over each user and either create it or skip if already exists based on email
        foreach ($users as $user) {
            User::firstOrCreate(
                ['email' => $user['email']], // Check if email already exists
                $user                         // If not, create this user
            );
        }
    }
}
