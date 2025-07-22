@if (setting('general.is_captcha'))
    <div class="cf-turnstile" data-sitekey="{{ setting('general.captcha_site_key') }}" data-theme="light"></div>

    <!-- Display error -->
    @error('cf-turnstile-response')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
@endif
