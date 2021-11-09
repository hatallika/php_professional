<?php

namespace app\models\repositories;

use app\engine\App;
use app\engine\Db;
use app\models\entities\Cart;
use app\models\Repository;


class CartRepository extends Repository
{
    public function getTableName(){
        return 'cart';
    }

    protected function getEntityClass(){
        return Cart::class;
    }

    public function getCart($session_id){
        $sql = "SELECT c.id as cart_id, c.product_id, p.name, p.price, p.image , c.quantity 
                        FROM products p JOIN cart c 
                        WHERE c.product_id = p.id AND c.session_id = :session_id";

        return App::call()->db->queryAll($sql,['session_id' => $session_id]);
    }

  /*  public function getCartProduct($session_id,$id){
        $tablename = $this->getTableName();
        $sql = "SELECT * FROM {$tablename} WHERE session_id = :session_id AND product_id = :id";

        return Db::getInstance()->queryOneObject($sql, ['session_id' => $session_id, 'id' => $id], $this->getEntityClass());
    }*/

    public function countCartItems($session_id){
        $tablename = $this->getTableName();
        $sql = "SELECT SUM(quantity) as count FROM $tablename WHERE session_id = :session_id";
        return App::call()->db->queryOne($sql,['session_id' => $session_id])['count'];
    }

    public function getCartProduct($session_id,$id){

        $tablename = $this->getTableName();
        $sql = "SELECT * FROM {$tablename} WHERE session_id = :session_id AND product_id = :id";

        return App::call()->db->queryOneObject($sql, ['session_id' => $session_id, 'id' => $id], $this->getEntityClass());
    }
}