<?php
error_reporting(0);
require('../../conn/conn.php');
$Id = $_GET['advId'] or die('网络错误'); 
$sql = "SELECT * FROM activity WHERE Id='$Id' ";
$result = mysqli_query($conn,$sql);
//DQL: false 或 结果集
if($result===false){ //SQL语法错误
	echo "<h3>查询失败!</h3>";
	echo "请检查SQL语法：$sql";
}else {	
  $result=mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);

  $raw_arr=array(
  'activityName'=>$row['activityName'],
  'src'=>$row['src'],
  'totalTick'=>$row['totalTick'],
  'expried'=>$row['expried'],
  'tickExpried'=>$row['tickExpried'],
  'tickName'=>$row['tickName']);

  header('Content-Type:application/json;charset=utf-8');//这个类型声明非常关键
  $res_arr = json_encode($raw_arr);

  echo $res_arr;
    
   
}

?>
