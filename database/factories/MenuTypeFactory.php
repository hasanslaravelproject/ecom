<?php

namespace Database\Factories;

use App\Models\MenuType;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MenuType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTime,
        ];
    }
}
