<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Booking extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    protected function casts()
    {
        return [
            'id' => 'integer',
            'user_id' => 'string',
            'service_id' => 'integer',
            'status' => 'string',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'duration_minutes' => 'integer',
            'price_cents' => 'integer',
            'customer_first_name' => 'string',
            'customer_last_name' => 'string',
            'customer_email' => 'string',
            'customer_phone' => 'string',
            'notes' => 'string',
            'cancelled_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
