<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

final readonly class CreateBookingAction
{
    /**
     * Execute the action.
     */
    public function handle(array $validated, Service $service): Booking
    {
        $data = array_merge($validated, [
            'user_id' => Auth::id(),
            'service_id' => $service->id,
            'ends_at' => Date::createFromTimeString($validated['starts_at'])
                ->addMinutes($service->duration_minutes)
                ->format('Y-m-d H:i'),
            'duration_minutes' => $service->duration_minutes,
            'price_cents' => $service->price_cents,
        ]);

        return Booking::query()->create($data);
    }
}
