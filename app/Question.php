<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Question extends Model
{

    protected $fillable = ['title', 'body', 'slug'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function favorites()
    {
        return $this->belongsToMany('App\User', 'favorites',
            'question_id', 'user_id')->withTimestamps();
    }

    /**
     * @return bool
     */
    public function isFavorited()
    {
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }


    /**
     * Do stlpca best_answer_id priradime id konkretnej odpovede v tabulke questions
     */
    public function acceptBestAnswer(Answer $ansver)
    {
        $this->best_answer_id = $ansver->id;
        $this->save();
    }

    /*MUTATOR*/
    /**
     * @param $value
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    /*ACCSESOR*/
    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('questions.show', $this->id);
    }

    /**
     * @return string
     */
    public function getStatusAttribute()
    {
        if( $this->answers_count > 0 ) {
            if($this->best_answer_id) {
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }
}
