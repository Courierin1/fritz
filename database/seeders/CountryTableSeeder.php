<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();

        $countries = array(
                array(
                    'id' => 1,
                    'code' => 'US',
                    'name' => "United States",
                    'phonecode' => 1,
                    'status' => 1
                ),
            
            );
        DB::table('countries')->insert($countries);
    }
}
