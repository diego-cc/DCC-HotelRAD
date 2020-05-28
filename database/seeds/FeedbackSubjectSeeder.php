<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add initial seed
        DB::table('feedback_subjects')->insert(
            [
                'subject' => 'General',
                'description' => 'General Enquiry/Comments',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('feedback_subjects')->insert(
            [
                'subject' => 'Booking',
                'description' => 'Booking Enquiry / Room Availability',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('feedback_subjects')->insert(
            [
                'subject' => 'Thank You',
                'description' => 'Message to thank the hotel/staff',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('feedback_subjects')->insert(
            [
                'subject' => 'Complaint',
                'description' => 'Had a problem with your booking or stay',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('feedback_subjects')->insert(
            [
                'subject' => 'Help',
                'description' => 'Assistance Required',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );

        DB::table('feedback_subjects')->insert(
            [
                'subject' => 'Bug',
                'description' => 'Problem with the application/web site',
                'created_at' => Carbon::now('Australia/Perth'),
                'updated_at' => null
            ]
        );
    }
}
