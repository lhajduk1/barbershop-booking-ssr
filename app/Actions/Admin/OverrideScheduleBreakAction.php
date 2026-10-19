<?php

declare(strict_types=1);

namespace App\Actions\Admin;

use App\Models\ScheduleBreak;
use Illuminate\Support\Facades\Date;

final readonly class OverrideScheduleBreakAction
{
    /**
     * Execute the action.
     */
    public function handle(array $breaks): void
    {
        foreach ($breaks as $id => $break) {
            $scheduleBreak = ScheduleBreak::find($id);

            if (!$scheduleBreak) {
                continue;
            }

            $scheduleBreak->scheduleBreakOverride()
                ->updateOrCreate([
                    'schedule_break_id' => $scheduleBreak->id,
                    'date' => Date::parse($break['date'])->startOfDay()->toDateTimeString(),
                ], [
                    'start_time' => $break['start_time'],
                    'end_time' => $break['end_time'],
                ]);
        }
    }
}
