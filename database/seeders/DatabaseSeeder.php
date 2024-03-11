<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\ConnectRelationshipsSeeder;
use Database\Seeders\CategoryTableSeeder;
use Database\Seeders\CountryTableSeeder;
use Database\Seeders\EventTypeTableSeeder;
use Database\Seeders\StateTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ConnectRelationshipsSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(StateTableSeeder::class);
        $this->call(EventTypeTableSeeder::class);
        $this->call(CreateCompanySettingTableSeeder::class);
        $this->call(CreateOrganizerTableSeeder::class);
        $this->call(CreateEventsTableSeeder::class);
        $this->call(CreateOrderTableSeeder::class);
        
    }
}
