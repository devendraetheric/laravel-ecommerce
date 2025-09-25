<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscriber\StoreRequest as SubscriberStoreRequest;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(SubscriberStoreRequest $request)
    {
        $validated = $request->validated();

        $subscriber = Subscriber::updateOrCreate($validated);

        return redirect()->back()->with('success', 'Subscribed successfully.');
    }
}
