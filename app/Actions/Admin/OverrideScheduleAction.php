<?php

declare(strict_types=1);

namespace App\Actions\Admin;

use App\Models\Schedule;
use App\Models\ScheduleOverride;
use Illuminate\Support\Facades\Date;

final readonly class OverrideScheduleAction
{
    /**
     * Execute the action.
     */
    public function handle(Schedule $schedule, array $data): ScheduleOverride
    {
        return $schedule->scheduleOverrides()
            ->updateOrCreate([
                'schedule_id' => $schedule->id,
                'date' => Date::parse($data['date'])->startOfDay()->toDateTimeString(),
            ], [
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'is_working' => $data['is_working'],
            ]);
    }
}
