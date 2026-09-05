<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Employee extends Model
{
    use HasFactory;

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    protected function casts()
    {
        return [
            'first_name' => 'string',
            'last_name' => 'string',
            'bio' => 'string',
            'is_active' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
