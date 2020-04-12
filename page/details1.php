<?php
header('Content-Type:application/json;charset=utf-8');
require('../conn/conn.php');//这个类型声明非常关键
/**
*接收客户端提交的phone、pwd，执行查询，若都正确，则输出“登录成功”，更新最后一次登录时间；若有错误，则输出“用户名或密码有误”
*/
/* @$name = $_REQUEST['userName'] or die('userName required');
@$pwd = $_REQUEST['pwd'] or die('pwd required'); */
 @$type = $_GET['type'] or die('网络错误'); 

 $arr['detail']=array();
	$arr['basic']=array();
	$sql = "SELECT * FROM products WHERE type='$type'";
  $result = mysqli_query($conn,$sql);
	$num_rows=mysqli_num_rows($result);
  if ($num_rows>0) {
        // 输出每行数据
    while($row = mysqli_fetch_assoc($result)){
			$data["productId"]=$row['productId'];

				$sql2 = "SELECT * FROM productinfo WHERE productId='".$data['productId']."'";
				$result2 = mysqli_query($conn,$sql2);
				$num_rows2=mysqli_num_rows($result2);
				if ($num_rows2>0) {
							// 输出每行数据
					while($row2 = mysqli_fetch_assoc($result2)){
						$data2["content"]=$row2['content'];
						$data2["isElectronic"]=$row2['isElectronic'];
						$data2["getTimeDesc"]=$row2['getTimeDesc'];
						$data2["period"]=$row2['period'];
						$data2["totalpics"]=$row2['totalpics'];
						array_push($arr["detail"],$data2);
					}
				}
			$data["name"]=$row['name'];
			$data["price"]=$row['price'];
			$data["icon"]=$row['icon'];
      $data["type"]=$row['type'];
			$data["eName"]=$row['eName'];
			$data["discount"]=$row['discount'];
			$data["exPrice"]=$row['exPrice'];
      array_push($arr["basic"],$data);
    }
      echo json_encode($arr);
  }else{
    echo "暂无产品";
	};
	
	

		//修改最后一次登录时间
		/* $now = time()*1000;
		$id = $row['Id'];
		$sql = "UPDATE users SET lastLoginTime='$now' WHERE Id='$id'";
    $result = mysqli_query($conn,$sql);
		 */
   


?>
