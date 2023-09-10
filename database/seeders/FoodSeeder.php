<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Food;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Ingredient;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create 10 foods with random titles and descriptions
        Food::factory()->count(10)->create();

        //connect foods with tags, categories and ingredients..

        //get all the seeded tags
        $tags = Tag::all();
        //every food must have  at least one tag
        //every tag does not need to have at least one food
        //for each food insert a random number of tag ids into the food-tag pivot table
        Food::all()->each(function ($food) use ($tags) {
            $food->tags()->attach(
                $tags->random(rand(1, $tags->count()))->pluck('id')->toArray()
            );
        });

        //get all the seeded categories
        $categories = Category::all();
        //every food can have at most 1 category
        //every category does not need to have at least one food
        Food::all()->each(function ($food) use ($categories) {
            $add_category = rand(0, 1);
            if ($add_category) {
                $food->category_id = $categories->random()->id;
                $food->save();
            };

        });

        //get all the seeded ingredients
        $ingredients = Ingredient::all();
        //every food must have  at least one ingredient
        //every ingredient does not need to have at least one food
        Food::all()->each(function ($food) use ($ingredients) {
            $food->ingredients()->attach(
                $ingredients->random(rand(1, $ingredients->count()))->pluck('id')->toArray()
            );
        });
    }
}
