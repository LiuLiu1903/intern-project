<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert(
            [[
                'first_name' => 'Admin',
                'last_name' => 'Super',
                'email' => 'superadmin@khgc.com',
                'password' => Hash::make('Abcd@1234'),
                'address' => '123 Admin Street',
                'status' => 1, // Kích hoạt tài khoản
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'first_name' => 'Lieu',
                'last_name' => 'phan',
                'email' => 'liuliu@gmail.com',
                'password' => Hash::make('Abcd@1234'),
                'address' => '123 kkk Street',
                'status' => 1, // Kích hoạt tài khoản
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],]

        );
    }
}
