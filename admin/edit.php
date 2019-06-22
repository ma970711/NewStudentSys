<?php
ob_start(); //打开缓冲区
include("../Application/controller/connDB.class.php");
$a_account=$_GET['a_account'];
$v_id=$_GET['v_id'];
$conn = conn();
$sql = "SELECT * FROM v_info where v_id=".$v_id;
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
    <title>志愿者消息编辑系统</title>
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
<div class="weui-cells__title">志愿者资料</div>
<form method="post">
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">志愿者姓名</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" name="v_name" value="<?echo $result['v_name']?>" required="required"/>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">志愿者手机号</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="number" name="v_phone" value="<?echo $result['v_phone']?>" required="required"/>
            </div>
        </div>
    </div>
    <div class="weui-btn-area">
        <button class="weui-btn weui-btn_primary" type="submit" name="subBtn" id="subBtn">修改</button>
    </div>
</form>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.js"></script>
<?php
if (isset($_POST['v_phone'])) {
    $v_nameEd = $_POST['v_name'];
    $v_phoneEd = $_POST['v_phone'];
    $stmt=$conn->prepare("update v_info set v_name=?,v_phone=? where v_id=".$v_id);
    $stmt->bindParam(1,$v_nameEd);
    $stmt->bindParam(2,$v_phoneEd,PDO::PARAM_INT);
    $stmt->execute();
    if($stmt->rowCount()==1){
        header("Location:success.php?a_account=".$a_account);
    }else{
        echo "<script>alert('修改失败！')</script>";
    }
}
ob_end_flush();//输出所有内容到浏览器
?>
</body>

