<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Date;

#[Appends(['period', 'override_url', 'weekday'])]
final class WorkingHourOverride extends Model
{
    use HasFactory;

    public function workingHour(): BelongsTo
    {
        return $this->belongsTo(WorkingHour::class);
    }

    protected function casts()
    {
        return [
            'date' => 'date',
        ];
    }

    protected function period(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes): string => Date::createFromTimeString($attributes['start_time'])->format('H:i') . '-' .
                Date::createFromTimeString($attributes['end_time'])->format('H:i')
        );
    }

    protected function overrideUrl(): Attribute
    {
        return Attribute::make(
            get: fn(): string => route('admin.schedule.override', $this->workingHour)
        );
    }

    protected function weekday(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes): int => Date::parse($attributes['date'])->dayOfWeekIso - 1
        );
    }
}
