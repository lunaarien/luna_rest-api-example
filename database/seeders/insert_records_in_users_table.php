<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class insert_records_in_users_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name"=> "Luna1",
                "email"=> "luna1@gmail.com",
                "password"=> bcrypt("deniceluna"),
            ],
            [
                "name"=> "Galero1",
                "email"=> "galero1@gmail.com",
                "password"=> bcrypt("shielagalero"),
            ],
            [
                "name"=> "Magtalas1",
                "email"=> "magtalas1@gmail.com",
                "password"=> bcrypt("lourdmagtalas"),
            ],
            [
                "name"=> "Goco1",
                "email"=> "goco1@gmail.com",
                "password"=> bcrypt("johncarlo"),
            ]
        ];
        User::insert($users);
    }
}
