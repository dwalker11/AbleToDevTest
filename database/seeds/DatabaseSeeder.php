<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->truncate();
        DB::table('options')->truncate();

        $date = date("Y-m-d H:i:s");

        // Question #1
        $id = DB::table('questions')->insertGetId([
            'text'       => "What did you eat for breakfast this morning?",
            'created_at' => $date,
            'updated_at' => $date
        ]);

        DB::table('options')->insert([
            ['text' => 'Eggs & Bacon', 'question_id' => $id, 'created_at' => $date, 'updated_at' => $date],
            ['text' => 'Oatmeal', 'question_id' => $id, 'created_at' => $date, 'updated_at' => $date],
            ['text' => 'Nothing', 'question_id' => $id, 'created_at' => $date, 'updated_at' => $date],
        ]);

        // Question #2
        $id = DB::table('questions')->insertGetId([
            'text'       => "How would you rate your current mood?",
            'created_at' => $date,
            'updated_at' => $date
        ]);

        DB::table('options')->insert([
            ['text' => 'Good', 'question_id' => $id, 'created_at' => $date, 'updated_at' => $date],
            ['text' => 'Neutral', 'question_id' => $id, 'created_at' => $date, 'updated_at' => $date],
            ['text' => 'Bad', 'question_id' => $id, 'created_at' => $date, 'updated_at' => $date],
        ]);

        // Question #3
        $id = DB::table('questions')->insertGetId([
            'text'       => "How often do you excercise?",
            'created_at' => $date,
            'updated_at' => $date
        ]);

        DB::table('options')->insert([
            ['text' => 'Frequently', 'question_id' => $id, 'created_at' => $date, 'updated_at' => $date],
            ['text' => 'Regularly', 'question_id' => $id, 'created_at' => $date, 'updated_at' => $date],
            ['text' => 'Rarely', 'question_id' => $id, 'created_at' => $date, 'updated_at' => $date],
        ]);

        // Question #4
        $id = DB::table('questions')->insertGetId([
            'text'       => "How would you rate your current stress level?",
            'created_at' => $date,
            'updated_at' => $date
        ]);

        DB::table('options')->insert([
            ['text' => 'High', 'question_id' => $id, 'created_at' => $date, 'updated_at' => $date],
            ['text' => 'Medium', 'question_id' => $id, 'created_at' => $date, 'updated_at' => $date],
            ['text' => 'Low', 'question_id' => $id, 'created_at' => $date, 'updated_at' => $date],
        ]);
    }
}
