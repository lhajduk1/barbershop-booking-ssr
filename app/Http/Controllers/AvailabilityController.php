<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Services\AvailabilityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class AvailabilityController
{
    public function index(Request $request, Employee $employee, AvailabilityService $service): JsonResponse
    {
        $data = $service->availability($request, $employee);

        return response()->json($data);
    }
}
