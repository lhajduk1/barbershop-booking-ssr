@extends('layouts.admin')
@section('title', 'Employee details')
@section('content')
    <x-admin-shell title="Employees / Details" active="Employees">
        <a href="{{ route('admin.employees.index') }}" class="admin-accent text-sm">← Back to employees</a>
        <div class="mt-8 flex flex-wrap items-end justify-between gap-6">
            <div class="min-w-0 flex-1"><p class="admin-eyebrow">The team</p><h1 class="mt-3 wrap-anywhere font-display text-5xl">{{ $employee->first_name }} {{ $employee->last_name }}</h1></div>
            <a href="{{ route('admin.employees.edit', $employee) }}" class="admin-button inline-flex items-center">Edit employee</a>
        </div>
        <section aria-label="Employee details" class="admin-surface mt-8 max-w-3xl border border-[var(--admin-border)] p-6 sm:p-9">
            <span class="{{ $employee->is_active ? 'admin-selected' : 'admin-muted' }} inline-block border border-[var(--admin-border)] px-3 py-1 text-xs">{{ $employee->is_active ? 'Active' : 'Inactive' }}</span>
            <dl class="mt-7 grid gap-6 sm:grid-cols-2">
                <div><dt class="admin-muted text-xs">First name</dt><dd class="mt-2 wrap-anywhere text-lg">{{ $employee->first_name }}</dd></div>
                <div><dt class="admin-muted text-xs">Last name</dt><dd class="mt-2 wrap-anywhere text-lg">{{ $employee->last_name }}</dd></div>
                <div class="border-t border-[var(--admin-border)] pt-6 sm:col-span-2"><dt class="font-display text-2xl">About this employee</dt><dd class="admin-muted mt-3 whitespace-pre-line wrap-anywhere text-sm leading-7">{{ filled($employee->bio) ? $employee->bio : 'No bio provided.' }}</dd></div>
            </dl>
        </section>
        <section class="mt-8 max-w-3xl border border-[var(--admin-border)] p-6 sm:p-9">
            <h2 class="font-display text-2xl">Delete employee</h2>
            <details class="mt-4">
                <summary class="admin-error w-fit cursor-pointer text-sm underline underline-offset-4">Review deletion</summary>
                <p class="mt-4 wrap-anywhere text-sm">Are you sure you want to delete {{ $employee->first_name }} {{ $employee->last_name }}?</p>
                <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="admin-outline admin-error mt-4 min-h-12 px-5 text-sm">Delete employee</button>
                </form>
            </details>
        </section>
    </x-admin-shell>
@endsection
