<?php
require('../../conn/conn.php');
 $name = $_GET['name'] or die('网络错误'); 
$sql = "SELECT * FROM users WHERE username='$name'";
$result = mysqli_query($conn,$sql);


$row = mysqli_fetch_assoc($result);

$raw_arr=array('id'=>$row['Id'],'username'=>$row['username'],'realname'=>$row['realname'],
'pwd'=>$row['pwd'],'phone'=>$row['phone'],
'address'=>$row['address'],'breakTimes'=>$row['breakTimes'],
'email'=>$row['email']);

header('Content-Type:application/json;charset=utf-8');//这个类型声明非常关键
$res_arr = json_encode($raw_arr);

echo $res_arr;


?>
