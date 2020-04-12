<?php

@$time = $_POST['time'] or die('网络错误'); 
@$address = $_POST['address'] or die('网络错误'); 
@$date = $_POST['date'] or die('网络错误'); 
@$name = $_POST['name'] or die('网络错误'); 
@$phone = $_POST['phone'] or die('网络错误'); 
@$price = $_POST['price'] or die('网络错误'); 
@$realname = $_POST['realname'] or die('网络错误'); 
@$eName = $_POST['eName'] or die('网络错误'); 
@$shop = $_POST['located'] or die('网络错误'); 
@$userName = $_POST['userName'] or die('网络错误'); 
date_default_timezone_set("PRC");
@$createTime=date('Ymdhis');
switch($eName){
	case 'sfz':$productId='EF010001';
	break;
	case 'gatxz':$productId='EF010002';
	break;
	case 'jz':$productId='EF010003';
	break;
	case 'xyshz':$productId='EF010004';
	break;
	case 'byz':$productId='EF010005';
	break;
	case 'pnsy':$productId='EF010006';
	break;
	case 'hsz':$productId='EF010007';
	break;
	case 'zzz':$productId='EF010008';
	break;
	case 'hz':$productId='EF010009';
	break;
	case 'dsbq':$productId='EF010010';
	break;
	case 'pmgg':$productId='EF010011';
	break;
}
require('../conn/conn.php');
$sql = "SELECT * FROM orders WHERE eName='$eName' and userName='$userName' and status=0";
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
		//while($row=mysql_fetch_array($query)){    while($row = $result->fetch_assoc()) {
		//$result = $conn->query($sql);
$num_rows=mysqli_num_rows($result);
	if($num_rows>0){
		echo "1";//表示已存在该用户已有相同订单
	}else{
		$sql = "SELECT COUNT(*) FROM orders WHERE date='$date' and shop='$shop' and time='$time' and status=0";
		$result = mysqli_query($conn,$sql);
		$row=mysqli_fetch_array($result)[0];
		if($row>=10){
			echo "2";
		}else{
			$sql ="insert into orders VALUES('$createTime','$productId','$realname','$userName','$phone','$address','$shop','$date','$time','$name','$eName','$price','$createTime','$createTime','0')";
			$result = mysqli_query($conn,$sql);
			if($result===false){
				echo "4";
			}else{
			echo "3";
			}
		}
		//$rows = mysqli_fetch_row($result);
	  // $rowcount = $rows[0];
		// $raw_arr=array('name'=>$row['name']);获取数据的结果集mysql_fetch_array
		//header('Content-Type:application/json;charset=utf-8');//这个类型声明非常关键
		//$res_arr = json_encode($raw_arr);
		// echo $res_arr;
	}


?>
