<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateBookingAction;
use App\Events\BookingCreated;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Employee;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class BookingController
{
    public function create(Service $service): View
    {
        $employees = Employee::query()
            ->with('schedules')
            ->get();

        return view('bookings.create', [
            'service' => $service,
            'employees' => $employees,
        ]);
    }

    public function store(StoreBookingRequest $request, Service $service, CreateBookingAction $action): RedirectResponse
    {
        $booking = $action->handle($request->validated(), $service);

        event(new BookingCreated($booking));

        return to_route('booking.thank-you')
            ->with('booking_created', true);
    }

    public function thankYou(Request $request): View|RedirectResponse
    {
        if ($request->session()->get('booking_created') !== true) {
            return to_route('services.index');
        }

        $request->session()->keep('booking_created');

        return view('bookings.thank-you');
    }
}
