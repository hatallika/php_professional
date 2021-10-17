<?php
/*2* Добавьте метод andWhere в класс Db, который обеспечит реализацию цепочеки:
echo $db->table('product')->where('name', 'Alex')->where('session', 123)->andWhere('id', 5)->get();
что должно вывести SELECT * FROM product WHERE name = Alex AND session = 123 AND id = 5
 * */
Class Db{
    protected $tableName;
    protected $wheres=[];
    public function table($tableName){
        $this->tableName = $tableName;
        return $this;
    }

    public function getAll(){
        $sql = "SELECT * FROM {$this->tableName}";
        if(!empty($this->wheres)){
            $sql .= " WHERE ";
            foreach ($this->wheres as $value){
                $sql .= $value['field'] . " = " . $value['value'];
                if($value != end($this->wheres)) { $sql .= " AND "; }
            }
            $this->wheres = [];
        }
        return $sql ."<br>";
    }

    public function getOne($id){
        return "SELECT * FROM {$this->tableName} WHERE id = {$id} <br>";
    }

    public function where($field, $value){
        $this->wheres[]=[
            'field' => $field,
            'value'=> $value
        ];
        return $this;
    }

    public function andWhere($field, $value){
        $this->where($field,$value);
        return $this;
    }


}
$db= new Db;

//echo $db->table('goods')->get();
//echo $db->table('goods')->getOne(2);
//echo $db->table('users')->where('login','admin')->get();
//echo $db->table('users')->where('login','admin')->where('pass','123')->get();
echo $db->table('product')->where('name', 'Alex')->where('session', 123)->andWhere('id', 5)->getAll();
//что должно вывести SELECT * FROM product WHERE name = Alex AND session = 123 AND id = 5
