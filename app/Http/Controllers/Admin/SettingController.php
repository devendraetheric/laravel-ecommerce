<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Settings\CompanySetting;
use App\Settings\GeneralSetting;
use App\Settings\PrefixSetting;
use App\Settings\SocialMediaSetting;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function general()
    {
        $settings = new GeneralSetting();

        $dateFormats = [
            'Y-m-d'  => date('Y-m-d'),
            'm/d/Y'  => date('m/d/Y'),
            'd/m/Y'  => date('d/m/Y'),
            'd-m-Y'  => date('d-m-Y'),
            'm-d-Y'  => date('m-d-Y'),
            'F j, Y' => date('F j, Y'),
            'j M Y'  => date('j M Y'),
        ];

        $timeFormats = [
            'H:i'   => date('H:i'),
            'H:i:s' => date('H:i:s'),
            'g:i A' => date('g:i A'),
            'g:i a' => date('g:i a'),
        ];

        $timezones =  DateTimeZone::listIdentifiers(DateTimeZone::ALL);


        return view('admin.settings.general', compact('settings', 'dateFormats', 'timeFormats', 'timezones'));
    }


    public function saveGeneralSettings(Request $request)
    {

        $validated = $request->validate([
            'app_name'           => ['required', 'string', 'max:255'],
            'site_name'          => ['required', 'string', 'max:255'],
            'site_description'   => ['required', 'string', 'max:255'],
            'date_format'        => ['required', 'string'],
            'time_format'        => ['required', 'string'],
            'timezone'           => ['required', 'string'],
            'is_captcha'         => ['required'],
            'captcha_secret_key' => ['nullable', 'string'],
            'captcha_site_key'   => ['nullable', 'string'],

            'logo'               => ['nullable', 'image', 'max:2000'],
            'favicon'            => ['nullable', 'image', 'mimes:png'],

        ]);

        $settings = new GeneralSetting();

        /**
         * Logo Upload
         */
        if ($request->hasFile('logo')) {

            if ($settings->logo && Storage::disk('public')->exists($settings->logo)) {
                Storage::disk('public')->delete($settings->logo);
            }

            $fileLogo = $request->file('logo');
            $logoFileName = $request->logo->getClientOriginalName();

            $validated['logo'] = $fileLogo->store('uploads', 'public');
        } else {
            $validated['logo'] = $settings->logo;
        }

        /**
         * Favicon Upload
         */
        if ($request->hasFile('favicon')) {

            if ($settings->favicon && Storage::disk('public')->exists($settings->favicon)) {
                Storage::disk('public')->delete($settings->favicon);
            }

            $fileFavicon = $request->file('favicon');
            $faviconFileName = $request->favicon->getClientOriginalName();
            $validated['favicon'] = $fileFavicon->store('uploads', 'public');
        } else {
            $validated['favicon'] = $settings->favicon;
        }

        $settings->fill($validated);

        $settings->save();

        return redirect()->back()
            ->with('success', 'General settings saved successfully!');
    }


    public function socialMedia()
    {

        $settings = new SocialMediaSetting();

        return view('admin.settings.social_media', compact('settings'));
    }

    public function saveSocialMedia(Request $request)
    {
        $validated = $request->validate([
            'facebook'  => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'youtube'   => ['nullable', 'url', 'max:255'],
            'twitter'   => ['nullable', 'url', 'max:255'],
        ]);

        $settings = new SocialMediaSetting();

        $settings->fill($validated);

        $settings->save();

        return redirect()->back()
            ->with('success', 'Social Media settings saved successfully!');
    }


    public function company()
    {

        $settings = new CompanySetting();

        $countries = Country::all('id', 'name')
            ->pluck('name', 'id');

        return view('admin.settings.company', compact('settings', 'countries'));
    }


    public function saveCompany(Request $request)
    {
        $validated = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email'],
            'phone'     => ['required', 'string', 'max:20'],
            'website'   => ['required', 'url', 'max:255'],
            'address'   => ['required', 'string', 'max:255'],
            'country'   => ['required'],
            'state'     => ['required'],
            'city'      => ['required', 'string', 'max:255'],
            'zipcode'   => ['required', 'string', 'max:10'],
        ]);

        $settings = new CompanySetting();

        $settings->fill($validated);

        $settings->save();

        return redirect()->back()
            ->with('success', 'Company settings saved successfully!');
    }


    public function prefix()
    {

        $settings = new PrefixSetting();

        return view('admin.settings.prefix', compact('settings'));
    }


    public function savePrefix(Request $request)
    {
        $validated = $request->validate([
            'order_prefix'       => ['required', 'string', 'max:255'],
            'order_digit_length' => ['required', 'string', 'max:20'],
            'order_sequence'     => ['required', 'string', 'max:20'],

            'payment_prefix'       => ['required', 'string', 'max:255'],
            'payment_digit_length' => ['required', 'string', 'max:20'],
            'payment_sequence'     => ['required', 'string', 'max:20'],
        ]);

        $settings = new PrefixSetting();

        $settings->fill($validated);

        $settings->save();

        return redirect()->back()
            ->with('success', 'Prefix settings saved successfully!');
    }
}
