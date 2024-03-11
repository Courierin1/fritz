<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefundRequest extends Model
{
    protected $table = 'refund_requests';

    protected $fillable = [
        'user_id',
        'order_id',
        'accept_by_planner',
        'accept_by_admin',
        'ticket_refunded',
    ];

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }
}
