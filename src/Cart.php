<?php

namespace App;

class Cart
{
    private $products = [];
    private $discount = 0;

    public function addProduct($name, $price)
    {
        if (isset($this->products[$name])) {
            $this->products[$name]['quantity']++;
        } else {
            $this->products[$name] = [
                'price' => $price,
                'quantity' => 1
            ];
        }
    }

    public function removeProduct($name)
    {
        unset($this->products[$name]);
    }

    public function applyDiscount($percent)
    {
        $this->discount = $percent;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product['price'] * $product['quantity'];
        }
        $total = $total - ($total * $this->discount / 100);
        return round($total, 2);
    }
}
