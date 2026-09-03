@extends('layouts.app')

@section('content')
    <x-auth-shell eyebrow="One last step" title="Check your inbox." description="We sent a verification link to your email address. Open the message and follow the link to activate your account.">
        <div class="bg-white/3 border border-white/10 p-6 sm:p-8">
            <div class="flex items-start gap-5">
                <div class="border-gold-400/35 bg-gold-400/8 text-gold-300 grid size-14 shrink-0 place-items-center border" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" class="size-6">
                        <path d="M3.75 6.75A2.25 2.25 0 0 1 6 4.5h12a2.25 2.25 0 0 1 2.25 2.25v10.5A2.25 2.25 0 0 1 18 19.5H6a2.25 2.25 0 0 1-2.25-2.25V6.75Z" stroke="currentColor" stroke-width="1.5" />
                        <path d="m4.5 6 6.04 5.03a2.25 2.25 0 0 0 2.92 0L19.5 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-display text-2xl text-stone-100">Verification email sent</h2>
                    <p class="mt-2 text-sm leading-6 text-stone-400">The link may take a few minutes to arrive. Remember to check your spam folder.</p>
                </div>
            </div>
        </div>

        <form action="{{ route('verification.send') }}" method="POST">
            @csrf
            <button type="submit" class="bg-gold-400 text-ink-950 hover:bg-gold-300 focus-visible:outline-gold-400 mt-6 flex w-full items-center justify-center px-5 py-4 text-sm font-bold uppercase tracking-[0.14em] transition focus-visible:outline-2 focus-visible:outline-offset-4">Resend verification email</button>
        </form>

        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="border-white/12 hover:border-gold-400/50 hover:text-gold-300 focus-visible:outline-gold-400 w-full border px-5 py-3.5 text-sm font-semibold text-stone-300 transition focus-visible:outline-2 focus-visible:outline-offset-4">Sign out</button>
        </form>

        <p class="mt-7 text-center text-xs leading-5 text-stone-600">You can safely close this page and return after confirming your email.</p>
    </x-auth-shell>
@endsection
