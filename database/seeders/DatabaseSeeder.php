<?php

namespace Database\Seeders;

use App\Models\User; 
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
       
       User::create([
        'name' => 'Administrator',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('admin123'),
        'role' => 'admin',
    ]);
    }
}