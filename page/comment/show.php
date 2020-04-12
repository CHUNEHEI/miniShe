<?php
error_reporting(0);
require('../../conn/conn.php'); 
//DQL: false 或 结果集
header('Content-Type:application/json;charset=utf-8');//这个类型声明非常关键
  $sql = "SELECT * FROM comment ";
  $result = mysqli_query($conn,$sql);
  $total=mysqli_num_rows($result);
  
  $arr['row']=$total;
  $arr['details']=array();
  $sql = "SELECT * FROM comment order By commentId DESC Limit 3";
  $result = mysqli_query($conn,$sql);
  $num_rows=mysqli_num_rows($result);
  if ($num_rows>0) {
        // 输出每行数据
    while($row = mysqli_fetch_assoc($result)){
      $data["username"]=$row['username'];
      $data[ "content"]=$row['content'];
      $data["createTime"]=$row['createTime'];
      array_push($arr["details"],$data);
    }
      echo json_encode($arr);
  }else{
    echo "暂无评论";
  };

    


?>
