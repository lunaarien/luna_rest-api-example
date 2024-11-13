<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Machine;

class insert_records_in_machine_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machine = [
            [
                'machine_name' => 'Excavator',
                'brand' => 'Caterpillar',
                'power_rating' => 300.50,
                'manufactured_date' => '2019-05-15',
                'model_name' => 'CAT-320',
                'rpm' => 2500,
                'description_of_machine' => 'Heavy-duty hydraulic excavator.',                
            ],
            [
                'machine_name' => 'Bulldozer',
                'brand' => 'Komatsu',
                'power_rating' => 400.75,
                'manufactured_date' => '2020-11-01',
                'model_name' => 'D155AX-8',
                'rpm' => 2200,
                'description_of_machine' => 'High-powered bulldozer for tough terrain.',            ],
            [
                'machine_name' => 'Crane',
                'brand' => 'Liebherr',
                'power_rating' => 450.00,
                'manufactured_date' => '2018-02-20',
                'model_name' => 'LTM 1300-6.2',
                'rpm' => 1800,
                'description_of_machine' => 'Mobile crane with high lifting capacity.',            ],
        ];
        Machine::insert($machine);
    }
}
