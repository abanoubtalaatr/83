<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdvertisingCampaign>
 */
class AdvertisingCampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'from' => $this->faker->date,
            'to' => $this->faker->date,
            'total' => $this->faker->numberBetween(1,30),
            'daily_budget' => $this->faker->numberBetween(1,30),
            'images' => $this->faker->url
        ];
    }
}
