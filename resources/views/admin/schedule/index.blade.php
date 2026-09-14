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

        <div x-data="scheduleModal()">
            <section class="admin-surface mt-9 border border-[var(--admin-border)]" aria-labelledby="schedule-week">
                <div class="flex flex-wrap items-center justify-between gap-4 border-b border-[var(--admin-border)] p-6">
                    <div>
                        <p class="admin-eyebrow">Weekly schedule</p>
                        <h2 id="schedule-week" class="font-display mt-2 text-3xl">{{ $startOfWeek->format('d') }}-{{ $endOfWeek->format('d') }} {{ $startOfWeek->format('F') }} 2026</h2>
                    </div>
                    <span class="admin-muted text-xs">{{ $employees->count() }} employees · Monday–Sunday</span>
                </div>

                <div class="overflow-x-auto focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[var(--admin-accent)]" role="region" aria-labelledby="schedule-week" tabindex="0">
                    <table class="w-full min-w-[780px] border-separate border-spacing-0 text-left" aria-describedby="schedule-legend">
                        <caption class="sr-only">Sample employee working hours for 14–19 September 2026</caption>
                        <thead>
                            <tr>
                                <th scope="col" class="admin-surface admin-muted sticky left-0 z-10 w-36 border-b border-r border-[var(--admin-border)] px-6 py-5 text-[10px] font-semibold uppercase tracking-widest sm:w-44">Employee</th>
                                @foreach ($week as $weekday)
                                    <th scope="col" class="border-b border-[var(--admin-border)] px-4 py-5 text-center font-normal">
                                        <span class="block text-sm font-semibold tabular-nums">{{ $weekday->format('d.m') }}</span>
                                        <span class="admin-muted mt-2 block text-[10px] font-semibold uppercase tracking-widest">{{ $weekday->format('l') }}</span>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr class="{{ !$employee->is_active ? 'opacity-50' : '' }} group">
                                    <th scope="row" class="admin-surface font-display sticky left-0 z-10 border-b border-r border-[var(--admin-border)] px-6 py-7 text-2xl font-medium group-last:border-b-0">{{ $employee->name }}</th>
                                    @foreach ($employee->workingHours as $shift)
                                        @php
                                            $shift = $shift->workingHourOverride ?? $shift;

                                        @endphp
                                        <td class="border-b border-[var(--admin-border)] px-4 py-7 text-center group-last:border-b-0">
                                            <button type="button" aria-haspopup="dialog" aria-controls="schedule-edit-modal" class="{{ !$shift->is_working ? 'admin-muted border-dashed' : 'admin-selected' }} min-w-18 inline-flex min-h-11 cursor-pointer items-center justify-center whitespace-nowrap border border-[var(--admin-border)] px-3 py-2 text-xs font-semibold tabular-nums transition-colors hover:border-[var(--admin-accent)] hover:bg-[var(--admin-selected)] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[var(--admin-accent)]" @click="open(@js($employee->name), @js($week[$shift->weekday]), @js($week[$shift->weekday]->format('d.m l')), @js(['start_time' => $shift->start_time, 'end_time' => $shift->end_time]), @js(route('admin.schedule.update', $shift)), @js($shift->weekday))"><span class="sr-only">Edit working hours for {{ $employee->name }}: </span>{{ !$shift->is_working ? 'OFF' : $shift->period }}</button>
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

            <dialog id="schedule-edit-modal" x-ref="dialog" aria-labelledby="schedule-edit-title" class="admin-surface m-auto max-h-[calc(100dvh-2rem)] w-[calc(100%-2rem)] max-w-md overflow-y-auto border border-[var(--admin-border)] p-0 text-[var(--admin-text)] shadow-2xl backdrop:bg-black/70">
                <form x-bind:action="url" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="date" :value="date">
                    <div class="flex items-start justify-between gap-4 border-b border-[var(--admin-border)] p-6">
                        <div>
                            <p class="admin-eyebrow">Schedule</p>
                            <h2 id="schedule-edit-title" class="font-display mt-2 text-3xl">Edit working hours</h2>
                        </div>
                        <button type="button" aria-label="Close edit working hours" class="admin-outline inline-flex size-11 shrink-0 cursor-pointer items-center justify-center" @click="close()">
                            <svg aria-hidden="true" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                <path d="m6 6 12 12M18 6 6 18" />
                            </svg>
                        </button>
                    </div>

                    <div class="p-6">
                        <dl class="grid grid-cols-2 gap-4 border-b border-[var(--admin-border)] pb-6">
                            <div>
                                <dt class="admin-muted text-xs">Employee</dt>
                                <dd id="schedule-edit-employee" x-text="name" class="mt-2 text-sm font-medium">—</dd>
                            </div>
                            <div>
                                <dt class="admin-muted text-xs">Day</dt>
                                <dd id="schedule-edit-day" x-text="dateFormatted" class="mt-2 text-sm font-medium">—</dd>
                            </div>
                        </dl>

                        <div class="mt-6 grid gap-5 sm:grid-cols-2">
                            <div class="min-w-0">
                                <label for="start_time" class="text-sm font-medium">Start time</label>
                                <input id="start_time" :value="data.start_time" name="start_time" type="time" class="admin-input mt-2 min-w-0">
                            </div>
                            <div class="min-w-0">
                                <label for="end_time" class="text-sm font-medium">End time</label>
                                <input id="end_time" :value="data.end_time" name="end_time" type="time" class="admin-input mt-2 min-w-0">
                            </div>
                        </div>

                        <label for="is_off" class="mt-6 flex min-h-11 w-fit cursor-pointer items-center gap-3 text-sm font-medium">
                            <input id="is_off" name="is_off" type="checkbox" value="1" class="size-4 accent-[var(--admin-accent)]">
                            Day off
                        </label>
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-[var(--admin-border)] p-6 sm:flex-row sm:justify-end">
                        <button type="button" class="admin-outline min-h-13 inline-flex cursor-pointer items-center justify-center px-5 text-sm" @click="close()">Cancel</button>
                        <button type="submit" class="admin-button cursor-pointer">Save changes</button>
                    </div>
                </form>
            </dialog>
        </div>
    </x-admin-shell>
@endsection
