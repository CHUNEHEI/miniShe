

<?php
include '../../conn/conn.php';


$Id=$_REQUEST['Id'];
$admin=$_REQUEST['adminname'];
$createtime=$_REQUEST['createtime'];
$shop =$_REQUEST['shop'];
$date =$_REQUEST['date'];
$time =$_REQUEST['time'];
$status =$_REQUEST['status'];
if($status=="已完成"){$statusFlag="1";}
            else if($status=="已取消"){$statusFlag="2";}
            else if($status=="待处理"){$statusFlag="0";}
            else{$statusFlag="";}
$sql = "update orders set 
Id = '".$Id."',
shop = '".$shop."',
date = '".$date."',
time = '".$time."',
createtime = '".$createtime."',
status='".$statusFlag."' where id = ".$Id;

if ($conn->query($sql)) {
  header("Location: orders.php?name=".$admin);
}else {
  printf("Error: %s\n", mysqli_error($conn));
  echo "更新失败请重试！<a href='edit.php'> 点此返回 </a>";
}
?>