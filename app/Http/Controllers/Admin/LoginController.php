<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $credentials = $request->only('email', 'password');

        if (auth('admin')->attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->intended('admin.dashboard')
                ->with('success', 'Login successful.');
        }

        return redirect()->back()->with('error', 'Invalid credentials.');
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logout successful.');
    }
}
