<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventOrganizer extends Model
{
    protected $fillable = [
        'name',
        'event_planner_id',
        'tax_id',
        'address',
        'website',    
        'image',
        'bio',
        'description',
        'bank_name',
        'account_no',
        'routing_number',
        'account_type', 
        'status',
    ];
    
    public function event()
    {
        return $this->belongsTo('App\Event', 'event_planner_id');
    }

    public function followers(){
        return $this->hasMany('App\OrganizerFollower', 'organizer_id');
    }


}
