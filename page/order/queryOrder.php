<?php
error_reporting(0);
header('Content-Type:application/json;charset=utf-8');
require('../../conn/conn.php');
$username = $_GET['username'] ;
$Id = $_GET['Id'] ;  



$sql = "SELECT * FROM orders WHERE userName='$username' OR Id='$Id'";
//DQL: false 或 结果集
$result = mysqli_query($conn,$sql);
$num_rows=mysqli_num_rows($result);
$arr["details"]=array();
  if ($num_rows>0) {
        // 输出每行数据
    while($row = mysqli_fetch_assoc($result)){
      $data["Id"]=$row['Id'];
      $data["productId"]=$row['productId'];
      $data["phone"]=$row['phone'];
      $data["username"]=$row['userName'];
      $data["address"]=$row['address'];
      $data["shop"]=$row['shop'];
      $data["date"]=$row['date'];
      $data["time"]=$row['time'];
      $data["name"]=$row['name'];
      $data["price"]=$row['price'];
      $data["updatetime"]=$row['updatetime'];
      $data["status"]=$row['status'];
      $data["createtime"]=$row['createtime'];
      array_push($arr["details"],$data);
    }
      echo json_encode($arr);
  }else{
    echo "404";
  };



?>
