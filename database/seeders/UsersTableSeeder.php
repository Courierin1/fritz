<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\UserDetail;
use App\User;
use App\CompanySetting;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = config('roles.models.role')::where('name', '=', 'User')->first();
        $adminRole = config('roles.models.role')::where('name', '=', 'Admin')->first();
        // $subadminRole = config('roles.models.role')::where('name', '=', 'Sub Admin')->first();
        $permissions = config('roles.models.permission')::all();

        /*
         * Add Users
         *
         */
        if (config('roles.models.defaultUser')::where('email', '=', 'admin@frimix.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'Admin',
                'email'    => 'admin@frimix.com',
                'password' => bcrypt('frimix2121'),
            ]);

            $newUser->attachRole($adminRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }

        // if (config('roles.models.defaultUser')::where('email', '=', 'user@user.com')->first() === null) {
        //     $newUser = config('roles.models.defaultUser')::create([
        //         'name'     => 'User',
        //         'email'    => 'user@user.com',
        //         'password' => bcrypt('demo2121'),
        //     ]);

        //     $newUser->attachRole($userRole);
        // }

        // if (config('roles.models.defaultUser')::where('email', '=', 'demo1@gmail.com')->first() === null) {
        //     $newUser = config('roles.models.defaultUser')::create([
        //         'name'     => 'demo1',
        //         'email'    => 'demo1@gmail.com',
        //         'password' => bcrypt('demo2121'),
        //     ]);

        //     $newUser->attachRole($userRole);
        // }

        // if (config('roles.models.defaultUser')::where('email', '=', 'demo2@gmail.com')->first() === null) {
        //     $newUser = config('roles.models.defaultUser')::create([
        //         'name'     => 'demo2',
        //         'email'    => 'demo2@gmail.com',
        //         'password' => bcrypt('demo2121'),
        //     ]);

        //     $newUser->attachRole($userRole);
        // }

        // if (config('roles.models.defaultUser')::where('email', '=', 'subadmin@subadmin.com')->first() === null) {
        //     $newUser = config('roles.models.defaultUser')::create([
        //         'name'     => 'Sub Admin',
        //         'email'    => 'subadmin@subadmin.com',
        //         'password' => bcrypt('demo2121'),
        //     ]);
        //     $newUser->attachRole($subadminRole);
        // }

        $users = User::whereHas('roles', function($q) {
          $q->where('name', "User");
        })->get();

        $distribution = CompanySetting::where('key', 'DISTRIBUTION')->first();

        foreach ($users as $user) { 
            UserDetail::create([
                'user_id' => $user->id,
                'distribution' => $distribution->value ?? '9',
            ]);
        }
    }
}
