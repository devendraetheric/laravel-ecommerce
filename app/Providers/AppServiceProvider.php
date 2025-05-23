<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Payment;
use App\Observers\OrderObserver;
use App\Observers\PaymentObserver;
use App\Settings\GeneralSetting;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        Blade::directive('money', function (string $money) {
            return "<?php echo get_currency_symbol() .' '. number_format($money, 2); ?>";
        });

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {

            return (new MailMessage)
                ->subject('Verify Email Address')
                ->greeting("Hello {$notifiable->first_name}!")
                ->line('Thank you for registering with us.')
                ->line('Please click the button below to verify your email address.')
                ->action('Verify Email Address', $url)
                ->line('If you did not create an account, no further action is required.')
                ->salutation("Best Regards, \n " . setting('general.app_name'));
        });


        Order::observe(OrderObserver::class);
        Payment::observe(PaymentObserver::class);
    }
}
