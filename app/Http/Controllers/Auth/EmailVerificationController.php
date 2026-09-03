<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class EmailVerificationController
{
    public function notice(): View
    {
        return view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();

        return redirect('/dashboard');
    }

    public function send(Request $request): RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with([
            'type' => 'success',
            'message' => 'Verification link sent!',
        ]);
    }
}
