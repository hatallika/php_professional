<?php

namespace app\models;

class Cart extends Model
{
    public $id;
    public $product_id;
    public $session_id;
    public $quantity;
    public $fixed_price;


    public function getTableName(){
        return 'cart';
    }
}