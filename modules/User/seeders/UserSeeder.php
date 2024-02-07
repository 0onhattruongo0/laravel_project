<?php

namespace Modules\User\seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Modules\User\src\Model\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $user = new User();
        // $user->name = 'admin';
        // $user->email = 'admin@gmail.com';
        // $user->group_id=1;
        // $user->password= Hash::make('123456');
        // $user->save();

        $faker = Factory::create();

        for($i=1;$i<=30;$i++){
            $user = new User();
            $user->name = $faker->name;
            $user->email = $faker->email;
            $user->group_id=1;
            $user->password= Hash::make('123456');
            $user->save();
        }
    }
}