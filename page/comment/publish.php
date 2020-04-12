<?php
require('../../conn/conn.php');
$userName = $_POST['userName'] ;
$content = $_POST['content'];
$createTime =$_POST['createTime']; ;
		$sql = "INSERT INTO comment VALUES(0,'$userName','$createTime','$content','$createTime')";
		$result = mysqli_query($conn,$sql);
		//DML: false 或 true
		if($result===false){	//INSERT执行失败
			echo "发布失败";
		}else {	//INSERT执行成功
		  echo '发布成功';
		}
?>