<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class NewTransaction
{
    use SerializesModels;

    public $transaction;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }
}
