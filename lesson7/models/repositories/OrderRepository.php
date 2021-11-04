<?php

namespace app\models\repositories;

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
}