<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantity' => $this->faker->randomNumber(2),
            'date' => $this->faker->dateTime,
            'product_id' => \App\Models\Product::factory(),
            'order_category_id' => \App\Models\OrderCategory::factory(),
            'menu_type_id' => \App\Models\MenuType::factory(),
        ];
    }
}
