<?php
/**
 * Created by PhpStorm.
 * User: XYX
 * Date: 2019/6/15
 * Time: 20:27
 * @param $s_admission
 * @param $dadName
 * @param $dadNum
 * @param $mumName
 * @param $mumNum
 * @param $address
 * @param $address2
 * @return bool
 */
include "connDB.class.php";
function updateUser($s_admission,$dadName,$dadNum,$mumName,$mumNum,$address,$address2){
    $db = conn();
    $stmt=$db->prepare("UPDATE studentInfo.s_info SET s_info.dadName=?,s_info.dadNum=?,s_info.mumName=?,s_info.mumNum=?,s_info.address=?,s_info.address2=?,s_info.is_finInfo=1 WHERE s_info.s_admission = ?");
    $stmt->bindParam(1,$dadName);
    $stmt->bindParam(2,$dadNum,PDO::PARAM_INT);
    $stmt->bindParam(3,$mumName);
    $stmt->bindParam(4,$mumNum,PDO::PARAM_INT);
    $stmt->bindParam(5,$address);
    $stmt->bindParam(6,$address2);
    $stmt->bindParam(7,$s_admission);
    $stmt->execute();
    return ($stmt->rowCount()==1);
}
?>