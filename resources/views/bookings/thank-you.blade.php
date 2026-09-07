@extends('layouts.app')

@section('content')
    <main lang="en" class="relative min-h-screen overflow-hidden bg-ink-950 text-stone-100">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -right-48 -top-48 size-144 rounded-full border border-gold-400/10"></div>
            <div class="absolute -right-36 -top-36 size-112 rounded-full border border-gold-400/8"></div>
            <div class="absolute -left-48 top-1/2 size-112 rounded-full bg-gold-500/5 blur-3xl"></div>
        </div>

        <header class="relative border-b border-white/8">
            <div class="mx-auto max-w-7xl px-5 py-5 sm:px-8 lg:px-10">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3 text-xs font-semibold uppercase tracking-[0.24em] text-gold-300 transition hover:text-gold-200 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400 sm:text-sm">
                    <span class="grid size-10 shrink-0 place-items-center border border-gold-400/50 bg-gold-400/5" aria-hidden="true">
                        <svg viewBox="0 0 32 32" fill="none" class="size-5"><path d="M7 25 25 7M10 6l16 16M6 11l15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" /></svg>
                    </span>
                    <span class="wrap-anywhere">{{ config('app.name', 'Barbershop') }}</span>
                </a>
            </div>
        </header>

        <section class="relative mx-auto max-w-3xl px-5 pb-16 pt-14 text-center sm:px-8 sm:pb-20 sm:pt-20">
            <div aria-hidden="true" class="mx-auto grid size-20 place-items-center rounded-full border border-gold-400/40 bg-gold-400/8 ring-8 ring-gold-400/3">
                <svg viewBox="0 0 32 32" fill="none" class="size-9 text-gold-300"><path d="m7 16 6 6L25 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>
            </div>
            <p class="mt-8 text-xs font-semibold uppercase tracking-[0.3em] text-gold-400">A moment for yourself</p>
            <h1 class="mt-5 font-display text-5xl leading-[1.05] text-stone-50 sm:text-6xl">Thank you for<br><span class="italic text-gold-300">your booking.</span></h1>
            <p class="mx-auto mt-6 max-w-lg text-base leading-7 text-stone-300">We have received your reservation. Thank you for making us part of your grooming ritual.</p>

            <div class="mt-9 border-y border-gold-400/20 py-6">
                <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" class="mx-auto size-6 text-gold-300"><rect x="3" y="5" width="18" height="14" rx="1" stroke="currentColor" stroke-width="1.4" /><path d="m4 6 8 7 8-7" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round" /></svg>
                <h2 class="mt-3 text-sm font-medium leading-6 text-stone-200">Your booking details have been sent to your email</h2>
                <p class="mt-2 text-sm leading-6 text-stone-400">Can't find the email? Please check your spam or junk folder.</p>
            </div>

            @guest
                <div class="relative mt-9 border border-gold-400/25 bg-ink-800 p-6 sm:p-9">
                    <div aria-hidden="true" class="absolute inset-x-0 top-0 h-px bg-linear-to-r from-transparent via-gold-400 to-transparent"></div>
                    <p class="text-[0.65rem] font-semibold uppercase tracking-[0.24em] text-gold-300">Your next chapter</p>
                    <h2 class="mt-4 font-display text-3xl leading-tight text-stone-100 sm:text-4xl">Make your next visit even easier</h2>
                    <p class="mx-auto mt-4 max-w-md text-sm leading-6 text-stone-400">Enjoyed booking with us? Create your account and sign in next time you book your chair.</p>
                    <a href="{{ route('register') }}" class="mt-6 inline-flex min-h-13 w-full items-center justify-center gap-3 bg-gold-400 px-6 py-4 text-xs font-bold uppercase tracking-[0.16em] text-ink-950 transition hover:bg-gold-300 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400 sm:w-auto">
                        Create an account <span aria-hidden="true">&rarr;</span>
                    </a>
                    <p class="mt-5 text-sm leading-6 text-stone-400">Already a member? <a href="{{ route('login') }}" class="font-semibold text-gold-300 underline decoration-gold-400/40 underline-offset-4 transition hover:text-gold-200 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400">Sign in</a></p>
                </div>
            @endguest

            <a href="{{ route('services.index') }}" class="mt-9 inline-flex min-h-11 items-center gap-3 border-b border-gold-400/40 px-1 text-xs font-semibold uppercase tracking-[0.16em] text-gold-300 transition hover:border-gold-300 hover:text-gold-200 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400">Explore our services <span aria-hidden="true">&rarr;</span></a>
            <p class="mt-8 font-display text-xl italic text-stone-400">A little time. A lasting impression.</p>
        </section>
    </main>
@endsection
