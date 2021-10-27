<?php

namespace app\controllers;
use app\models\Products;

class ProductController extends Controller
{

    public function actionIndex()
    {
        echo $this->render('index');
    }


    public function actionCatalog()
    {
        $max_page = floor(Products::getCount() / PER_PAGE); // ограничить вывод страниц, когда товары закончатся.
        //$catalog = Products::getAll();
        $page = $_GET['page'] ?? 0;
        if ($page > $max_page){
            $page = $max_page;
        }

        $catalog = Products::getLimit($page*PER_PAGE); //LIMIT 0,2////LIMIT 3,2


        echo $this->render('catalog', [
            'catalog'=> $catalog,
            'page' => ++$page
        ]);
    }

    // карточка товара
    public function actionCard()
    {
        $id = $_GET['id'];
        $product = Products::getOne($id);

        echo $this->render('card',[
            'product'=> $product
        ]);
    }

    public function actionAdd()
    {
        //админ добавляет новый продукт в каталог
    }


}