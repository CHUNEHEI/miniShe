<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mini摄后台管理系统</title> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../../css/index.css" />  
  <style>
     th{text-align:center}
     .table>tbody>tr>td{vertical-align:middle}
     td input{width:80%;height:2rem;text-indent:5px}
     td select{width:80%;height:2rem;}
     td input[type=file]{cursor:pointer;width:100px;opacity:0;position:absolute;left:0;}/* 与a标签重合 */
     td a:hover{color:black;}
     .readonlyIp{border:0;background:initial}
  </style>
</head>
<body>
  <header>
    <div id="fixed">
      <div id="nav">
          <ul id="ul">
              <li>欢迎 管理员 <a class="sName"></a>
              </li>
              <li><a href="../admins/admins.php?name=<?php echo $_REQUEST['adminname'] ?>">修改密码</a>
              </li>
              <li><a href="javascript:location.replace('../../../login.html');">退出</a></li>        
          </ul>
      </div>
</div>
</header>
<?php if($_REQUEST['adminname']==""){
  echo "
  <div style='height:30rem;width:100%;'>
  <h1 style='margin-top:5rem;text-align:center'><a href='../../../login.html'>请先登录!</a><h1>
  </div>
  ";
}else {
  echo '
<article>
     <form action="edit.php" method="POST">
     <table style="text-align:center;" border="1" class="table table-striped">
            <thead>
              <tr><th style="color:#4682b4;font-size:2rem;padding:1rem 0" colspan="4">
              编辑订单信息
              </th></tr>
            </thead>
            <tbody> '?>
            <?php 
               include "../../conn/conn.php";
               $id=$_REQUEST["pid"];
               $sql="select * from orders where Id=".$id;
               $result=mysqli_query($conn,$sql);
               $row = mysqli_fetch_assoc($result);
               
            ?>
          <?php echo '
            <tr>
            <td>id</td>
            <td><input  class="num readonlyIp"  name="Id" readonly value="'.$row["Id"].'"></td>
            <td>订单编号 </td>
            <td><input name="createtime" value="'.$row["createtime"].'" class="readonlyIp" readonly></td>
            </tr>

            <tr>
            <td>用户姓名</td>
            <td><input name="realname"value="'.$row["realname"].'" disabled class="readonlyIp" readonly></td>
            <td>用户名</td>
            <td><input disabled name="userName" value="'.$row["userName"].'" class="readonlyIp" readonly></td>
            </tr>

            <tr>
            <td>手机 </td>
            <td><input disabled name="phone" value="'.$row["phone"].'" class="readonlyIp" reonly>
               </td>
            <td>地址</td>
            <td><input disabled  name="address" value="'.$row["address"].'" class="readonlyIp" readonly></td>
            </tr>
 
            <tr>
            <td>门店</td>
            <td><input name="shop" value="'.$row["shop"].'"></td>
            <td>预约日期 <label style="color:red">*</label></td>
            <td><input class="" name="date" value="'.$row["date"].'" required></td>
            </tr>

            <tr>
            <td>预约时间</td>
            <td><input name="time" value="'.$row["time"].'"></td>
            <td>产品名称<label style="color:red">*</label></td>
            <td><input disabled class="readonlyIp" name="name" value="'.$row["name"].'" required></td>
            </tr>

            <tr>
            <td>产品字段<label style="color:red">*</label></td>
            <td><input disabled class="readonlyIp" name="eName" value="'.$row["eName"].' " required></td>
            <td>价格<label style="color:red">*</label></td>
						<td><input disabled class="readonlyIp" name="price"  value="'.$row["price"].'" required></td>
            </tr>

            <tr>
            <td>状态<label style="color:red" required>*</label></td>
            <td>
            <select name="status">
              <option '?><?php if($row["status"]=="0"){echo 'selected';} ?><?php echo'>待处理</option>
              <option '?><?php if($row["status"]=="1"){echo 'selected';} ?><?php echo'>已完成</option>
              <option '?><?php if($row["status"]=="2"){echo 'selected';} ?><?php echo'>已取消</option>
            </select>
            </td>
            <td></td>
            <td></td>
            </tr>

          
            <tr>
            <td colspan="4" style="border-top:1px solid black">操作</td>
            </tr><tr>
            <td colspan="4"><input style="width:5rem" type="submit" value="更新" class="btn btn-primary" />
            <a href="orders.php?name='.$_REQUEST["adminname"].'" style="height:2rem;display:inline-block;width:5rem" class="btn btn-danger">返回</a>
            <input  name="adminname" value="'.$_REQUEST["adminname"] .'" hidden></td>
            </tr>
            
            </tbody>
         </table>
       </form>
</article>
     ';
}
?>
     <script src="../../../lib/jquery-3.2.1.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
     <script>
   (function(){
   var nums=document.querySelectorAll('.num');
   var reg=/^\d{1,11}$/;
   for(let i=0,len=nums.length;i<len;i++){
     nums[i].onchange=function(){
    if(!reg.test(this.value)){
    alert("请输入数字");this.focus()}
     }
   }
     
  })();
   
  
  (function query(){ 
  var first= document.querySelector(".sName");
  var userName=location.search.slice(1).split("&")[0];
  userName=userName.split('=')[1];
  $.ajax({
    type:'get',
    async:'true',
    url:'../ushow.php?userName='+userName,
    //若服务器有规定接口函数则不可以修改
    success:function(data){
      //alert(data);  
      console.log(data);
      if(parseInt(data).toString()==2){
          first.href="../../index.html?userName="+userName;
          first.innerText=userName;
        }else{ first.innerHTML='请先登录';first.href="../../../login.html" }
      
    },
    error:function(){
      alert("fail");
    }
    });
 })();
  
 
</script>
</body>
</html>

