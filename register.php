<?php
/*
*接收客户端提交的phone、pwd，添加到数据库 —— 若手机号已经存在，则不能添加，提示已经注册过，无需重复注册
*/

@$userName = $_GET['userName'] or die('userName required');
@$phone = $_GET['phone'] or die('phone required');
@$pwd = $_GET['pwd'] or die('pwd required');

require('./conn/conn.php');
$sql = "SELECT * FROM users order by id DESC limit 1";
$result0 = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result0);
$id=$row['Id']+1;
//先判断指定的phone在数据库中是否已经存在
$sql = "SELECT * FROM users WHERE username='$userName' OR phone='$phone'";
$result = mysqli_query($conn,$sql);
if($result===false){  //SQL执行失败//DQL: false 或 结果集
  echo "<h3>SQL语句执行失败！</h3>";
  echo "请检查SQL语法：$sql";
}else {		//SQL执行成功
	$row = mysqli_fetch_row($result); //抓取一行
	if($row===null){ //未查询到任何记录
		$now = time()*1000;
		$sql = "INSERT INTO users VALUES('$id','$userName',Null,'$pwd','$phone',Null,Null,'0','0')";
		$result = mysqli_query($conn,$sql);
		//DML: false 或 true
		if($result===false){	//INSERT执行失败
			echo "1";
		}else {	//INSERT执行成功
		  echo '2';/* 			echo "您在系统中编号为：".mysqli_insert_id($conn); */
		}
	}else {  //查询到一行记录
		echo "3";
		echo "原因：该用户名已经被注册！";
	}
}