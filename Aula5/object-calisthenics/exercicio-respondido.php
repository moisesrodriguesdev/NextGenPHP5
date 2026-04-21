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

            $multiplier = match ($item['category']) {
                'food' => 1.05,
                'electronics' => 1.20,
                default => 1.10,
            };

            $total += $subTotal * $multiplier;
        }

        if ($this->discount > 0) {
            $total = $total - ($total * $this->discount / 100);
        }

        return $total;
    }

    public function getItemsByCategory(string $category): array
    {
        $results = [];

        foreach ($this->items as $item) {
            if ($item['category'] == $category) {
                $results[] = $item;
            }
        }

        return $results;
    }

}