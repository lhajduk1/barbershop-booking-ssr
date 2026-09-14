@props(['title' => 'Overview', 'active' => 'Overview'])
<div class="min-h-screen lg:grid lg:grid-cols-[250px_minmax(0,1fr)]">
    <aside class="admin-surface border-b border-[var(--admin-border)] lg:min-h-screen lg:border-b-0 lg:border-r">
        <div class="flex items-center justify-between gap-3 p-6 lg:px-7 lg:py-9">
            <x-admin-brand />
            <button type="button" :aria-expanded="menuOpen" aria-controls="admin-nav" class="admin-outline grid size-11 shrink-0 place-items-center lg:hidden" aria-label="Toggle navigation" @click="menuOpen = !menuOpen">☰</button>
        </div>
        <nav id="admin-nav" aria-label="Admin navigation" :class="{ 'hidden': !menuOpen }" class="hidden px-4 pb-6 lg:block lg:px-5 lg:pt-8">
            <p class="admin-muted mb-4 px-3 text-[10px] font-semibold uppercase tracking-[0.2em]">Workspace</p>
            @foreach ([
        'admin.dashboard' => 'Overview',
        'admin.services.index' => 'Services',
        'admin.employees.index' => 'Employees',
        'admin.schedule.index' => 'Schedule',
    ] as $route => $label)
                <a href="{{ route($route) }}" @if ($active === $label) aria-current="page" @endif class="{{ $active === $label ? 'admin-selected border-current' : 'admin-muted border-transparent' }} mt-2 flex min-h-12 items-center gap-3 border-l-2 px-4 text-sm font-semibold">{{ $label }}</a>
            @endforeach
            @foreach (['Bookings', 'Team'] as $section)
                <span aria-disabled="true" class="admin-muted mt-2 flex min-h-12 cursor-not-allowed items-center justify-between gap-2 px-4 text-sm">{{ $section }} <span class="text-[9px] uppercase tracking-wide">Coming soon</span></span>
            @endforeach
            <div class="mt-16 border-t border-[var(--admin-border)] px-3 pt-6">
                <p class="font-display text-xl italic">A cut above.</p>
                <p class="admin-muted mt-2 text-xs leading-5">Thoughtful service.<br>Every single day.</p>
            </div>
        </nav>
    </aside>
    <div class="min-w-0">
        <header class="flex flex-wrap items-center justify-between gap-4 border-b border-[var(--admin-border)] px-6 py-5 lg:px-10">
            <p class="admin-muted text-xs">Workspace <span class="mx-2 opacity-50">/</span> <span class="text-[var(--admin-text)]">{{ $title }}</span></p>
            <div class="flex items-center gap-3"><x-admin-theme-toggle />
                <form action="{{ route('logout') }}" method="POST">@csrf<button class="admin-outline min-h-11 px-3 text-xs" type="submit">Sign out</button></form>
            </div>
        </header>
        <main id="admin-main" class="mx-auto max-w-7xl px-6 py-10 lg:px-10 lg:py-14">
            {{ $slot }}
        </main>
    </div>
</div>
