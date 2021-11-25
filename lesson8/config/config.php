<?php
/*define('ROOT', dirname(__DIR__));
define('DS', DIRECTORY_SEPARATOR);
define('CONTROLLER_NAMESPACE','app\\controllers\\');
define('VIEWS_DIR','../views/');
define('PER_PAGE', 4);
*/

use app\engine\Db;
use app\engine\Message;
use app\engine\Request;
use app\engine\Session;
use app\engine\TwigRender;
use app\models\repositories\CartRepository;
use app\models\repositories\FeedbackRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;
use app\models\repositories\ImageRepository;

return [
    'root'=>dirname(__DIR__),
    'controller_namespace' => 'app\\controllers\\',
    'views_dir'=>'../views/',
    'product_per_page'=> 4,
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost:3307',
            'login' => 'test',
            'password' => '12345',
            'database' => 'gb2',
            'charset' => 'utf8'
        ],
        'request' => [
            'class' => Request::class
        ],
        'cartRepository' => [
            'class' => CartRepository::class
        ],
        'productRepository' => [
            'class' => ProductRepository::class
        ],
        'userRepository' => [
            'class' => UserRepository::class
        ],
        'orderRepository' => [
            'class' => OrderRepository::class
        ],
        'feedbackRepository' => [
            'class' => FeedbackRepository::class
        ],
        'imageRepository' => [
            'class' => ImageRepository::class
        ],
        'message' => [
            'class' => Message::class
        ],
        'session' => [
            'class' => Session::class
        ],
        'twigRender' => [
            'class' => TwigRender::class
        ],



    ]


];