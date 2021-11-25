<?php

namespace app\models\repositories;

use app\engine\App;
use app\engine\Session;
use app\models\entities\Users;
use app\models\Repository;

class UserRepository extends Repository
{
    protected function getTableName(){
        return 'users';
    }

    public function isAuth()
    { // авторизован ли кто-то
        if(isset($_COOKIE['hash']) && !isset($_SESSION['login'])){
            $hash = $_COOKIE['hash'];

            $row = $this->getOneWhere('hash',$hash);
            if($row) {
                $user = $row->login;
                if (!empty($user)){
                    (new Session())->set('login', $user);
                    (new Session())->set('id', $row->id);
                    //$_SESSION['login'] = $user;
                    //$_SESSION['id'] = $row->id;
                }
            }
        }
        //return isset($_SESSION['login']);
        $session_login = (new Session())->get('login');
        return isset($session_login);
    }

    //проверка логина и пароля
    public function auth($login, $pass)
    {
        $passDB = $this->getOneWhere('login',$login);
        //password_hash('123', PASSWORD_DEFAULT);// поможет получить захешированный пароль для нового пользователя в базе.
        if (password_verify($pass,$passDB->pass)){
            App::call()->session->set('login', $login);
            App::call()->session->set('id', $passDB->id);
            //$_SESSION['login'] = $login;
            //$_SESSION['id'] = $passDB->id;
            return true;
        }
        return false;
    }

    public function updateHash(){

        $hash = uniqid(rand(), true);
        $id = (int)$_SESSION['id'];
        $user = App::call()->userRepository->getOne($id);
        $user->hash = $hash;
        $user->props['hash'] = true;
        App::call()->userRepository->save($user);
        //$user->save();
        setcookie("hash", $hash, time() + 36000, '/');
    }


    public function get_user()
    {
        $session_login = App::call()->session->get('login');
        return $session_login;
    }

    public function is_admin()
    {
        $isAdmin = (App::call()->session->get('login')) == 'admin';
        return $isAdmin;
        //return $_SESSION['login'] == 'admin';
    }

    protected function getEntityClass(){
        return Users::class;
    }
}