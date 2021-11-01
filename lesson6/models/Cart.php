<?php

namespace app\models;
use app\models\DBModel as DBModel;
use app\engine\Db;

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

    function __construct($product_id = null, $session_id = null, $quantity = null, $fixed_price = null)
    {
        $this->product_id = $product_id;
        $this->session_id = $session_id;
        $this->quantity = $quantity;
        $this->fixed_price = $fixed_price;
    }

    public static function getCart($session_id){
        $sql = "SELECT c.id as cart_id, c.product_id, p.name, p.price, p.image , c.quantity 
                        FROM products p JOIN cart c 
                        WHERE c.product_id = p.id AND c.session_id = :session_id";

        /*$sql = "SELECT cart.id cart_id, product_id prod_id, products.name, products.description, products.price,
        products.image, products.quantity
        FROM cart, products WHERE session_id = '{$session_id}' AND cart.product_id = products.id";*/

        return Db::getInstance()->queryAll($sql,['session_id' => $session_id]);
    }

    public static function getCartProduct($session_id,$id){
        $tablename = static::getTableName();
        $sql = "SELECT * FROM {$tablename} WHERE session_id = :session_id AND product_id = :id";

        return Db::getInstance()->queryOneObject($sql, ['session_id' => $session_id, 'id' => $id], static::class);
    }

   /* public static function deleteCartProduct($session_id,$id){
        $tablename = static::getTableName();
        $sql = "DELETE FROM $tablename WHERE session_id = :session_id AND product_id = :id ";
        return Db::getInstance()->execute($sql,['session_id' => $session_id, 'id' => $id]);
    }*/

    public static function countCartItems($session_id){
        $tablename = static::getTableName();
        $sql = "SELECT SUM(quantity) as count FROM $tablename WHERE session_id = :session_id";
        return Db::getInstance()->queryOne($sql,['session_id' => $session_id])['count'];
    }


    public static function getTableName(){
        return 'cart';
    }
}