<?php
include '../../conn/conn.php';
//检测表单字段是否为空
/*
  if (!isset($_POST['Id'])) {
  echo "请输入文章标题！";
  exit;
 }
 if (!isset($_POST['name'])) {
  echo "请输入作者！";
  exit;
 }
 if (!isset($_POST['eName'])) {
  echo "请输入文章内容！";
  exit;
 } 
*/
$admin=$_POST['adminname'];
$Id=$_POST['Id'];
$name=$_POST['name'];
$eName=$_POST['eName'];
$icon = $_POST['icons'];
$type =$_POST['type'];
$details = $_POST['details'];
$desc =$_POST['description'];
$exPrice =$_POST['exPrice'];
$price =$_POST['price'];
$discount =$_POST['discount'];
$count =$_POST['count'];
$time =$_POST['time'];
$pg =$_POST['pg'];
$getTime =$_POST['getTime'];

$sql="select* from products where Id=".$Id;
$result=mysqli_query($conn, $sql);
if(mysqli_num_rows($result )<1){
   $sql = "insert into products 
(Id,name,price,icon,type,details,pg,description,eName,count,getTime,time,discount,exPrice) VALUES ('".$Id."','".$name."','".$price."','".$icon."','".$type."','".$details."','".$pg."','".$desc."','".$eName."','".$count."','".$getTime."','".$time."','".$discount."','".$exPrice."')";
  
      if (mysqli_query($conn, $sql)) {

        echo "<div style='font-size:20px;font-weight:600;color:gray;width:100%;text-align:center'>添加成功!
        <span id='lt'>3</span>秒后自动返回。</div>";
        echo "<script>
           var lt=document.getElementById('lt');
           var i=3;
           setInterval(function(){
             lt.innerHTML=--i;
           },1000);
           setInterval(function(){
             window.location.replace('addPro.php?adminname=".$admin."')
           },3000)
        </script>";
        
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }else{
    echo "该Id已经存在<br>";
    echo "<a href='addPro.php?adminname=".$admin."' style='color:blue;cursor:pointer'>点击返回</a>";
  }
?>