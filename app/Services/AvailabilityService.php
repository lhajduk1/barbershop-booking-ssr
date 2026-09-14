<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Employee;
use App\Models\WorkingHour;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

final class AvailabilityService
{
    public function availability(Request $request, Employee $employee): array
    {
        $slots = new Collection();

        $dates = $this->prepareDates($employee);

        if ($request->has('date')) {
            $slots = $this->prepareSlots($request->input('date'), $dates);
        }

        $dates = $this->formatDates($dates);

        return [
            'dates' => $dates,
            'slots' => $slots,
        ];
    }

    private function prepareDates(Employee $employee): Collection
    {
        $employee->loadMissing('workingHours');

        return $employee->workingHours->map(fn (WorkingHour $date): array => [
            'starts_at' => $date->start_time,
            'ends_at' => $date->end_time,
        ])->unique();
    }

    private function prepareSlots(string $date, Collection $dates): Collection
    {
        $date = CarbonImmutable::parse($date);
        $dayStart = $date->startOfDay();
        $dayEnd = $date->endOfDay();

        $availabilities = $dates->filter(fn (array $item): bool => $item['starts_at']->lessThanOrEqualTo($dayEnd)
            && $item['ends_at']->greaterThanOrEqualTo($dayStart))->map(fn (array $item): array => [
                'starts_at' => $item['starts_at']->greaterThan($dayStart)
                    ? $item['starts_at']
                    : $dayStart,
                'ends_at' => $item['ends_at']->lessThan($dayEnd)
                    ? $item['ends_at']
                    : $dayEnd,
            ]);

        return $availabilities->flatMap(function (array $availability): Collection {
            $slots = new Collection();

            $current = $availability['starts_at'];

            while ($current->lessThan($availability['ends_at'])) {
                $slots->push($current);

                $current = $current->addMinutes(30);
            }

            return $slots;
        });
    }

    private function formatDates(Collection $dates): Collection
    {
        return $dates->flatten()->map(fn ($item) => $item->format('Y-m-d'));
    }
}
