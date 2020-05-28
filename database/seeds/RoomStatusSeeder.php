<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add initial seed
        DB::table('room_statuses')->insert(
            [
                'name' => 'AVBL',
                'description' => 'Available',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('room_statuses')->insert(
            [
                'name' => 'SERV',
                'description' => 'Service Required',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('room_statuses')->insert(
            [
                'name' => 'MAIN',
                'description' => 'Maintenance Required',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('room_statuses')->insert(
            [
                'name' => 'OOSV',
                'description' => 'Out of Service',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('room_statuses')->insert(
            [
                'name' => 'UNAV',
                'description' => 'Unavailable',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('room_statuses')->insert(
            [
                'name' => 'OCCP',
                'description' => 'Occupied',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );
    }
}
