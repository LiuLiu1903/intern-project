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
        User::updateOrCreate(
            ['email' => 'superadmin@khgc.com'], // Kiểm tra nếu email tồn tại thì cập nhật, nếu không thì tạo mới
            [
                'first_name' => 'Admin',
                'last_name' => 'Super',
                'email' => 'superadmin@khgc.com',
                'password' => Hash::make('Abcd@1234'),
                'address' => '123 Admin Street',
                'status' => 1, // Kích hoạt tài khoản
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            );
    }
}
