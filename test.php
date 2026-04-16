<?php

require 'vendor/autoload.php';

use App\Cart;
use App\RateLimiter;

$cart = new Cart();
$cart->addProduct('Laptop', 50000);
$cart->addProduct('Mouse', 500);
$cart->addProduct('Laptop', 50000);

echo "Cart total: " . $cart->getTotal() . "\n";

$cart->applyDiscount(10);
echo "Cart total after 10% discount: " . $cart->getTotal() . "\n";

$cart->removeProduct('Mouse');
echo "Cart total after removing Mouse: " . $cart->getTotal() . "\n";

echo "\n";

$limiter = new RateLimiter(3, 5);

for ($i = 0; $i < 5; $i++) {
    $result = $limiter->allow() ? 'allowed' : 'denied';
    echo "Request " . ($i + 1) . ": " . $result . "\n";
}

sleep(6);

$result = $limiter->allow() ? 'allowed' : 'denied';
echo "Request after 6 seconds: " . $result . "\n";
