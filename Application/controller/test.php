<?php
/**
 * Created by PhpStorm.
 * User: XYX
 * Date: 2019/6/15
 * Time: 13:54
 */
    $db = new db();
    $conn=$db->conn();
    $result = $conn->query("select * from s_info");
    echo $result;