<?php

namespace app\models\repositories;

use app\models\entities\Images;
use app\models\Repository;

class ImageRepository extends Repository
{
    protected function getTableName(){
        return 'images';
    }

    protected function getEntityClass(){
        return Images::class;
    }
}