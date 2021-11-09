<?php

namespace app\engine;
use app\models\entities\Products;
use app\traits\TSingleton;
use \PDO;
class Db
{

    protected $config;

    private $connection = null;//PDO

    public function __construct($driver = null, $host = null, $login = null, $password = null, $database = null,
                $charset = "utf8")
    {
        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['login'] = $login;
        $this->config['password'] = $password;
        $this->config['database'] = $database;
        $this->config['charset'] = $charset;
    }

    private function getConnection(){
        // $DBH = new PDO("mssql:host=$host;dbname=$dbname", $user, $pass);
        if(is_null($this->connection)){
            //"msql:host=$host;dbname=$dbname"  получим из prepareDsnString()
            $this->connection = new PDO($this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }

    public function lastInsertID(){
        //вернули id - получили доступ к conection и вернули lastInsertID PDO
        //return $this->connection->lastInsertID();
        return $this->getConnection()->lastInsertId();
    }

    private function prepareDsnString(){
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

    //SELECT * FROM products WHERE id = :id
    //params = ['id'=> 1]
    private function query($sql, $params){

        $STH = $this->getConnection()->prepare($sql);
        //$STH->bindValue(':id',2, PDO::PARAM_INT);//ручной бинд - напр для LIMIT
        //происходит бинд по массиву $params
        $STH->execute($params); //запускает подготовленный запрос на исполнение
        return $STH;
    }
    public function queryLimit($sql, $limit)
    {
        $STH = $this->getConnection()->prepare($sql);
        $STH->bindValue(1, $limit, PDO::PARAM_INT);
        $STH->bindValue(2, App::call()->config['product_per_page'], PDO::PARAM_INT);
        $STH->execute(); //запускает подготовленный запрос на исполнение

        return $STH;
    }

    //WHERE id = 1
    public function queryOne($sql, $params=[])
    {
        return $this->query($sql, $params)->fetch(); // в getConnection указали в каком виде вернуть данные - PDO::FETCH_ASSOC
    }

    public function queryOneObject($sql, $params, $class)
    {
        try {

            $STH = $this->query($sql, $params);
            $STH->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $class); //$class = app\models\Product
            $obj = $STH->fetch();

            if (!$obj) {

                throw new \Exception("Объект не найден");
            }
        } catch (\Exception $e) {
            App::call()->session->set('message', ['exception'=>$e->getMessage()]);

        }
        return $obj;
    }

    //SELECT all
    public function queryAll($sql, $params=[]){
        return $this->query($sql, $params)->fetchAll(); //Возвращает массив, содержащий все строки результирующего набора
    }


    //INSERT, UPDATE, DELETE - не нужны данные
    public function execute($sql, $params=[]){
        return $this->query($sql, $params)->rowCount();
    }
}