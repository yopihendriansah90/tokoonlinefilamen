<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //insert data user relationship role
DB::table('users')->insert([
            [
                // crate user with role refers to role id 1 (superadmin)
                 


                'role_id' => 1,
                'name' => 'Super Admin',
                'email' => 'superadmin@mail.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);

        

    }
}
