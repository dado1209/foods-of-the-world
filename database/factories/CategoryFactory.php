<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'en' => ['title' => 'Category title in EN'],
            'hr' => ['title' => 'Naslov kategorije na HRV jeziku'],
            'slug' => 'tag-' . $this->faker->unique()->numberBetween(1, 1000000000),
        ];
    }
}
