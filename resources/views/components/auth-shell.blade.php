@props([
    'eyebrow',
    'title',
    'description',
])

<main class="relative min-h-screen overflow-hidden bg-ink-950 text-stone-100">
    <div aria-hidden="true" class="pointer-events-none absolute inset-0">
        <div class="absolute -left-40 top-1/3 size-96 rounded-full bg-gold-500/10 blur-3xl"></div>
        <div class="absolute -right-32 -top-32 size-80 rounded-full border border-gold-400/10"></div>
        <div class="absolute -right-20 -top-20 size-80 rounded-full border border-gold-400/10"></div>
    </div>

    <div class="relative mx-auto grid min-h-screen w-full max-w-400 lg:grid-cols-[minmax(0,0.9fr)_minmax(34rem,1.1fr)]">
        <aside class="relative hidden overflow-hidden border-r border-gold-400/15 bg-ink-900 lg:flex lg:flex-col lg:justify-between lg:p-14 xl:p-20">
            <div aria-hidden="true" class="absolute inset-0 bg-[radial-gradient(circle_at_20%_10%,rgba(212,175,55,0.14),transparent_34%),linear-gradient(135deg,transparent_55%,rgba(212,175,55,0.05))]"></div>
            <div aria-hidden="true" class="absolute -bottom-36 -left-20 size-96 rounded-full border border-gold-400/15"></div>
            <div aria-hidden="true" class="absolute -bottom-24 -left-8 size-72 rounded-full border border-gold-400/10"></div>

            <a href="{{ url('/') }}" class="relative inline-flex w-fit items-center gap-3 text-sm font-semibold uppercase tracking-[0.26em] text-gold-300 transition-colors hover:text-gold-200 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400">
                <span class="grid size-10 place-items-center border border-gold-400/50 bg-gold-400/5" aria-hidden="true">
                    <svg viewBox="0 0 32 32" fill="none" class="size-5" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 25 25 7M10 6l16 16M6 11l15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </span>
                {{ config('app.name', 'Barbershop') }}
            </a>

            <div class="relative max-w-xl py-16">
                <div class="mb-8 h-px w-16 bg-gold-400"></div>
                <p class="text-xs font-semibold uppercase tracking-[0.34em] text-gold-300">The gentleman's ritual</p>
                <p class="mt-6 font-display text-5xl leading-[1.08] text-stone-50 xl:text-6xl">
                    Timeless craft.<br>
                    <span class="italic text-gold-300">Impeccable style.</span>
                </p>
                <p class="mt-7 max-w-md text-base leading-7 text-stone-400">
                    Book your chair and make time for the kind of care that never goes out of style.
                </p>
            </div>

            <p class="relative text-xs uppercase tracking-[0.24em] text-stone-600">Cut &bull; Shave &bull; Groom</p>
        </aside>

        <section class="flex min-h-screen items-center px-5 py-8 sm:px-10 sm:py-12 lg:px-16 xl:px-24">
            <div {{ $attributes->merge(['class' => 'mx-auto w-full max-w-xl']) }}>
                <a href="{{ url('/') }}" class="mb-12 inline-flex items-center gap-3 text-xs font-semibold uppercase tracking-[0.24em] text-gold-300 transition-colors hover:text-gold-200 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400 lg:hidden">
                    <span class="grid size-9 place-items-center border border-gold-400/50 bg-gold-400/5" aria-hidden="true">
                        <svg viewBox="0 0 32 32" fill="none" class="size-4" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 25 25 7M10 6l16 16M6 11l15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </span>
                    {{ config('app.name', 'Barbershop') }}
                </a>

                <header>
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-gold-400">{{ $eyebrow }}</p>
                    <h1 class="mt-4 font-display text-4xl leading-tight text-stone-50 sm:text-5xl">{{ $title }}</h1>
                    <p class="mt-4 max-w-lg text-sm leading-6 text-stone-400 sm:text-base">{{ $description }}</p>
                </header>

                <div class="mt-9 sm:mt-10">{{ $slot }}</div>
            </div>
        </section>
    </div>
</main>
