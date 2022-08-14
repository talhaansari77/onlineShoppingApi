<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'brand' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'sku' => $this->faker->word,
            'image' => $this->faker->word,
            'tags' => $this->faker->word,
            

        
        ];
    }
}
