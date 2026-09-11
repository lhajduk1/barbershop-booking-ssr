@extends('layouts.admin')
@section('title', 'Edit service')
@section('content')
    <x-admin-shell title="Services / Edit service" active="Services">
        <a href="{{ route('admin.services.show', $service) }}" class="admin-accent text-sm">← Back to service</a>
        <p class="admin-eyebrow mt-8">The service menu</p>
        <h1 class="mt-3 font-display text-5xl">Edit service</h1>
        <p class="admin-muted mt-4 wrap-anywhere text-sm">{{ $service->name }}</p>
        <x-admin-service-form :service="$service" />
    </x-admin-shell>
@endsection
