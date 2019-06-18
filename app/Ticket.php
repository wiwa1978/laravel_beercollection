<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    protected $fillable = [
        'user_id', 'ticket_id', 'ticket_title', 'ticket_priority', 'type_id', 'ticket_description', 'ticket_status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tickettype()
    {
        return $this->belongsTo('App\TicketType');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}



