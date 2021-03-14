<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['body', 'user_id'];

    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // odstavce v clankoch
    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function votes()
    {
        return $this->morphToMany('App\User', 'votable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function upVotes()
    {
        return $this->votes()->wherePivot('vote', 1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function downVotes()
    {
        return $this->votes()->wherePivot('vote', -1);
    }


    public static function boot()
    {
        parent::boot();
        // po vlozeni do db sa zvysi increment o 1 -> tabulka questions stlpec answers_count
        static::created(function($answer) {
            $answer->question->increment('answers_count');
        });

        // po vymazani z db sa znizi increment o 1 ->tabulka questions stlpec answers_count
        static::deleted(function($answer) {
            $question = $answer->question;
            $question->decrement('answers_count');
            if( $question->best_answer_id === $answer->id ) {
                $question->best_answer_id = NULL;
                $question->save();
            }
        });

    }

    /**
     * @return string
     */
    public function getStatusAttribute()
    {
        return $this->isBest() ? 'vote-accepted' : '';
    }

    /**
     * @return bool
     */
    public function getIsBestAttribute()
    {
        return $this->isBest();
    }

    /**
     * @return bool
     */
    public function isBest()
    {
        return $this->id === $this->question->best_answer_id;
    }
}
