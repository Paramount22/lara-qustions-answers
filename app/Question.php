<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Question extends Model
{
    use VotableTrait; // metody votes, upVotes, downVotes

    protected $fillable = ['title', 'body', 'slug'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany('App\Answer')->orderBy('votes_count', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
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

    /**
     * @return bool
     */
    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    /**
     * @return mixed
     */
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

    /**
     * @param $value
     * clean funkcia a ocistenie vstupu od skodliveho kodu z kniznice purifier
     */
   /* public function setBodyAttribute($value)
    {
        $this->attributes['body'] = clean($value);
    }*/

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

    /**
     * @return mixed
     * clean funkcia a ocistenie vystupu od skodliveho kodu z kniznice purifier
     */
    public function getBodyHtmlAttribute()
    {
        return  clean($this->bodyHtml());
    }

    public function getExcerptAttribute()
    {
        return $this->excerpt(250);
    }

    /**
     * @param $length
     * @return string
     */
    private function excerpt($length)
    {
        return Str::limit( strip_tags( $this->bodyHtml() ), $length);
    }

    /**
     * @return string
     */
    private function bodyHtml()
    {
        return \Parsedown::instance()->text($this->body);
    }


}
