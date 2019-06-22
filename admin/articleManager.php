<?php
ob_start(); //打开缓冲区
include("../Application/controller/connDB.class.php");
$a_account=$_GET['a_account'];
if($a_account==null){
    header("location:login.php");
} //如果没登录则弹到登录页
$conn = conn();
$sql = "SELECT * FROM a_ariticle";
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
    <title>报到规则编写</title>

</head>
<body ontouchstart>
<div class="weui-cells__title">编辑页</div>
<form method="post">
    <div class="weui-cells__title">报道注意事项</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <textarea class="weui-textarea"  rows="15" name="art" id="art"><?echo $result['article']?></textarea>
            </div>
        </div>
    </div>
    <div class="weui-btn-area">
        <button class="weui-btn weui-btn_primary" type="submit" name="subBtn" id="subBtn">确定</button>
    </div>
</form>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.js"></script>
<?php
if (isset($_POST['art'])) {
    $art = $_POST['art'];
    $stmt=$conn->prepare("update a_ariticle set article=? where id=1");
    $stmt->bindParam(1,$art);
    $stmt->execute();
    if($stmt->rowCount()==1){
        header("Location:success.php?a_account=".$a_account);
    }else{
        echo "<script>alert('提交失败！')</script>";
    }
}
ob_end_flush();//输出所有内容到浏览器
?>
</body>