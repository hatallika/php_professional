<?php

namespace app\models;

class Feedback extends DBModel
{
    protected $id;
    protected $name;
    protected $feedback;
    protected $product_id;

    protected $props = [
        'name' => false,
        'feedback' => false,
        'product_id'=> false
    ];

    public function __construct($name = null, $feedback = null, $product_id = null)
    {
        $this->name = $name;
        $this->feedback = $feedback;
        $this->product_id = $product_id;
    }

    public static function getTableName(){
        return 'feedback';
    }
}