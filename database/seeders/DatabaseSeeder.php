<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@cnfm.edu.ni'],
            [
                'name' => 'Administración CNFM',
                'password' => Hash::make('Cnfm2026*'),
                'email_verified_at' => now(),
            ]
        );
    }
}