<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\EventOrganizer;
use Carbon\Carbon;

class CreateOrganizerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // EventOrganizer::insert([
      //   [
      //     'name' => 'organizer1',
      //     'event_planner_id' => 2,
      //     'tax_id' => 142345,
      //     'address' => 'dummy address1',
      //     'website' => null,
      //     'image' => 'org1.jpg',
      //     'bio' => ' dummy bio1',
      //     'description' => null,
      //     'bank_name' => 'Bank of America Corp.',
      //     'account_no' => '4003830171874018', 
      //     'routing_number' => '45234',
      //     'account_type' => 'Current',
      //     'status' => 1,
      //     'created_at' => Carbon::now(),
      //     'updated_at' => Carbon::now()
      //   ],
      //   [
      //     'name' => 'organizer2',
      //     'event_planner_id' => 2,
      //     'tax_id' => 546435,
      //     'address' => 'dummy address2',
      //     'website' => 'https://www.google.com/',
      //     'image' => 'org2.jpg',
      //     'bio' => ' dummy bio2',
      //     'description' => 'dummy description2',
      //     'bank_name' => 'Bank of America Corp.',
      //     'account_no' => '4643547456452345674', 
      //     'routing_number' => '467345',
      //     'account_type' => 'Saving',
      //     'status' => 1,
      //     'created_at' => Carbon::now(),
      //     'updated_at' => Carbon::now()
      //   ],
      //   [
      //     'name' => 'organizer3',
      //     'event_planner_id' => 3,
      //     'tax_id' => 546435,
      //     'address' => 'dummy address3',
      //     'website' => 'https://www.google.com/',
      //     'image' => 'org3.jpg',
      //     'bio' => ' dummy bio3',
      //     'description' => 'dummy description3',
      //     'bank_name' => 'Bank of America Corp.',
      //     'account_no' => '4643547456453345674', 
      //     'routing_number' => '467345',
      //     'account_type' => 'Saving',
      //     'status' => 1,
      //     'created_at' => Carbon::now(),
      //     'updated_at' => Carbon::now()
      //   ],
      // ]);
    }
}
