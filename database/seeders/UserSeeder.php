<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = new User([
            'name' => 'Super Admin',
            'email' => 'superadmin@test.com',
            'password' => bcrypt('password'),
            'role' => 'super-admin',
        ]);

        $admin = new User([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $moderator = new User([
            'name' => 'Moderator',
            'email' => 'moderator@test.com',
            'password' => bcrypt('password'),
            'role' => 'moderator',
        ]);

        $superAdmin->save();
        $admin->save();
        $moderator->save();

    }
}
