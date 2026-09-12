<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Employee;
use App\Models\WorkingHour;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WorkingHour>
 */
final class WorkingHourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startsAt = CarbonImmutable::createFromTime(8, 0);

        return [
            'employee_id' => Employee::factory(),
            'weekday' => 1,
            'starts_at' => $startsAt->format('H:i:s'),
            'ends_at' => $startsAt->copy()->addHours(8)->format('H:i:s'),
        ];
    }

    public function weekday(int $weekday): static
    {
        return $this->state([
            'weekday' => $weekday,
        ]);
    }

    public function startsAt(CarbonInterface $startsAt): static
    {
        return $this->state([
            'starts_at' => $startsAt->format('H:i:s'),
            'ends_at' => $startsAt->copy()->addHours(8)->format('H:i:s'),
        ]);
    }
}
