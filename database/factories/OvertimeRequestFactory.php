<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OvertimeRequest>
 */
class OvertimeRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::pluck('id')->random(),
            'date' => fake()->dateTimeBetween('-1 years', 'now'),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
            'duration' => fake()->numberBetween(1, 8),
            'reason' => fake()->sentence(),
        ];
    }
}