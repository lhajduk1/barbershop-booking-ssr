@extends('layouts.admin')
@section('title', 'Edit employee')
@section('content')
    <x-admin-shell title="Employees / Edit employee" active="Employees">
        <a href="{{ route('admin.employees.show', $employee) }}" class="admin-accent text-sm">← Back to employee</a>
        <p class="admin-eyebrow mt-8">The team</p>
        <h1 class="mt-3 font-display text-5xl">Edit employee</h1>
        <p class="admin-muted mt-4 wrap-anywhere text-sm">{{ trim($employee->first_name.' '.$employee->last_name) }}</p>
        <x-admin-employee-form :employee="$employee" />
    </x-admin-shell>
@endsection
