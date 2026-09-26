<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Schedule;
use App\Models\ScheduleOverride;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ScheduleOverride>
 */
final class ScheduleOverrideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'schedule_id' => Schedule::factory(),
            'date' => fake()->date(),
            'start_time' => '08:00:00',
            'end_time' => '16:00:00',
            'is_working' => true,
        ];
    }
}
