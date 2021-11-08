<?php

namespace app\controllers;
use app\engine\Message;
use app\models\entities\Products;
use app\models\repositories\ProductRepository;
use app\engine\App;

class ProductController extends Controller
{

    public function actionIndex()
    {
        echo $this->render('index');
    }


    public function actionCatalog()
    {
        $max_page = floor(App::call()->productRepository->getCount() / App::call()->config['product_per_page']); // ограничить вывод страниц, когда товары закончатся.
        //$catalog = Products::getAll();
        //$page = $this->getGlobalParams()['page'] ?? 0;
        $page = App::call()->request->getParams()['page'] ?? 0;
        if ($page > $max_page){
            $page = $max_page;
        }

        $catalog = App::call()->productRepository->getLimit($page * App::call()->config['product_per_page']); //LIMIT 0,2////LIMIT 3,2// отображаем по 2=PER_PAGE


        echo $this->render('catalog/index', [
            'catalog'=> $catalog,
            'page' => ++$page
        ]);
    }

    // карточка товара
    public function actionCard()
    {
        $id = App::call()->request->getParams()['id'];
        $product = App::call()->productRepository->getOne($id);



        echo $this->render('catalog/card',[
            'product'=> $product,
            'message_ex'=> App::call()->message->getMessageException()
        ]);

    }

    public function actionAdd()
    {
        //админ добавляет новый продукт в каталог
    }

}