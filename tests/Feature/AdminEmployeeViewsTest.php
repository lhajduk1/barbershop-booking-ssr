<?php

declare(strict_types=1);

use App\Models\Employee;
use App\Models\User;
use Spatie\Permission\Models\Role;

beforeEach(function (): void {
    $user = User::factory()->make(['id' => 'admin']);
    $user->setRelation('roles', collect([new Role(['name' => 'admin', 'guard_name' => 'web'])]));
    $this->actingAs($user);
});

it('renders the empty list and explicit create fields', function (): void {
    $this->get(route('admin.employees.index'))->assertOk()->assertSee('No employees have been added yet.');
    $this->get(route('admin.employees.create'))->assertOk()->assertSee('action="'.route('admin.employees.store').'"', false)
        ->assertSee(['name="first_name"', 'name="last_name"', 'name="bio"', 'name="is_active"', 'name="_token"'], false);
});

it('renders employee details and update and deletion forms', function (): void {
    $employee = Employee::factory()->create(['first_name' => str_repeat('James ', 20).'<b>Test</b>', 'last_name' => 'Smith', 'bio' => null, 'is_active' => true]);
    $this->get(route('admin.employees.show', $employee))->assertOk()->assertSee($employee->first_name)->assertSee('No bio provided.')
        ->assertSee('action="'.route('admin.employees.destroy', $employee).'"', false)->assertSee('value="DELETE"', false)->assertDontSee('<b>Test</b>', false);
    $this->get(route('admin.employees.edit', $employee))->assertOk()->assertViewHas('employee', $employee)
        ->assertSee('value="Smith"', false)->assertSee('value="PUT"', false)
        ->assertSee('action="'.route('admin.employees.update', $employee).'"', false);
});

it('paginates employees at 25 per page', function (): void {
    Employee::factory()->count(26)->create();
    $first = $this->get(route('admin.employees.index'))->assertOk()->assertSee('1 / 2');
    expect($first->viewData('employees')->count())->toBe(25);
    $second = $this->get(route('admin.employees.index', ['page' => 2]))->assertOk()->assertSee('2 / 2');
    expect($second->viewData('employees')->count())->toBe(1);
});

it('renders validation messages with accessible associations', function (): void {
    $this->withViewErrors(['first_name' => 'Please enter a first name.'])->view('admin.employees.create')
        ->assertSee('Please enter a first name.')->assertSee('aria-describedby="first-name-error"', false);
});
