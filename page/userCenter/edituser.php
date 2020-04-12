<?php
include '../../conn/conn.php';

$username=$_POST['username'];
$realname=$_POST['realname'];
$pwd=$_POST['pwd'];
$phone = $_POST['phone'];
$address =$_POST['address'];
$email = $_POST['email'];



$sql = "update users set 
realname = '".$realname."',
pwd = '".$pwd."',
phone = '".$phone."',
address = '".$address."',
email = '".$email."' where username = '".$username."'";

if (mysqli_query($conn,$sql)) {
  echo '1';
}else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  echo "更新失败请重试！<a href='edit.php'> 点此返回 </a>";
}

?>