<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecommendationItem extends Model
{

    public function recommendations()
    {
        return $this->belongsTo('App\Recommendation');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recommendation_id',
        'name',
        'year',
        'overview',
        'poster',
        'backdrop',
        'trailer',
        'commentary'
    ];

    public function recommendation()
    {
        return $this->belongsTo('App\Recommendation');
    }
}