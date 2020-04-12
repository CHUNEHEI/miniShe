<?php
include '../../conn/conn.php';
$uid = $_POST['uid'];
$sql = "delete from users where Id = ".$uid;

if (mysqli_query($conn,$sql)) {
  echo 1;
}else {
  echo 0;
}
?>