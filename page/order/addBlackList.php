<?php
include '../../conn/conn.php';

$username=$_POST['username'];
$breakTimes=$_POST['breakTimes '];
$isBlock=$_POST['isBlock '];

$sql = "update users set 
isBlock = '".$isBlock."',
breakTimes = '".$breakTimes."' where username = ".$username;

if ($conn->query($sql)) {
  echo '1';
}else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  echo "更新失败请重试！<a href='edit.php'> 点此返回 </a>";
}
?>