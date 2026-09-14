<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Date;

final class WorkingHour extends Model
{
    use HasFactory;

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    protected function casts()
    {
        return [
            'id' => 'integer',
            'employee_id' => 'integer',
            'weekday' => 'integer',
            'starts_at' => 'string',
            'ends_at' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    protected function period(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes): string => Date::createFromFormat('H:i:s', $attributes['starts_at'])->format('H:i').'-'.Date::createFromFormat('H:i:s', $attributes['ends_at'])->format('H:i')
        );
    }
}
