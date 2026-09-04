@extends('layouts.app')

@section('content')
    <main class="relative min-h-screen overflow-hidden bg-ink-950 text-stone-100">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -right-48 -top-48 size-144 rounded-full border border-gold-400/10"></div>
            <div class="absolute -right-36 -top-36 size-112 rounded-full border border-gold-400/8"></div>
            <div class="absolute left-1/4 top-0 h-96 w-px bg-linear-to-b from-gold-400/20 to-transparent"></div>
            <div class="absolute -left-48 top-1/2 size-112 rounded-full bg-gold-500/5 blur-3xl"></div>
        </div>

        <header class="relative border-b border-white/8">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-5 sm:px-8 lg:px-10">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3 text-xs font-semibold uppercase tracking-[0.24em] text-gold-300 transition hover:text-gold-200 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400 sm:text-sm">
                    <span class="grid size-9 place-items-center border border-gold-400/50 bg-gold-400/5 sm:size-10" aria-hidden="true">
                        <svg viewBox="0 0 32 32" fill="none" class="size-4 sm:size-5">
                            <path d="M7 25 25 7M10 6l16 16M6 11l15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </span>
                    {{ config('app.name', 'Barbershop') }}
                </a>

                <a href="{{ route('login') }}" class="border-b border-gold-400/40 pb-1 text-xs font-semibold uppercase tracking-[0.16em] text-stone-300 transition hover:border-gold-300 hover:text-gold-300 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400 sm:text-sm">Sign in</a>
            </div>
        </header>

        <section class="relative mx-auto max-w-7xl px-5 pb-20 pt-16 sm:px-8 sm:pb-24 sm:pt-20 lg:px-10 lg:pb-28 lg:pt-24">
            <div class="max-w-3xl">
                <div class="mb-7 h-px w-14 bg-gold-400"></div>
                <p class="text-xs font-semibold uppercase tracking-[0.32em] text-gold-400">Our services</p>
                <h1 class="mt-5 font-display text-5xl leading-[0.95] text-stone-50 sm:text-6xl lg:text-7xl">Services made<br><span class="italic text-gold-300">for gentlemen.</span></h1>
                <p class="mt-7 max-w-2xl text-base leading-7 text-stone-300 sm:text-lg sm:leading-8">From precise cuts to traditional shaves, every service is delivered with patience, expertise and uncompromising attention to detail.</p>
            </div>

            <div class="mt-14 grid gap-px bg-gold-300/20 shadow-2xl shadow-black/20 sm:mt-18 md:grid-cols-2 lg:mt-20">
                @forelse ($services as $service)
                    <article class="group relative flex min-w-0 flex-col overflow-hidden bg-ink-800 p-6 transition duration-300 hover:bg-[#2b271e] sm:p-8 lg:p-10">
                        <div aria-hidden="true" class="absolute inset-x-0 top-0 h-px origin-left scale-x-0 bg-gold-400 transition-transform duration-300 group-hover:scale-x-100"></div>

                        <div class="flex items-start justify-between gap-6">
                            <span class="text-xs font-semibold tracking-[0.24em] text-gold-300/80">{{ str((string) ($services->firstItem() + $loop->index))->padLeft(2, '0') }}</span>
                            <div class="flex shrink-0 items-center gap-2 text-xs uppercase tracking-[0.16em] text-stone-400">
                                <svg viewBox="0 0 20 20" fill="none" class="size-4 text-gold-300/80" aria-hidden="true">
                                    <circle cx="10" cy="10" r="7" stroke="currentColor" stroke-width="1.4" />
                                    <path d="M10 6v4l2.5 1.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                {{ $service->duration_minutes }} min
                            </div>
                        </div>

                        <h2 class="mt-8 break-words font-display text-3xl leading-tight text-stone-100 transition-colors group-hover:text-gold-200 sm:text-4xl">{{ $service->name }}</h2>

                        @if ($service->description)
                            <p class="mt-4 break-words text-sm leading-6 text-stone-400 sm:text-base sm:leading-7">{{ $service->description }}</p>
                        @endif

                        <div class="mt-auto flex items-end justify-between gap-6 pt-10">
                            <div>
                                <p class="text-[0.65rem] font-semibold uppercase tracking-[0.2em] text-stone-500">From</p>
                                <p class="mt-1 font-display text-3xl text-gold-300"><span class="text-lg">$</span>{{ number_format($service->price_cents / 100, 2, ',', ' ') }}</p>
                            </div>

                            <button type="button" class="inline-flex shrink-0 items-center gap-2 border border-gold-400/35 px-4 py-3 text-xs font-bold uppercase tracking-[0.12em] text-gold-300 transition hover:border-gold-400 hover:bg-gold-400 hover:text-ink-950 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400 sm:px-5">
                                Book
                                <span class="hidden sm:inline">this service</span>
                                <svg viewBox="0 0 16 16" fill="none" class="size-4 transition-transform group-hover:translate-x-0.5" aria-hidden="true">
                                    <path d="M3 8h10m-3-3 3 3-3 3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </article>
                @empty
                    <div class="border border-gold-300/20 bg-ink-800 px-6 py-16 text-center sm:px-10 sm:py-20 md:col-span-2">
                        <div class="mx-auto grid size-16 place-items-center border border-gold-400/40 bg-gold-400/10 text-gold-300" aria-hidden="true">
                            <svg viewBox="0 0 32 32" fill="none" class="size-7">
                                <path d="M7 25 25 7M10 6l16 16M6 11l15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </div>
                        <h2 class="mt-7 font-display text-3xl text-stone-100 sm:text-4xl">New services are being prepared.</h2>
                        <p class="mx-auto mt-3 max-w-md text-sm leading-6 text-stone-400 sm:text-base">Our service menu is currently being refined. Please check back soon.</p>
                    </div>
                @endforelse
            </div>

            <x-services-pagination :paginator="$services" />
        </section>
    </main>
@endsection
