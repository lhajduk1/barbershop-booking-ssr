<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $services = Service::factory(20)->create();

        Booking::factory(10)
            ->recycle($services)
            ->pending()
            ->create();

        Booking::factory(10)
            ->recycle($services)
            ->completed()
            ->create();

        Booking::factory(10)
            ->recycle($services)
            ->cancelled()
            ->create();
    }
}
