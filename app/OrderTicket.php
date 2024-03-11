<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderTicket extends Model
{
    protected $fillable = [
        'order_id',
        'event_id',
        'ticket_type',
        'no_of_tickets',    
        'unit_price',
        'ticket_fee_percentage',
        'ticket_fee',
        'ticket_price',
        'admin_comission',
        'organizer_comission',
    ];
    
    public function order()
    {
        return $this->belongsTo('App\Order','order_id');
    }
    
    public function event()
    {
        return $this->belongsTo('App\Event','event_id');
    }
}
