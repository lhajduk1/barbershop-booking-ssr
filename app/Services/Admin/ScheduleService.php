<?php

declare(strict_types=1);

namespace App\Services\Admin;

use App\Models\Employee;
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;

final class ScheduleService
{
    public function getWeek(CarbonInterface $date, string $type): array
    {
        $startOfWeek = $this->resolveStartOfWeek($date, $type);
        $endOfWeek = $startOfWeek->copy()->endOfWeek();
        $current = $startOfWeek;
        $week = [];

        while ($current <= $endOfWeek) {
            $week[] = [
                'weekday' => $current->format('l'),
                'date_formatted' => $current->format('d.m'),
                'date' => $current,
            ];

            $current = $current->copy()->addDay();
        }

        $query = $this->query($startOfWeek, $endOfWeek);

        return [
            'employees' => $this->schedule($query),
            'weekLabel' => $this->weekLabel($startOfWeek, $endOfWeek),
            'startOfWeek' => $startOfWeek,
            'endOfWeek' => $endOfWeek,
            'week' => $week,
        ];
    }

    private function resolveStartOfWeek(CarbonInterface $date, string $type): CarbonInterface
    {
        $startOfWeek = $date->startOfWeek();

        return match ($type) {
            'previous' => $startOfWeek->subWeek(),
            'next' => $startOfWeek->addWeek(),
            default => $startOfWeek
        };
    }

    private function query(CarbonInterface $startOfWeek, CarbonInterface $endOfWeek): Collection
    {
        return Employee::query()
            ->select('id', 'first_name', 'last_name', 'is_active')
            ->with([
                'schedules' => fn ($query) => $query
                    ->select('id', 'employee_id', 'weekday', 'start_time', 'end_time', 'is_working')
                    ->orderBy('weekday'),
                'schedules.scheduleOverrides' => fn ($query) => $query
                    ->select('id', 'schedule_id', 'date', 'start_time', 'end_time', 'is_working')
                    ->whereBetween('date', [$startOfWeek, $endOfWeek]),
            ])
            ->orderBy('is_active', 'DESC')
            ->get();
    }

    private function schedule(Collection $query): Collection
    {
        return $query->map(fn ($employee): array => [
            'id' => $employee->id,
            'name' => $employee->name,
            'is_active' => $employee->is_active,
            'schedule' => $employee->schedules->toArray(),
        ]);
    }

    private function weekLabel(CarbonInterface $startOfWeek, CarbonInterface $endOfWeek): string
    {
        return $startOfWeek->format('d').'-'.$endOfWeek->format('d F Y');
    }
}
