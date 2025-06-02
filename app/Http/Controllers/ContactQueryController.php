<?php

namespace App\Http\Controllers;

use App\Models\ContactQuery;
use App\Notifications\ContactCreatedNotification;
use App\Rules\Captcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactQueryController extends Controller
{
    public function store(Request $request)
    {

        $validations = [
            'name'    => ['required', 'string'],
            'email'   => ['required', 'email'],
            'phone'   => ['nullable'],
            'subject' => ['required'],
            'message' => ['required'],

        ];

        if (setting('general.is_captcha')) {
            $validations = array_merge($validations, ['cf-turnstile-response' => ['required', new Captcha()]]);
        }

        $validated = $request->validate($validations);

        $contactQuery = ContactQuery::create($validated);

        Notification::route('mail', explode(',', setting('general.admin_emails')) ?? [])
            ->notify(new ContactCreatedNotification($contactQuery));

        return redirect()
            ->route('contact')
            ->with('success', __('Your message has been sent successfully. We will get back to you soon.'));
    }
}
