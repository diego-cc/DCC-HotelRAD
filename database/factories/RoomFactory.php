<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Room;
use App\RoomType;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    $floor = $faker->numberBetween(1, 13);
    $roomNumber = $faker->numberBetween($floor * 100, $floor * 100 + 99);

    return [
        'status_id' => $faker->numberBetween(1, 6),
        'rate_id' => $faker->numberBetween(1, 7),
        'room_type' => $faker->numberBetween(RoomType::SINGLE, RoomType::TRIPLE),
        'room_number' => $roomNumber,
        'floor' => $floor,
        'accessible' => $faker->boolean
    ];
});
