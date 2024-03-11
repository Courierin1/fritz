<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_details';

    protected $fillable = [
        'user_id',
        'prefix',
        'img',
        'first_name',
        'dob',
        'last_name',
        'suffix',
        'home_phone',
        'cell_phone',
        'job_title',
        'company',
        'website',
        'blog',
        'home_address_one',
        'home_address_two',
        'home_address_city',
        'home_address_country',
        'home_address_zip',
        'home_address_state',
        'billing_address_one',
        'billing_address_two',
        'billing_address_city',
        'billing_address_country',
        'billing_address_zip',
        'billing_address_state',
        'shipping_address_one',
        'shipping_address_two',
        'shipping_address_city',
        'shipping_address_country',
        'shipping_address_zip',
        'shipping_address_state',
        'work_address_one',
        'work_address_two',
        'work_address_city',
        'work_address_country',
        'work_address_zip',
        'work_address_state',
        'distribution',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getCountry()
    {
        return $this->belongsTo('App\Country', 'home_address_country');
    }

    public function getState()
    {
        return $this->belongsTo('App\State', 'home_address_state');
    }

    public function getBillingCountry()
    {
        return $this->belongsTo('App\Country', 'billing_address_country');
    }

    public function getBillingState()
    {
        return $this->belongsTo('App\State', 'billing_address_state');
    }

    public function getShippingCountry()
    {
        return $this->belongsTo('App\Country', 'shipping_address_country');
    }

    public function getShippingState()
    {
        return $this->belongsTo('App\State', 'shipping_address_state');
    }

    public function getWorkCountry()
    {
        return $this->belongsTo('App\Country', 'work_address_country');
    }

    public function getWorkState()
    {
        return $this->belongsTo('App\State', 'work_address_state');
    }
}
