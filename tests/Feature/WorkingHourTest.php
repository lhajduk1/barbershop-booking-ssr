<?php

declare(strict_types=1);

use App\Models\User;
use App\Models\WorkingHour;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

it('stores working times and formats the period using the renamed columns', function (): void {
    $workingHour = WorkingHour::factory()->startsAt(CarbonImmutable::createFromTime(9, 30))->create()->refresh();

    expect($workingHour->start_time)->toBe('09:30:00')
        ->and($workingHour->end_time)->toBe('17:30:00')
        ->and($workingHour->period)->toBe('09:30-17:30');

    $workingHour->update(['start_time' => '10:15:00', 'end_time' => '18:45:00']);

    expect($workingHour->refresh()->period)->toBe('10:15-18:45');
});

it('preserves working times when the column rename is reversed and reapplied', function (): void {
    $workingHour = WorkingHour::factory()->create();
    $migration = require database_path('migrations/2026_09_14_104555_rename_time_columns_on_working_hours_table.php');

    $migration->down();

    $row = DB::table('working_hours')->find($workingHour->id);
    expect($row->starts_at)->toBe('08:00:00')
        ->and($row->ends_at)->toBe('16:00:00');

    $migration->up();

    expect($workingHour->refresh()->start_time)->toBe('08:00:00')
        ->and($workingHour->end_time)->toBe('16:00:00');
});

it('renders working times in the schedule and edit dialog data', function (): void {
    $user = User::factory()->make(['id' => 'admin']);
    $user->setRelation('roles', collect([new Role(['name' => 'admin', 'guard_name' => 'web'])]));
    WorkingHour::factory()->create();

    $this->actingAs($user)->get(route('admin.schedule.index'))
        ->assertOk()
        ->assertSee('08:00-16:00')
        ->assertSee('08:00:00')
        ->assertSee('16:00:00');
});
