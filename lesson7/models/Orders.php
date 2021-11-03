<?php

namespace app\models;

class Orders extends DBModel
{
    protected $id;
    protected $cart_session_id;
    protected $name;
    protected $phone;
    protected $user_id;
    protected $status;

    protected $props = [
        'cart_session_id'=> false,
        'name' => false,
        'phone' => false,
        'user_id'=> false,
        'status' => false
    ];

    public function __construct($cart_session_id = null, $name = null, $phone = null, $user_id = null, $status = null)
    {
        $this->cart_session_id = $cart_session_id;
        $this->name = $name;
        $this->phone = $phone;
        $this->user_id = $user_id;
        $this->status = $status;
    }

    public static function getTableName(){
        return 'orders';
    }

}