@props(['paginator'])

@if ($paginator->hasPages())
    @php
        $pages = array_filter([
            1,
            $paginator->currentPage() - 1,
            $paginator->currentPage(),
            $paginator->currentPage() + 1,
            $paginator->lastPage(),
        ], fn (int $page): bool => $page >= 1 && $page <= $paginator->lastPage());
        $pages = array_values(array_unique($pages));
        sort($pages);
        $previousPage = null;
    @endphp

    <nav {{ $attributes->class(['mt-14 border-t border-gold-400/20 pt-8 sm:mt-16']) }} aria-label="Services pagination">
        <div class="flex items-center justify-between gap-4">
            <p class="hidden text-xs uppercase tracking-[0.18em] text-stone-500 sm:block">
                Showing {{ $paginator->firstItem() }}&ndash;{{ $paginator->lastItem() }} of {{ $paginator->total() }}
            </p>

            <div class="flex w-full items-center justify-between gap-2 sm:w-auto sm:justify-end">
                @if ($paginator->onFirstPage())
                    <span class="inline-flex cursor-not-allowed items-center gap-2 border border-white/10 bg-white/2 px-4 py-2.5 text-xs font-semibold uppercase tracking-[0.14em] text-stone-600" aria-disabled="true">
                        <svg viewBox="0 0 16 16" fill="none" class="size-4" aria-hidden="true">
                            <path d="m10 3-5 5 5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Previous
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center gap-2 border border-white/20 bg-white/4 px-4 py-2.5 text-xs font-semibold uppercase tracking-[0.14em] text-stone-200 transition hover:border-gold-400/60 hover:bg-gold-400/10 hover:text-gold-200 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400">
                        <svg viewBox="0 0 16 16" fill="none" class="size-4" aria-hidden="true">
                            <path d="m10 3-5 5 5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Previous
                    </a>
                @endif

                <div class="hidden items-center gap-2 sm:flex">
                    @foreach ($pages as $page)
                        @if ($previousPage !== null && $page - $previousPage > 1)
                            <span class="grid size-10 place-items-center text-sm text-stone-500" aria-hidden="true">&hellip;</span>
                        @endif

                        @if ($page === $paginator->currentPage())
                            <span class="grid size-10 place-items-center bg-gold-400 text-sm font-bold text-ink-950" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $paginator->url($page) }}" class="grid size-10 place-items-center border border-white/15 bg-white/3 text-sm text-stone-300 transition hover:border-gold-400/60 hover:bg-gold-400/10 hover:text-gold-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gold-400" aria-label="Go to page {{ $page }}">{{ $page }}</a>
                        @endif

                        @php($previousPage = $page)
                    @endforeach
                </div>

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center gap-2 border border-white/20 bg-white/4 px-4 py-2.5 text-xs font-semibold uppercase tracking-[0.14em] text-stone-200 transition hover:border-gold-400/60 hover:bg-gold-400/10 hover:text-gold-200 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400">
                        Next
                        <svg viewBox="0 0 16 16" fill="none" class="size-4" aria-hidden="true">
                            <path d="m6 3 5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                @else
                    <span class="inline-flex cursor-not-allowed items-center gap-2 border border-white/10 bg-white/2 px-4 py-2.5 text-xs font-semibold uppercase tracking-[0.14em] text-stone-600" aria-disabled="true">
                        Next
                        <svg viewBox="0 0 16 16" fill="none" class="size-4" aria-hidden="true">
                            <path d="m6 3 5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
