<?php
/**
*接收客户端提交的phone、pwd，执行查询，若都正确，则输出“登录成功”，更新最后一次登录时间；若有错误，则输出“用户名或密码有误”
*/
/* @$name = $_REQUEST['userName'] or die('userName required');
@$pwd = $_REQUEST['pwd'] or die('pwd required'); */
 @$type = $_GET['type'] or die('网络错误'); 

require('../conn/conn.php');

$sql = "SELECT * FROM products WHERE type='$type'";
$result = mysqli_query($conn,$sql);
//DQL: false 或 结果集
if($result===false){ //SQL语法错误
	echo "<h3>查询失败！</h3>";
	echo "请检查SQL语法：$sql";
}else {	//SQL语法正确
	//试着抓取一行记录
	$result=mysqli_query($conn,$sql);
$arr = array();
while ($row = mysqli_fetch_assoc($result))
{
$arr[] = $row;
}
for($i=0;$i<count($arr);$i++){
/* echo '<table><tr><td>'.$arr[$i]['name'].'</td><td>'.$arr[$i]['type'].'</td><td>'.$arr[$i]['pg'].
'</td></tr></table>'; */
echo $arr[$i]['name']."+". $arr[$i]['type']."+".$arr[$i]['details']."+".$arr[$i]['price']
."+".$arr[$i]['count']."+".$arr[$i]['time']."+".$arr[$i]['eName']."+".$arr[$i]['pg'].
$arr[$i]['icon']." ";

}
		//修改最后一次登录时间
		/* $now = time()*1000;
		$id = $row['Id'];
		$sql = "UPDATE users SET lastLoginTime='$now' WHERE Id='$id'";
    $result = mysqli_query($conn,$sql);
		 */
   
	}

?>
