<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Contracts\View\View;

final class BookingController
{
    public function create(Service $service): View
    {
        return view('bookings.create', [
            'service' => $service,
        ]);
    }
}
