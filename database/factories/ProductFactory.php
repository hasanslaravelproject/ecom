<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'quantity' => $this->faker->randomNumber,
            'unitprice' => $this->faker->randomFloat(2, 0, 9999),
            'status' => 'inactive',
            'unit_id' => \App\Models\Unit::factory(),
            'product_category_id' => \App\Models\ProductCategory::factory(),
            'product_category_id' => \App\Models\ProductCategory::factory(),
        ];
    }
}
