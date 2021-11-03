<?php

namespace app\models;

use app\engine\Session;

class Users extends DBModel
{
    protected $id;
    protected $login;
    protected $pass;
    protected $hash;

    protected $props = [
       'login' => false,
       'pass' => false,
       'hash' => false
    ];

    public function __construct($login = null , $pass = null, $hash = null)
    {
        $this->login = $login;
        $this->pass = $pass;
        $this->hash = $hash;
    }


    public static function getTableName(){
        return 'users';
    }

    public static function isAuth()
    { // авторизован ли кто-то
        if(isset($_COOKIE['hash']) && !isset($_SESSION['login'])){
            $hash = $_COOKIE['hash'];

            $row = Users::getOneWhere('hash',$hash);
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
    public static function auth($login, $pass)
    {
        $passDB = Users::getOneWhere('login',$login);
        //password_hash('123', PASSWORD_DEFAULT);// поможет получить захешированный пароль для нового пользователя в базе.
        if (password_verify($pass,$passDB->pass)){
            (new Session())->set('login', $login);
            (new Session())->set('id', $passDB->id);
            //$_SESSION['login'] = $login;
            //$_SESSION['id'] = $passDB->id;
            return true;
        }
        return false;
    }

  public static function updateHash(){

        $hash = uniqid(rand(), true);
        $id = (int)$_SESSION['id'];
        $user = Users::getOne($id);
        $user->hash = $hash;
        $user->props['hash'] = true;
        $user->save();
        setcookie("hash", $hash, time() + 36000, '/');
    }


    public static function get_user()
    {
        $session_login = (new Session())->get('login');
        return $session_login;
    }

    function is_admin()
    {
        $isAdmin = ((new Session())->get('login')) == 'admin';
        return $isAdmin;
        //return $_SESSION['login'] == 'admin';
    }

}