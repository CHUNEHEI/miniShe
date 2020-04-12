<?php
include '../../conn/conn.php';
$username= $_POST['username'];

$sql = "delete * from useralbum where username = ".$username;

if (mysqli_query($conn,$sql)) {
  echo "删除成功";
}else {
  echo "删除失败";
}
?>
?>