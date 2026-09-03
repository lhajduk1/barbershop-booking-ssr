@props([
    'type' => 'info',
    'message',
])

@php
    $isError = $type === 'error';
    $isWarning = $type === 'warning';
    $isSuccess = $type === 'success';
    $isInfo = !$isError && !$isWarning && !$isSuccess;
@endphp

<div x-data="{ open: true }" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" x-show="open" x-cloak class="pointer-events-none fixed inset-x-0 top-0 z-50 flex justify-center p-4 sm:justify-end sm:p-6">
    <div role="{{ $isError ? 'alert' : 'status' }}" aria-live="{{ $isError ? 'assertive' : 'polite' }}" {{ $attributes->class(['pointer-events-auto relative w-full max-w-md overflow-hidden border bg-ink-900/95 shadow-2xl shadow-black/40 backdrop-blur-xl', 'border-gold-400/40' => $isSuccess, 'border-red-500/40' => $isError, 'border-amber-400/40' => $isWarning, 'border-white/15' => $isInfo]) }}>
        <div @class([
            'absolute inset-y-0 left-0 w-1',
            'bg-gold-400' => $isSuccess,
            'bg-red-500' => $isError,
            'bg-amber-400' => $isWarning,
            'bg-stone-400' => $isInfo,
        ])></div>

        <div class="flex items-start gap-4 px-5 py-4 pl-6">
            <div @class([
                'mt-0.5 grid size-9 shrink-0 place-items-center border',
                'border-gold-400/35 bg-gold-400/10 text-gold-300' => $isSuccess,
                'border-red-500/35 bg-red-500/10 text-red-400' => $isError,
                'border-amber-400/35 bg-amber-400/10 text-amber-300' => $isWarning,
                'border-white/15 bg-white/5 text-stone-300' => $isInfo,
            ]) aria-hidden="true">
                @if ($isSuccess)
                    <svg viewBox="0 0 20 20" fill="none" class="size-4">
                        <path d="m4 10 4 4 8-9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                @elseif ($isError)
                    <svg viewBox="0 0 20 20" fill="none" class="size-4">
                        <path d="m5 5 10 10M15 5 5 15" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                @elseif ($isWarning)
                    <svg viewBox="0 0 20 20" fill="none" class="size-4">
                        <path d="M10 6v4.5m0 3v.01M8.05 3.68 2.6 13.25A1.5 1.5 0 0 0 3.9 15.5h12.2a1.5 1.5 0 0 0 1.3-2.25l-5.45-9.57a2.25 2.25 0 0 0-3.9 0Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                @else
                    <svg viewBox="0 0 20 20" fill="none" class="size-4">
                        <path d="M10 9v5m0-8v.01M17.5 10a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                @endif
            </div>

            <div class="min-w-0 flex-1">
                <p @class([
                    'text-xs font-semibold uppercase tracking-[0.2em]',
                    'text-gold-300' => $isSuccess,
                    'text-red-400' => $isError,
                    'text-amber-300' => $isWarning,
                    'text-stone-300' => $isInfo,
                ])>
                    @if ($isSuccess)
                        Success
                    @elseif ($isError)
                        Something went wrong
                    @elseif ($isWarning)
                        Attention
                    @else
                        Information
                    @endif
                </p>
                <p class="mt-1.5 break-words text-sm leading-6 text-stone-300">{{ $message }}</p>
            </div>

            <button type="button" class="shrink-0 text-stone-400 transition hover:text-white" aria-label="Close notification" @click="open = false">
                <svg viewBox="0 0 20 20" fill="none" class="size-5">
                    <path d="m5 5 10 10M15 5 5 15" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
            </button>
        </div>
    </div>
</div>
