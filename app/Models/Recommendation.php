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

    public function recommendation_items()
    {
        return $this->hasMany('App\RecommendationItem');
    }

}