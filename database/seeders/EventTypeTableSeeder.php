<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\EventType;

class EventTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { DB::table('event_types')->delete();

        $types = array(
            ["name" => "Appearance or Signing"],
            ["name" => "Attraction"],
            ["name" => "Camp, Trip, or Retreat"],
            ["name" => "Class, Training, or Workshop"],
            ["name" => "Concert or Performance"],
            ["name" => "Conference"],
            ["name" => "Convention"],
            ["name" => "Dinner or Gala"],
            ["name" => "Festival or Fair"],
            ["name" => "Game or Competition"],
            ["name" => "Meeting or Networking Event"],
            ["name" => "Other"],
            ["name" => "Party or Social Gathering"],
            ["name" => "Race or Endurance Event"],
            ["name" => "Rally"],
            ["name" => "Screening"],
            ["name" => "Seminar or Talk"],
            ["name" => "Tour"],
            ["name" => "Tournament"],
            ["name" => "Tradeshow, Consumer Show, or Expo"],
        );
        foreach ($types as $type){
            EventType::create(["name" => $type["name"]]);
        }

    }
}
