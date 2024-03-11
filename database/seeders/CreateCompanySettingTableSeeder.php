<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateCompanySettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_settings')->delete();

        $company_settings = array(
            array(
                'key' => 'ORDER_NO',
                'value' => "2000",
            ),
            array(
                'key' => 'TICKET_FEE_PERCENTAGE',
                'value' => "9",  
            ),
            
        );
        DB::table('company_settings')->insert($company_settings);
    }
}
