<?php

namespace Joton\PreOrder\Listeners;

use Illuminate\Support\Facades\Mail;
use Joton\PreOrder\Mail\UserPreOrderMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Joton\PreOrder\Events\PreOrderSubmitted;

class SendUserPreOrderEmail implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param PreOrderSubmitted $event
     */
    public function handle(PreOrderSubmitted $event)
    {
        $data = (object) $event->preOrderData;

        // Sending an email to the user
        Mail::to($data->email)->later(now()->addSeconds(5), new UserPreOrderMail($data));
    }
}
