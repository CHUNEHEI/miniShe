<?php
include '../../conn/conn.php';
$status= $_POST['status'];
$username=$_POST['userName'];
$sql = "update useralbum set 
status = '".$status."'  where username = '".$username."'";

if (mysqli_query($conn,$sql)) {
  echo "更新状态成功";
}else {
  echo "更新状态失败".$status.$username;
}

?>