<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NewMachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\NewMachine::factory()->count(100)->create();
    }
}
