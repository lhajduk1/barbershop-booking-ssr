@extends('layouts.admin')
@section('title', 'Overview')
@section('content')
    <x-admin-shell>
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
    </x-admin-shell>
@endsection
