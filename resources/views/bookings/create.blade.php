@extends('layouts.app')

@section('content')
    <main lang="en" class="bg-ink-950 relative min-h-screen overflow-hidden text-stone-100">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="size-144 border-gold-400/10 absolute -right-48 -top-48 rounded-full border"></div>
            <div class="size-112 border-gold-400/8 absolute -right-36 -top-36 rounded-full border"></div>
            <div class="bg-linear-to-b from-gold-400/20 absolute left-1/4 top-0 h-96 w-px to-transparent"></div>
            <div class="size-112 bg-gold-500/5 absolute -left-48 top-1/2 rounded-full blur-3xl"></div>
        </div>

        <header class="border-white/8 relative border-b">
            <div class="mx-auto flex max-w-7xl items-center justify-between gap-5 px-5 py-5 sm:px-8 lg:px-10">
                <a href="{{ url('/') }}" class="text-gold-300 hover:text-gold-200 focus-visible:outline-gold-400 inline-flex min-w-0 items-center gap-3 text-xs font-semibold uppercase tracking-[0.24em] transition focus-visible:outline-2 focus-visible:outline-offset-4 sm:text-sm">
                    <span class="border-gold-400/50 bg-gold-400/5 grid size-9 shrink-0 place-items-center border sm:size-10" aria-hidden="true">
                        <svg viewBox="0 0 32 32" fill="none" class="size-4 sm:size-5">
                            <path d="M7 25 25 7M10 6l16 16M6 11l15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </span>
                    <span class="wrap-anywhere">{{ config('app.name', 'Barbershop') }}</span>
                </a>
                <a href="{{ route('services.index') }}" class="border-gold-400/40 hover:border-gold-300 hover:text-gold-300 focus-visible:outline-gold-400 shrink-0 border-b pb-1 text-xs font-semibold uppercase tracking-[0.16em] text-stone-300 transition focus-visible:outline-2 focus-visible:outline-offset-4">Our services</a>
            </div>
        </header>

        <section class="relative mx-auto max-w-7xl px-5 pb-16 pt-12 sm:px-8 sm:pb-24 sm:pt-16 lg:px-10">
            <a href="{{ route('services.index') }}" class="hover:text-gold-300 focus-visible:outline-gold-400 inline-flex items-center gap-2 text-xs font-medium text-stone-400 transition focus-visible:outline-2 focus-visible:outline-offset-4">
                <span aria-hidden="true">&larr;</span> Back to services
            </a>
            <div class="bg-gold-400 mt-9 h-px w-14"></div>
            <p class="text-gold-400 mt-6 text-xs font-semibold uppercase tracking-[0.32em]">Make time for yourself</p>
            <h1 class="font-display mt-4 text-5xl leading-[0.95] text-stone-50 sm:text-6xl lg:text-7xl">Book your <span class="text-gold-300 italic">appointment.</span></h1>
            <p class="mt-6 max-w-xl text-base leading-7 text-stone-400">Your next great look starts here. Choose your barber, find your moment and leave the rest to us.</p>

            <form action="{{ route('booking.store', $service) }}" method="POST">
                @csrf
                <div x-data="bookingForm({ employeeId: @js(old('employee_id', '')), date: @js(old('date', '')), time: @js(old('time', '')), urls: { @foreach ($employees as $employee) '{{ $employee->id }}': @js(route('employees.availability', $employee)), @endforeach } })" class="mt-12 grid items-start gap-8 lg:grid-cols-[minmax(0,1fr)_360px] lg:gap-12">
                    <div class="min-w-0 space-y-9" aria-label="Appointment details">
                        <fieldset class="min-w-0" aria-describedby="barber-note">
                            <legend class="font-display text-3xl"><span class="text-gold-400 mr-3 align-middle font-sans text-xs tracking-[0.18em]">01</span> Choose your barber</legend>
                            <p id="barber-note" class="mt-2 text-sm leading-6 text-stone-400">Choose a barber to see available appointments.</p>
                            <div class="mt-5 grid gap-3 sm:grid-cols-3">
                                <label class="relative cursor-not-allowed opacity-40">
                                    <input disabled type="radio" name="employee_id" value="" class="peer sr-only">
                                    <span class="border-white/12 bg-ink-900 hover:border-gold-400/50 peer-checked:border-gold-400 peer-checked:bg-gold-400/8 peer-checked:[&_.selection-mark]:bg-gold-400 peer-checked:[&_.selection-mark]:border-gold-400 peer-focus-visible:outline-gold-400 flex h-full items-center gap-4 border p-4 transition peer-focus-visible:outline-2 peer-focus-visible:outline-offset-4 sm:flex-col sm:items-start sm:p-5">
                                        <span aria-hidden="true" class="border-gold-400/25 bg-gold-400/5 font-display text-gold-300 grid size-10 shrink-0 place-items-center border text-2xl">N</span>
                                        <span class="block"><span class="block text-sm font-semibold text-stone-100">No preferences</span><span class="mt-1 block text-xs text-stone-400">Let us choose</span></span>
                                        <span aria-hidden="true" class="selection-mark absolute right-4 top-4 size-2 rounded-full border border-stone-500"></span>
                                    </span>
                                </label>
                                @foreach ($employees as $employee)
                                    <label class="relative cursor-pointer">
                                        <input x-model="employeeId" @change="loadAvailableDates()" required type="radio" name="employee_id" value="{{ $employee->id }}" @checked(old('employee_id') == $employee->id) class="peer sr-only">
                                        <span class="border-white/12 bg-ink-900 hover:border-gold-400/50 peer-checked:border-gold-400 peer-checked:bg-gold-400/8 peer-checked:[&_.selection-mark]:bg-gold-400 peer-checked:[&_.selection-mark]:border-gold-400 peer-focus-visible:outline-gold-400 flex h-full items-center gap-4 border p-4 transition peer-focus-visible:outline-2 peer-focus-visible:outline-offset-4 sm:flex-col sm:items-start sm:p-5">
                                            <span aria-hidden="true" class="border-gold-400/25 bg-gold-400/5 font-display text-gold-300 grid size-10 shrink-0 place-items-center border text-2xl">{{ substr($employee->first_name, 0, 1) }}</span>
                                            <span class="block"><span class="block text-sm font-semibold text-stone-100">{{ $employee->first_name }}</span><span class="mt-1 block text-xs text-stone-400">Barber</span></span>
                                            <span aria-hidden="true" class="selection-mark absolute right-4 top-4 size-2 rounded-full border border-stone-500"></span>
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                            @error('employee_id')
                                <p id="employee-error" class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </fieldset>

                        <fieldset class="min-w-0 border-t border-white/10 pt-8" aria-describedby="availability-note">
                            <legend class="font-display float-left w-full text-3xl"><span class="text-gold-400 mr-3 align-middle font-sans text-xs tracking-[0.18em]">02</span> Pick your moment</legend>
                            <div class="clear-both pt-5" :aria-busy="loadingDates || loadingSlots">
                                <label for="booking-date" class="block text-sm font-medium text-stone-200">Available date</label>
                                <input id="booking-date" x-ref="datePicker" name="date" type="text" required disabled :disabled="loadingDates || !availableDates.length" placeholder="Choose a date" aria-describedby="availability-note" class="min-h-13 border-white/12 bg-white/3 focus:border-gold-400 focus:ring-gold-400/40 mt-2.5 block w-full min-w-0 rounded-none border px-4 py-3.5 text-base text-stone-100 outline-none focus:ring-1 disabled:cursor-not-allowed disabled:opacity-50">
                                <fieldset x-cloak x-show="availableSlots.length" class="mt-6">
                                    <legend class="text-sm font-medium text-stone-200">Available times</legend>
                                    <div class="mt-3 grid grid-cols-3 gap-3 sm:grid-cols-4">
                                        <template x-for="slot in availableSlots" :key="slot">
                                            <label class="relative cursor-pointer">
                                                <input x-model="selectedTime" :value="slot" type="radio" name="time" required class="peer sr-only">
                                                <span x-text="slot.slice(11, 16)" class="border-white/12 bg-ink-900 text-gold-300 hover:border-gold-400/60 peer-checked:bg-gold-400 peer-checked:text-ink-950 peer-checked:border-gold-400 peer-focus-visible:outline-gold-400 flex min-h-12 items-center justify-center border px-3 py-3 text-sm font-semibold transition peer-focus-visible:outline-2 peer-focus-visible:outline-offset-4"></span>
                                            </label>
                                        </template>
                                    </div>
                                </fieldset>
                            </div>
                            @error('starts_at')
                                <p id="starts-at-error" class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                            <p id="availability-note" role="status" aria-live="polite" x-text="status" class="mt-3 text-xs leading-6 text-stone-400">Choose a barber to see available appointments.</p>
                            <button x-cloak x-show="error" type="button" class="text-gold-300 focus-visible:outline-gold-400 mt-3 text-sm underline underline-offset-4 focus-visible:outline-2" @click="retry()">Try again</button>
                        </fieldset>

                        <fieldset class="min-w-0 border-t border-white/10 pt-8">
                            <legend class="font-display float-left w-full text-3xl"><span class="text-gold-400 mr-3 align-middle font-sans text-xs tracking-[0.18em]">03</span> Your details</legend>
                            <div class="clear-both grid gap-5 pt-5 sm:grid-cols-2">
                                <div class="min-w-0">
                                    <label for="booking-customer-first-name" class="block text-sm font-medium text-stone-200">First name</label>
                                    <input id="booking-customer-first-name" name="customer_first_name" type="text" value="{{ old('customer_first_name') }}" autocomplete="customer_first_name" placeholder="" class="border-white/12 bg-white/3 focus:border-gold-400 focus:ring-gold-400/40 mt-2.5 block w-full rounded-none border px-4 py-3.5 text-base text-stone-100 outline-none transition placeholder:text-stone-500 focus:bg-white/5 focus:ring-1">
                                    @error('customer_first_name')
                                        <p id="customer-first-name-error" class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="min-w-0">
                                    <label for="booking-customer-last-name" class="block text-sm font-medium text-stone-200">Last name</label>
                                    <input id="booking-customer-last-name" name="customer_last_name" type="text" value="{{ old('customer_last_name') }}" autocomplete="customer_last_name" placeholder="" class="border-white/12 bg-white/3 focus:border-gold-400 focus:ring-gold-400/40 mt-2.5 block w-full rounded-none border px-4 py-3.5 text-base text-stone-100 outline-none transition placeholder:text-stone-500 focus:bg-white/5 focus:ring-1">
                                    @error('customer_last_name')
                                        <p id="customer-last-name-error" class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="min-w-0">
                                    <label for="customer-email" class="block text-sm font-medium text-stone-200">E-mail address</label>
                                    <input id="customer-email" name="customer_email" type="email" value="{{ old('customer_email') }}" autocomplete="customer_email" placeholder="" class="border-white/12 bg-white/3 focus:border-gold-400 focus:ring-gold-400/40 mt-2.5 block w-full rounded-none border px-4 py-3.5 text-base text-stone-100 outline-none transition placeholder:text-stone-500 focus:bg-white/5 focus:ring-1">
                                    @error('customer_email')
                                        <p id="customer-mail-error" class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="min-w-0">
                                    <label for="customer-phone" class="block text-sm font-medium text-stone-200">Phone number</label>
                                    <input id="customer-phone" name="customer_phone" type="text" value="{{ old('customer_phone') }}" autocomplete="customer_phone" placeholder="" class="border-white/12 bg-white/3 focus:border-gold-400 focus:ring-gold-400/40 mt-2.5 block w-full rounded-none border px-4 py-3.5 text-base text-stone-100 outline-none transition placeholder:text-stone-500 focus:bg-white/5 focus:ring-1">
                                    @error('customer_phone')
                                        <p id="customer-phone-error" class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="notes" class="block text-sm font-medium text-stone-200">Anything we should know? <span class="font-normal text-stone-400">(optional)</span></label>
                                    <textarea id="notes" name="notes" rows="3" value="{{ old('notes') }}" placeholder="Your preferred style or any special requests…" class="border-white/12 bg-white/3 focus:border-gold-400 focus:ring-gold-400/40 mt-2.5 block w-full resize-y rounded-none border px-4 py-3.5 text-base text-stone-100 outline-none transition placeholder:text-stone-500 focus:bg-white/5 focus:ring-1"></textarea>
                                    @error('notes')
                                        <p id="notes-error" class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <aside aria-labelledby="summary-heading" class="border-gold-400/25 bg-ink-800 min-w-0 border lg:sticky lg:top-8">
                        <div class="bg-linear-to-r from-gold-500 via-gold-300 to-gold-500 h-1"></div>
                        <div class="p-6 sm:p-8">
                            <p id="summary-heading" class="text-gold-300 text-xs font-semibold uppercase tracking-[0.24em]">Your appointment</p>
                            <div aria-hidden="true" class="border-gold-400/35 bg-gold-400/5 text-gold-300 mt-8 grid size-12 place-items-center border">
                                <svg viewBox="0 0 32 32" fill="none" class="size-6">
                                    <path d="M7 25 25 7M10 6l16 16M6 11l15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </div>
                            <h2 class="wrap-anywhere font-display mt-5 text-4xl leading-tight text-stone-100">{{ $service->name }}</h2>
                            @if ($service->description)
                                <p class="wrap-anywhere mt-4 text-sm leading-7 text-stone-400">{{ $service->description }}</p>
                            @endif
                            <dl class="mt-7 border-t border-white/10 pt-6">
                                <div class="flex items-center justify-between gap-4 text-sm">
                                    <dt class="text-stone-400">Duration</dt>
                                    <dd class="text-stone-200">{{ $service->duration_minutes }} min</dd>
                                </div>
                                <div class="mt-6 flex flex-wrap items-end justify-between gap-3 border-t border-white/10 pt-6">
                                    <dt class="pb-1 text-xs font-semibold uppercase tracking-[0.16em] text-stone-400">Service price</dt>
                                    <dd class="wrap-anywhere font-display text-gold-300 text-4xl"><span class="text-xl">$</span>{{ number_format($service->price_cents / 100, 2, ',', ' ') }}</dd>
                                </div>
                            </dl>
                            <button type="submit" disabled :disabled="!canSubmit" aria-describedby="booking-preview-note" class="bg-gold-400 text-ink-950 hover:bg-gold-300 focus-visible:outline-gold-400 mt-8 flex min-h-14 w-full items-center justify-center gap-3 px-4 py-4 text-xs font-bold uppercase tracking-[0.16em] transition focus-visible:outline-2 focus-visible:outline-offset-4 disabled:cursor-not-allowed disabled:opacity-40">
                                Confirm booking <span aria-hidden="true">&rarr;</span>
                            </button>
                            <p id="booking-preview-note" class="mt-4 text-center text-xs leading-6 text-stone-400">Choose a barber, date and time to complete your booking.</p>
                        </div>
                        <div class="border-gold-400/15 border-t px-6 py-5 text-center sm:px-8">
                            <p class="font-display text-gold-200/80 text-xl italic">A little time. A lasting impression.</p>
                        </div>
                    </aside>
                </div>
            </form>
        </section>
    </main>
@endsection
