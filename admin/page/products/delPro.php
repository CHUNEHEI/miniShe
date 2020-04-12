<?php
include '../../conn/conn.php';
$pid = $_POST['pid'];
$sql = "delete from products where Id = ".$pid;

if (mysqli_query($conn,$sql)) {
  echo 1;
}else {
  echo 0;
}
?>