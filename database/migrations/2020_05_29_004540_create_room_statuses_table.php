<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateRoomStatusesTable Creates the room_statuses table
 */
class CreateRoomStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * Notes:
     * - nullableTimestamps() instead of timestamps() allows the updated_at column of the initial seed data to be null when a new entry is added
     * - It does NOT work for any subsequent entries, because Eloquent sets updated_at to current_timestamp by default (this behaviour is intentional)
     * - One possible workaround is to set the $timestamps property to false in each model, but then they have to be managed manually everywhere
     * @return void
     */
    public function up()
    {
        Schema::create(
            'room_statuses',
            function (Blueprint $table) {
                $table->id();
                $table->string('name', 16);
                $table->string('description', 255);
                $table->nullableTimestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_statuses');
    }
}
