<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends Factory<Employee>
 */
final class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'bio' => fake()->optional()->paragraph(3),
            'is_active' => Arr::random([true, false]),
        ];
    }

    public function active(): static
    {
        return $this->state(['is_active' => true]);
    }

    public function inActive(): static
    {
        return $this->state(['is_active' => true]);
    }
}
