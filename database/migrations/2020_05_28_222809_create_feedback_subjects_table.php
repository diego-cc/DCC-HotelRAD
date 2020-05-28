<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFeedbackSubjectsTable Creates the feedback_subjects table
 */
class CreateFeedbackSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'feedback_subjects',
            function (Blueprint $table) {
                $table->id();
                $table->string('subject', 24);
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
        Schema::dropIfExists('feedback_subjects');
    }
}
