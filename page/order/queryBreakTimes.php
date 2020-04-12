<?php
// error_reporting(0);
header('Content-Type:application/json;charset=utf-8');
require('../../conn/conn.php');
$userName = $_GET['username'] ;

$sql = "SELECT breakTimes FROM users WHERE username='$userName' ";
//DQL: false 或 结果集
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
	if($row===null){
	  echo '暂无数据';
	}else {
    echo $row['breakTimes'];
  }
?>