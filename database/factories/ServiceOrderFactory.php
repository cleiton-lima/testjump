<?php

namespace Database\Factories;

use App\Models\ServiceOrder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceOrder>
 */
class ServiceOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = ServiceOrder::class;


    public function definition(): array
    {
        $plateFormat = $this->faker->randomElement([
            '[A-Z]{3}\d{4}',   // Formato convencional: ABC1234
            '[A-Z]{3}\d[A-Z]\d{2}',  // Formato Mercosul: ABC1D45
        ]);

        return [
            'user_id' =>User::inRandomOrder()->first()->id,
            'vehiclePlate' => $this->faker->regexify($plateFormat),
            'entryDateTime' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'exitDateTime' => $this->faker->dateTimeBetween('now', '+1 week'),
            'priceType' => $this->faker->randomElement(['hourly', 'fixed']),
            'price' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
