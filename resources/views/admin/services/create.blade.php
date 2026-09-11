@extends('layouts.admin')
@section('title', 'Add service')
@section('content')
    <x-admin-shell title="Services / Add service" active="Services">
        <a href="{{ route('admin.services.index') }}" class="admin-accent text-sm">← Back to services</a>
        <p class="admin-eyebrow mt-8">The service menu</p>
        <h1 class="mt-3 font-display text-5xl">Add service</h1>
        <p class="admin-muted mt-4 text-sm">Shape the next addition to your grooming menu.</p>
        <x-admin-service-form />
    </x-admin-shell>
@endsection
