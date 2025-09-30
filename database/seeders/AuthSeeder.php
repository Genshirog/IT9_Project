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
            'birthday' => '2025-04-25',
            'image' => 'wew.jpg'
        ]);
        User::create([
            'firstname' => 'Wheelie',
            'lastname' => 'Ocampo', 
            'username' => 'WheelChair', 
            'password' => 'OcampoWC',
            'RoleID' => '2',
            'birthday' => '2025-04-25',
            'image' => 'wew.jpg'
        ]);
        User::create([
            'firstname' => 'Biggus',
            'lastname' => 'Dickus', 
            'username' => 'Biggie', 
            'password' => 'Dickie',
            'RoleID' => '4',
            'birthday' => '2025-04-25',
            'image' => 'wew.jpg'
        ]);
        User::create([
            'firstname' => 'Naruto',
            'lastname' => 'Uzumaki', 
            'username' => 'Naruto', 
            'password' => 'Uzumaki123',
            'RoleID' => '5',
            'birthday' => '2025-04-25',
            'image' => 'wew.jpg'
        ]);
        User::create([
            'firstname' => 'Tester',
            'lastname' => 'Test', 
            'username' => 'Tester', 
            'password' => 'Testing123',
            'RoleID' => '6',
            'birthday' => '2025-04-25',
            'image' => 'wew.jpg'
        ]);
    }
}
