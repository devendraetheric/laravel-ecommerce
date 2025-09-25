<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    private array $generalSettingValidation = [
        'app_name'           => ['required', 'string', 'max:255'],
        'site_name'          => ['required', 'string', 'max:255'],
        'tagline'            => ['required', 'string', 'max:255'],
        'site_description'   => ['required', 'string', 'max:255'],
        'date_format'        => ['required', 'string'],
        'time_format'        => ['required', 'string'],
        'timezone'           => ['required', 'string'],
        'admin_emails'       => ['required', 'string'],
        'is_captcha'         => ['required', 'bool'],
        'captcha_secret_key' => ['nullable', 'string'],
        'captcha_site_key'   => ['nullable', 'string'],

        'analytics_code'     => ['nullable', 'string'],

        'is_tax_inclusive'   => ['required', 'bool'],

        'delivery_charge'    => ['required', 'integer', 'min:0'],
        'free_delivery_zipcode' => ['nullable', 'string'],

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

    private array $rozapaySettingValidation = [
        'is_active'         => ['required', 'bool'],
        'client_id'         => ['required', 'string'],
        'client_secret'     => ['required', 'string'],
    ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [];

        if ($this->request->get('group_name') == 'general') {
            $rules =  $this->generalSettingValidation;
        } elseif ($this->request->get('group_name') == 'social_media') {
            $rules =  $this->socialMediaSettingValidation;
        } elseif ($this->request->get('group_name') == 'company') {
            $rules =  $this->companySettingValidation;
        } elseif ($this->request->get('group_name') == 'prefix') {
            $rules =  $this->prefixSettingValidation;
        } elseif ($this->request->get('group_name') == 'payment_paypal') {
            $rules =  $this->paypalSettingValidation;
        } elseif ($this->request->get('group_name') == 'payment_phonepe') {
            $rules =  $this->phonepeSettingValidation;
        } elseif ($this->request->get('group_name') == 'payment_razorpay') {
            $rules =  $this->rozapaySettingValidation;
        }

        return $rules;
    }
}
