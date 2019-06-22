<?php
function conn(){

        $dsn = "mysql:host=bloudecbrmwl.mysql.sae.sina.com.cn;port=10208;dbname=studentInfo";
        try {
            $db = new PDO($dsn, 'admin', 'admin123', array(PDO::ATTR_PERSISTENT => true));

        }catch (PDOException $ex){
            die("不能连接数据库".$ex->getMessage());
        }
        return $db;
    }



