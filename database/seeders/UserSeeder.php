<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create demo admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@webakuntan.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
}
