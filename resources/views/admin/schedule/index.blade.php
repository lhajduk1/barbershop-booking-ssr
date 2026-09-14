@extends('layouts.admin')
@section('title', 'Schedule')
@section('content')
    <x-admin-shell title="Schedule" active="Schedule">
        <div class="flex flex-wrap items-end justify-between gap-5">
            <div>
                <p class="admin-eyebrow">The working week</p>
                <h1 class="font-display mt-3 text-5xl sm:text-6xl">Schedule</h1>
                <p class="admin-muted mt-4 text-sm leading-6">Your team’s week, at a glance.</p>
            </div>
        </div>

        <section class="admin-surface mt-9 border border-[var(--admin-border)]" aria-labelledby="schedule-week">
            <div class="flex flex-wrap items-center justify-between gap-4 border-b border-[var(--admin-border)] p-6">
                <div>
                    <p class="admin-eyebrow">Weekly schedule</p>
                    <h2 id="schedule-week" class="font-display mt-2 text-3xl">14–19 September 2026</h2>
                </div>
                <span class="admin-muted text-xs">{{ $employees->count() }} employees · Monday–Sunday</span>
            </div>

            <div class="overflow-x-auto focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[var(--admin-accent)]" role="region" aria-labelledby="schedule-week" tabindex="0">
                <table class="w-full min-w-[780px] border-separate border-spacing-0 text-left" aria-describedby="schedule-legend">
                    <caption class="sr-only">Sample employee working hours for 14–19 September 2026</caption>
                    <thead>
                        <tr>
                            <th scope="col" class="admin-surface admin-muted sticky left-0 z-10 w-36 border-b border-r border-[var(--admin-border)] px-6 py-5 text-[10px] font-semibold uppercase tracking-widest sm:w-44">Employee</th>
                            @foreach ([['14.09', 'Mon'], ['15.09', 'Tue'], ['16.09', 'Wed'], ['17.09', 'Thu'], ['18.09', 'Fri'], ['19.09', 'Sat'], ['20.09', 'Sun']] as [$date, $day])
                                <th scope="col" class="border-b border-[var(--admin-border)] px-4 py-5 text-center font-normal">
                                    <span class="block text-sm font-semibold tabular-nums">{{ $date }}</span>
                                    <span class="admin-muted mt-2 block text-[10px] font-semibold uppercase tracking-widest">{{ $day }}</span>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr class="{{ !$employee->is_active ? 'opacity-50' : '' }} group">
                                <th scope="row" class="admin-surface font-display sticky left-0 z-10 border-b border-r border-[var(--admin-border)] px-6 py-7 text-2xl font-medium group-last:border-b-0">{{ $employee->name }}</th>
                                @foreach ($employee->workingHours as $shift)
                                    <td class="border-b border-[var(--admin-border)] px-4 py-7 text-center group-last:border-b-0">
                                        <span class="{{ $shift === 'OFF' ? 'admin-muted border-dashed' : 'admin-selected' }} min-w-18 inline-flex min-h-10 items-center justify-center whitespace-nowrap border border-[var(--admin-border)] px-3 py-2 text-xs font-semibold tabular-nums">{{ $shift->period }}</span>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="admin-muted flex flex-wrap items-center justify-between gap-3 border-t border-[var(--admin-border)] px-6 py-4 text-xs leading-5">
                <p id="schedule-legend"><span class="font-semibold">OFF</span> — Day off</p>
                <p>Sample working hours for preview.</p>
            </div>
        </section>
    </x-admin-shell>
@endsection
