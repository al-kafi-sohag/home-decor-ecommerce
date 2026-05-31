<?php

namespace Database\Seeders;

use App\Enums\AdminStatus;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'status' => AdminStatus::Active,
                'email_verified_at' => now(),
            ],
        );
    }
}
