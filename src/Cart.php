<?php

namespace App;

class Cart
{
    private array $products = [];
    private float $discount = 0.0;

    public function addProduct(string $name, float $price): void
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

    public function removeProduct(string $name): void
    {
        unset($this->products[$name]);
    }

    public function applyDiscount(float $percent): void
    {
        $this->discount = $percent;
    }

    public function getTotal(): float
    {
        $total = 0.0;
        foreach ($this->products as $product) {
            $total += $product['price'] * $product['quantity'];
        }
        $total = $total - ($total * $this->discount / 100);
        return round($total, 2);
    }
}
