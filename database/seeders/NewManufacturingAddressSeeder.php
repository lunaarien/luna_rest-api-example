<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NewManufacturingAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\NewManufacturingAddress::factory()->count(100)->create();
    }
}
