<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\CreateUserAction;
use App\Http\Requests\Auth\StoreUserRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;

final class RegisterController
{
    public function __invoke(StoreUserRequest $request, CreateUserAction $action): RedirectResponse
    {
        $user = $action->handle($request->safe()->except(['agree_to_policies']));

        event(new Registered($user));

        return back()->with([
            'type' => 'success',
            'message' => 'You have registered sucessfully!',
        ]);
    }
}
