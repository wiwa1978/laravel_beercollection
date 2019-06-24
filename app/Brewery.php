<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Brewery extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = [
        'user_id', 'brewery_name', 'brewery_description', 'brewery_zipcode', 'brewery_city', 'brewery_subcity', 'brewery_state', 'brewery_country', 'created_at', 'updated_at'
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
