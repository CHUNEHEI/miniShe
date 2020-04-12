<?php
include '../../conn/conn.php';
$pid = $_POST['oid'];
$sql = "delete from orders where Id = ".$oid;

if (mysqli_query($conn,$sql)) {
  echo 1;
}else {
  echo 0;
}
?>