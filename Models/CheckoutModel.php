<?php

class CheckoutModel extends Model
{
    public function __construct($cartSize, $nameOnCard, $cardNumber, $errors = null)
    {
        parent::__construct($errors);
        $this->cartSize = $cartSize;
        $this->nameOnCard = $nameOnCard;
        $this->cardNumber = $cardNumber;
    }
}