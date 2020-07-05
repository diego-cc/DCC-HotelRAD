<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert(
            [
                'id' => 1,
                'type' => 'Guest',
                'description' => 'Customer or general user looking for information',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('user_types')->insert(
            [
                'id' => 2,
                'type' => 'Booking staff',
                'description' => 'Responsible for managing bookings',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('user_types')->insert(
            [
                'id' => 3,
                'type' => 'General staff',
                'description' => 'Includes security, support, etc.',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('user_types')->insert(
            [
                'id' => 4,
                'type' => 'Maintenance',
                'description' => 'Perform routine checks and repairs throughout the hotel',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('user_types')->insert(
            [
                'id' => 5,
                'type' => 'Manager',
                'description' => 'Supervises staff, handles customer complaints, etc.',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('user_types')->insert(
            [
                'id' => 6,
                'type' => 'Administrator',
                'description' => 'System administrator',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );
    }
}
