<?php

declare(strict_types=1);

use App\Models\User;
use Spatie\Permission\Models\Role;

it('renders admin login with the existing authentication action', function (): void {
    $this->get(route('admin.login'))->assertOk()->assertSee('Admin sign in')
        ->assertSee('action="'.route('login').'"', false)
        ->assertSee('name="_token"', false)->assertSee('name="remember"', false)
        ->assertDontSee('Create an account');
});

it('redirects guests and rejects customers from the admin dashboard', function (): void {
    $this->get(route('admin.dashboard'))->assertRedirectToRoute('admin.login');
    $user = User::factory()->make(['id' => 'customer']);
    $user->setRelation('roles', collect());
    $this->actingAs($user)->get(route('admin.dashboard'))->assertRedirect('/');
});

it('renders the protected dashboard for admins with explicit demo data', function (): void {
    $user = User::factory()->make(['id' => 'admin']);
    $user->setRelation('roles', collect([new Role(['name' => 'admin', 'guard_name' => 'web'])]));
    $this->actingAs($user)->get(route('admin.dashboard'))->assertOk()
        ->assertSee(['Demo data', 'Appointments today', 'Pending bookings', 'Completed today', 'James Sullivan', 'Coming soon'])
        ->assertSee('action="'.route('logout').'"', false)->assertSee('name="_token"', false);
});

it('renders validation feedback without repopulating passwords', function (): void {
    $this->withViewErrors(['email' => 'Invalid credentials.'])->view('admin.login')
        ->assertSee('Invalid credentials.')->assertSee('aria-invalid="true"', false)
        ->assertSee('aria-describedby="email-error"', false);
});
