<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        print_r(session()->getId());

        $oldCart = cart();

        $request->authenticate();

        $request->session()->regenerate();

        $newCart = cart();

        foreach ($oldCart->items as $item) {
            $existingItem = $newCart->items()->where('product_id', $item->product_id)->first();

            if ($existingItem) {
                $existingItem->increment('quantity', $item->quantity);
            } else {
                // Add new items to logged-in user's cart
                $newCart->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                ]);
            }
        }

        return redirect()->intended(route('account.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
