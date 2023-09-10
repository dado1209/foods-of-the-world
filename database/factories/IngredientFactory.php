<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //generate random number for the slug to be unique
            'en' => ['title' => 'Ingredient title in EN'],
            'hr' => ['title' => 'Naslov sastojka na HRV jeziku'],
            'slug' => 'tag-' . $this->faker->unique()->numberBetween(1, 1000000000),
        ];
    }
}
