<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_name', 'ticket_type', 'ticket_description', 'user_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
