<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Requests\Auth\LoginUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

final class LoginController
{
    public function __invoke(LoginUserRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->safe()->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            if ($request->user()->hasRole(UserRole::ADMIN)) {
                return redirect()->intended('/admin');
            };

            return redirect()->intended('/dashboard');
        }


        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
