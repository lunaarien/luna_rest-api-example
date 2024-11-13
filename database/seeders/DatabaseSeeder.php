<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            //insert_records_in_users_table::class,
            //insert_records_in_machine_table::class,
            NewMachineSeeder::class,
            NewManufacturingAddressSeeder::class,
        ]);

        
    }
}
