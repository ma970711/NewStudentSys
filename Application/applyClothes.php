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
    <title>军服选购</title>
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
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>您好，<? echo $result['s_name'] ?> 同学</p>
        </div>
    </div>
</div>
<form method="post">
    <div class="weui-cells weui-cells_form">
    <div class="weui-cells__title">欢迎体验军服选购系统,身高单位(cm)，体重单位(斤)</div>
        <? if($result['is_clothes']==0){
            echo '
        <div class="weui-cell">
            <div class="weui-cell__hd"><label for="name" class="weui-label">码数</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" id="size" name="size" type="text" value="" readonly="readonly"/>
            </div>          
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label for="name" class="weui-label">￥35.00</label></div>
        </div>
        ';
            echo '<button class="weui-btn weui-btn_primary" name="apply" type="submit" style="text-align: center">确认选购</button>';
            if (isset($_POST['apply'])){
                $stmt=$db->prepare("UPDATE s_info SET is_clothes=1,s_cloSize='{$_POST['size']}' WHERE s_admission =".$s_admission);
                $stmt->execute();
                if($stmt->rowCount()>0){
                    echo '<script type="text/javascript">';
                    echo 'alert(\'购买成功,您的军训服装为'.$_POST['size'].'码\');';
                    echo 'window.location.href = "menu.php?s_admission= '.$s_admission.'"';
                    echo '</script>';
                }else{
                    echo '<script>alert(\'购买失败！\')</script> ';
                }
            }
        }else{
            echo '<div class="weui-cells__title">您已选购'.$result['s_cloSize'].'码军训衣服，请勿重复选购</div>';
            echo '<a href="javascript:;" id="back" class="weui-btn weui-btn_primary">返回报到系统</a>';



        }

        ?>
    </div>
</form>
<div class="weui-cells">
    <div class="weui-cells__title">军服码数表</div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>S码</p>
        </div>
        <div class="weui-cell__ft">身高155-160，体重85-100</div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>M码</p>
        </div>
        <div class="weui-cell__ft">身高160-165，体重95-115</div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>L码</p>
        </div>
        <div class="weui-cell__ft">身高165-170，体重115-135</div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>XL码</p>
        </div>
        <div class="weui-cell__ft">身高170-175，体重130-150</div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>XXL码</p>
        </div>
        <div class="weui-cell__ft">身高175-180，体重145-170</div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>XXXL码</p>
        </div>
        <div class="weui-cell__ft">身高180-185，体重170-190</div>
    </div>

</div>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.js"></script>
<script>
    $("#size").select({
        title: "选择码数",
        items: ["S", "M", "L", "XL", "XXL", "XXXL"],
        onChange: function(d) {
            console.log(this, d);
        },
        onClose: function() {
            console.log("close");
        },
        onOpen: function() {
            console.log("open");
        },
    });
    $(document).on("click", "#back", function() {
        window.location.replace("menu.php?s_admission=<?echo $s_admission?>");
    });

</script>
</body>

