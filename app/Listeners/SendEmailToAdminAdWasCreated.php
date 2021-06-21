<?php

namespace App\Listeners;

use App\Events\AdCreated;
use App\Jobs\SendEmailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailToAdminAdWasCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AdCreated  $event
     * @return void
     */
    public function handle(AdCreated $event)
    {
        SendEmailJob::dispatch($event->ad);
    }
}
