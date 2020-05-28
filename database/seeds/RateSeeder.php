<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add initial seed
        DB::table('rates')->insert(
            [
                'rate' => 50.00,
                'description' => 'Single Room Rate, 1 Person',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('rates')->insert(
            [
                'rate' => 80.00,
                'description' => 'Double Room Rate, 1 Person',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('rates')->insert(
            [
                'rate' => 90.00,
                'description' => 'Double Room Rate, 2+ Persons',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('rates')->insert(
            [
                'rate' => 90.00,
                'description' => 'Executive Room Rate, 1 Person',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('rates')->insert(
            [
                'rate' => 100.00,
                'description' => 'Executive Room Rate, 2+ Persons',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('rates')->insert(
            [
                'rate' => 150.00,
                'description' => 'Princess Room Rate, 1 Person',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('rates')->insert(
            [
                'rate' => 180.00,
                'description' => 'Princess Room Rate, 2+ Persons',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );
    }
}
