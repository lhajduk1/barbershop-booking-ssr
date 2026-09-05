<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Booking;
use App\Models\Employee;
use App\Models\Service;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $services = Service::factory(20)->create();
        $employees = Employee::factory(9)->create();

        Booking::factory(10)
            ->recycle($services)
            ->recycle($employees)
            ->pending()
            ->create();

        Booking::factory(10)
            ->recycle($services)
            ->recycle($employees)
            ->completed()
            ->create();

        Booking::factory(10)
            ->recycle($services)
            ->recycle($employees)
            ->cancelled()
            ->create();
    }
}
