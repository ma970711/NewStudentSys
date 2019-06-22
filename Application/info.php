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
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.min.css">
    <title>个人信息</title>

</head>
<body ontouchstart>
<div class="weui-cells__title">信息采集</div>
<form method="post">
<div class="weui-cells weui-cells_form">
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">准考证号</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="number" name="admission" value="<?echo $result['s_admission']?>" readonly="readonly">
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">身份证号</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="number" name="identifyId" value="<?echo $result['s_identifyId']?>" readonly="readonly">
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="s_name" value="<?echo $result['s_name']?>" readonly="readonly">
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">性别</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="sex" value="<?echo $result['s_sex']?>" readonly="readonly">
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">登录密码</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="dadName"  value="<?echo $result['s_password']?>" required="required"/>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">父亲姓名</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="dadName" placeholder="请输入父亲的姓名" value="<?echo $result['s_dadName']?>" required="required"/>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">父亲号码</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="number" name="dadNum" placeholder="请输入父亲的手机号码" value="<?echo $result['s_dadNum']?>" required="required"/>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">母亲姓名</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="mumName" placeholder="请输入母亲姓名" value="<?echo $result['s_momName']?>" required="required"/>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">母亲号码</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="number" name="mumNum" placeholder="请输入母亲的手机号码" value="<?echo $result['s_monNum']?>" required="required"/>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">家庭住址</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" id="address" type="text" name="address" value="广东省 广州市 白云区">
            <input class="weui-input" type="text" name="address2" placeholder="请补充详细地址" value="<?echo $result['s_address2']?>" required="required"/>
        </div>
    </div>
    <div class="weui-btn-area">
        <button class="weui-btn weui-btn_primary" type="submit" name="subBtn" id="subBtn">确定</button>
    </div>
</div>
</form>

<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.js"></script>
<?php
if (isset($_POST['dadName'])) {
    $dadName = $_POST['dadName'];
    $dadNum = $_POST['dadNum'];
    $mumName = $_POST['mumName'];
    $mumNum = $_POST['mumNum'];
    $address = $_POST['address'];
    $address2 = $_POST['address2'];
    $stmt=$db->prepare("UPDATE s_info SET s_dadName=?,s_dadNum=?,s_momName=?,s_monNum=?,s_address=?,s_address2=?,is_finInfo=1 WHERE s_admission = ?");
    $stmt->bindParam(1,$dadName);
    $stmt->bindParam(2,$dadNum,PDO::PARAM_INT);
    $stmt->bindParam(3,$mumName);
    $stmt->bindParam(4,$mumNum,PDO::PARAM_INT);
    $stmt->bindParam(5,$address);
    $stmt->bindParam(6,$address2);
    $stmt->bindParam(7,$s_admission,PDO::PARAM_INT);
    $stmt->execute();
    if($stmt->rowCount()==1){
        header("Location:success.php?s_admission=".$s_admission);
    }else{
       echo "<script>alert('提交失败！')</script>";
    }



}
ob_end_flush();//输出所有内容到浏览器
?>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/city-picker.min.js"></script>
<script>
    $("#address").cityPicker({
        title: "选择地址",
        onChange: function (picker, values, displayValues) {

        }
    });
</script>

</body>