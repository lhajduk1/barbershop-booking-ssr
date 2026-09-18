<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\OverrideScheduleAction;
use App\Http\Requests\Admin\AdminWorkingHourOverrideUpdateRequest;
use App\Http\Requests\Admin\ScheduleChangeWeekRequest;
use App\Models\WorkingHour;
use App\Services\Admin\ScheduleService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class AdminScheduleController
{
    public function index(): View
    {
        return view('admin.schedule.index');
    }

    public function override(AdminWorkingHourOverrideUpdateRequest $request, WorkingHour $workingHour, OverrideScheduleAction $action): RedirectResponse
    {
        $action->handle($workingHour, $request->validated());

        return to_route('admin.schedule.index')
            ->with([
                'type' => 'success',
                'message' => 'You have sucessfully updated a schedule!',
            ]);
    }

    public function changeWeek(ScheduleChangeWeekRequest $request, ScheduleService $service)
    {
        $response = $service->getWeek(...$request->validated());

        return response()->json($response);
    }
}
