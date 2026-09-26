<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\OverrideScheduleAction;
use App\Http\Requests\Admin\AdminScheduleOverrideUpdateRequest;
use App\Http\Requests\Admin\ScheduleChangeWeekRequest;
use App\Models\Schedule;
use App\Services\Admin\ScheduleService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class AdminScheduleController
{
    public function index(): View
    {
        return view('admin.schedule.index');
    }

    public function override(AdminScheduleOverrideUpdateRequest $request, Schedule $schedule, OverrideScheduleAction $action): RedirectResponse
    {
        $action->handle($schedule, $request->validated());

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
