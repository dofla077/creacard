<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quotation>
 */
class QuotationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'label' => $this->faker->word(),
            'number' => $this->faker->unique()->numerify('###-###-####'),
           // 'state' => ,
            'price' => $this->faker->numberBetween(10, 500),
            'description' => $this->faker->sentence(4),

        ];
    }
}
