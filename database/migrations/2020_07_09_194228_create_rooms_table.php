<?php

use App\RoomType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status_id')->default(5);
            $table->unsignedBigInteger('rate_id')->default(1);
            $table->unsignedTinyInteger('room_type')->default(RoomType::SINGLE);

            $table
                ->foreign('status_id')
                ->references('id')
                ->on('room_statuses');

            $table->unsignedSmallInteger('room_number');
            $table->unsignedTinyInteger('floor');

            $table
                ->foreign('rate_id')
                ->references('id')
                ->on('rates');

            $table
                ->foreign('room_type')
                ->references('type')
                ->on('room_types');

            $table->boolean('accessible')->default(false);

            $table->timestamps();
            $table->timestamp('deleted_at')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
