@extends('layouts.admin')
@section('title', 'Services')
@section('content')
    <x-admin-shell title="Services" active="Services">
        <div class="flex flex-wrap items-end justify-between gap-6">
            <div><p class="admin-eyebrow">The service menu</p><h1 class="mt-3 font-display text-5xl sm:text-6xl">Services</h1><p class="admin-muted mt-4 text-sm">The craft, the care, and everything on your menu.</p></div>
            <a href="{{ route('admin.services.create') }}" class="admin-button inline-flex items-center gap-3"><span aria-hidden="true">+</span> Add service</a>
        </div>
        <section class="admin-surface mt-9 border border-[var(--admin-border)]" aria-label="Service list">
            <div class="flex items-center justify-between border-b border-[var(--admin-border)] p-6"><h2 class="font-display text-2xl">Your services</h2><span class="admin-muted text-xs">{{ $services->total() }} total</span></div>
            @if ($services->isNotEmpty())
                <div aria-hidden="true" class="admin-muted hidden grid-cols-[minmax(0,2fr)_90px_90px_90px_110px] gap-4 border-b border-[var(--admin-border)] px-6 py-4 text-[10px] font-semibold uppercase tracking-widest xl:grid"><span>Service</span><span>Price</span><span>Duration</span><span>Status</span><span>Actions</span></div>
            @endif
            <ul>
                @forelse ($services as $service)
                    <li class="grid min-w-0 gap-4 border-b border-[var(--admin-border)] p-6 last:border-b-0 sm:grid-cols-2 xl:grid-cols-[minmax(0,2fr)_90px_90px_90px_110px] xl:items-center">
                        <a href="{{ route('admin.services.show', $service) }}" class="wrap-anywhere font-display text-2xl">{{ $service->name }}</a>
                        <span class="admin-accent text-sm"><span class="sr-only">Price: </span>${{ number_format($service->price_cents / 100, 2, ',', ' ') }}</span>
                        <span class="admin-muted text-sm"><span class="sr-only">Duration: </span>{{ $service->duration_minutes }} min</span>
                        <span class="{{ $service->is_active ? 'admin-selected' : 'admin-muted' }} w-fit border border-[var(--admin-border)] px-2 py-1 text-xs">{{ $service->is_active ? 'Active' : 'Inactive' }}</span>
                        <div class="flex gap-4 text-sm"><a href="{{ route('admin.services.show', $service) }}" aria-label="View {{ $service->name }}" class="admin-accent underline underline-offset-4">View</a><a href="{{ route('admin.services.edit', $service) }}" aria-label="Edit {{ $service->name }}" class="admin-accent underline underline-offset-4">Edit</a></div>
                    </li>
                @empty
                    <li class="px-6 py-16 text-center"><h2 class="font-display text-3xl">Your menu starts here.</h2><p class="admin-muted mt-3 text-sm">No services have been added yet.</p><a href="{{ route('admin.services.create') }}" class="admin-accent mt-6 inline-block underline underline-offset-4">Add your first service</a></li>
                @endforelse
            </ul>
        </section>
        @if ($services->hasPages())
            <nav aria-label="Services pagination" class="mt-6 flex flex-wrap items-center justify-between gap-4 text-sm">
                <p class="admin-muted">Showing {{ $services->firstItem() }}–{{ $services->lastItem() }} of {{ $services->total() }}</p>
                <div class="flex items-center gap-4">
                    @if ($services->onFirstPage())<span aria-disabled="true" class="admin-muted">Previous</span>@else<a rel="prev" href="{{ $services->previousPageUrl() }}" class="admin-outline px-4 py-3">Previous</a>@endif
                    <span class="admin-muted">{{ $services->currentPage() }} / {{ $services->lastPage() }}</span>
                    @if ($services->hasMorePages())<a rel="next" href="{{ $services->nextPageUrl() }}" class="admin-outline px-4 py-3">Next</a>@else<span aria-disabled="true" class="admin-muted">Next</span>@endif
                </div>
            </nav>
        @endif
    </x-admin-shell>
@endsection
