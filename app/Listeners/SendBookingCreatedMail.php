<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Mail\BookingCreatedMail;
use Illuminate\Support\Facades\Mail;

final class SendBookingCreatedMail
{
    /**
     * Handle the event.
     */
    public function handle(BookingCreated $event): void
    {
        Mail::to($event->booking->customer_email)
            ->send(new BookingCreatedMail($event->booking));
    }
}
