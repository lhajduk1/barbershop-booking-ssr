@extends('layouts.admin')
@section('title', 'Service details')
@section('content')
    <x-admin-shell title="Services / Details" active="Services">
        <a href="{{ route('admin.services.index') }}" class="admin-accent text-sm">← Back to services</a>
        <div class="mt-8 flex flex-wrap items-end justify-between gap-6">
            <div class="min-w-0 flex-1">
                <p class="admin-eyebrow">The service menu</p>
                <h1 class="wrap-anywhere font-display mt-3 text-5xl">{{ $service->name }}</h1>
            </div>
            <a href="{{ route('admin.services.edit', $service) }}" class="admin-button inline-flex items-center">Edit service</a>
        </div>
        <section class="admin-surface mt-8 max-w-3xl border border-[var(--admin-border)] p-6 sm:p-9" aria-label="Service details">
            <span class="{{ $service->is_active ? 'admin-selected' : 'admin-muted' }} inline-block border border-[var(--admin-border)] px-3 py-1 text-xs">{{ $service->is_active ? 'Active' : 'Inactive' }}</span>
            <dl class="mt-7 grid gap-6 sm:grid-cols-2">
                <div>
                    <dt class="admin-muted text-xs">Price</dt>
                    <dd class="admin-accent font-display mt-2 text-4xl">${{ number_format($service->price_cents / 100, 2, ',', ' ') }}</dd>
                </div>
                <div>
                    <dt class="admin-muted text-xs">Duration</dt>
                    <dd class="font-display mt-2 text-4xl">{{ $service->duration_minutes }} <span class="text-xl">min</span></dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="admin-muted text-xs">Slug</dt>
                    <dd class="wrap-anywhere mt-2 text-sm">{{ $service->slug }}</dd>
                </div>
                <div class="border-t border-[var(--admin-border)] pt-6 sm:col-span-2">
                    <dt class="font-display text-2xl">Description</dt>
                    <dd class="admin-muted wrap-anywhere mt-3 whitespace-pre-line text-sm leading-7">{{ filled($service->description) ? $service->description : 'No description provided.' }}</dd>
                </div>
            </dl>
        </section>
        <section class="mt-8 max-w-3xl border border-[var(--admin-border)] p-6 sm:p-9">
            <h2 class="font-display text-2xl">Delete service</h2>
            <form action="{{ route('admin.services.destroy', $service) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="admin-outline admin-error mt-4 min-h-12 cursor-pointer px-5 text-sm">Delete service</button>
            </form>
        </section>
    </x-admin-shell>
@endsection
