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
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/2.0.0/weui.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.css">
    <title>宿舍申请</title>
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

    <div class="weui-panel weui-panel_access">
        <div class="weui-panel__hd">

            经系统检测，<?
            if($result['is_dor']==0) {
                echo '您属于' . $result['s_zhuanye'] . '系，能选择';
                if ($result['s_zhuanye'] == "软件工程") {
                    echo '绿杨楼G楼';
                } else {
                    echo '书新楼Q楼';
                };
                echo "宿舍,请选择楼层";
            }else{
                echo "<br>你已申请了".$result['s_dorNum']."宿舍，请勿重新申请";
            }
            ?>
        </div>
    </div>
    <?
    if($result['is_dor']==0) {
    echo '
    <form method="post">
    <div class="weui-cells weui-cells_radio">
        <label class="weui-cell weui-check__label" for="x11">
            <div class="weui-cell__bd">
                <p>1楼</p>
            </div>
            <div class="weui-cell__ft">
                <input type="radio" class="weui-check" name="radio1" id="x11" value="1">
                <span class="weui-icon-checked"></span>
            </div>
        </label>
        <label class="weui-cell weui-check__label" for="x12">

            <div class="weui-cell__bd">
                <p>2楼</p>
            </div>
            <div class="weui-cell__ft">
                <input type="radio" name="radio1" class="weui-check" id="x12" checked="checked" value="2">
                <span class="weui-icon-checked"></span>
            </div>
        </label>
        <label class="weui-cell weui-check__label" for="x13">

            <div class="weui-cell__bd">
                <p>3楼</p>
            </div>
            <div class="weui-cell__ft">
                <input type="radio" name="radio1" class="weui-check" id="x13"  value="3">
                <span class="weui-icon-checked"></span>
            </div>
        </label>
        <label class="weui-cell weui-check__label" for="x14">

            <div class="weui-cell__bd">
                <p>4楼</p>
            </div>
            <div class="weui-cell__ft">
                <input type="radio" name="radio1" class="weui-check" id="x14"  value="4">
                <span class="weui-icon-checked"></span>
            </div>
        </label>
        <button class="weui-btn weui-btn_primary" type="submit" name="apply">确认申请</button>
    </form>
    </div>
    ';
    }else{
        echo "<br>";
        echo '<a href="javascript:;" id="back" class="weui-btn weui-btn_primary">返回报到系统</a>';
    }
    if (isset($_POST['apply'])){//点击确定按钮开始分配宿舍
        $dorNum = $_POST['radio1'];
        $t_dorNum=$dorNum.mt_rand(10,20);
        if($result['s_zhuanye']=="软件工程"){
            $t2_dorNum='G'.$t_dorNum;
        }else{
            $t2_dorNum='Q'.$t_dorNum;
        }
        $arr2 = $db->prepare("select * from dormitory where s_dorNum=".$t2_dorNum);
        $arr2->execute();
        if($arr2->rowCount() < 1) {//随机出来的宿舍没人的时候的操作
            $sql1 = "UPDATE s_info SET s_info.is_dor=1,s_info.s_dorNum='{$t2_dorNum}' WHERE s_info.s_admission ='{$s_admission}';
                    insert into dormitory (dormitory.s_dorNum) VALUE ('{$t2_dorNum}');";
            $stmt = $db->prepare($sql1);
            $stmt->execute();
            if ($stmt->rowCount() > 0 ) {
                echo '<script type="text/javascript">';
                echo 'alert("申请成功！您的宿舍为'.$t2_dorNum.'");';
                echo ' window.location.href = "menu.php?s_admission= '.$s_admission.'"';
                echo '</script>';

            } else {
                echo '<script>alert(\'申请失败！\')</script> ';
            }
        }else {//当随机出来的宿舍已经有人时的操作
            $result2 = $arr2->fetch(PDO::FETCH_ASSOC);
            if($result2['d_remainder']>0) {
                $sql1 = "UPDATE s_info,dormitory  SET s_info.is_dor=1,dormitory.d_remainder=dormitory.d_remainder-1,s_info.s_dorNum='{$t2_dorNum}' WHERE dormitory.s_dorNum='{$t2_dorNum}',s_info.s_admission =".$s_admission;
                $stmt = $db->prepare($sql1);
                $stmt->execute();
                if ($stmt->rowCount() > 0 ) {
                    echo '<script type="text/javascript">';
                    echo 'alert("申请成功！您的宿舍为'.$t2_dorNum.'");';
                    echo ' window.location.href = "menu.php?s_admission= '.$s_admission.'"';
                    echo '</script>';

                } else {
                    echo '<script>alert(\'申请失败！\')</script> ';
                }
            }else{//当宿舍满4人时
                echo '<script type="text/javascript">';
                echo 'alert(\'宿舍已满人！\');';
                echo ' window.location.href = "menu.php?s_admission= '.$s_admission.'"';
                echo '</script>';
            }
        }
    }
    ?>

</div>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.js"></script>
<script>
    $(document).on("click", "#back", function() {
        window.location.replace("menu.php?s_admission=<?echo $s_admission?>");
    });
</script>
</body>