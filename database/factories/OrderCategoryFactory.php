<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\OrderCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(255),
        ];
    }
}
