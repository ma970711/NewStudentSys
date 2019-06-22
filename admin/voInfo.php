<?php
ob_start(); //打开缓冲区
include("../Application/controller/connDB.class.php");
$a_account=$_GET['a_account'];
if($a_account==null){
    header("location:login.php");
} //如果没登录则弹到登录页
$conn = conn();
$sql = "SELECT * FROM v_info";
$arr = $conn->query($sql);
$arr->execute();

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/2.0.0/weui.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.min.css">
    <title>报到规则编写</title>

</head>
<body ontouchstart>
<div class="weui-cells__title">志愿者信息</div>
<div class="weui-cells">
    <?
    while ($result = $arr->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <a class="weui-cell weui-cell_access" href="edit.php?v_id=<?echo $result['v_id']?>&a_account=<?echo $a_account?>">
        <div class="weui-cell__bd"><? echo $result['v_name']?>
        </div>
        <div class="weui-cell__ft"><? echo $result['v_phone']?>
        </div>
       </a>
    <?
    }
    ?>
</div>
    <a href="add.php?a_account=<? echo $a_account?>" class="weui-cell weui-cell_link">
        <div class="weui-cell__bd">添加更多</div>
    </a>

<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.js"></script>
</body>