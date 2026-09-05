<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

final class ServiceController
{
    public function index(): View
    {
        $services = Service::query()->paginate(10);

        return view('services.index', [
            'services' => $services,
        ]);
    }
}
