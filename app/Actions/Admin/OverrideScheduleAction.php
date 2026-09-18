<?php

declare(strict_types=1);

namespace App\Actions\Admin;

use App\Models\WorkingHour;
use App\Models\WorkingHourOverride;
use Illuminate\Support\Facades\Date;

final readonly class OverrideScheduleAction
{
    /**
     * Execute the action.
     */
    public function handle(WorkingHour $workingHour, array $data): WorkingHourOverride
    {
        return $workingHour->workingHourOverrides()
            ->updateOrCreate([
                'working_hour_id' => $workingHour->id,
                'date' => Date::parse($data['date'])->startOfDay()->toDateTimeString(),
                'weekday' => $workingHour->weekday,
            ], [
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'is_working' => $data['is_working'],
            ]);
    }
}
