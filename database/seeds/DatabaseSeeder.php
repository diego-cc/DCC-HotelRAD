<?php

use App\Room;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTypeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RateSeeder::class);
        $this->call(FeedbackSubjectSeeder::class);
        $this->call(RoomStatusSeeder::class);
        $this->call(RoomTypeSeeder::class);

        factory(Room::class, 5)->create();
    }
}
