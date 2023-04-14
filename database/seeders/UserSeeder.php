<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // User::create([
        //     'user_id' => 0,
        //     'username' => 'admin',
        //     'password' => Hash::make('admin'),
        //     'level' => 1
        // ]);
        DB::table('users')->insert([
            // 'name' => Str::random(10),
            'user_id' => 0,
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'level' => 1
        ]);
        DB::table('users')->insert([
            // 'name' => Str::random(10),
            'user_id' => 0,
            'username' => 'superadmin',
            'password' => Hash::make('admin'),
            'level' => 2
        ]);
    }
}
