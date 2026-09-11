@props(['service' => null])
<form action="{{ $service ? route('admin.services.update', $service) : route('admin.services.store') }}" method="POST">
    @csrf
    @method($service ? 'PUT' : 'POST')
    <div class="admin-surface mt-8 max-w-3xl border border-[var(--admin-border)] p-6 sm:p-9" aria-label="Service details">
        <div x-data="generateSlug(@js($service?->name), @js($service?->slug))" class="grid gap-6 sm:grid-cols-2">
            <div class="min-w-0">
                <label for="service-name" class="text-sm font-medium">Service name</label>
                <input id="service-name" x-model="name" @input="slug = generate(name)" name="name" type="text" value="{{ old('name', $service?->name) }}" placeholder="Signature cut" maxlength="255" class="admin-input mt-2" @error('name') aria-invalid="true" aria-describedby="name-error" @enderror>
                @error('name')
                    <p id="name-error" class="admin-error mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="min-w-0">
                <label for="service-slug" class="text-sm font-medium">Slug</label>
                <input id="service-slug" x-model="slug" name="slug" type="text" value="{{ old('slug', $service?->slug) }}" placeholder="signature-cut" maxlength="255" class="admin-input mt-2" @error('slug') aria-invalid="true" aria-describedby="slug-error" @enderror>
                @error('slug')
                    <p id="slug-error" class="admin-error mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="min-w-0">
                <label for="service-duration_minutes" class="text-sm font-medium">Duration (minutes)</label>
                <input id="service-duration_minutes" name="duration_minutes" type="number" value="{{ old('duration_minutes', $service?->duration_minutes) }}" placeholder="45" min="0" step="1" class="admin-input mt-2" @error('duration_minutes') aria-invalid="true" aria-describedby="duration_minutes-error" @enderror>
                @error('duration_minutes')
                    <p id="duration_minutes-error" class="admin-error mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="min-w-0">
                <label for="service-price_cents" class="text-sm font-medium">Price ($)</label>
                <input id="service-price_cents" name="price_cents" type="number" value="{{ old('price_cents', $service ? number_format($service->price_cents / 100, 2, '.', '') : '') }}" placeholder="0.00" min="0" step="0.01" class="admin-input mt-2" @error('price_cents') aria-invalid="true" aria-describedby="price_cents-error" @enderror>
                @error('price_cents')
                    <p id="price_cents-error" class="admin-error mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <label for="service-description" class="text-sm font-medium">Description <span class="admin-muted font-normal">(optional)</span></label>
                <textarea id="service-description" name="description" rows="5" class="admin-input mt-2 resize-y" placeholder="Describe the service and what is included…" @error('description') aria-invalid="true" aria-describedby="description-error" @enderror>{{ old('description', $service?->description) }}</textarea>
                @error('description')
                    <p id="description-error" class="admin-error mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <label class="flex w-fit cursor-pointer items-center gap-3">
                    <input id="service-active" type="checkbox" name="is_active" value="1" @checked(old('is_active', $service?->is_active ?? false)) class="peer sr-only" @error('is_active') aria-invalid="true" aria-describedby="active-error" @enderror>
                    <span aria-hidden="true" class="admin-outline relative h-6 w-11 rounded-full peer-checked:bg-[var(--admin-accent)] peer-focus-visible:outline-2 peer-focus-visible:outline-offset-4 peer-focus-visible:outline-[var(--admin-accent)] peer-checked:[&>span]:translate-x-5"><span class="absolute left-0.5 top-0.5 size-4 rounded-full bg-[var(--admin-muted)] transition-transform peer-checked:bg-white"></span></span>
                    <span class="text-sm font-medium">Active service</span>
                </label>
                @error('is_active')
                    <p id="active-error" class="admin-error mt-2 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mt-8 border-t border-[var(--admin-border)] pt-6">
            <div class="mt-4 flex flex-wrap items-center gap-4">
                <button type="submit" class="admin-button">{{ $service ? 'Save changes' : 'Create service' }}</button>
                <a href="{{ route('admin.services.index') }}" class="admin-outline inline-flex min-h-12 items-center px-5 text-sm">Cancel</a>
            </div>
        </div>
    </div>
</form>
