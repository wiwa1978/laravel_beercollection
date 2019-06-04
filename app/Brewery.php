<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brewery extends Model
{
    protected $fillable = [
        'user_id', 'brewery_name', 'brewery_description', 'brewery_zipcode', 'brewery_town', 'brewery_subtown', 'brewery_province', 'brewery_country', 'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function beeritem()
    {
        return $this->hasMany('App\Beeritem');
    }
}
