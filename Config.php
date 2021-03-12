<?php

class Database {
    public $con;
    public function __construct() {
        $this->con = mysqli_connect("localhost:3306", "root", "", "booking");
        if (!$this->con) {
            echo "Mysql bağlantı hatası: ".mysqli_connect_error();
        }
    }
}

class DataOperation extends Database {
    public function getAll($table){
        $sql = "SELECT * FROM ".$table;
        $array = array();
        $query = mysqli_query($this->con,$sql);
        while($row = mysqli_fetch_assoc($query)){
            $array[] = $row;
        }
        return $array;
    }

    public function get($table,$where){
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value) {
            // id = '5' AND  name LIKE 'something' AND
            if (strpos($key, 'like') !== false){
                //key like ise like tipinde sorgu ekle. Burada value = "name LIKE '%ali%'" şeklinde gönderileceği varsayılmaktadır
                $condition .= $value . "' AND ";
            }else {//normal sorguları and ile birleştir
                if (is_numeric($value)){ // sayısal bir değerse tırnak işareti olmaz
                    $condition .= $key . "=" . $value . " AND ";
                }else {
                    $condition .= $key . "='" . $value . "' AND ";
                }
            }
        }
        //sonra kalan " AND " sil
        $condition = substr($condition, 0, -5);
        $condition = $condition == "" ? "true" : $condition;
        $sql .= "SELECT * FROM ".$table." WHERE ".$condition;
        $query = mysqli_query($this->con,$sql);
        return mysqli_fetch_array($query);
    }

    public function getList($table,$where){
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value) {
            // id = '5' AND  name LIKE 'something' AND
            if (strpos($key, 'like') !== false){
                //key like ise like tipinde sorgu ekle. Burada value = "name LIKE '%ali%'" şeklinde gönderileceği varsayılmaktadır
                $condition .= $value . " AND ";
            }else {//normal sorguları and ile birleştir
                if (is_numeric($value)){ // sayısal bir değerse tırnak işareti olmaz
                    $condition .= $key . "=" . $value . " AND ";
                }else {
                    $condition .= $key . "='" . $value . "' AND ";
                }
            }
        }
        //sonra kalan " AND " sil
        $condition = substr($condition, 0, -5);
        $condition = $condition == "" ? "true" : $condition;
        $sql .= "SELECT * FROM ".$table." WHERE ".$condition;
        $array = array();
        $query = mysqli_query($this->con,$sql);
        while ($row = mysqli_fetch_assoc($query)){
            $array[] = $row;
        }
        return $array;
    }

    public function add($table,$data){
        //"INSERT INTO table_name (, , ) VALUES ('name','qty')";
        $sql = "";
        $sql .= "INSERT INTO ".$table;
        $sql .= " (".implode(",", array_keys($data)).") VALUES ";
        $sql .= "('".implode("','", array_values($data))."')";
        $query = mysqli_query($this->con,$sql);
        if($query){
            return true;
        }
    }

    public function update($table,$where,$fields){
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value) {
            // id = '5' AND m_name = 'something'
            $condition .= $key . "='" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        foreach ($fields as $key => $value) {
            //UPDATE table SET m_name = '' , qty = '' WHERE id = '';
            $sql .= $key . "='".$value."', ";
        }
        $sql = substr($sql, 0,-2);
        $sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
        if(mysqli_query($this->con,$sql)){
            return true;
        }
    }

    public function delete($table,$where){
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value) {
            $condition .= $key . "='" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        $sql = "DELETE FROM ".$table." WHERE ".$condition;
        if(mysqli_query($this->con,$sql)){
            return true;
        }
    }

}

session_start();
$dataOperation = new DataOperation();


