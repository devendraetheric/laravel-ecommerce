<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\UpdateRequest as ProfileUpdateRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileUpdateRequest $request, Admin $admin)
    {

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    /**
     * profile Password change
     */

    public function password(Request $request)
    {

        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'password-updated');
    }
}
