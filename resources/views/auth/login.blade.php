@extends('layouts.app')

@section('content')
    <x-auth-shell eyebrow="Private access" title="Welcome back." description="Sign in to manage your appointments and reserve your next visit.">
        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-stone-200">Email address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="you@example.com" @error('email') aria-invalid="true" aria-describedby="email-error" @enderror class="mt-2.5 block w-full rounded-none border bg-white/3 px-4 py-3.5 text-base text-stone-100 outline-none transition placeholder:text-stone-600 focus:border-gold-400 focus:bg-white/5 focus:ring-1 focus:ring-gold-400/40 @error('email') border-red-500/70 @else border-white/12 @enderror">
                @error('email')
                    <p id="email-error" class="mt-2 flex items-center gap-2 text-sm text-red-400"><span class="size-1 rounded-full bg-red-400" aria-hidden="true"></span>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-stone-200">Password</label>
                <input id="password" type="password" name="password" autocomplete="current-password" placeholder="Enter your password" @error('password') aria-invalid="true" aria-describedby="password-error" @enderror class="mt-2.5 block w-full rounded-none border bg-white/3 px-4 py-3.5 text-base text-stone-100 outline-none transition placeholder:text-stone-600 focus:border-gold-400 focus:bg-white/5 focus:ring-1 focus:ring-gold-400/40 @error('password') border-red-500/70 @else border-white/12 @enderror">
                @error('password')
                    <p id="password-error" class="mt-2 flex items-center gap-2 text-sm text-red-400"><span class="size-1 rounded-full bg-red-400" aria-hidden="true"></span>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="remember" class="group inline-flex cursor-pointer items-center gap-3 text-sm text-stone-400">
                    <input id="remember" type="checkbox" name="remember" value="1" @checked(old('remember')) class="peer sr-only">
                    <span class="grid size-5 place-items-center border border-white/20 bg-white/3 transition group-hover:border-gold-400/70 peer-checked:border-gold-400 peer-checked:bg-gold-400 peer-checked:[&_svg]:opacity-100 peer-focus-visible:outline-2 peer-focus-visible:outline-offset-2 peer-focus-visible:outline-gold-400" aria-hidden="true">
                        <svg viewBox="0 0 16 16" fill="none" class="size-3 text-ink-950 opacity-0 transition"><path d="m3 8 3 3 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                    </span>
                    Remember me
                </label>
                @error('remember')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="group flex w-full items-center justify-center bg-gold-400 px-5 py-4 text-sm font-bold uppercase tracking-[0.18em] text-ink-950 transition hover:bg-gold-300 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400">
                <span>Sign in</span>
                <svg viewBox="0 0 20 20" fill="none" class="ml-3 size-4 transition-transform group-hover:translate-x-1" aria-hidden="true"><path d="M4 10h12m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>
            </button>
        </form>

        <p class="mt-8 border-t border-white/10 pt-7 text-center text-sm text-stone-500">
            New to {{ config('app.name', 'Barbershop') }}?
            <a href="{{ route('register') }}" class="ml-1 font-semibold text-gold-300 underline decoration-gold-400/30 underline-offset-4 transition hover:text-gold-200 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400">Create an account</a>
        </p>
    </x-auth-shell>
@endsection
