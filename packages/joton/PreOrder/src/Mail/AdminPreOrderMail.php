<?php

namespace Joton\PreOrder\Mail;

use Illuminate\Mail\Mailable;

/**
 * Mailable for sending pre-order details to the admin.
 */
class AdminPreOrderMail extends Mailable
{
    public $data;

    /**
     * Constructor to initialize email data.
     *
     * @param array $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the email.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('pre-order::emails.admin_preorder')->with('data', $this->data);
    }
}
