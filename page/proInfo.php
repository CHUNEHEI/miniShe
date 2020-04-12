<?php
/**
*接收客户端提交的phone、pwd，执行查询，若都正确，则输出“登录成功”，更新最后一次登录时间；若有错误，则输出“用户名或密码有误”
*/
/* @$name = $_REQUEST['userName'] or die('userName required');
@$pwd = $_REQUEST['pwd'] or die('pwd required'); */
 @$eName = $_GET['eName'] or die('网络错误'); 
// @$callback=$_GET['callback'] or die('网络错误');
require('../conn/conn.php');

/* $sql = "SELECT * FROM products WHERE eName='$eName'"; */
$sql = "SELECT * FROM products WHERE eName='$eName'";
$result = mysqli_query($conn,$sql);
//DQL: false 或 结果集
if($result===false){ //SQL语法错误
	echo "<h3>查询失败！</h3>";
	echo "请检查SQL语法：$sql";
}else {	//SQL语法正确
	//试着抓取一行记录
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

/* echo $row['name'],$row['price'],$row['icon'],$row['type'],$row['details'],$row['pg'],
$row['description'],$row['count'],$row['getTime'],$row['time'],$row['discount'],$row['ex-price'];
 */
$raw_arr=array('name'=>$row['name'],'icon'=>$row['icon'],'price'=>$row['price'],'type'=>$row['type'],'details'=>$row['details'],
'pg'=>$row['pg'],'description'=>$row['description'],'count'=>$row['count'],'getTime'=>$row['getTime'],
'time'=>$row['time'],'discount'=>$row['discount'],'ex_price'=>$row['exPrice']);

header('Content-Type:application/json;charset=utf-8');//这个类型声明非常关键
$res_arr = json_encode($raw_arr);
/* $callback = $_GET['callback']; */
/* echo "$callback($res_arr)"; */
echo $res_arr;

	}

?>
