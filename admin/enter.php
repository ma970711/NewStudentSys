<?php
ob_start(); //打开缓冲区
include("../Application/controller/connDB.class.php");
$a_account=$_GET['a_account'];
$s_admission=$_GET['s_admission'];
$conn = conn();
$sql = "SELECT * FROM s_info where s_admission=".$s_admission;
$arr = $conn->query($sql);
$arr->execute();
$result = $arr->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/2.0.0/weui.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.min.css">
    <title>学生审核系统</title>
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
<div class="weui-cells__title">学生资料</div>
<form method="post">
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">学生姓名</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" name="s_name" value="<?echo $result['s_name']?>" required="required" readonly="readonly"/>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">学生身份证</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="number" name="s_identifyId" value="<?echo $result['s_identifyId']?>" required="required" readonly="readonly"/>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">学生专业</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" name="s_zhuanye" value="<?echo $result['s_zhuanye']?>" required="required" readonly="readonly"/>
            </div>
        </div>
    </div>
    <div class="weui-btn-area">
        <button class="weui-btn weui-btn_primary" type="submit" name="subBtn" id="subBtn">审核通过</button>
    </div>
</form>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.js"></script>
<?php
if (isset($_POST['subBtn'])) {
    $stmt=$conn->prepare("update s_info set is_ok=1 where s_admission=".$s_admission);
    $stmt->execute();
    if($stmt->rowCount()==1){
        header("Location:success.php?a_account=".$a_account);
    }else{
        echo "<script>alert('未知错误！')</script>";
    }
}
ob_end_flush();//输出所有内容到浏览器
?>
</body>

