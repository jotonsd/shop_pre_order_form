<?php

namespace Joton\PreOrder\Listeners;

use Illuminate\Support\Facades\Mail;
use Joton\PreOrder\Mail\AdminPreOrderMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Joton\PreOrder\Events\PreOrderSubmitted;

/**
 * Listener to send an email to the admin after a pre-order is submitted.
 */
class SendAdminPreOrderEmail implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param PreOrderSubmitted $event
     */
    public function handle(PreOrderSubmitted $event)
    {
        $data = (object) $event->preOrderData;

        // Sending an email to the admin
        Mail::to($data->admin_email)->send(new AdminPreOrderMail($data));
    }
}
