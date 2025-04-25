<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Settings\GeneralSetting;
use DateTimeZone;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function general()
    {
        $settings = new GeneralSetting();

        $dateFormats = [
            'Y-m-d' => date('Y-m-d'),
            'm/d/Y' => date('m/d/Y'),
            'd/m/Y' => date('d/m/Y'),
            'd-m-Y' => date('d-m-Y'),
            'm-d-Y' => date('m-d-Y'),
            'F j, Y' => date('F j, Y'),
            'j M Y' => date('j M Y'),
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
            'app_name'          => ['required', 'string', 'max:255'],
            'site_name'         => ['required', 'string', 'max:255'],
            'site_description'  => ['required', 'string', 'max:255'],
            'date_format'       => ['required', 'string'],
            'time_format'       => ['required', 'string'],
            'timezone'         => ['required', 'string'],
        ]);

        $settings = new GeneralSetting();

        $settings->fill($validated);

        $settings->save();

        return redirect()->back()
            ->with('success', 'General settings saved successfully!');
    }
}
