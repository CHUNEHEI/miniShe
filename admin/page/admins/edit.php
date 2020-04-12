

<?php
include '../../conn/conn.php';

$admin=$_POST['adminname'];
$Id=$_POST['Id'];
$name=$_POST['name'];
$pwd=$_POST['pwd'];

$sql = "update admins set 
Id = '".$Id."',
adminname = '".$name."',
pwd = '".$pwd."' where Id = ".$Id;
/* echo $admin,$name,$sql; */
if ($conn->query($sql)) {
  header("Location:admins.php?name=".$admin);
}else {
  echo "更新失败请重试！<a href='admins.php?name='".$admin."> 点此返回 </a>";
}
?>