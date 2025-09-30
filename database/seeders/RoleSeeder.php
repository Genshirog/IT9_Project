<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['roleName' => 'admin', 'roleDescription' => 'oversees who registers, give staff access, and remove staffs']);
        Role::create(['roleName' => 'staff', 'roleDescription' => 'updates the website, adds products, and monitor the profits']);
        Role::create(['roleName' => 'customer', 'roleDescription' => 'buys from the website']);
        Role::create(['roleName' => 'cashier', 'roleDescription' => 'checks payment and send to order ']);
        Role::create(['roleName' => 'kitchenStaff', 'roleDescription' => 'checks orders and updates status ']);
        Role::create(['roleName' => 'inventory', 'roleDescription' => 'monitor inventory ']);
    }
}
