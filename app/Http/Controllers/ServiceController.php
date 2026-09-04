<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController
{
    public function index(): View
    {
        $services = Service::query()->paginate(10);

        return view('services.index', [
            'services' => $services
        ]);
    }
}
