<?php
header('Content-Type:application/json;charset=utf-8');//这个类型声明非常关键
error_reporting(0);
require('../../conn/conn.php');
$username = $_GET['username'];
$sql = "SELECT * FROM useralbum WHERE username='$username' and type ='UPLOAD' ";
//DQL: false 或 结果集
$result = mysqli_query($conn,$sql);
$num_rows=mysqli_num_rows($result);
$arr["details"]=array();
  if ($num_rows>0) {
        // 输出每行数据
    while($row = mysqli_fetch_assoc($result)){
      $data["username"]=$row['username'];
      $data[ "src"]=$row['src'];
      $data[ "status"]=$row['status'];
      $data["createtime"]=$row['createtime'];
      array_push($arr["details"],$data);
    }
      echo json_encode($arr);
  }else{
    echo "你还没上传图片喔~";
  };

    
   


?>
