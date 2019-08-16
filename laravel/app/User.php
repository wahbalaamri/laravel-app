<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Question;
//use Symfony\Component\Console\Question\Question;

class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function getAvaterAttribute()
    {
        $email = $this->email;
        $size = 32;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }
    public function favorites()
    {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps(); //, 'author_id', 'question_id');
    }
    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class,'votable')->withTimestamps();
    }
    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class,'votable')->withTimestamps();
    }
    public function voteQuestion(Question $question, $vote)
    {
        $voteQuestions=$this->voteQuestions();
        if($voteQuestions->where('votable_id',$question->id)->exists())
        {
            $voteQuestions->updateExistingPivot($question,['vote'=>$vote]);
        }
        else {
            $voteQuestions->attach($question,['vote'=>$vote]);
        }
        $question->load('votes');
        $downVote=(int) $question->downVotes()->sum('vote');
        $upVote=(int) $question->upVotes()->sum('vote');
        $question->votes_count= $upVote+$downVote;
        $question->save();
    }
}
