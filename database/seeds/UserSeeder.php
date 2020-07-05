<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'id' => 1,
                'user_type_id' => 6,
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'email_verified_at' => now(),
                'password' => 'Secret1', // password
                'remember_token' => Str::random(10)
            ]
        );
    }
}
