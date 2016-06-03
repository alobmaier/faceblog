<?php

class CheckoutSuccessModel extends Model
{
    public function __construct($orderId)
    {
        parent::__construct();
        $this->orderId = $orderId;
    }
}