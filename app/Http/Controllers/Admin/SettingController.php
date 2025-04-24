<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Settings\GeneralRequest as SettingsGeneralRequest;
use App\Http\Requests\Settings\PrefixRequest as SettingsPrefixRequest;
use App\Settings\GeneralSetting;
use App\Settings\PrefixSettings;
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
            'H:i' => date('H:i'),
            'H:i:s' => date('H:i:s'),
            'g:i A' => date('g:i A'),
            'g:i a' => date('g:i a'),
        ];

        return view('admin.settings.general', compact('settings', 'dateFormats', 'timeFormats'));
    }
}
