<?php

class Cart
{
    public array $items = [];
    public int $discount = 0;

    public function add(string $name, int $quantity, float $price, string $category): void
    {
        if ($quantity <= 0) {
            throw new Exception('Quantity must be greater than zero');
        }

        if ($price <= 0) {
            throw new Exception('Price must be greater than zero');
        }

        $this->items[] = [
            'name' => $name,
            'qty' => $quantity,
            'price' => $price,
            'cat' => $category,
        ];
    }

    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->items as $item) {
            $subTotal = $item['quantity'] * $item['price'];

            if ($item['category'] == 'food') {
                $subTotal = $subTotal * 1.05;
            } else {
                if ($item['category'] == 'electronics') {
                    $subTotal = $subTotal * 1.20;
                } else {
                    $subTotal = $subTotal * 1.10;
                }
            }
            
            $total += $subTotal;
        }

        if ($this->discount > 0) {
            $total = $total - ($total * $this->discount / 100);
        }

        return $total;
    }

    public function getItemsByCategory($cat)
    {
        $res = [];
        foreach ($this->items as $i) {
            if ($i['cat'] == $cat) {
                $res[] = $i;
            }
        }
        return $res;
    }
}