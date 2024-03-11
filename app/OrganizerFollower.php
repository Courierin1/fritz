<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganizerFollower extends Model
{
    //
    
    protected $fillable = ['user_id', 'organizer_id'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
