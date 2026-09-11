@props(['employee' => null])
<form action="{{ $employee ? route('admin.employees.update', $employee) : route('admin.employees.store') }}" method="POST" class="admin-surface mt-8 max-w-3xl border border-[var(--admin-border)] p-6 sm:p-9">
    @csrf
    @if ($employee) @method('PUT') @endif
    <div class="grid gap-6 sm:grid-cols-2">
        <div class="min-w-0">
            <label for="employee-first-name" class="text-sm font-medium">First name</label>
            <input id="employee-first-name" name="first_name" type="text" value="{{ old('first_name', $employee?->first_name) }}" maxlength="255" autocomplete="given-name" class="admin-input mt-2" @error('first_name') aria-invalid="true" aria-describedby="first-name-error" @enderror>
            @error('first_name')<p id="first-name-error" class="admin-error mt-2 text-sm">{{ $message }}</p>@enderror
        </div>
        <div class="min-w-0">
            <label for="employee-last-name" class="text-sm font-medium">Last name</label>
            <input id="employee-last-name" name="last_name" type="text" value="{{ old('last_name', $employee?->last_name) }}" maxlength="255" autocomplete="family-name" class="admin-input mt-2" @error('last_name') aria-invalid="true" aria-describedby="last-name-error" @enderror>
            @error('last_name')<p id="last-name-error" class="admin-error mt-2 text-sm">{{ $message }}</p>@enderror
        </div>
        <div class="sm:col-span-2">
            <label for="employee-bio" class="text-sm font-medium">Bio <span class="admin-muted font-normal">(optional)</span></label>
            <textarea id="employee-bio" name="bio" rows="5" placeholder="Experience, specialties and a few words about this barber…" class="admin-input mt-2 resize-y" @error('bio') aria-invalid="true" aria-describedby="bio-error" @enderror>{{ old('bio', $employee?->bio) }}</textarea>
            @error('bio')<p id="bio-error" class="admin-error mt-2 text-sm">{{ $message }}</p>@enderror
        </div>
        <div class="sm:col-span-2">
            <input type="hidden" name="is_active" value="0">
            <label class="flex w-fit cursor-pointer items-center gap-3">
                <input id="employee-active" type="checkbox" name="is_active" value="1" @checked(old('is_active', $employee?->is_active ?? false)) class="peer sr-only" @error('is_active') aria-invalid="true" aria-describedby="active-error" @enderror>
                <span aria-hidden="true" class="admin-outline relative h-6 w-11 rounded-full peer-checked:bg-[var(--admin-accent)] peer-checked:[&>span]:translate-x-5 peer-focus-visible:outline-2 peer-focus-visible:outline-offset-4 peer-focus-visible:outline-[var(--admin-accent)]"><span class="absolute left-0.5 top-0.5 size-4 rounded-full bg-[var(--admin-surface)] ring-1 ring-[var(--admin-border)] transition-transform"></span></span>
                <span class="text-sm font-medium">Active employee</span>
            </label>
            @error('is_active')<p id="active-error" class="admin-error mt-2 text-sm">{{ $message }}</p>@enderror
        </div>
    </div>
    <div class="mt-8 flex flex-wrap items-center gap-4 border-t border-[var(--admin-border)] pt-6">
        <button type="submit" class="admin-button">{{ $employee ? 'Save changes' : 'Create employee' }}</button>
        <a href="{{ route('admin.employees.index') }}" class="admin-outline inline-flex min-h-12 items-center px-5 text-sm">Cancel</a>
    </div>
</form>
