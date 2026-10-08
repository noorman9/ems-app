<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@ems.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Technician',
            'email' => 'technician@ems.test',
            'password' => Hash::make('password'),
            'role' => 'technician',
        ]);

        User::create([
            'name' => 'Viewer',
            'email' => 'viewer@ems.test',
            'password' => Hash::make('password'),
            'role' => 'viewer',
        ]);
    }
}