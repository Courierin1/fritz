<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\State;
class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->delete();
	    $states = array(
            array('name' => "Alabama",'country_id' => 1, 'status' => 1),
            array('name' => "Alaska",'country_id' => 1, 'status' => 1),
            array('name' => "Arizona",'country_id' => 1, 'status' => 1),
            array('name' => "Arkansas",'country_id' => 1, 'status' => 1),
            array('name' => "Byram",'country_id' => 1, 'status' => 1),
            array('name' => "California",'country_id' => 1, 'status' => 1),
            array('name' => "Cokato",'country_id' => 1, 'status' => 1),
            array('name' => "Colorado",'country_id' => 1, 'status' => 1),
            array('name' => "Connecticut",'country_id' => 1, 'status' => 1),
            array('name' => "Delaware",'country_id' => 1, 'status' => 1),
            array('name' => "District of Columbia",'country_id' => 1, 'status' => 1),
            array('name' => "Florida",'country_id' => 1, 'status' => 1),
            array('name' => "Georgia",'country_id' => 1, 'status' => 1),
            array('name' => "Hawaii",'country_id' => 1, 'status' => 1),
            array('name' => "Idaho",'country_id' => 1, 'status' => 1),
            array('name' => "Illinois",'country_id' => 1, 'status' => 1),
            array('name' => "Indiana",'country_id' => 1, 'status' => 1),
            array('name' => "Iowa",'country_id' => 1, 'status' => 1),
            array('name' => "Kansas",'country_id' => 1, 'status' => 1),
            array('name' => "Kentucky",'country_id' => 1, 'status' => 1),
            array('name' => "Louisiana",'country_id' => 1, 'status' => 1),
            array('name' => "Lowa",'country_id' => 1, 'status' => 1),
            array('name' => "Maine",'country_id' => 1, 'status' => 1),
            array('name' => "Maryland",'country_id' => 1, 'status' => 1),
            array('name' => "Massachusetts",'country_id' => 1, 'status' => 1),
            array('name' => "Medfield",'country_id' => 1, 'status' => 1),
            array('name' => "Michigan",'country_id' => 1, 'status' => 1),
            array('name' => "Minnesota",'country_id' => 1, 'status' => 1),
            array('name' => "Mississippi",'country_id' => 1, 'status' => 1),
            array('name' => "Missouri",'country_id' => 1, 'status' => 1),
            array('name' => "Montana",'country_id' => 1, 'status' => 1),
            array('name' => "Nebraska",'country_id' => 1, 'status' => 1),
            array('name' => "Nevada",'country_id' => 1, 'status' => 1),
            array('name' => "New Hampshire",'country_id' => 1, 'status' => 1),
            array('name' => "New Jersey",'country_id' => 1, 'status' => 1),
            array('name' => "New Jersy",'country_id' => 1, 'status' => 1),
            array('name' => "New Mexico",'country_id' => 1, 'status' => 1),
            array('name' => "New York",'country_id' => 1, 'status' => 1),
            array('name' => "North Carolina",'country_id' => 1, 'status' => 1),
            array('name' => "North Dakota",'country_id' => 1, 'status' => 1),
            array('name' => "Ohio",'country_id' => 1, 'status' => 1),
            array('name' => "Oklahoma",'country_id' => 1, 'status' => 1),
            array('name' => "Ontario",'country_id' => 1, 'status' => 1),
            array('name' => "Oregon",'country_id' => 1, 'status' => 1),
            array('name' => "Pennsylvania",'country_id' => 1, 'status' => 1),
            array('name' => "Ramey",'country_id' => 1, 'status' => 1),
            array('name' => "Rhode Island",'country_id' => 1, 'status' => 1),
            array('name' => "South Carolina",'country_id' => 1, 'status' => 1),
            array('name' => "South Dakota",'country_id' => 1, 'status' => 1),
            array('name' => "Sublimity",'country_id' => 1, 'status' => 1),
            array('name' => "Tennessee",'country_id' => 1, 'status' => 1),
            array('name' => "Texas",'country_id' => 1, 'status' => 1),
            array('name' => "Trimble",'country_id' => 1, 'status' => 1),
            array('name' => "Utah",'country_id' => 1, 'status' => 1),
            array('name' => "Vermont",'country_id' => 1, 'status' => 1),
            array('name' => "Virginia",'country_id' => 1, 'status' => 1),
            array('name' => "Washington",'country_id' => 1, 'status' => 1),
            array('name' => "West Virginia",'country_id' => 1, 'status' => 1),
            array('name' => "Wisconsin",'country_id' => 1, 'status' => 1),
            array('name' => "Wyoming",'country_id' => 1, 'status' => 1),
        );
       foreach($states as $state){
        State::create(["name"=> $state['name'], "country_id"=> $state['country_id']]);
       }
    }
}
