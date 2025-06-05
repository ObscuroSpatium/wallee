<?php

class Discount
{
    private $rules = [
            [   'active' => 1,
                'area' => 'total_qty',
                'total' => false,
                'total_qty' => 100,
                'brand' => false,
                'brand_qty' => false,
                'discount_type' => 'percentage',
                'discount' => 10,
            ],
            [   'active' => 0,
                'area' => 'total',
                'total' => 1000,
                'total_qty' => false,
                'brand' => 'Canon',
                'brand_qty' => false,
                'discount_type' => 'flat',
                'discount' => 75,
            ],
        ];

    public function applyDiscount(Cart $cart) {}

}