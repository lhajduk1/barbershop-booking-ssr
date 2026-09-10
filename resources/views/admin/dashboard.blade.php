@extends('layouts.admin')
@section('title', 'Overview')
@section('content')
    <div class="min-h-screen lg:grid lg:grid-cols-[250px_minmax(0,1fr)]">
        <aside class="admin-surface border-b border-[var(--admin-border)] lg:min-h-screen lg:border-b-0 lg:border-r">
            <div class="flex items-center justify-between gap-3 p-6 lg:px-7 lg:py-9">
                <x-admin-brand />
                <button type="button" @click="menuOpen = !menuOpen" :aria-expanded="menuOpen" aria-controls="admin-nav" class="admin-outline grid size-11 shrink-0 place-items-center lg:hidden" aria-label="Toggle navigation">☰</button>
            </div>
            <nav id="admin-nav" aria-label="Admin navigation" :class="{ 'hidden': !menuOpen }" class="hidden px-4 pb-6 lg:block lg:px-5 lg:pt-8">
                <p class="admin-muted mb-4 px-3 text-[10px] font-semibold uppercase tracking-[0.2em]">Workspace</p>
                <a href="{{ route('admin.dashboard') }}" aria-current="page" class="admin-selected flex min-h-12 items-center gap-3 border-l-2 border-current px-4 text-sm font-semibold"><span aria-hidden="true">▦</span> Overview</a>
                @foreach (['Bookings', 'Services', 'Team'] as $section)
                    <span aria-disabled="true" class="admin-muted mt-2 flex min-h-12 cursor-not-allowed items-center justify-between gap-2 px-4 text-sm">{{ $section }} <span class="text-[9px] uppercase tracking-wide">Coming soon</span></span>
                @endforeach
                <div class="mt-16 border-t border-[var(--admin-border)] px-3 pt-6"><p class="font-display text-xl italic">A cut above.</p><p class="admin-muted mt-2 text-xs leading-5">Thoughtful service.<br>Every single day.</p></div>
            </nav>
        </aside>
        <div class="min-w-0">
            <header class="flex flex-wrap items-center justify-between gap-4 border-b border-[var(--admin-border)] px-6 py-5 lg:px-10">
                <p class="admin-muted text-xs">Workspace <span class="mx-2 opacity-50">/</span> <span class="text-[var(--admin-text)]">Overview</span></p>
                <div class="flex items-center gap-3"><x-admin-theme-toggle /><form action="{{ route('logout') }}" method="POST">@csrf<button class="admin-outline min-h-11 px-3 text-xs" type="submit">Sign out</button></form></div>
            </header>
            <main id="admin-main" class="mx-auto max-w-7xl px-6 py-10 lg:px-10 lg:py-14">
                <div class="flex flex-wrap items-end justify-between gap-5">
                    <div><p class="admin-eyebrow">The daily edit</p><h1 class="mt-3 font-display text-5xl sm:text-6xl">Welcome back.</h1><p class="admin-muted mt-4 text-sm leading-6">A little overview of the day ahead.</p></div>
                    <span class="admin-selected border border-[var(--admin-border)] px-3 py-2 text-[10px] font-semibold uppercase tracking-[0.16em]">Demo data</span>
                </div>
                <p class="admin-muted mt-6 text-xs leading-5">Sample appointments and totals for preview. No live booking data is shown.</p>
                <div class="mt-7 grid gap-4 sm:grid-cols-3">
                    @foreach ([['Appointments today', '4', 'On the schedule'], ['Pending bookings', '2', 'Awaiting confirmation'], ['Completed today', '2', 'Visits taken care of']] as [$label, $value, $caption])
                        <section class="admin-surface border border-[var(--admin-border)] p-6 lg:p-7"><h2 class="admin-muted text-xs font-medium">{{ $label }}</h2><p class="admin-accent mt-5 font-display text-5xl">{{ $value }}</p><p class="admin-muted mt-4 text-xs">{{ $caption }}</p></section>
                    @endforeach
                </div>
                <section class="admin-surface mt-8 border border-[var(--admin-border)]">
                    <div class="flex flex-wrap items-center justify-between gap-3 border-b border-[var(--admin-border)] px-6 py-6"><h2 class="font-display text-3xl">Today’s appointments</h2><span class="admin-muted text-xs">4 sample visits</span></div>
                    <div class="hidden grid-cols-[70px_1.2fr_1.2fr_0.8fr_100px] gap-4 border-b border-[var(--admin-border)] px-6 py-4 text-[10px] font-semibold uppercase tracking-widest admin-muted md:grid" aria-hidden="true"><span>Time</span><span>Client</span><span>Service</span><span>Barber</span><span>Status</span></div>
                    <ul>
                        @foreach ([['09:00', 'James Sullivan', 'Signature cut', 'Oliver', 'Completed'], ['10:00', 'Daniel Brooks', 'Cut & beard', 'James', 'Completed'], ['11:30', 'Thomas Reed', 'Traditional shave', 'Oliver', 'Pending'], ['14:00', 'William Hayes', 'Signature cut', 'James', 'Pending']] as [$time, $client, $service, $barber, $status])
                            <li class="grid gap-3 border-b border-[var(--admin-border)] px-6 py-6 text-sm last:border-b-0 md:grid-cols-[70px_1.2fr_1.2fr_0.8fr_100px] md:items-center md:gap-4">
                                <span class="admin-accent font-semibold"><span class="sr-only">Time: </span>{{ $time }}</span>
                                <span class="font-medium"><span class="sr-only">Client: </span>{{ $client }}</span>
                                <span class="admin-muted"><span class="sr-only">Service: </span>{{ $service }}</span>
                                <span class="admin-muted"><span class="md:sr-only">Barber: </span>{{ $barber }}</span>
                                <span class="{{ $status === 'Pending' ? 'admin-selected' : 'admin-muted' }} w-fit border border-[var(--admin-border)] px-2.5 py-1 text-xs"><span class="sr-only">Status: </span>{{ $status }}</span>
                            </li>
                        @endforeach
                    </ul>
                </section>
                <p class="admin-muted mt-8 text-xs">Considered care starts with the details.</p>
            </main>
        </div>
    </div>
@endsection
