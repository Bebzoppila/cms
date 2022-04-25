<?php

class DataBase
{
    private $db;

    public function __construct (){
        $this->db = new PDO("mysql:host=127.0.0.1;dbname=admin1", 'root', '');
    }

    public function queryAll($sql, $params = []){
        return $this->sthExecute($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function queryOne($sql, $params = []){
        return $this->sthExecute($sql, $params)->fetch(PDO::FETCH_ASSOC);
    }

    public function sthExecute($sql, $params = []){
        $sth = $this->db->prepare($sql);
        $sth->execute($params);
        return $sth;
    }

    public function getLastId(){
        return $this->db->lastInsertId();
    }

//
}