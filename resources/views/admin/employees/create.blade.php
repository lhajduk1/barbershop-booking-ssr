@extends('layouts.admin')
@section('title', 'Add employee')
@section('content')
    <x-admin-shell title="Employees / Add employee" active="Employees">
        <a href="{{ route('admin.employees.index') }}" class="admin-accent text-sm">← Back to employees</a>
        <p class="admin-eyebrow mt-8">The team</p>
        <h1 class="mt-3 font-display text-5xl">Add employee</h1>
        <p class="admin-muted mt-4 text-sm">Introduce the next member of your team.</p>
        <x-admin-employee-form />
    </x-admin-shell>
@endsection
