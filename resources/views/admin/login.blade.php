@extends('layouts.admin')
@section('title', 'Admin sign in')
@section('content')
    <div class="grid min-h-screen lg:grid-cols-2">
        <aside class="admin-surface relative hidden overflow-hidden border-r border-[var(--admin-border)] p-14 lg:flex lg:flex-col lg:justify-between xl:p-20">
            <x-admin-brand class="relative z-10" />
            <div aria-hidden="true" class="admin-accent pointer-events-none absolute -bottom-32 -left-32 size-[600px] rounded-full border border-current opacity-10"></div>
            <div aria-hidden="true" class="admin-accent pointer-events-none absolute -bottom-16 -left-16 size-[470px] rounded-full border border-current opacity-10"></div>
            <div class="relative py-20">
                <div class="admin-accent mb-8 h-px w-16 bg-current"></div>
                <p class="admin-eyebrow">Behind every great experience</p>
                <h2 class="mt-6 font-display text-6xl leading-[1.05] xl:text-7xl">The craft.<br>The care.<br><em class="admin-accent">The details.</em></h2>
                <p class="admin-muted mt-8 max-w-sm text-base leading-7">A considered space for the people who keep the barbershop running.</p>
            </div>
            <p class="admin-muted relative text-xs uppercase tracking-[0.2em]">Cut · Shave · Groom</p>
        </aside>
        <div class="flex min-w-0 flex-col px-6 py-7 sm:px-12 lg:px-16">
            <div class="flex flex-wrap items-center justify-between gap-4 lg:justify-end"><x-admin-brand class="lg:hidden" /><x-admin-theme-toggle /></div>
            <main id="admin-main" class="mx-auto flex w-full max-w-md flex-1 flex-col justify-center py-16">
                <p class="admin-eyebrow">Private access</p>
                <h1 class="mt-4 font-display text-5xl sm:text-6xl">Admin sign in</h1>
                <p class="admin-muted mt-4 text-sm leading-6">Welcome back. Sign in to your workspace.</p>
                <form action="{{ route('login') }}" method="POST" class="mt-10 space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="text-sm font-medium">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="username" required value="{{ old('email') }}" placeholder="you@barbershop.com" class="admin-input mt-2" @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                        @error('email')<p id="email-error" class="admin-error mt-2 text-sm">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="password" class="text-sm font-medium">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required placeholder="Enter your password" class="admin-input mt-2" @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>
                        @error('password')<p id="password-error" class="admin-error mt-2 text-sm">{{ $message }}</p>@enderror
                    </div>
                    <label class="admin-muted flex cursor-pointer items-center gap-3 text-sm"><input type="checkbox" name="remember" value="1" @checked(old('remember')) class="size-4 accent-[var(--admin-accent)]">Remember me</label>
                    @error('remember')<p class="admin-error text-sm">{{ $message }}</p>@enderror
                    <button type="submit" class="admin-button flex w-full items-center justify-center gap-3">Sign in <span aria-hidden="true">→</span></button>
                </form>
                <p class="admin-muted mt-8 border-t border-[var(--admin-border)] pt-6 text-xs leading-6">For authorized barbershop staff.</p>
            </main>
        </div>
    </div>
@endsection
