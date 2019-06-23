<?php
    include("controller/connDB.class.php");
    $s_admission=$_GET['s_admission'];
    if($s_admission==null){
        header("location:login.php");
    } //如果没登录则弹到登录页
    $conn = conn();
    $sql = "select * from s_info where s_admission = '{$s_admission}'";
    $arr = $conn->query($sql);
    $arr->execute();
    $result = $arr->fetch(PDO::FETCH_ASSOC);
    $sql2 = "select * from v_info";
    $arr2 = $conn->query($sql2);
    $arr2->execute();
    $sql3 = "select * from a_ariticle";
    $arr3 = $conn->query($sql3);
    $arr3->execute();
    $result3 = $arr3->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/2.0.0/weui.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.1/css/jquery-weui.min.css">
    <title>自助报到系统</title>
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
<body>

<header>

    <img src="banner2.jpg" width="100%" height="100%" class="demos-pic">
</header>
<div class="weui-cells">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>您好，<?php echo $result['s_name'] ?></p>
        </div>
        <?  if ($result['is_pay']== 0 || $result['is_finInfo']== 0 || $result['is_card']== 0 || $result['is_clothes']== 0 || $result['is_dor']==0 || $result['is_print']== 0) {
            echo '<div class="weui-cell__ft">请继续按流程完成注册</div>';
        }else{
            echo '<div class="weui-cell__ft">您已注册成功！</div>';
        }
        ?>
    </div>
</div>
<div class="weui-grids" style="height: 100%">
    <a href="info.php?s_admission=<?echo $s_admission?>" class="weui-grid js_grid" data-id="finInfo" >
        <div class="weui-grid__icon">
            <img src="images/icon_nav_article.png" alt="">
        </div>
        <p class="weui-grid__label">个人信息采集</p>
    </a>
    <a href="pay.php?s_admission=<?echo $s_admission?>" class="weui-grid" data-id="pay">
        <div class="weui-grid__icon">
            <img src="images/icon_nav_cell.png" alt="">
        </div>
        <p class="weui-grid__label">在线缴费</p>
    </a>
    <?  if ($result['is_pay']== 1){
        echo '
    <a href="applyCard.php?s_admission=<?echo $s_admission?>" class="weui-grid" data-id="applyCard">
        <div class="weui-grid__icon">
            <img src="images/icon_nav_button.png" alt="">
        </div>
        <p class="weui-grid__label">办理一卡通</p>
    </a>
    <a href="applyDor.php?s_admission=<?echo $s_admission?>" class="weui-grid" data-id="applyDon">
        <div class="weui-grid__icon">
            <img src="images/icon_nav_picker.png" alt="">
        </div>
        <p class="weui-grid__label">宿舍申请</p>
    </a>
    <a href="applyClothes.php?s_admission=<?echo $s_admission?>" class="weui-grid" data-id="buyClo">
        <div class="weui-grid__icon">
            <img src="images/icon_nav_msg.png" alt="">
        </div>
        <p class="weui-grid__label">选购军训服装</p>
    </a>';
    }?>
    <a href="javascript:" class="weui-grid open-popup" data-target="#full2">
        <div class="weui-grid__icon">
            <img src="images/icon_nav_city.png" alt="">
        </div>
        <p class="weui-grid__label">报道须知</p>
    </a>
    <a href="javascript:" class="weui-grid open-popup" data-target="#half" data-id="callHum">
        <div class="weui-grid__icon">
            <img src="images/icon_nav_toast.png" alt="">
        </div>
        <p class="weui-grid__label">联系志愿者</p>
    </a>
    <?  if ($result['is_pay']== 1 && $result['is_finInfo']== 1 && $result['is_card']== 1 && $result['is_clothes']== 1 && $result['is_dor']) {
        echo '<a href="report.php?s_admission='.$s_admission.'" class="weui-grid" data-id="infoPrint">';
        echo '<div class="weui-grid__icon">';
        echo '<img src="images/icon_nav_panel.png" alt="">';
        echo '</div>';
        echo '<p class="weui-grid__label">报道单打印</p>';
        echo '</a>';
    }
    ?>
    <a href="javascript:" class="weui-grid open-popup" data-target="#full">
        <div class="weui-grid__icon">
            <img src="images/icon_nav_progress.png" alt="">
        </div>
        <p class="weui-grid__label">注册完成情况</p>
    </a>
</div>
<div id="full" class='weui-popup__container'>
    <div class="weui-popup__overlay"></div>
    <div class="weui-popup__modal">
        <div class="bd">
            <div class="page__bd">
                <div class="weui-cells__title"><? echo $result['s_name']?>同学，您的注册完成情况如下：</div>
                <div class="weui-cells">
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <p>信息补齐</p>
                        </div>
                        <div class="weui-cell__ft">
                            <?
                            if ($result['is_finInfo']==1) {
                                echo '<i class="weui-icon-success-no-circle"></i>';
                            }else{
                                echo '<i class="weui-icon-cancel"></i>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <p>一卡通申办</p>
                        </div>
                        <div class="weui-cell__ft">
                            <?
                            if ($result['is_card']==1) {
                                echo '<i class="weui-icon-success-no-circle"></i>';
                            }else{
                                echo '<i class="weui-icon-cancel"></i>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <p>缴费情况</p>
                        </div>
                        <div class="weui-cell__ft">
                            <?
                            if ($result['is_pay']==1) {
                                echo '<i class="weui-icon-success-no-circle"></i>';
                            }else{
                                echo '<i class="weui-icon-cancel"></i>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <p>宿舍申请</p>
                        </div>
                        <div class="weui-cell__ft">
                            <?
                            if ($result['is_dor']==1) {
                                echo '<i class="weui-icon-success-no-circle"></i>';
                            }else{
                                echo '<i class="weui-icon-cancel"></i>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <p>军训服装选购</p>
                        </div>
                        <div class="weui-cell__ft">
                            <?
                            if ($result['is_clothes']==1) {
                                echo '<i class="weui-icon-success-no-circle"></i>';
                            }else{
                                echo '<i class="weui-icon-cancel"></i>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="weui-cells__tips">当上面流程全完成后才能进行报到单打印！</div>
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <p>报到单打印</p>
                        </div>
                        <div class="weui-cell__ft">
                            <?
                            if ($result['is_print']==1) {
                                echo '<i class="weui-icon-success-no-circle"></i>';
                            }else{
                                echo '<i class="weui-icon-cancel"></i>';
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <br>
        <a href="javascript:;" class="weui-btn weui-btn_primary close-popup">关闭</a>
    </div>
</div>
<div id="half" class='weui-popup__container popup-bottom'>
    <div class="weui-popup__overlay"></div>
    <div class="weui-popup__modal">
        <div class="toolbar">
            <div class="toolbar-inner">
                <a href="javascript:;" class="picker-button close-popup">关闭</a>
                <h1 class="title">志愿者联系方式</h1>
            </div>
        </div>
        <div class="modal-content">
            <div class="weui-cells">
                <?
                while($aee2=$arr2->fetch(PDO::FETCH_ASSOC)) {
                    echo ' <div class="weui-cell">';
                    echo ' <div class="weui-cell__bd">';
                    echo '<p>' . $aee2['v_name'] . '</p>';
                    echo '</div>';
                    echo '<div class="weui-cell__ft">' . $aee2['v_phone'] . '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
        <div id="full2" class='weui-popup__container'>
            <div class="weui-popup__overlay"></div>
            <div class="weui-popup__modal">
                <article class="weui-article">
                    <h1>报到须知</h1>
                    <section>
                        <h2 class="title">注意事项</h2>
                        <section>
                            <p>
                                <?
                                echo $result3['article'];
                                ?>
                            </p>
                        </section>
                    </section>
                </article>
                <a href="javascript:;" class="weui-btn weui-btn_primary close-popup">关闭</a>
            </div>
        </div>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.1/js/jquery-weui.js"></script>
<script>
    $(document).on("open", ".weui-popup-modal", function() {
        console.log("open popup");
    }).on("close", ".weui-popup-modal", function() {
        console.log("close popup");
    });
</script>

</body>
</html>