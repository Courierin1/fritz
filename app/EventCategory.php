<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    protected $fillable = ["name","parent_id", 'status'];

    public function parent()
    {
        return $this->belongsTo('App\EventCategory','parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\EventCategory','parent_id');
    }
}
