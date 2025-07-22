<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email'   => ['required', 'email'],
        ]);

        $subscriber = Subscriber::updateOrCreate($validated);

        return redirect()->back()->with('success', 'Subscribed successfully.');
    }
}
