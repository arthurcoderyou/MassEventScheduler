<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [//admin
                'name' => 'Arthur Cervania',
                'email' => 'arthurcervania13@gmail.com',
                'password' => Hash::make('Arthur123@'),
                'role' => 'admin',
            ],
            [//user 
                'name' => 'Quirino',
                'email' => 'qrncer90@gmail.com',
                'password' => Hash::make('Quirino90@'),
                'role' => 'user'
            ]
        ]);
    }
}
