<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'venue_name',
        'event_planner_id',
        'organizer_id',
        'type_id',
        'category_id',
        'sub_category_id',
        'country_id',
        'state_id',
        'city',
        'zipcode',
        'location_type',
        'address',
        'url',
        'event_start',
        'start_time',
        'event_end',
        'end_time',
        'display_start_time',
        'display_end_time',
        'image',
        'summary',
        'details',
        'ticket_type',
        'name',
        'available_quantity',
        'total_quantity',
        'price',
        'sale_start',
        'sale_start_time',
        'sale_end',
        'sale_end_time',
        'max_ticket',
        'min_ticket',
        'ticket_description',
        'status',
        'step',
    ];

    public function orderTickets()
    {
        return $this->hasMany('App\OrderTicket', 'event_id');
    }

    public function orderTickets_sum()
    {
        return $this->hasMany('App\OrderTicket', 'event_id');
    }

    public function eventOrganizers()
    {
        return $this->hasMany('App\EventOrganizer', 'event_planner_id');
    }

    
    public function user()
    {
        return $this->belongsTo('App\User', 'event_planner_id');
    }
    
    public function userDetail()
    {
        return $this->belongsTo('App\UserDetail', 'event_planner_id', 'user_id');
    }

    public function organizer()
    {
        return $this->belongsTo('App\EventOrganizer','organizer_id');
    }
    public function eventCategory()
    {
        return $this->belongsTo('App\EventCategory','category_id');
    }
    public function eventSubCategory()
    {
        return $this->belongsTo('App\EventCategory','sub_category_id');
    }
    public function state()
    {
        return $this->belongsTo('App\State','state_id');
    }
    public function country()
    {
        return $this->belongsTo('App\Country','country_id');
    }
    public function traffic()
    {
        return $this->hasMany('App\EventTraffic','event_id');
    }

    public function getEventOrderTickets()
    {
        return $this->hasMany('App\OrderTicket', 'event_id')->with(['order']);
    }


}
