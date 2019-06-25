<?php
ob_start(); //打开缓冲区
include("../Application/controller/connDB.class.php");
$a_account=$_GET['a_account'];
if($a_account==null){
    header("location:login.php");
} //如果没登录则弹到登录页
$conn = conn();
$sql = "SELECT * FROM s_info where is_ok=0";
$arr = $conn->query($sql);
$arr->execute();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/2.0.0/weui.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.min.css">
    <title>审核页</title>

</head>
<body ontouchstart>
<div class="weui-cells__title">待审核学生信息</div>
<div class="weui-cells">
    <?
        if ($arr->rowCount()==0){
            echo '<h2 class="weui-msg__title" style="text-align: center">暂无未审核学生</h2>';
            echo '<a href="javascript:;" id="back" class="weui-btn weui-btn_primary">返回</a>';
        }else{
            while ($result = $arr->fetch(PDO::FETCH_ASSOC)) {
                ?>
    <a class="weui-cell weui-cell_access" href="enter.php?s_admission=<?echo $result['s_admission']?>&a_account=<?echo $a_account?>">
        <div class="weui-cell__bd"><? echo $result['s_name']?>
        </div>
    </a>
                <?
            }
        }
        echo '<a href="javascript:;" id="back" class="weui-btn weui-btn_primary">返回</a>';

    ?>
</div>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.js"></script>
<script>
    $(document).on("click", "#back", function() {
        window.location.replace("menu.php?a_account=<?echo $a_account?>");
    });
</script>
</body>

