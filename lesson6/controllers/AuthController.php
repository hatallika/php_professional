<?php

namespace app\controllers;

use app\engine\Session;
use app\models\Users;

class AuthController extends Controller
{
    public function actionLogin(){

         //form action='/auth/login/'
         $login = $this->getGlobalParams()['login']; //POST['login']
         $pass = $this->getGlobalParams()['pass']; // //POST['pass']
         if (Users::auth($login,$pass)) {
             if (isset($this->getGlobalParams()['save'])) {
                 Users::updateHash();
             }
         } else {
             //$_SESSION['message']['login'] = 'Не верный логин и пароль';
             Session::addSession('message', ['login'=>'Не верный логин и пароль']);

         }
         header("Location: " . $_SERVER['HTTP_REFERER']);
         die();
    }

     public function actionLogout()
     {
         setcookie("hash", '', time() - 3600, '/');
         session_regenerate_id();
         session_destroy();
         header("Location: " . $_SERVER['HTTP_REFERER']);
         die();
     }

}