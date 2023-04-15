<?php

namespace Database\Factories;
//use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
//use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->name,
            'cat_name' => $this->faker->name,
            'sub_cat_name' => $this->faker->name,
            'price' => 500,
            'quantity' => 20,
            'sku' => $this->faker->slug,
            'des' => $this->faker->paragraph,
            'expire_date' => $this->faker->date,
            'feature_image' => $this->faker->name,
            'discount_type' => 'flat',
            'discount_amount' => 10,

        ];
    }
}
