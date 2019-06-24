<?php
ob_start(); //打开缓冲区
    include ("controller/connDB.class.php");


    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
    <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/2.0.0/weui.css">
    <style>
        body, html {
            height: 100%;
            -webkit-tap-highlight-color: transparent;
        }
        .demos-pic {
            width: 375px;
            height: 167px;
            display : block;
        }
        .demos-title {
            text-align: center;
            font-size: 34px;
            color: #3eacff;
            font-weight: 400;
            margin: 0 15%;
        }
        .demos-header {
            padding: 35px 0;
        }
        footer {
            text-align: center;
            font-size: 14px;
            padding: 20px;
        }
        footer a {
            color: #999;
            text-decoration: none;
        }
    </style>
    <title>自助报道系统</title>

</head>
<body ontouchstart>
<header>

    <img src="banner2.jpg" width="100%" height="100%" class="demos-pic">
</header>
<form method="post">
<div class="weui-cells weui-cells_form">

    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">准考证号</label></div>
        <div class="weui-cell__bd weui-cell_primary"><input type="number" id="admission" name="admission" pattern="[0-9]*" class="weui-input" placeholder="请输入你的准考证号"/></div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">密码</label></div>
        <div class="weui-cell__bd weui-cell_primary"><input type="password" id="pass" name="pass" class="weui-input" placeholder="身份证后六位"/></div>
    </div>
</div>
<div class="weui-btn-area">
    <button type="submit"  id="loginSub" name="loginSub" class="weui-btn weui-btn_primary" >登录</button>
</div>

</form>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.js"></script>
<?php
    $s_admission = $_POST["admission"];
    $pass = $_POST["pass"];
    $conn = conn();
    if(isset($s_admission)) {
        $sql = "select * from s_info where s_admission = '{$s_admission}'";
        $arr = $conn->query($sql);
        $arr->execute();
        $result = $arr->fetch(PDO::FETCH_ASSOC);
        if($result['s_password'] == $pass && !empty($pass)){
            if($result['is_ok']==1) {
                header('Location:menu.php?s_admission=' . $s_admission);
            }else{
                echo "<script>";
                echo "alert('账号未审核');";
                echo "</script>";
            }
        }else{
            echo '
            <script>
                alert("账号或密码错误");              
            </script>
        ';
        }

    }
    ob_end_flush();//输出所有内容到浏览器
?>

<!--<script>-->
<!--    $(document).on('click', '#loginSub', function() {-->
<!--        $.toast("登录成功", function() {-->
<!--            console.log('close');-->
<!--        });-->
<!--            window.location.replace("menu.php");-->
<!--        })-->
<!---->
<!--</script>-->
</body>
</html>