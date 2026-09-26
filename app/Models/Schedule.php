<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Date;

#[Appends(['period', 'override_url'])]
final class Schedule extends Model
{
    use HasFactory;

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function scheduleOverrides(): HasMany
    {
        return $this->hasMany(ScheduleOverride::class);
    }

    protected function casts()
    {
        return [
            'id' => 'integer',
            'employee_id' => 'integer',
            'weekday' => 'integer',
            'start_time' => 'string',
            'end_time' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    protected function period(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes): string => Date::createFromFormat('H:i:s', $attributes['start_time'])->format('H:i').'-'.Date::createFromFormat('H:i:s', $attributes['end_time'])->format('H:i')
        );
    }

    protected function overrideUrl(): Attribute
    {
        return Attribute::make(
            get: fn (): string => route('admin.schedule.override', $this)
        );
    }
}
