<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            [
                'email' => 'admin@megacarpets.com',
            ],
            [
                'name' => 'Mega Carpets Admin',
                'password' => Hash::make('Admin@12345'),
                'is_admin' => true,
            ]
        );
    }
}