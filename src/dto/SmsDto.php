<?php

namespace Yvesniyo\SmsIntouchLaravel\Dto;

use Illuminate\Contracts\Support\Arrayable;

class SmsDto implements Arrayable
{


    public function __construct(
        private string $message,
        public string $reciepient,
    ) {
    }


    /**
     * Get the value of message
     */
    public function getMessage()
    {
        return $this->message;
    }


    /**
     * Get the value of reciepient
     */
    public function getReciepient()
    {
        return $this->reciepient;
    }

    public function toArray()
    {

        return (array) $this;
    }
}
