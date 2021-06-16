<?php

namespace Database\Factories;

use App\Models\Product;
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
            'category_id' => $this->faker->biasedNumberBetween($min = 1, $max = 5, $function = 'sqrt'),
            'name' => $this->faker->name(),
            'price' => $this->faker->biasedNumberBetween($min = 1000, $max = 10000, $function = 'sqrt'),
            'cost_price' => $this->faker->biasedNumberBetween($min = 1000, $max = 10000, $function = 'sqrt'),
            'description' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'gallery' => 'static/shopee.png',
        ];
    }
}
