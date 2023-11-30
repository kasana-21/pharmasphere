<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // use faker
        
        DB::table('users')->insert([
            [
                'name' => 'John Doe', 
                'email' => 'doe@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'gender' => 'male',
            ],
            [
                'name' => 'Jane Doe', 
                'email' => 'jane@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'gender' => 'female',
            ],
            [
                'name' => 'John Smith', 
                'email' => 'smith@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'gender' => 'male',
            ],
            [
                'name' => 'Jane Smith', 
                'email' => 'janesmith@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'gender' => 'female',
            ],
            [
                'name' => 'lance', 
                'email' => 'lance@gmail.com',
                'password' => bcrypt('@.happy!0310'),
                'role' => 'user',
                'gender' => 'male',
            ],
            [
                'name' => 'admin', 
                'email' => 'admin@gmail.com',
                'password' => bcrypt('@.happy!0310'),
                'role' => 'admin',
                'gender' => 'male',
            ],
        ]);
    }
}
