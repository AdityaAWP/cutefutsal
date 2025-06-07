<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'adminku@gmail.com',
            'password' => bcrypt('adminku123'), 
            'role' => 'admin', 
        ]);

        User::factory()->create([
            'name' => 'User Biasa',
            'email' => 'userku@gmail.com',
            'password' => bcrypt('user123'),
            'role' => 'user',
        ]);
    }
}
