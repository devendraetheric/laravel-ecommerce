<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Settings\CompanySetting;
use App\Settings\GeneralSetting;
use App\Settings\PaypalSetting;
use App\Settings\PhonepeSetting;
use App\Settings\PrefixSetting;
use App\Settings\SocialMediaSetting;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    private array $generalSettingValidation = [
        'app_name'           => ['required', 'string', 'max:255'],
        'site_name'          => ['required', 'string', 'max:255'],
        'tagline'            => ['required', 'string', 'max:255'],
        'site_description'   => ['required', 'string', 'max:255'],
        'date_format'        => ['required', 'string'],
        'time_format'        => ['required', 'string'],
        'timezone'           => ['required', 'string'],
        'is_captcha'         => ['required'],
        'captcha_secret_key' => ['nullable', 'string'],
        'captcha_site_key'   => ['nullable', 'string'],

        'logo'               => ['nullable', 'image', 'max:2000'],
        'favicon'            => ['nullable', 'image', 'mimes:png'],

    ];

    private array $socialMediaSettingValidation = [
        'facebook'  => ['nullable', 'url', 'max:255'],
        'instagram' => ['nullable', 'url', 'max:255'],
        'youtube'   => ['nullable', 'url', 'max:255'],
        'twitter'   => ['nullable', 'url', 'max:255'],
    ];


    private array $companySettingValidation = [
        'name'      => ['required', 'string', 'max:255'],
        'email'     => ['required', 'email'],
        'phone'     => ['required', 'string', 'max:20'],
        'website'   => ['required', 'url', 'max:255'],
        'address'   => ['required', 'string', 'max:255'],
        'country'   => ['required'],
        'state'     => ['required'],
        'city'      => ['required', 'string', 'max:255'],
        'zipcode'   => ['required', 'string', 'max:10'],
    ];

    private array $prefixSettingValidation = [
        'order_prefix'       => ['required', 'string', 'max:255'],
        'order_digit_length' => ['required', 'string', 'max:20'],
        'order_sequence'     => ['required', 'string', 'max:20'],

        'payment_prefix'       => ['required', 'string', 'max:255'],
        'payment_digit_length' => ['required', 'string', 'max:20'],
        'payment_sequence'     => ['required', 'string', 'max:20'],
    ];

    private array $paypalSettingValidation = [
        'is_active'         => ['required', 'bool'],
        'is_live'           => ['required', 'bool'],
        'client_id'         => ['required', 'string'],
        'client_secret'     => ['required', 'string'],
    ];

    private array $phonepeSettingValidation = [
        'is_active'         => ['required', 'bool'],
        'is_live'           => ['required', 'bool'],
        'client_id'         => ['required', 'string'],
        'client_secret'     => ['required', 'string'],
        'client_version'    => ['required']
    ];

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

    public function socialMedia()
    {

        $settings = new SocialMediaSetting();

        return view('admin.settings.social_media', compact('settings'));
    }

    public function company()
    {

        $settings = new CompanySetting();

        $countries = Country::all('id', 'name')
            ->pluck('name', 'id');

        return view('admin.settings.company', compact('settings', 'countries'));
    }

    public function prefix()
    {
        $settings = new PrefixSetting();

        return view('admin.settings.prefix', compact('settings'));
    }

    public function paymentGateway()
    {
        return view('admin.settings.payment-gateway');
    }

    public function store(Request $request)
    {
        switch ($request->group_name) {
            case 'general':
                $validationRule = $this->generalSettingValidation;
                $settings = new GeneralSetting();

                break;

            case 'social_media':
                $validationRule = $this->socialMediaSettingValidation;
                $settings = new SocialMediaSetting();

                break;

            case 'company':
                $validationRule = $this->companySettingValidation;
                $settings = new CompanySetting();

                break;

            case 'prefix':
                $validationRule = $this->prefixSettingValidation;
                $settings = new PrefixSetting();

                break;

            case 'payment_paypal':
                $validationRule = $this->paypalSettingValidation;
                $settings = new PaypalSetting();

                break;

            case 'payment_phonepe':
                $validationRule = $this->phonepeSettingValidation;
                $settings = new PhonepeSetting();

                break;

            default:
                throw new \Exception("Unknown group name: {$request->group_name}");
        }

        $validated = $request->validate($validationRule);


        /**
         * Logo Upload
         */
        if ($request->hasFile('logo')) {

            if ($settings->logo && Storage::disk('public')->exists($settings->logo)) {
                Storage::disk('public')->delete($settings->logo);
            }

            $fileLogo = $request->file('logo');
            $validated['logo'] = $fileLogo->store('uploads', 'public');
        }

        /**
         * Favicon Upload
         */
        if ($request->hasFile('favicon')) {

            if ($settings->favicon && Storage::disk('public')->exists($settings->favicon)) {
                Storage::disk('public')->delete($settings->favicon);
            }

            $fileFavicon = $request->file('favicon');
            $validated['favicon'] = $fileFavicon->store('uploads', 'public');
        }

        $settings->fill($validated);

        $settings->save();

        return redirect()->back()
            ->with('success', 'Settings updated successfully!');
    }
}
