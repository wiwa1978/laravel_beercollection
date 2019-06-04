<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Conner\Tagging\Taggable;

class Ticket extends Model
{
    use Taggable;

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
}



