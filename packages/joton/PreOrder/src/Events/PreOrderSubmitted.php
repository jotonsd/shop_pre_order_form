<?php

namespace Joton\PreOrder\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PreOrderSubmitted
{
    use Dispatchable, SerializesModels;

    /**
     * Pre-order data passed with the event.
     *
     * @var array
     */
    public $preOrderData;

    /**
     * Create a new event instance.
     *
     * @param array $preOrderData
     */
    public function __construct($preOrderData)
    {
        $this->preOrderData = $preOrderData;
    }
}
