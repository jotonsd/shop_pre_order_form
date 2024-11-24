<?php

namespace Joton\PreOrder\Mail;

use Illuminate\Mail\Mailable;

class UserPreOrderMail extends Mailable
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
        return $this->markdown('pre-order::emails.user_preorder')->with('data', $this->data);
    }
}
