<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Service;
use DateInterval;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends Factory<Booking>
 */
final class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startsAt = fake()->dateTimeThisMonth();
        $service = Service::factory()->create();
        $status = Arr::random([
            'pending',
            'completed',
            'cancelled',
        ]);

        return [
            'user_id' => null,
            'status' => $status,
            'starts_at' => $startsAt,
            'ends_at' => (clone $startsAt)->add(
                DateInterval::createFromDateString($service->duration_minutes.' minutes')
            ),
            'duration_minutes' => $service->duration_minutes,
            'price_cents' => $service->price_cents,
            'customer_first_name' => fake()->firstName(),
            'customer_last_name' => fake()->lastName(),
            'customer_email' => fake()->safeEmail(),
            'customer_phone' => fake()->phoneNumber(),
            'notes' => fake()->optional()->paragraph(2),
            'cancelled_at' => $status === 'cancelled'
                ? fake()->dateTimeBetween($startsAt, 'now')
                : null,
        ];
    }

    public function pending(): static
    {
        return $this->state([
            'status' => 'pending',
            'cancelled_at' => null,
        ]);
    }

    public function completed(): static
    {
        return $this->state([
            'status' => 'completed',
            'cancelled_at' => null,
        ]);
    }

    public function cancelled(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => 'cancelled',
            'cancelled_at' => fake()->dateTimeBetween(
                $attributes['starts_at'] ?? '-1 month',
                'now'
            ),
        ]);
    }
}
