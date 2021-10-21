<?php

namespace app\models;

class Orders extends Model
{
    public $id;
    public $cart_session_id;
    public $name;
    public $phone;
    public $user_id;
    public $status;

    public function __construct($cart_session_id = null, $name = null, $phone = null, $user_id = null, $status = null)
    {
        $this->cart_session_id = $cart_session_id;
        $this->name = $name;
        $this->phone = $phone;
        $this->user_id = $user_id;
        $this->status = $status;
    }

    public function getTableName(){
        return 'orders';
    }

}