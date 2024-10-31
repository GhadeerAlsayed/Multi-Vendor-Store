<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'ghadeer',
            'email' => 'gh@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '123456789',
        ]);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'ad@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '12121212',
        ]);
    }
}
