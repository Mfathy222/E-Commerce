<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name= $this->faker->words(5,true);
        return [

            'name'=>$name,
            'slug'=>str::slug($name),
            'description'=>$this->faker->sentence(10),
            'image'=>$this->faker->imageUrl(600,600),
            'price'=>$this->faker->randomFloat(1,1,499),
            'compare_price'=>$this->faker->randomFloat(1,1,999),
            'category_id'=>Category::inRandomOrder()->first()->id,
            'featured'=>rand(0,1),
            'store_id'=>Store::inRandomOrder()->first()->id

        ];
    }
}
