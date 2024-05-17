<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class MassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /**
         'date',
        'start_time',
        'end_time',
        'location',
        'status',
        'is_delete',
        'user_id'
         * 
         */

         //pending
        for($i = 0; $i < 10; $i++){
        
        
            DB::table('masses')->insert([
                [
                    'mass_intention' => fake()->word,
                    'details' => fake()->text,
                    'location' => fake()->address,
                    'date' => fake()->date,
                    'start_time' => fake()->time,
                    'end_time' => fake()->time,
                    'status' => 'pending',
                    'is_delete' => 'not_deleted',
                    'user_id' => 2, //created by the first user
                ]
            ]);
        }

        //cancelled
        for($i = 0; $i < 10; $i++){
        
        
            DB::table('masses')->insert([
                [
                    'mass_intention' => fake()->word,
                    'details' => fake()->text,
                    'location' => fake()->address,
                    'date' => fake()->date,
                    'start_time' => fake()->time,
                    'end_time' => fake()->time,
                    'status' => 'cancelled',
                    'is_delete' => 'not_deleted',
                    'user_id' => 2, //created by the first user
                ]
            ]);
        }

        //confirmed
        for($i = 0; $i < 10; $i++){
        
        
            DB::table('masses')->insert([
                [
                    'mass_intention' => fake()->word,
                    'details' => fake()->text,
                    'location' => fake()->address,
                    'date' => fake()->date,
                    'start_time' => fake()->time,
                    'end_time' => fake()->time,
                    'status' => 'confirmed',
                    'is_delete' => 'not_deleted',
                    'user_id' => 2, //created by the first user
                ]
            ]);
        }



    }
}
