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

        <div x-data="scheduleChangeWeek(@js(\Carbon\Carbon::today()))">
            <section class="admin-surface mt-9 border border-[var(--admin-border)]" aria-labelledby="schedule-week">
                <div class="flex flex-wrap items-center justify-between gap-4 border-b border-[var(--admin-border)] p-6">
                    <div>
                        <p class="admin-eyebrow">Weekly schedule</p>
                        <h2 id="schedule-week" class="font-display mt-2 text-3xl" x-text="weekLabel"></h2>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <button type="button" class="admin-outline inline-flex min-h-11 cursor-pointer items-center justify-center px-5 text-sm" @click="loadWeek('previous')">← Previous week</button>
                        <button type="button" class="admin-outline inline-flex min-h-11 cursor-pointer items-center justify-center px-5 text-sm" @click="loadWeek('next')">Next week →</button>
                    </div>
                    <span class="admin-muted text-xs"><span x-text="employees.length"></span> employees · Monday–Sunday</span>
                </div>

                <div class="overflow-x-auto focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[var(--admin-accent)]" role="region" aria-labelledby="schedule-week" tabindex="0">
                    <table class="w-full min-w-[780px] border-separate border-spacing-0 text-left" aria-describedby="schedule-legend">
                        <caption class="sr-only">Sample employee working hours for 14–19 September 2026</caption>
                        <thead>
                            <tr>
                                <th scope="col" class="admin-surface admin-muted sticky left-0 z-10 w-36 border-b border-r border-[var(--admin-border)] px-6 py-5 text-[10px] font-semibold uppercase tracking-widest sm:w-44">Employee</th>
                                <template x-for="day in week">
                                    <th scope="col" class="border-b border-[var(--admin-border)] px-4 py-5 text-center font-normal">
                                        <span x-text="day.date_formatted" class="block text-sm font-semibold tabular-nums"></span>
                                        <span x-text="day.weekday" class="admin-muted mt-2 block text-[10px] font-semibold uppercase tracking-widest"></span>
                                    </th>
                                </template>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="employee in employees" :key="employee.id">
                                <tr :class="{ 'opacity-50': !employee.is_active, 'group': true }">
                                    <th x-text="employee.name" scope="row" class="admin-surface font-display sticky left-0 z-10 border-b border-r border-[var(--admin-border)] px-6 py-7 text-2xl font-medium group-last:border-b-0"></th>
                                    <template x-for="originalShift in employee.schedule" :key="`${startOfWeek}-${originalShift.id}`">
                                        <td x-data="{
                                            shift: originalShift.override ?? originalShift
                                        }" class="border-b border-[var(--admin-border)] px-4 py-7 text-center group-last:border-b-0">
                                            <button type="button" aria-haspopup="dialog" aria-controls="schedule-edit-modal" :class="{ 'admin-muted border-dashed': !shift.is_working, 'admin-selected': shift.is_working, 'min-w-18 inline-flex min-h-11 cursor-pointer items-center justify-center whitespace-nowrap border border-[var(--admin-border)] px-3 py-2 text-xs font-semibold tabular-nums transition-colors hover:border-[var(--admin-accent)] hover:bg-[var(--admin-selected)] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[var(--admin-accent)]': true }" @click="$dispatch('schedule-edit', {
                                                employeeName: employee.name,
                                                date: week[originalShift.weekday],
                                                shift: shift
                                            })"><span class="sr-only">Edit working hours for <span x-text="employee.name"></span>: </span> <span x-text="shift.is_working ? shift.period : 'OFF'"></span></button>
                                        </td>
                                    </template>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <div class="admin-muted flex flex-wrap items-center justify-between gap-3 border-t border-[var(--admin-border)] px-6 py-4 text-xs leading-5">
                    <p id="schedule-legend"><span class="font-semibold">OFF</span> — Day off</p>
                    <p>Sample working hours for preview.</p>
                </div>
            </section>

            <div x-data="scheduleModal()" @schedule-edit.window="open($event.detail)">
                <dialog id="schedule-edit-modal" x-ref="dialog" aria-labelledby="schedule-edit-title" class="admin-surface m-auto max-h-[calc(100dvh-2rem)] w-[calc(100%-2rem)] max-w-md overflow-y-auto border border-[var(--admin-border)] p-0 text-[var(--admin-text)] shadow-2xl backdrop:bg-black/70">
                    <form x-bind:action="shift.override_url" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="date" :value="date.date">
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
                                    <dd id="schedule-edit-employee" x-text="employeeName" class="mt-2 text-sm font-medium">—</dd>
                                </div>
                                <div>
                                    <dt class="admin-muted text-xs">Day</dt>
                                    <dd id="schedule-edit-day" x-text="`${date.date_formatted} ${date.weekday}`" class="mt-2 text-sm font-medium">—</dd>
                                </div>
                            </dl>

                            <div class="mt-6 grid gap-5 sm:grid-cols-2">
                                <div class="min-w-0">
                                    <label for="start_time" class="text-sm font-medium">Start time</label>
                                    <input id="start_time" :value="shift.start_time" name="start_time" type="time" class="admin-input mt-2 min-w-0">
                                </div>
                                <div class="min-w-0">
                                    <label for="end_time" class="text-sm font-medium">End time</label>
                                    <input id="end_time" :value="shift.end_time" name="end_time" type="time" class="admin-input mt-2 min-w-0">
                                </div>
                            </div>

                            <label for="is_off" class="mt-6 flex min-h-11 w-fit cursor-pointer items-center gap-3 text-sm font-medium">
                                <input id="is_off" name="is_off" type="checkbox" value="1" :checked="!shift.is_working" class="size-4 accent-[var(--admin-accent)]">
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
        </div>
    </x-admin-shell>
@endsection
