<?php
require('../../conn/conn.php');
$userName = $_GET['userName'] ;

$sql = "SELECT * FROM userticks where username='$userName'";
$result = mysqli_query($conn,$sql);
// $row = mysqli_fetch_assoc($result);
$a=array();
$num_rows=mysqli_num_rows($result);
		//while($row=mysql_fetch_array($query)){    while($row = $result->fetch_assoc()) {
    //$result = $conn->query($sql);
if ($num_rows>0) {
      // 输出每行数据
  while($row = mysqli_fetch_assoc($result)){


    $raw_arr=array(
    'tickName'=>$row['tickName'],
    'tickExpried'=>$row['tickExpried']);
    array_push($a,$raw_arr);
    
  }
  
};
header('Content-Type:application/json;charset=utf-8');//这个类型声明非常关键
$res_arr = json_encode($a);
echo $res_arr;
?>