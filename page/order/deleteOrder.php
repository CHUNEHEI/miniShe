<?php
include '../../conn/conn.php';
$id = $_POST['id'] or die('网络错误');

$sql = "update orders set status='2' where Id = ".$id;
if (mysqli_query($conn,$sql)) {
  echo "撤单成功";
}else {
  echo "撤单失败";
}
?>