@extends('layouts.app')

@section('content')
    <main lang="en" class="relative min-h-screen overflow-hidden bg-ink-950 text-stone-100">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -right-48 -top-48 size-144 rounded-full border border-gold-400/10"></div>
            <div class="absolute -right-36 -top-36 size-112 rounded-full border border-gold-400/8"></div>
            <div class="absolute left-1/4 top-0 h-96 w-px bg-linear-to-b from-gold-400/20 to-transparent"></div>
            <div class="absolute -left-48 top-1/2 size-112 rounded-full bg-gold-500/5 blur-3xl"></div>
        </div>

        <header class="relative border-b border-white/8">
            <div class="mx-auto flex max-w-7xl items-center justify-between gap-5 px-5 py-5 sm:px-8 lg:px-10">
                <a href="{{ url('/') }}" class="inline-flex min-w-0 items-center gap-3 text-xs font-semibold uppercase tracking-[0.24em] text-gold-300 transition hover:text-gold-200 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400 sm:text-sm">
                    <span class="grid size-9 shrink-0 place-items-center border border-gold-400/50 bg-gold-400/5 sm:size-10" aria-hidden="true">
                        <svg viewBox="0 0 32 32" fill="none" class="size-4 sm:size-5"><path d="M7 25 25 7M10 6l16 16M6 11l15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" /></svg>
                    </span>
                    <span class="wrap-anywhere">{{ config('app.name', 'Barbershop') }}</span>
                </a>
                <a href="{{ route('services.index') }}" class="shrink-0 border-b border-gold-400/40 pb-1 text-xs font-semibold uppercase tracking-[0.16em] text-stone-300 transition hover:border-gold-300 hover:text-gold-300 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400">Our services</a>
            </div>
        </header>

        <section class="relative mx-auto max-w-7xl px-5 pb-16 pt-12 sm:px-8 sm:pb-24 sm:pt-16 lg:px-10">
            <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 text-xs font-medium text-stone-400 transition hover:text-gold-300 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400">
                <span aria-hidden="true">&larr;</span> Back to services
            </a>
            <div class="mt-9 h-px w-14 bg-gold-400"></div>
            <p class="mt-6 text-xs font-semibold uppercase tracking-[0.32em] text-gold-400">Make time for yourself</p>
            <h1 class="mt-4 font-display text-5xl leading-[0.95] text-stone-50 sm:text-6xl lg:text-7xl">Book your <span class="italic text-gold-300">appointment.</span></h1>
            <p class="mt-6 max-w-xl text-base leading-7 text-stone-400">Your next great look starts here. Choose your barber, find your moment and leave the rest to us.</p>

            <div class="mt-12 grid items-start gap-8 lg:grid-cols-[minmax(0,1fr)_360px] lg:gap-12">
                <div class="min-w-0 space-y-9" aria-label="Appointment details">
                    <fieldset class="min-w-0" aria-describedby="barber-note">
                        <legend class="font-display text-3xl"><span class="mr-3 align-middle font-sans text-xs tracking-[0.18em] text-gold-400">01</span> Choose your barber</legend>
                        <p id="barber-note" class="mt-2 text-sm leading-6 text-stone-400">Example barber selection for preview.</p>
                        <div class="mt-5 grid gap-3 sm:grid-cols-3">
                            @foreach (['any' => ['No preference', 'Let us choose', '—'], 'james' => ['James', 'Barber', 'J'], 'oliver' => ['Oliver', 'Barber', 'O']] as $value => [$name, $caption, $initial])
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="barber" value="{{ $value }}" @checked($loop->first) class="peer sr-only">
                                    <span class="flex h-full items-center gap-4 border border-white/12 bg-ink-900 p-4 transition hover:border-gold-400/50 peer-checked:border-gold-400 peer-checked:bg-gold-400/8 peer-checked:[&_.selection-mark]:bg-gold-400 peer-checked:[&_.selection-mark]:border-gold-400 peer-focus-visible:outline-2 peer-focus-visible:outline-offset-4 peer-focus-visible:outline-gold-400 sm:flex-col sm:items-start sm:p-5">
                                        <span aria-hidden="true" class="grid size-10 shrink-0 place-items-center border border-gold-400/25 bg-gold-400/5 font-display text-2xl text-gold-300">{{ $initial }}</span>
                                        <span class="block"><span class="block text-sm font-semibold text-stone-100">{{ $name }}</span><span class="mt-1 block text-xs text-stone-400">{{ $caption }}</span></span>
                                        <span aria-hidden="true" class="selection-mark absolute right-4 top-4 size-2 rounded-full border border-stone-500"></span>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </fieldset>

                    <fieldset class="min-w-0 border-t border-white/10 pt-8" aria-describedby="availability-note">
                        <legend class="float-left w-full font-display text-3xl"><span class="mr-3 align-middle font-sans text-xs tracking-[0.18em] text-gold-400">02</span> Pick your moment</legend>
                        <div class="clear-both grid gap-5 pt-5 sm:grid-cols-2">
                            <div class="min-w-0">
                                <label for="booking-date" class="block text-sm font-medium text-stone-200">Preferred date</label>
                                <input id="booking-date" name="date" type="date" class="mt-2.5 block min-h-13 w-full min-w-0 rounded-none border border-white/12 bg-white/3 px-4 py-3.5 text-base text-stone-100 scheme-dark outline-none transition focus:border-gold-400 focus:bg-white/5 focus:ring-1 focus:ring-gold-400/40">
                            </div>
                            <div class="min-w-0">
                                <label for="booking-time" class="block text-sm font-medium text-stone-200">Preferred time</label>
                                <input id="booking-time" name="time" type="time" class="mt-2.5 block min-h-13 w-full min-w-0 rounded-none border border-white/12 bg-white/3 px-4 py-3.5 text-base text-stone-100 scheme-dark outline-none transition focus:border-gold-400 focus:bg-white/5 focus:ring-1 focus:ring-gold-400/40">
                            </div>
                        </div>
                        <p id="availability-note" class="mt-3 text-xs leading-6 text-stone-400">Choose a preferred time. Live appointment availability is not connected yet.</p>
                    </fieldset>

                    <fieldset class="min-w-0 border-t border-white/10 pt-8">
                        <legend class="float-left w-full font-display text-3xl"><span class="mr-3 align-middle font-sans text-xs tracking-[0.18em] text-gold-400">03</span> Your details</legend>
                        <div class="clear-both grid gap-5 pt-5 sm:grid-cols-2">
                            @foreach ([['first-name', 'first_name', 'First name', 'text', 'given-name', 'James'], ['last-name', 'last_name', 'Last name', 'text', 'family-name', 'Sullivan'], ['email', 'email', 'Email address', 'email', 'email', 'you@example.com'], ['phone', 'phone', 'Phone number', 'tel', 'tel', '+1 212 555 0142']] as [$id, $name, $label, $type, $autocomplete, $placeholder])
                                <div class="min-w-0">
                                    <label for="booking-{{ $id }}" class="block text-sm font-medium text-stone-200">{{ $label }}</label>
                                    <input id="booking-{{ $id }}" name="{{ $name }}" type="{{ $type }}" autocomplete="{{ $autocomplete }}" placeholder="{{ $placeholder }}" class="mt-2.5 block w-full rounded-none border border-white/12 bg-white/3 px-4 py-3.5 text-base text-stone-100 outline-none transition placeholder:text-stone-500 focus:border-gold-400 focus:bg-white/5 focus:ring-1 focus:ring-gold-400/40">
                                </div>
                            @endforeach
                            <div class="sm:col-span-2">
                                <label for="booking-notes" class="block text-sm font-medium text-stone-200">Anything we should know? <span class="font-normal text-stone-400">(optional)</span></label>
                                <textarea id="booking-notes" name="notes" rows="3" placeholder="Your preferred style or any special requests…" class="mt-2.5 block w-full resize-y rounded-none border border-white/12 bg-white/3 px-4 py-3.5 text-base text-stone-100 outline-none transition placeholder:text-stone-500 focus:border-gold-400 focus:bg-white/5 focus:ring-1 focus:ring-gold-400/40"></textarea>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <aside aria-labelledby="summary-heading" class="min-w-0 border border-gold-400/25 bg-ink-800 lg:sticky lg:top-8">
                    <div class="h-1 bg-linear-to-r from-gold-500 via-gold-300 to-gold-500"></div>
                    <div class="p-6 sm:p-8">
                        <p id="summary-heading" class="text-xs font-semibold uppercase tracking-[0.24em] text-gold-300">Your appointment</p>
                        <div aria-hidden="true" class="mt-8 grid size-12 place-items-center border border-gold-400/35 bg-gold-400/5 text-gold-300">
                            <svg viewBox="0 0 32 32" fill="none" class="size-6"><path d="M7 25 25 7M10 6l16 16M6 11l15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" /></svg>
                        </div>
                        <h2 class="mt-5 wrap-anywhere font-display text-4xl leading-tight text-stone-100">{{ $service->name }}</h2>
                        @if ($service->description)
                            <p class="mt-4 wrap-anywhere text-sm leading-7 text-stone-400">{{ $service->description }}</p>
                        @endif
                        <dl class="mt-7 border-t border-white/10 pt-6">
                            <div class="flex items-center justify-between gap-4 text-sm">
                                <dt class="text-stone-400">Duration</dt>
                                <dd class="text-stone-200">{{ $service->duration_minutes }} min</dd>
                            </div>
                            <div class="mt-6 flex flex-wrap items-end justify-between gap-3 border-t border-white/10 pt-6">
                                <dt class="pb-1 text-xs font-semibold uppercase tracking-[0.16em] text-stone-400">Service price</dt>
                                <dd class="wrap-anywhere font-display text-4xl text-gold-300"><span class="text-xl">$</span>{{ number_format($service->price_cents / 100, 2, ',', ' ') }}</dd>
                            </div>
                        </dl>
                        <button type="button" aria-describedby="booking-preview-note" class="mt-8 flex min-h-14 w-full items-center justify-center gap-3 bg-gold-400 px-4 py-4 text-xs font-bold uppercase tracking-[0.16em] text-ink-950 transition hover:bg-gold-300 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400">
                            Confirm booking <span aria-hidden="true">&rarr;</span>
                        </button>
                        <p id="booking-preview-note" class="mt-4 text-center text-xs leading-6 text-stone-400">Online bookings are not active yet.<br>Your details will not be sent or saved.</p>
                    </div>
                    <div class="border-t border-gold-400/15 px-6 py-5 text-center sm:px-8">
                        <p class="font-display text-xl italic text-gold-200/80">A little time. A lasting impression.</p>
                    </div>
                </aside>
            </div>
        </section>
    </main>
@endsection
