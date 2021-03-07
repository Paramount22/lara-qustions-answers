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
        if( $this->answers > 0 ) {
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
