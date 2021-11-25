<?php

namespace app\models\repositories;

use app\engine\App;
use app\models\entities\Orders;
use app\models\Repository;

class OrderRepository extends Repository
{
    protected function getTableName(){
        return 'orders';
    }

    protected function getEntityClass(){
        return Orders::class;
    }

    public function getOneOrder($id, $user_id){
        $sql = "SELECT o.id as order_id, o.name, o.phone, o.status, 
                c.id as cart_id, c.product_id, c.quantity, c.fixed_price,
                p.name as product_name, p.image
                FROM orders o JOIN cart c ON c.session_id = o.cart_session_id
                JOIN products p ON p.id = c.product_id
                WHERE o.id = :order_id AND o.user_id = :user_id";
        //var_dump($sql,$id, $user_id );

        return App::call()->db->queryAll($sql,['order_id' => $id, 'user_id'=> $user_id]);
    }

}