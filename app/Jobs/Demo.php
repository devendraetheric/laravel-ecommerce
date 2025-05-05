<?php

namespace App\Jobs;

use App\Notifications\JobFailedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;

class Demo implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $a = 1;
        $a + 'abc';
    }


    public function failed(\Throwable $exception)
    {

        Notification::route('mail', 'hello@example.com')
            ->notify(new JobFailedNotification($exception));

    }

}
