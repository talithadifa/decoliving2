<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin DecoLiving',
            'email' => 'admin@decoliving.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Customer DecoLiving',
            'email' => 'user@decoliving.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}