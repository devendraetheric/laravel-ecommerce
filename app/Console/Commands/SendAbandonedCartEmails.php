<?php

namespace App\Console\Commands;

use App\Mail\AbandonedCartMail;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendAbandonedCartEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'carts:send-abandoned-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails to users who abandoned their carts';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $threshold = Carbon::now()->subHours(1);

        $carts = Cart::with('user')
            ->where('is_checked_out', false)
            ->where('updated_at', '<=', $threshold)
            ->get();

        foreach ($carts as $cart) {
            if ($cart->user && $cart->user->email) {
                Mail::to($cart->user->email)->send(new AbandonedCartMail($cart->user));
                $this->info("Email sent to {$cart->user->email}");
            }
        }

        return Command::SUCCESS;
    }
}
