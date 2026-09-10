<a href="{{ url('/') }}" {{ $attributes->class(['inline-flex min-w-0 items-center gap-3']) }}>
    <span aria-hidden="true" class="admin-accent grid size-10 shrink-0 place-items-center border border-current">
        <svg viewBox="0 0 32 32" fill="none" class="size-5"><path d="M7 25 25 7M10 6l16 16M6 11l15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" /></svg>
    </span>
    <span class="min-w-0"><span class="block break-words text-xs font-semibold uppercase tracking-[0.22em]">{{ config('app.name', 'Barbershop') }}</span><span class="admin-muted mt-1 block text-[10px] uppercase tracking-[0.2em]">Administration</span></span>
</a>
