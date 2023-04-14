<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'user_id' => 0,
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'level' => 1
        ]);
    }
}
