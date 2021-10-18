<?php

namespace app\models;

class Feedback extends Model
{
    public $id;
    public $name;
    public $feedback;
    public $product_id;

    public function getTableName(){
        return 'feedback';
    }
}