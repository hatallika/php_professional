<?php

namespace app\models;
use app\models\DBModel as DBModel;

class Cart extends DBModel
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

    function __construct($name = null, $product_id = null, $session_id = null, $quantity = null, $fixed_price = null)
    {
        $this->name = $name;
        $this->product_id = $product_id;
        $this->session_id = $session_id;
        $this->quantity = $quantity;
        $this->fixed_price = $fixed_price;

    }


    public static function getTableName(){
        return 'cart';
    }
}