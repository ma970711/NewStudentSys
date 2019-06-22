<?php
ob_start(); //打开缓冲区
include("controller/connDB.class.php");
$s_admission=$_GET['s_admission'];
if($s_admission==null){
    header("location:login.php");
} //如果没登录则弹到登录页
$db = conn();
$sql = "select * from s_info where s_admission = '{$s_admission}'";
$arr = $db->query($sql);
$arr->execute();
$result = $arr->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<div lang="en" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1, user-scalable=no">
        <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/2.0.0/weui.css">
        <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.css">
        <title>报到单打印</title>
        <style>
            .demos-pic {
                width: 375px;
                height: 167px;
                display : block;
            }
        </style>
    </head>
    <body ontouchstart>
    <header>

        <img src="banner2.jpg" width="100%" height="100%" class="demos-pic">
    </header>
    <div class="weui-cells">
        <div class="weui-cells__title">个人报到信息</div>
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <p>姓名</p>
            </div>
            <div class="weui-cell__ft"><?echo $result['s_name']?></div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <p>专业</p>
            </div>
            <div class="weui-cell__ft"><?echo $result['s_zhuanye']?></div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <p>身份证号</p>
            </div>
            <div class="weui-cell__ft"><?echo $result['s_identifyId']?></div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <p>准考证号</p>
            </div>
            <div class="weui-cell__ft"><?echo $result['s_admission']?></div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <p>宿舍</p>
            </div>
            <div class="weui-cell__ft"><?echo $result['s_dorNum']?></div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <p>军训服装码数</p>
            </div>
            <div class="weui-cell__ft"><?echo $result['s_cloSize']?></div>
        </div>

    </div>
    <?
    if ($result['is_print']==0) {
        echo'
                    <form method="post">
                    <button type="submit" name="wechatPay" class="weui-btn weui-btn_primary">打印</button>             
                    </form>';
        if (isset($_POST['wechatPay'])){
            $stmt=$db->prepare("UPDATE s_info SET is_print=1 WHERE s_admission =".$s_admission);
            $stmt->execute();
            if($stmt->rowCount()==1){
                echo '<script type="text/javascript">';
                echo 'alert(\'打印完成！请到打印室凭身份证领取打印单\');';
                echo ' window.location.href = "menu.php?s_admission= '.$s_admission.'"';
                echo '</script>';

            }else{
                echo '<script>alert(\'打印失败！\')</script> ';
            }
        }
    }else{
        echo '<script>alert(\'请勿重新打印！\')</script>';
        echo '<a href="javascript:;" id="back" class="weui-btn weui-btn_primary">返回报到系统</a>';

    }

    ?>
    <script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.js"></script>
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.js"></script>
    <script>
        $(document).on("click", "#back", function() {
            window.location.replace("menu.php?s_admission=<?echo $s_admission?>");
        });
        </script>
    </body>