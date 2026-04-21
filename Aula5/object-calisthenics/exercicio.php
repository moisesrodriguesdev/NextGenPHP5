<?php

class Cart
{
    public $items = [];
    public $disc = 0;

    public function add($name, $qty, $price, $cat)
    {
        if ($qty > 0) {
            if ($price > 0) {
                $this->items[] = [
                    'name' => $name,
                    'qty' => $qty,
                    'price' => $price,
                    'cat' => $cat,
                ];
            }
        }
    }

    public function getTotal()
    {
        $t = 0;
        foreach ($this->items as $i) {
            $sub = $i['qty'] * $i['price'];
            if ($i['cat'] == 'food') {
                $sub = $sub * 1.05;
            } else {
                if ($i['cat'] == 'electronics') {
                    $sub = $sub * 1.20;
                } else {
                    $sub = $sub * 1.10;
                }
            }
            $t += $sub;
        }
        if ($this->disc > 0) {
            $t = $t - ($t * $this->disc / 100);
        }
        return $t;
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