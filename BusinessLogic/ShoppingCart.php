<?php

SessionContext::create();

class ShoppingCart
{
    public static function add($bookId)
    {
        $c = self::getCart();
        $c[$bookId] = $bookId;
        self::storeCart($c);
    }

    public static function remove($bookId)
    {
        $c = self::getCart();
        unset($c[$bookId]);
        self::storeCart($c);
    }

    public static function contains($bookId)
    {
        $c = self::getCart();
        return array_key_exists($bookId, $c);
    }

    private static function getCart()
    {
        return isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    }
    public static function getAll()
    {
        return self::getCart();
    }
    public static function size()
    {
        return sizeof(self::getCart());
    }
    private static function storeCart($cart)
    {
        $_SESSION['cart'] = $cart;
        
    }
    public static function clear()
    {
        self::storeCart(null);
    }
}