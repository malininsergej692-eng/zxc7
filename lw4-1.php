<?php
class Cart {
    private $items = [];
    public function addProduct($name, $price) {
   
        foreach ($this->items as &$item) {
            if ($item['name'] === $name) {
                $item['quantity']++;
                return;
            }
        }
        
        $this->items[] = [
            'name' => $name,
            'price' => $price,
            'quantity' => 1
        ];
    }

    public function removeProduct($name) {
        foreach ($this->items as $key => $item) {
            if ($item['name'] === $name) {
                unset($this->items[$key]);
            }
        }
       
        $this->items = array_values($this->items);
    }

    public function getTotal() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return round($total, 2);
    }

    public function applyDiscount($percent) {
        $total = $this->getTotal();
        $discountAmount = $total * ($percent / 100);
        $finalSum = $total - $discountAmount;
        
        return round($finalSum, 2);
    }
    
    public function getItems() {
        return $this->items;
    }
}

$myCart = new Cart();

$myCart->addProduct("Молоко", 100);
$myCart->addProduct("Хлеб", 50);
$myCart->addProduct("Молоко", 100); 

echo "Всего без скидки: " . $myCart->getTotal() . " руб.\n"; 

$myCart->removeProduct("Хлеб");
echo "После удаления хлеба: " . $myCart->getTotal() . " руб.\n"; 

echo "Итого со скидкой 15%: " . $myCart->applyDiscount(15) . " руб.\n"; 