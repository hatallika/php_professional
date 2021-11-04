<?php

namespace app\controllers;
use app\models\entities\Products;
use app\models\repositories\ProductRepository;

class ProductController extends Controller
{

    public function actionIndex()
    {
        echo $this->render('index');
    }


    public function actionCatalog()
    {
        $max_page = floor((new ProductRepository())->getCount() / PER_PAGE); // ограничить вывод страниц, когда товары закончатся.
        //$catalog = Products::getAll();
        $page = $this->getGlobalParams()['page'] ?? 0;
        if ($page > $max_page){
            $page = $max_page;
        }

        $catalog = (new ProductRepository())->getLimit($page*PER_PAGE); //LIMIT 0,2////LIMIT 3,2// отображаем по 2=PER_PAGE


        echo $this->render('catalog/index', [
            'catalog'=> $catalog,
            'page' => ++$page
        ]);
    }

    // карточка товара
    public function actionCard()
    {
        $id = $this->getGlobalParams()['id'];
        $product = (new ProductRepository())->getOne($id);

        echo $this->render('catalog/card',[
            'product'=> $product
        ]);

    }

    public function actionAdd()
    {
        //админ добавляет новый продукт в каталог
    }

}