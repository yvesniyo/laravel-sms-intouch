<?php

namespace Yvesniyo\SmsIntouchLaravel\Dto;

use Illuminate\Contracts\Support\Arrayable;

class SmsResult implements Arrayable
{

    protected bool $isOk = true;

    protected string $reason;

    protected string $status;

    protected string|float $cost;

    protected int $messageid;

    protected string $message;

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of cost
     */ 
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set the value of cost
     *
     * @return  self
     */ 
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get the value of messageid
     */ 
    public function getMessageid()
    {
        return $this->messageid;
    }

    /**
     * Set the value of messageid
     *
     * @return  self
     */ 
    public function setMessageid($messageid)
    {
        $this->messageid = $messageid;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of isOk
     */ 
    public function getIsOk()
    {
        return $this->isOk;
    }

    /**
     * Set the value of isOk
     *
     * @return  self
     */ 
    public function setIsOk($isOk)
    {
        $this->isOk = $isOk;

        return $this;
    }

    /**
     * Get the value of reason
     */ 
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set the value of reason
     *
     * @return  self
     */ 
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }


    public function toArray(){

        return (array) $this;
    }
}
