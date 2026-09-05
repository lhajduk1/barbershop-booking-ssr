<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Employee;
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
        $status = Arr::random([
            'pending',
            'completed',
            'cancelled',
        ]);

        return [
            'user_id' => null,
            'employee_id' => Employee::factory(),
            'service_id' => Service::factory(),
            'status' => $status,
            'starts_at' => $startsAt,
            'duration_minutes' => fn (array $attributes) => Service::query()->find($attributes['service_id'])->duration_minutes,
            'ends_at' => fn (array $attributes) => (clone $attributes['starts_at'])->add(
                DateInterval::createFromDateString(
                    $attributes['duration_minutes'].' minutes'
                )
            ),
            'price_cents' => fn (array $attributes) => Service::query()->find($attributes['service_id'])->price_cents,
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
