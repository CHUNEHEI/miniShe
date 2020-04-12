

<?php
include '../../conn/conn.php';

$admin=$_POST['adminname'];
$Id=$_POST['Id'];
$name=$_POST['name'];
$eName=$_POST['eName'];
$icon = $_POST['icons'];
$type =$_POST['type'];
$details = $_POST['details'];
$desc =$_POST['description'];
$price =$_POST['price'];
$exPrice =$_POST['exPrice'];
$discount =$_POST['discount'];
$count =$_POST['count'];
$time =$_POST['time'];
$pg =$_POST['pg'];
$getTime =$_POST['getTime'];


$sql = "update products set 
Id = '".$Id."',
name = '".$name."',
eName = '".$eName."',
icon = '".$icon."',
type = '".$type."',
details = '".$details."',
description = '".$desc."',
price = '".$price."',
discount = '".$discount."',
count = '".$count."',
time = '".$time."',
pg = '".$pg."',
getTime = '".$getTime."',
exPrice = '".$exPrice."' where id = ".$Id;

if ($conn->query($sql)) {
  header("Location: products.php?name=".$admin);
}else {
 echo "更新失败请重试！<a href='edit.php'> 点此返回 </a>";
}
?>