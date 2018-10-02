<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecommendationItem extends Model
{

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recommendation()
    {
        return $this->belongsTo('App\Recommendation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sources()
    {
        return $this->belongsToMany('App\Source');
    }
}