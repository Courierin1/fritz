<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTraffic extends Model
{
    protected $fillable = ['user_id','event_id'];
    
    public function event()
    {
        return $this->belongsTo('App\Event', 'event_id');
    }
}
