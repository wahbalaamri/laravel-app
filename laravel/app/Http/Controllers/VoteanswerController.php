<?php

namespace App\Http\Controllers;
use App\Answer;
use Illuminate\Http\Request;

class VoteanswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Answer $answer)
    {
        $vote=request()->vote;
        auth()->user()->voteAnswer($answer,$vote);
        return back();
    }
}
