<?php

namespace Modules\User\seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $group_id = DB::table('groups')->insertGetId([
            'name' => 'Administrator',
            'user_id' => 0,
            'permissions' => '{"users":["view","add","edit","delete"],"groups":["view","add","edit","delete","permission"],"teachers":["view","add","edit","delete"],"categories":["view","add","edit","delete"],"courses":["view","add","edit","delete"],"students":["view","edit","delete"],"orders":["view","edit","delete"]}',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        if ($group_id > 0) {
            $userId = DB::table('users')->insertGetId([
                'name' => 'admin',
                'email' => 'nhattruong.truongcong@gmail.com',
                'password' => Hash::make('123456'),
                'group_id' => $group_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
