<?php

namespace app\models\entities;

use app\models\Entity;


class Cart extends Entity
{
    protected $id;
    protected $product_id;
    protected $session_id;
    protected $quantity;
    protected $fixed_price;

    protected $props = [
        'product_id' => false,
        'session_id' => false,
        'quantity'=> false,
        'fixed_price' => false
    ];

    function __construct($product_id = null, $session_id = null, $quantity = null, $fixed_price = null)
    {
        $this->product_id = $product_id;
        $this->session_id = $session_id;
        $this->quantity = $quantity;
        $this->fixed_price = $fixed_price;
    }

}