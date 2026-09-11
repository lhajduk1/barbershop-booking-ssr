@extends('layouts.admin')
@section('title', 'Employees')
@section('content')
    <x-admin-shell title="Employees" active="Employees">
        <div class="flex flex-wrap items-end justify-between gap-6">
            <div><p class="admin-eyebrow">The team</p><h1 class="mt-3 font-display text-5xl sm:text-6xl">Employees</h1><p class="admin-muted mt-4 text-sm">The people behind every great appointment.</p></div>
            <a href="{{ route('admin.employees.create') }}" class="admin-button inline-flex items-center gap-3"><span aria-hidden="true">+</span> Add employee</a>
        </div>
        <section class="admin-surface mt-9 border border-[var(--admin-border)]" aria-label="Employee list">
            <div class="flex items-center justify-between border-b border-[var(--admin-border)] p-6"><h2 class="font-display text-2xl">Your employees</h2><span class="admin-muted text-xs">{{ $employees->total() }} total</span></div>
            @if ($employees->isNotEmpty())
                <div aria-hidden="true" class="admin-muted hidden grid-cols-[minmax(0,2fr)_90px_110px] gap-4 border-b border-[var(--admin-border)] px-6 py-4 text-[10px] font-semibold uppercase tracking-widest xl:grid"><span>Employee</span><span>Status</span><span>Actions</span></div>
            @endif
            <ul>
                @forelse ($employees as $employee)
                    <li class="grid min-w-0 gap-4 border-b border-[var(--admin-border)] p-6 last:border-b-0 sm:grid-cols-2 xl:grid-cols-[minmax(0,2fr)_90px_110px] xl:items-center">
                        <a href="{{ route('admin.employees.show', $employee) }}" class="wrap-anywhere font-display text-2xl">{{ trim($employee->first_name.' '.$employee->last_name) }}</a>
                        <span class="{{ $employee->is_active ? 'admin-selected' : 'admin-muted' }} w-fit border border-[var(--admin-border)] px-2 py-1 text-xs">{{ $employee->is_active ? 'Active' : 'Inactive' }}</span>
                        <div class="flex gap-4 text-sm"><a href="{{ route('admin.employees.show', $employee) }}" aria-label="View {{ trim($employee->first_name.' '.$employee->last_name) }}" class="admin-accent underline underline-offset-4">View</a><a href="{{ route('admin.employees.edit', $employee) }}" aria-label="Edit {{ trim($employee->first_name.' '.$employee->last_name) }}" class="admin-accent underline underline-offset-4">Edit</a></div>
                    </li>
                @empty
                    <li class="px-6 py-16 text-center"><h2 class="font-display text-3xl">Your team starts here.</h2><p class="admin-muted mt-3 text-sm">No employees have been added yet.</p><a href="{{ route('admin.employees.create') }}" class="admin-accent mt-6 inline-block underline underline-offset-4">Add your first employee</a></li>
                @endforelse
            </ul>
        </section>
        @if ($employees->hasPages())
            <nav aria-label="Employees pagination" class="mt-6 flex flex-wrap items-center justify-between gap-4 text-sm">
                <p class="admin-muted">Showing {{ $employees->firstItem() }}–{{ $employees->lastItem() }} of {{ $employees->total() }}</p>
                <div class="flex items-center gap-4">
                    @if ($employees->onFirstPage())<span aria-disabled="true" class="admin-muted">Previous</span>@else<a rel="prev" href="{{ $employees->previousPageUrl() }}" class="admin-outline px-4 py-3">Previous</a>@endif
                    <span class="admin-muted">{{ $employees->currentPage() }} / {{ $employees->lastPage() }}</span>
                    @if ($employees->hasMorePages())<a rel="next" href="{{ $employees->nextPageUrl() }}" class="admin-outline px-4 py-3">Next</a>@else<span aria-disabled="true" class="admin-muted">Next</span>@endif
                </div>
            </nav>
        @endif
    </x-admin-shell>
@endsection
