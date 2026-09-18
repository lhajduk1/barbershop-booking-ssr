<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminEmployeeStoreRequest;
use App\Http\Requests\Admin\AdminEmployeeUpdateRequest;
use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class AdminEmployeeController
{
    public function index(): View
    {
        $employees = Employee::query()
            ->paginate(25);

        return view('admin.employees.index', [
            'employees' => $employees,
        ]);
    }

    public function create(): View
    {
        return view('admin.employees.create');
    }

    public function edit(Employee $employee): View
    {
        return view('admin.employees.edit', [
            'employee' => $employee,
        ]);
    }

    public function show(Employee $employee): View
    {
        return view('admin.employees.show', [
            'employee' => $employee,
        ]);
    }

    public function store(AdminEmployeeStoreRequest $request): RedirectResponse
    {
        Employee::query()->create($request->validated());

        return to_route('admin.employees.index')
            ->with([
                'type' => 'success',
                'message' => "You've successfully created new employee!",
            ]);
    }

    public function update(AdminEmployeeUpdateRequest $request, Employee $employee): RedirectResponse
    {
        $employee->update($request->validated());

        return to_route('admin.employees.show', $employee)
            ->with([
                'type' => 'success',
                'message' => "You've successfully updated employee!",
            ]);
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return to_route('admin.employees.index')
            ->with([
                'type' => 'success',
                'message' => "You've successfully deleted employee!",
            ]);
    }
}
