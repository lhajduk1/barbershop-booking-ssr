<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminWorkingHourOverrideUpdateRequest;
use App\Models\Employee;
use App\Models\WorkingHour;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Date;

final class AdminScheduleController
{
    public function index(): View
    {
        $employees = Employee::query()->with([
            'workingHours' => fn ($workingHours) => $workingHours->orderBy('weekday', 'ASC'),
            'workingHours.workingHourOverride',
        ])
            ->orderBy('is_active', 'DESC')
            ->get();

        return view('admin.schedule.index', [
            'employees' => $employees,
            ...$this->currentWeek(),
        ]);
    }

    public function update(AdminWorkingHourOverrideUpdateRequest $request, WorkingHour $schedule): RedirectResponse
    {
        $data = $request->validated();

        $schedule->workingHourOverride()
            ->updateOrCreate([
                'working_hour_id' => $schedule->id,
                'date' => Date::parse($data['date'])->startOfDay()->toDateTimeString(),
            ], [
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'is_working' => $data['is_working'],
            ]);

        return to_route('admin.schedule.index')
            ->with([
                'type' => 'success',
                'message' => 'You have sucessfully updated a schedule!',
            ]);
    }

    private function currentWeek(): array
    {
        $date = Date::today();

        $startOfWeek = $date->copy()->startOfWeek();
        $endOfWeek = $date->copy()->endOfWeek();
        $current = $startOfWeek;
        $week = [];

        while ($current <= $endOfWeek) {
            $week[] = $current;
            $current = $current->copy()->addDay();
        }

        return [
            'startOfWeek' => $startOfWeek,
            'endOfWeek' => $endOfWeek,
            'week' => $week,
        ];
    }
}
