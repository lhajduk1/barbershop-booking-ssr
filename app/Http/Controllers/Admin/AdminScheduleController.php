<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Laravel\Mcp\Request;

final class AdminScheduleController
{
    public function index(): View
    {
        $employees = Employee::query()->with(['workingHours' => fn($workingHours) => $workingHours->orderBy('weekday', 'ASC')])
            ->orderBy('is_active', 'DESC')
            ->get();

        return view('admin.schedule.index', [
            'employees' => $employees,
            ...$this->currentWeek()
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        // TODO: implement working_hours_overrides
    }

    private function currentWeek(): array
    {
        $date = Carbon::today();

        $startOfWeek = $date->copy()->startOfWeek();
        $endOfWeek = $date->copy()->endOfWeek();
        $current = $startOfWeek;
        $week = [];

        while ($current <= $endOfWeek) {
            array_push($week, $current);
            $current = $current->copy()->addDay();
        }

        return [
            'startOfWeek' => $startOfWeek,
            'endOfWeek' => $endOfWeek,
            'week' => $week
        ];
    }
}
