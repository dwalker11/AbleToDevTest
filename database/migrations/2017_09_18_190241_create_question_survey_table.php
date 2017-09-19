<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_survey', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('survey_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->integer('answer')->unsigned();
            $table->timestamps();

            $table->foreign('survey_id')->references('id')->on('surveys')
              ->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')
              ->onDelete('cascade');
            $table->foreign('answer')->references('id')->on('options')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_survey');
    }
}
