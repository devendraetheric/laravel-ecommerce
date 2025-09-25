<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\StoreRequest as SettingStoreRequest;
use App\Models\Country;
use App\Settings\CompanySetting;
use App\Settings\GeneralSetting;
use App\Settings\PaypalSetting;
use App\Settings\PhonepeSetting;
use App\Settings\PrefixSetting;
use App\Settings\RazorpaySetting;
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

    public function store(SettingStoreRequest $request)
    {


        switch ($request->group_name) {
            case 'general':
                $settings = new GeneralSetting();
                break;

            case 'social_media':
                $settings = new SocialMediaSetting();
                break;

            case 'company':
                $settings = new CompanySetting();
                break;

            case 'prefix':
                $settings = new PrefixSetting();
                break;

            case 'payment_paypal':
                $settings = new PaypalSetting();
                break;

            case 'payment_phonepe':
                $settings = new PhonepeSetting();
                break;

            case 'payment_razorpay':
                $settings = new RazorpaySetting();
                break;

            default:
                throw new \Exception("Unknown group name: {$request->group_name}");
        }

        $validated = $request->validated();


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
