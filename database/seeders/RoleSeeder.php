<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::insert([
            ['name' => 'Super Admin', 'level' => 1],
            ['name' => 'Admin', 'level' => 2],
            ['name' => 'Operator', 'level' => 3],
            ['name' => 'Staff 1', 'level' => 4],
            ['name' => 'Staff 2', 'level' => 5],
            ['name' => 'Viewer', 'level' => 9],
            ['name' => 'User', 'level' => 10],
        ]);
    }
}
