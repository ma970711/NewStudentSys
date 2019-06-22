<?php
/**
 * Created by PhpStorm.
 * User: XYX
 * Date: 2019/6/16
 * Time: 11:33
 */
$a_account=$_GET['a_account'];
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/2.0.0/weui.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.min.css">
    <title>操作成功</title>

</head>
<body ontouchstart>
<div class="weui-msg">
    <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
    <div class="weui-msg__text-area">
        <h2 class="weui-msg__title">操作成功</h2>
        <p class="weui-msg__desc">编辑成功！</p>
    </div>
    <div class="weui-msg__opr-area">
        <p class="weui-btn-area">
            <a href="javascript:;" id="back" class="weui-btn weui-btn_primary">返回迎新系统</a>
        </p>
    </div>
</div>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.js"></script>
<script>
    $(document).on("click", "#back", function() {
        window.location.replace("menu.php?a_account=<?echo $a_account?>");
    });

</script>
</body>