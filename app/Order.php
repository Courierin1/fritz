<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'ticket_fee_percentage',
        'total_ticket_fee',
        'total_ticket_price',
        'total_admin_comission',
        'total_organizer_comission',
        'first_name',
        'last_name',
        'email',
        'payment_method',
        'payment_status',
        'order_status',
        'is_refunded',
        'refund_requested',
        'refund_status',
        'dob',
        'phone',
        'address',
    ];

    public function refundRequest()
    {
        return $this->hasOne('App\RefundRequest', 'order_id');
    }

    public function orderTickets()
    {
        return $this->hasMany('App\OrderTicket','order_id');
    }

    public function orderTicket()
    {
        return $this->hasOne('App\OrderTicket','order_id')->with(['event']);
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

}
