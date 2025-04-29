<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstname' => 'Tom',
            'lastname' => 'Arizobal', 
            'username' => 'admin', 
            'password' => 'admin123',
            'RoleID' => '1',
            'birthday' => '2025-04-25'
        ]);
    }
}
