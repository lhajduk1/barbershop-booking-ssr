<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\UserRole;
use App\Models\Booking;
use App\Models\Employee;
use App\Models\Service;
use App\Models\User;
use App\Models\WorkingHour;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::create(['name' => UserRole::ADMIN]);
        $employeeRole = Role::create(['name' => UserRole::EMPLOYEE]);
        $customerRole = Role::create(['name' => UserRole::CUSTOMER]);

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        $employee = User::factory()->create([
            'name' => 'Employee',
            'email' => 'employee@example.com',
        ]);

        $customer = User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@example.com',
        ]);

        $admin->assignRole($adminRole);
        $employee->assignRole($employeeRole);
        $customer->assignRole($customerRole);

        $services = Service::factory(20)->create();
        $employees = Employee::factory(9)->create();

        foreach ($employees as $employee) {
            WorkingHour::factory()
                ->recycle($employee)
                ->startsAt(CarbonImmutable::yesterday()->setTime(20, 0))
                ->create();
            WorkingHour::factory()
                ->recycle($employee)
                ->startsAt(CarbonImmutable::today()->setTime(20, 0))
                ->create();
            WorkingHour::factory()
                ->recycle($employee)
                ->startsAt(CarbonImmutable::today()->addDay()->setTime(20, 0))
                ->create();
        }

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
