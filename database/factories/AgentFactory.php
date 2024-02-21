<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agent>
 */
class AgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName(),
            'name' => $this->faker->lastName(),
            'status' => $status = fake()->randomElement(['SPP', 'SPV']),
            'cycle' => $status === 'SPP' ?  fake()->randomElement(['12', '24']) : null,
            'section' => $status === 'SPP' ?  fake()->randomElement([1,2,3,4]) : null,
        ];
    }
}
