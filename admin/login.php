<?php
ob_start(); //打开缓冲区
include ("../Application/controller/connDB.class.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
    <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/2.0.0/weui.css">
    <style>
        body, html {
            height: 100%;
            -webkit-tap-highlight-color: transparent;
        }
        .demos-pic {
            width: 375px;
            height: 167px;
            display : block;
        }
        footer {
            text-align: center;
            font-size: 14px;
            padding: 20px;
        }
        footer a {
            color: #999;
            text-decoration: none;
        }
    </style>
    <title>迎新管理系统</title>

</head>
<body ontouchstart>
<header>
    <img src="../Application/banner2.jpg" width="100%" height="100%" class="demos-pic">
</header>
<form method="post">
    <div class="weui-cells weui-cells_form">

        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">管理员账号</label></div>
            <div class="weui-cell__bd weui-cell_primary"><input type="text" id="a_account" name="a_account"  class="weui-input"/></div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">管理员密码</label></div>
            <div class="weui-cell__bd weui-cell_primary"><input type="password" id="a_pass" name="a_pass" class="weui-input" /></div>
        </div>
    </div>
    <div class="weui-btn-area">
        <button type="submit"  id="loginSub" name="loginSub" class="weui-btn weui-btn_primary" >登录</button>
    </div>
</form>
<?
$a_account = $_POST["a_account"];
$pass = $_POST["a_pass"];
$conn = conn();
if(isset($a_account)) {
    $sql = "select * from a_adminInfo where a_account = '{$a_account}'";
    $arr = $conn->query($sql);
    $arr->execute();
    $result = $arr->fetch(PDO::FETCH_ASSOC);
    if($result['a_pass'] == $pass && !empty($pass)){
        header("Location:menu.php?a_account=".$a_account);
    }else{
        echo '
            <script>         
                $(document).on(\'click\', \'#loginSub\', function() {
                    $.toast("账号密码出错！", "forbidden",function() {
                        console.log(\'close\');
                    });
                    location.replace(location.href);
                })               
            </script>
        ';
    }
}
ob_end_flush();//输出所有内容到浏览器
?>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.js"></script>

</body>
</html>