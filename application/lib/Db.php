<?php

namespace application\lib;

use PDO;

class Db 
{


    protected $db;

    public function __construct(){
        $config = $GLOBALS['config'];
        $this->db = new PDO('mysql:host='.$config['dbhost'].';dbname='.$config['dbname'], $config['user'], $config['password']);
    }

    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)){
            foreach ($params as $key => $val){
                $stmt->bindValue(':'.$key, $val);
            }
        }
        $stmt->execute();

        return $stmt;
    }

    public function row($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }


}
