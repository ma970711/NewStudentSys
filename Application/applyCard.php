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
    <title>一卡通申请</title>
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
                <p>您好，<? echo $result['s_name'] ?> ,请确认您的个人信息</p>
            </div>
        </div>
    </div>
    <div class="weui-form-preview">
    <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">姓名</label>
            <span class="weui-form-preview__value"><? echo $result['s_name'] ?></span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">身份证号</label>
            <span class="weui-form-preview__value"><? echo $result['s_identifyId'] ?></span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">专业</label>
            <span class="weui-form-preview__value"><? echo $result['s_zhuanye'] ?></span>
        </div>
    </div>

    <div class="weui-form-preview__ft">
        <? if($result['is_card']==0){

        echo '<a class="weui-form-preview__btn weui-form-preview__btn_primary open-popup" href="javascript:" data-target="#half">点击申办</a>';

        }else{
            echo '<a href="javascript:;" id="back" class="weui-btn weui-btn_primary">您已申办，请勿重新申办，点击返回报到系统</a>';
        }

        ?>
    </div>
    </div>
    <div id="half" class='weui-popup__container popup-bottom'>
        <div class="weui-popup__overlay"></div>
        <div class="weui-popup__modal">
            <div class="toolbar">
                <div class="toolbar-inner">
                    <a href="javascript:;" class="picker-button close-popup">关闭</a>
                </div>
            </div>
            <div class="bd">
                <div class="page__bd">
                    <div class="weui-cells__title"><? echo $result['s_name']?>同学</div>

                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>您确定申办?</p>
                            </div>
                            <div class="weui-cell__ft">
                                <?
                                if ($result['is_card']==0) {
                                    echo '
                                        <form method="post">
                                        <button name="pcard" id=\'pcard\' class="weui-btn weui-btn_primary">申请</button>
                                        </form>';
                                    if (isset($_POST['pcard'])){
                                        $stmt=$db->prepare("UPDATE s_info SET is_card=1 WHERE s_admission =".$s_admission);
                                                            $stmt->execute();
                                                            if($stmt->rowCount()==1){
                                                                echo '<script type="text/javascript">';
                                                                echo 'alert(\'申请成功,请在三个工作日后凭身份证到学生处办公室领取学生卡！\');';
                                                                echo ' window.location.href = "menu.php?s_admission= '.$s_admission.'"';
                                                                echo '</script>';
                                                            }else{
                                                                echo '<script>alert(\'申请失败！\')</script> ';
                                                            }
                                    }
                                }else{
                                    echo '<script>alert(\'您已经申请，请勿重新申请，请在办理成功后三个工作日后凭身份证到学生处办公室领取学生卡！\')</script>';
                                    //header("location:menu.php?s_admission=".$s_admission);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
    </div>
    <br>

    <script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.js"></script>
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.js"></script>
    <script>
        $(document).on("click", "#back", function() {
            window.location.replace("menu.php?s_admission=<?echo $s_admission?>");
        });
        $(document).on("open", ".weui-popup-modal", function() {
            console.log("open popup");
        }).on("close", ".weui-popup-modal", function() {
            console.log("close popup");
        });

        //$(document).on("click", "#card", function() {
        //    $.modal({
        //        title: "您好",
        //        text: "请选择支付方式",
        //        buttons: [
        //            { text: "支付宝", onClick: function(){ <?//
        //                    $stmt=$db->prepare("UPDATE s_info SET is_card=1 WHERE s_admission =".$s_admission);
        //                    $stmt->execute();
        //                    if($stmt->rowCount()==1){
        //                        echo '$.alert("支付成功"); ';
        //                        header("Location:menu.php?s_admission=".$s_admission);
        //                    }else{
        //                        echo '$.alert("支付失败"); ';
        //                    }
        //                    ?>//} },
        //            { text: "微信支付", onClick: function(){ <?//
        //                    $stmt=$db->prepare("UPDATE s_info SET is_card=1 WHERE s_admission =".$s_admission);
        //                    $stmt->execute();
        //                    if($stmt->rowCount()==1){
        //                        echo '$.alert("支付成功"); ';
        //                        header("Location:menu.php?s_admission=".$s_admission);
        //                    }else{
        //                        echo '$.alert("支付失败"); ';
        //                    }
        //                    ?>//} },
        //            { text: "取消", className: "default"},
        //        ]
        //    });
        //});
    </script>
</body>