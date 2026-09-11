<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminServiceStoreRequest;
use App\Http\Requests\Admin\AdminServiceUpdateRequest;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class AdminServiceController
{
    public function index(): View
    {
        $services = Service::query()
            ->paginate(25);

        return view('admin.services.index', [
            'services' => $services,
        ]);
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', [
            'service' => $service,
        ]);
    }

    public function show(Service $service): View
    {
        return view('admin.services.show', [
            'service' => $service,
        ]);
    }

    public function store(AdminServiceStoreRequest $request): RedirectResponse
    {
        Service::query()->create($request->validated());

        return to_route('admin.services.index')
            ->with([
                'type' => 'success',
                'message' => "You've successfully created new service!",
            ]);
    }

    public function update(AdminServiceUpdateRequest $request, Service $service): RedirectResponse
    {
        $service->update($request->validated());

        return to_route('admin.services.show', $service)
            ->with([
                'type' => 'success',
                'message' => "You've successfully updated service!",
            ]);
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return to_route('admin.services.index')
            ->with([
                'type' => 'success',
                'message' => "You've successfully deleted service!",
            ]);
    }
}
