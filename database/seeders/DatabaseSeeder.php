<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            [
                'email' => 'superadmin@gmail.com',
            ],
            [
                'name' => 'Super Admin',
                'phone' => '01700000000',
                'password' => Hash::make('admin123'),
                'role' => 1,
                'status' => 1,
            ]
        );
    }
}
