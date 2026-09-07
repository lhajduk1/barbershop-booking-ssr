@extends('layouts.app')

@section('content')
    <main class="bg-ink-950 relative min-h-screen overflow-hidden text-stone-100">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="size-144 border-gold-400/10 absolute -right-48 -top-48 rounded-full border"></div>
            <div class="size-112 border-gold-400/8 absolute -right-36 -top-36 rounded-full border"></div>
            <div class="bg-linear-to-b from-gold-400/20 absolute left-1/4 top-0 h-96 w-px to-transparent"></div>
            <div class="size-112 bg-gold-500/5 absolute -left-48 top-1/2 rounded-full blur-3xl"></div>
        </div>

        <header class="border-white/8 relative border-b">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-5 sm:px-8 lg:px-10">
                <a href="{{ url('/') }}" class="text-gold-300 hover:text-gold-200 focus-visible:outline-gold-400 inline-flex items-center gap-3 text-xs font-semibold uppercase tracking-[0.24em] transition focus-visible:outline-2 focus-visible:outline-offset-4 sm:text-sm">
                    <span class="border-gold-400/50 bg-gold-400/5 grid size-9 place-items-center border sm:size-10" aria-hidden="true">
                        <svg viewBox="0 0 32 32" fill="none" class="size-4 sm:size-5">
                            <path d="M7 25 25 7M10 6l16 16M6 11l15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </span>
                    {{ config('app.name', 'Barbershop') }}
                </a>

                <a href="{{ route('login') }}" class="border-gold-400/40 hover:border-gold-300 hover:text-gold-300 focus-visible:outline-gold-400 border-b pb-1 text-xs font-semibold uppercase tracking-[0.16em] text-stone-300 transition focus-visible:outline-2 focus-visible:outline-offset-4 sm:text-sm">Sign in</a>
            </div>
        </header>

        <section class="relative mx-auto max-w-7xl px-5 pb-20 pt-16 sm:px-8 sm:pb-24 sm:pt-20 lg:px-10 lg:pb-28 lg:pt-24">
            <div class="max-w-3xl">
                <div class="bg-gold-400 mb-7 h-px w-14"></div>
                <p class="text-gold-400 text-xs font-semibold uppercase tracking-[0.32em]">Our services</p>
                <h1 class="font-display mt-5 text-5xl leading-[0.95] text-stone-50 sm:text-6xl lg:text-7xl">Services made<br><span class="text-gold-300 italic">for gentlemen.</span></h1>
                <p class="mt-7 max-w-2xl text-base leading-7 text-stone-300 sm:text-lg sm:leading-8">From precise cuts to traditional shaves, every service is delivered with patience, expertise and uncompromising attention to detail.</p>
            </div>

            <div class="bg-gold-300/20 sm:mt-18 mt-14 grid gap-px shadow-2xl shadow-black/20 md:grid-cols-2 lg:mt-20">
                @forelse ($services as $service)
                    <article class="bg-ink-800 group relative flex min-w-0 flex-col overflow-hidden p-6 transition duration-300 hover:bg-[#2b271e] sm:p-8 lg:p-10">
                        <div aria-hidden="true" class="bg-gold-400 absolute inset-x-0 top-0 h-px origin-left scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></div>

                        <div class="flex items-start justify-between gap-6">
                            <span class="text-gold-300/80 text-xs font-semibold tracking-[0.24em]">{{ str((string) ($services->firstItem() + $loop->index))->padLeft(2, '0') }}</span>
                            <div class="flex shrink-0 items-center gap-2 text-xs uppercase tracking-[0.16em] text-stone-400">
                                <svg viewBox="0 0 20 20" fill="none" class="text-gold-300/80 size-4" aria-hidden="true">
                                    <circle cx="10" cy="10" r="7" stroke="currentColor" stroke-width="1.4" />
                                    <path d="M10 6v4l2.5 1.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                {{ $service->duration_minutes }} min
                            </div>
                        </div>

                        <h2 class="font-display group-hover:text-gold-200 mt-8 break-words text-3xl leading-tight text-stone-100 transition-colors sm:text-4xl">{{ $service->name }}</h2>

                        @if ($service->description)
                            <p class="mt-4 break-words text-sm leading-6 text-stone-400 sm:text-base sm:leading-7">{{ $service->description }}</p>
                        @endif

                        <div class="mt-auto flex items-end justify-between gap-6 pt-10">
                            <div>
                                <p class="text-[0.65rem] font-semibold uppercase tracking-[0.2em] text-stone-500">From</p>
                                <p class="font-display text-gold-300 mt-1 text-3xl"><span class="text-lg">$</span>{{ number_format($service->price_cents / 100, 2, ',', ' ') }}</p>
                            </div>

                            <a href="{{ route('booking.create', $service) }}" class="border-gold-400/35 text-gold-300 hover:border-gold-400 hover:bg-gold-400 hover:text-ink-950 focus-visible:outline-gold-400 inline-flex shrink-0 items-center gap-2 border px-4 py-3 text-xs font-bold uppercase tracking-[0.12em] transition focus-visible:outline-2 focus-visible:outline-offset-4 sm:px-5">
                                Book
                                <span class="hidden sm:inline">this service</span>
                                <svg viewBox="0 0 16 16" fill="none" class="size-4 transition-transform group-hover:translate-x-0.5" aria-hidden="true">
                                    <path d="M3 8h10m-3-3 3 3-3 3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="border-gold-300/20 bg-ink-800 border px-6 py-16 text-center sm:px-10 sm:py-20 md:col-span-2">
                        <div class="border-gold-400/40 bg-gold-400/10 text-gold-300 mx-auto grid size-16 place-items-center border" aria-hidden="true">
                            <svg viewBox="0 0 32 32" fill="none" class="size-7">
                                <path d="M7 25 25 7M10 6l16 16M6 11l15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </div>
                        <h2 class="font-display mt-7 text-3xl text-stone-100 sm:text-4xl">New services are being prepared.</h2>
                        <p class="mx-auto mt-3 max-w-md text-sm leading-6 text-stone-400 sm:text-base">Our service menu is currently being refined. Please check back soon.</p>
                    </div>
                @endforelse
            </div>

            <x-services-pagination :paginator="$services" />
        </section>
    </main>
@endsection
