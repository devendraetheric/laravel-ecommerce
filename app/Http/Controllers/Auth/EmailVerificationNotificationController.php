<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\Captcha;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if (setting('general.is_captcha')) {

            $request->validate([
                'cf-turnstile-response' => ['required', new Captcha()]
            ]);
        }

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('account.dashboard', absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
