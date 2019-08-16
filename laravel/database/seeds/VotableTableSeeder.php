<?php

use Illuminate\Database\Seeder;
use App\Question;
use App\Answer;
use App\User;
class VotableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('votables')->delete();

        $users= User::all();
        $numberofUser=$users->count();
        $votes=[-1,1];
        foreach (Question::all() as $question) {
            for ($i=0; $i < rand(1,$numberofUser); $i++) {
               $users[$i]->voteQuestion($question,$votes[rand(0,1)]);
            }
        }
        foreach (Answer::all() as $answer) {
            for ($i=0; $i < rand(1,$numberofUser); $i++) {
               $users[$i]->voteAnswer($answer,$votes[rand(0,1)]);
            }
        }
    }
}
