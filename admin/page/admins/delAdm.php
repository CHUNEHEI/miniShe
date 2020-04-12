<?php
include '../../conn/conn.php';
$aid = $_POST['aid'];
$sql = "delete from admins where Id = ".$aid;

if (mysqli_query($conn,$sql)) {
  echo 1;
}else {
  echo 0;
}
?>