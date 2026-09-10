<?php

declare(strict_types=1);

use App\Mail\BookingCreatedMail;
use App\Models\Booking;
use App\Models\Employee;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

it('redirects a successful booking and preserves the thank you page on refresh', function (): void {
    $service = Service::factory()->create();
    $employee = Employee::factory()->create();
    Mail::fake();

    $this->post(route('booking.store', $service), [
        'employee_id' => $employee->id,
        'date' => now()->addDay()->format('Y-m-d'),
        'time' => '10:00',
        'customer_first_name' => 'Alex',
        'customer_last_name' => 'Smith',
        'customer_email' => 'alex@example.test',
        'customer_phone' => '123456789',
    ])->assertRedirectToRoute('booking.thank-you')->assertSessionHas('booking_created', true);

    foreach (range(1, 3) as $visit) {
        $this->get(route('booking.thank-you'))
            ->assertOk()
            ->assertSee('Your booking details have been sent to your email')
            ->assertSee('Create an account')
            ->assertSee('Sign in')
            ->assertDontSee('alex@example.test');
    }

    expect(Booking::query()->count())->toBe(1);
    Mail::assertSent(BookingCreatedMail::class, 1);
});

it('hides account invitations for signed in customers', function (): void {
    $this->actingAs(User::factory()->make(['id' => 'test-customer']))
        ->withSession(['booking_created' => true])
        ->get(route('booking.thank-you'))
        ->assertOk()
        ->assertSee('Explore our services')
        ->assertDontSee('Create an account')
        ->assertDontSee('Sign in')
        ->assertDontSee('Make your next visit even easier');
});

it('requires a success marker', function (): void {
    $this->get(route('booking.thank-you'))->assertRedirectToRoute('services.index');
});

it('keeps invalid bookings on the booking form', function (): void {
    $service = Service::factory()->create();
    Mail::fake();

    $this->from(route('booking.create', $service))
        ->post(route('booking.store', $service), [])
        ->assertRedirect(route('booking.create', $service))
        ->assertSessionHasErrors(['starts_at', 'customer_email'])
        ->assertSessionMissing('booking_created');

    expect(Booking::query()->count())->toBe(0);
    Mail::assertNothingSent();
});
