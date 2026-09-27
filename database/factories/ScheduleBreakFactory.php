<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Schedule;
use App\Models\ScheduleBreak;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ScheduleBreak>
 */
final class ScheduleBreakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startsAt = CarbonImmutable::createFromTime(8, 0);
        $break = $startsAt->addHours(4);

        return [
            'schedule_id' => Schedule::factory(),
            'start_time' => $break->format('H:i:s'),
            'end_time' => $break->addMinutes(30)->format('H:i:s'),
        ];
    }

    public function startTime(CarbonInterface $startTime): static
    {
        return $this->state([
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $startTime->addMinutes(30)->format('H:i:s'),
        ]);
    }
}
