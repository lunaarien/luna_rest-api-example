<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\NewManufacturingAddress;

class NewManufacturingAddressFactory extends Factory
{
    
    protected $model = NewManufacturingAddress::class;
    
    public function definition()
    {
        return [
            'blk_blg_street_village' => $this->faker->address,          
            'region' => $this->faker->state,                           
            'province' => $this->faker->city,                            
            'district' => $this->faker->citySuffix,                      
            'municipality' => $this->faker->city,                       
            'barangay' => $this->faker->word,
        ];
    }
}
