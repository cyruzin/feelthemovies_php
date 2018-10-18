<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->belongsToMany('App\RecommendationItem');
    }

}