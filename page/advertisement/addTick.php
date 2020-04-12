<?php
require('../../conn/conn.php');
$userName = $_POST['userName'] ;
$tickName = $_POST['tickName'];
$tickExpried = $_POST['tickExpried'];

$sql = "SELECT * FROM userticks where username='$userName' and tickName='$tickName'";
$result = mysqli_query($conn,$sql);
// $row = mysqli_fetch_assoc($result0);
$row = mysqli_fetch_row($result); //抓取一行
	if($row===null){ //未查询到任何记录
		$sql = "INSERT INTO userticks VALUES(0,'$userName','$tickName','$tickExpried')";
		$result = mysqli_query($conn,$sql);
		//DML: false 或 true
		if($result===false){	//INSERT执行失败
			echo "领取失败";
		}else {	//INSERT执行成功
		  echo '领取成功';
		}
	}else {  //查询到一行记录
		echo "你已领取该优惠券";
	}