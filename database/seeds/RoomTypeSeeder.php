<?php

use App\RoomType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('room_types')->insert(
            [
                'type' => RoomType::SINGLE,
                'description' => 'Single room',
                'created_at' => Carbon::now('Australia/Perth')
            ]
        );

        DB::table('room_types')->insert(
            [
                'type' => RoomType::DOUBLE,
                'description' => 'Double room',
                'created_at' => Carbon::now('Australia/Perth')
            ]
        );

        DB::table('room_types')->insert(
            [
                'type' => RoomType::TRIPLE,
                'description' => 'Triple room',
                'created_at' => Carbon::now('Australia/Perth')
            ]
        );
    }
}
