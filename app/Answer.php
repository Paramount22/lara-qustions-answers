<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use VotableTrait; // metody votes, upVotes, downVotes

    protected $fillable = ['body', 'user_id'];

    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }



    /**
     * @return mixed
     * clean funkcia a ocistenie vystupu od skodliveho kodu z kniznice purifier
     * odstavce v clankoch kniznica Parsedown
     */
    public function getBodyHtmlAttribute()
    {
        return clean(\Parsedown::instance()->text($this->body));
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
