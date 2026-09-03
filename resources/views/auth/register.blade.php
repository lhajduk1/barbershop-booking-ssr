@extends('layouts.app')

@section('content')
    <x-auth-shell eyebrow="Join the club" title="Your chair awaits." description="Create your private account and make every appointment effortless." class="max-w-2xl">
        <form action="{{ route('register') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-stone-200">First name</label>
                    <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" autocomplete="given-name" placeholder="James" @error('first_name') aria-invalid="true" aria-describedby="first-name-error" @enderror class="mt-2.5 block w-full rounded-none border bg-white/3 px-4 py-3.5 text-base text-stone-100 outline-none transition placeholder:text-stone-600 focus:border-gold-400 focus:bg-white/5 focus:ring-1 focus:ring-gold-400/40 @error('first_name') border-red-500/70 @else border-white/12 @enderror">
                    @error('first_name')<p id="first-name-error" class="mt-2 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-stone-200">Last name</label>
                    <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" autocomplete="family-name" placeholder="Sullivan" @error('last_name') aria-invalid="true" aria-describedby="last-name-error" @enderror class="mt-2.5 block w-full rounded-none border bg-white/3 px-4 py-3.5 text-base text-stone-100 outline-none transition placeholder:text-stone-600 focus:border-gold-400 focus:bg-white/5 focus:ring-1 focus:ring-gold-400/40 @error('last_name') border-red-500/70 @else border-white/12 @enderror">
                    @error('last_name')<p id="last-name-error" class="mt-2 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-stone-200">Email address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="you@example.com" @error('email') aria-invalid="true" aria-describedby="email-error" @enderror class="mt-2.5 block w-full rounded-none border bg-white/3 px-4 py-3.5 text-base text-stone-100 outline-none transition placeholder:text-stone-600 focus:border-gold-400 focus:bg-white/5 focus:ring-1 focus:ring-gold-400/40 @error('email') border-red-500/70 @else border-white/12 @enderror">
                @error('email')<p id="email-error" class="mt-2 text-sm text-red-400">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-stone-200">Phone number</label>
                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" autocomplete="tel" placeholder="+1 212 555 0142" @error('phone') aria-invalid="true" aria-describedby="phone-error" @enderror class="mt-2.5 block w-full rounded-none border bg-white/3 px-4 py-3.5 text-base text-stone-100 outline-none transition placeholder:text-stone-600 focus:border-gold-400 focus:bg-white/5 focus:ring-1 focus:ring-gold-400/40 @error('phone') border-red-500/70 @else border-white/12 @enderror">
                @error('phone')<p id="phone-error" class="mt-2 text-sm text-red-400">{{ $message }}</p>@enderror
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <label for="password" class="block text-sm font-medium text-stone-200">Password</label>
                    <input id="password" type="password" name="password" autocomplete="new-password" placeholder="Minimum 8 characters" @error('password') aria-invalid="true" aria-describedby="password-error" @enderror class="mt-2.5 block w-full rounded-none border bg-white/3 px-4 py-3.5 text-base text-stone-100 outline-none transition placeholder:text-stone-600 focus:border-gold-400 focus:bg-white/5 focus:ring-1 focus:ring-gold-400/40 @error('password') border-red-500/70 @else border-white/12 @enderror">
                    @error('password')<p id="password-error" class="mt-2 text-sm text-red-400">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-stone-200">Confirm password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" placeholder="Repeat your password" class="mt-2.5 block w-full rounded-none border border-white/12 bg-white/3 px-4 py-3.5 text-base text-stone-100 outline-none transition placeholder:text-stone-600 focus:border-gold-400 focus:bg-white/5 focus:ring-1 focus:ring-gold-400/40">
                </div>
            </div>

            <div>
                <label for="agree_to_policies" class="group flex cursor-pointer items-start gap-3 text-sm leading-6 text-stone-400">
                    <input id="agree_to_policies" type="checkbox" name="agree_to_policies" value="1" @checked(old('agree_to_policies')) class="peer sr-only">
                    <span class="mt-0.5 grid size-5 shrink-0 place-items-center border bg-white/3 transition group-hover:border-gold-400/70 peer-checked:border-gold-400 peer-checked:bg-gold-400 peer-checked:[&_svg]:opacity-100 peer-focus-visible:outline-2 peer-focus-visible:outline-offset-2 peer-focus-visible:outline-gold-400 @error('agree_to_policies') border-red-500/70 @else border-white/20 @enderror" aria-hidden="true">
                        <svg viewBox="0 0 16 16" fill="none" class="size-3 text-ink-950 opacity-0 transition"><path d="m3 8 3 3 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                    </span>
                    <span>I agree to the <a href="#" class="font-semibold text-gold-300 underline decoration-gold-400/30 underline-offset-4 transition hover:text-gold-200">privacy policy</a>.</span>
                </label>
                @error('agree_to_policies')<p class="mt-2 text-sm text-red-400">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="group flex w-full items-center justify-center bg-gold-400 px-5 py-4 text-sm font-bold uppercase tracking-[0.18em] text-ink-950 transition hover:bg-gold-300 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400">
                <span>Create account</span>
                <svg viewBox="0 0 20 20" fill="none" class="ml-3 size-4 transition-transform group-hover:translate-x-1" aria-hidden="true"><path d="M4 10h12m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>
            </button>
        </form>

        <p class="mt-8 border-t border-white/10 pt-7 text-center text-sm text-stone-500">
            Already a member?
            <a href="{{ route('login') }}" class="ml-1 font-semibold text-gold-300 underline decoration-gold-400/30 underline-offset-4 transition hover:text-gold-200 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold-400">Sign in</a>
        </p>
    </x-auth-shell>
@endsection
