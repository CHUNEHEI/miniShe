<?php
$conn = mysqli_connect('localhost', 'root', '', 'shop', 3306) or die("数据库连接错误");

$sql = "SET NAMES UTF8";
mysqli_query($conn,$sql);
?>