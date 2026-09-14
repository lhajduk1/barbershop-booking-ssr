<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

final class AdminScheduleController
{
    public function index(): Factory|View
    {
        $employees = Employee::query()->with(['workingHours' => fn($workingHours) => $workingHours->orderBy('weekday', 'ASC')])
            ->orderBy('is_active', 'DESC')
            ->get();

        return view('admin.schedule.index', [
            'employees' => $employees,
        ]);
    }
}
