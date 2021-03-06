<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    protected $appends = [ 'url', 'avatar' ];

    /**
     * @return string
     */
    public function getAvatarAttribute()
    {
        $email = $this->email;
        $size = 32;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "&s=" . $size;
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        // return route("questions.show", $this->id);
        return '#';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany('App\Question', 'favorites',
            'user_id', 'question_id')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function voteQuestions()
    {
        return $this->morphedByMany('App\Question', 'votable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function voteAnswers()
    {
        return $this->morphedByMany('App\Answer', 'votable');
    }


    /**
     * @param Question $question
     * @param $vote
     */
    public function voteQuestion(Question $question, $vote)
    {
      $voteQuestions =  $this->voteQuestions();

      return $this->_vote($voteQuestions, $question, $vote);
    }

    /**
     * @param Answer $answer
     * @param $vote
     */
    public function voteAnswer(Answer $answer, $vote)
    {
        $voteAnswers =  $this->voteAnswers();

        return $this->_vote($voteAnswers, $answer, $vote);

    }

    /**
     * Vote questions / answers funcionality
     * @param $relationship
     * @param $model
     * @param $vote
     */
    private function _vote($relationship, $model, $vote)
    {
        if($relationship->where('votable_id', $model->id)->exists())
        {
            $relationship->updateExistingPivot($model, ['vote' => $vote]);
        }
        else
        {
            $relationship->attach($model, ['vote' => $vote]);
        }
        $model->load('votes');
        $downVotes = (int) $model->downVotes()->sum('vote');
        $upVotes = (int) $model->upVotes()->sum('vote');

        $model->votes_count = $downVotes + $upVotes;
        $model->save();

        return $model->votes_count;
    }





}
