<?php
include '../../conn/conn.php';


$Id=$_REQUEST['Id'];
$admin=$_REQUEST['adminname'];
$activityName=$_REQUEST['activityName'];
$tickName=$_REQUEST['tickName'];
$src =$_REQUEST['src'];
$isActive =$_REQUEST['isActive'];
$totalTick =$_REQUEST['totalTick'];
if($isActive=="是"){$activeFlag="1";}
            else{$activeFlag="0";}
$sql = "update activity set 
activityName = '".$activityName."',
tickName = '".$tickName."',
src = '".$src."',
isActive = '".$activeFlag."',
totalTick='".$totalTick."' where id = ".$Id;

if ($conn->query($sql)) {
  header("Location: advertisement.php?name=".$admin);
}else {
  printf("Error: %s\n", mysqli_error($conn));
  echo "更新失败请重试！<a href='edit.php'> 点此返回 </a>";
}
?>