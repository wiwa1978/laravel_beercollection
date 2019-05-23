<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'tag_name', 'user_id'
    ];

    public function beeritem()
    {
        return $this->belongsToMany('App\Beeritem', 'beeritems_tag');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
