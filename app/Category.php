<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'user_id', 'category_name', 'category_description'
    ];

    public function beeritem()
    {
        return $this->hasMany('App\Beeritem');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
