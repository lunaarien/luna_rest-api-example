<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewMachineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'manufacturing_id' => $this->faker->numberBetween(1, 50),
            'machine_name' => $this->faker->word,
            'brand' => $this->faker->company, 
            'power_rating' => $this->faker->optional()->randomFloat(2, 0, 100), 
            'manufactured_date' => $this->faker->optional()->date(), 
            'model_name' => $this->faker->word, 
            'rpm' => $this->faker->optional()->numberBetween(1000, 10000), 
            'description_of_machine' => $this->faker->optional()->sentence(), 
        ];

    }
}
