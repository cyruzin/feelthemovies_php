<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'backdrop', 'status', 'user_id'
    ];

    public function items()
    {
        return $this->hasMany('App\RecommendationItem');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Genre');
    }

    public function keywords()
    {
        return $this->belongsToMany('App\Keyword');
    }

}