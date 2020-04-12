<?php
include '../../conn/conn.php';
$ct = $_POST['ct'];
$sql = "delete from comment where createTime = ".$ct;

if (mysqli_query($conn,$sql)) {
  echo '删除成功！';
}else {
  echo '删除失败，稍后重试！';
}
?>