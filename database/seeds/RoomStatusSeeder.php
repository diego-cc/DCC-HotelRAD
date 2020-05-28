<?php

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
                'description' => 'Available'
            ]
        );

        DB::table('room_statuses')->insert(
            [
                'name' => 'SERV',
                'description' => 'Service Required'
            ]
        );

        DB::table('room_statuses')->insert(
            [
                'name' => 'MAIN',
                'description' => 'Maintenance Required'
            ]
        );

        DB::table('room_statuses')->insert(
            [
                'name' => 'OOSV',
                'description' => 'Out of Service'
            ]
        );

        DB::table('room_statuses')->insert(
            [
                'name' => 'UNAV',
                'description' => 'Unavailable'
            ]
        );

        DB::table('room_statuses')->insert(
            [
                'name' => 'OCCP',
                'description' => 'Occupied'
            ]
        );
    }
}
