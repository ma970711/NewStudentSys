<?php
include("../Application/controller/connDB.class.php");
$a_account=$_GET['a_account'];
if($a_account==null){
    header("location:login.php");
} //如果没登录则弹到登录页
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/2.0.0/weui.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.min.css">
    <title>迎新管理系统</title>
    <style>
        .demos-pic {
            width: 375px;
            height: 167px;
            display : block;
        }
        .demos-header {
            padding: 35px 0;
        }
    </style>
</head>
<body ontouchstart>
<header>
    <img src="../Application/banner2.jpg" width="100%" height="100%" class="demos-pic">
</header>
<div class="weui-cells">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>您好，管理员</p>
        </div>
    </div>
</div>
<div class="weui-grids" style="height: 100%">
    <a href="articleManager.php?a_account=<?echo $a_account ?>" class="weui-grid js_grid" data-id="finInfo" >
        <div class="weui-grid__icon">
            <img src="images/icon_nav_article.png" alt="">
        </div>
        <p class="weui-grid__label">编写报到规则</p>
    </a>
    <a href="voInfo.php?a_account=<?echo $a_account ?>" class="weui-grid" data-id="pay">
        <div class="weui-grid__icon">
            <img src="images/icon_nav_cell.png" alt="">
        </div>
        <p class="weui-grid__label">志愿者信息录入</p>
    </a>
    <a href="audit.php?a_account=<?echo $a_account?>" class="weui-grid" >
        <div class="weui-grid__icon">
            <img src="images/icon_nav_panel.png" alt="">
        </div>
        <p class="weui-grid__label">学生信息审核</p>
    </a>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.js"></script>
<script>
    $(document).on("open", ".weui-popup-modal", function() {
        console.log("open popup");
    }).on("close", ".weui-popup-modal", function() {
        console.log("close popup");
    });
</script>
</body>
</html>