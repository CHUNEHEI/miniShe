<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../../css/index.css" />  
  <style>
     th{text-align:center}
     .table>tbody>tr>td{vertical-align:middle}
     td input{width:80%;height:2rem;text-indent:5px}
     td select{width:80%;height:2rem;}
     td input[type=file]{cursor:pointer;width:100px;opacity:0;position:absolute;left:0;}/* 与a标签重合 */
     td a:hover{color:black;}
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
<article>
     <form action="edit.php" method="POST">
     <table style="text-align:center;" border="1" class="table table-striped">
            <thead>
              <tr><th style="color:#4682b4;font-size:2rem;padding:1rem 0s" colspan="4">
              编辑商品信息
              </th></tr>
            </thead>
            <tbody>
            <?php 
               include '../../conn/conn.php';
               $id=$_REQUEST['pid'];
               $sql="select * from products where Id=".$id;
               $result=mysqli_query($conn,$sql);
               $row = mysqli_fetch_assoc($result);
               
            ?>
            <!-- <tr><td colspan="4"><td></tr> -->
            <tr>
            <td>id <label style="color:red">*</label></td>
            <td><input  class="num"  name="Id" readonly value="<?php echo $row['Id'];?> " required></td>
            <td>名称 <label style="color:red">*</label></td>
            <td><input name="name" value="<?php echo $row['name'];?>" required></td>
            </tr>

            <tr>
            <td>别名 <label style="color:red">*</label></td>
            <td><input name="eName"value="<?php echo $row['eName'];?>" required></td>
            <td>图片</td>
            <td><a style="width:100px;display:inline-block;position:relative;
            background:#aeb4a7;color:white;border-radius:1rem;height:2rem;line-height:2rem;
            border:none;cursor:pointer"><input name="icons" value="<?php echo $row['icon'];?>" type="file" 
            name="icon">上传文件</php></td>
            </tr>

            <tr>
            <td>类型 <label style="color:red">*</label></td>
            <td><input name="type" value="<?php echo $row['type'];?>" required>
               </td>
            <td>详情</td>
            <td><input name="details" value="<?php echo $row['details'];?>"></td>
            </tr>

            <tr>
            <td>描述</td>
            <td><input name="description" value="<?php echo $row['description'];?>"></td>
            <td>原价 <label style="color:red">*</label></td>
            <td><input class="num" name="exPrice" value="<?php echo $row['exPrice'];?>" required></td>
            </tr>

            <tr>
            <td>价格 <label style="color:red">*</label></td>
            <td><input class="num" name="price" value="<?php echo $row['price'];?>" required></td>
            <td>折扣 <label style="color:red">*</label></td>
						<td><input name="discount"  value="<?php echo $row['discount'];?>" required></td>
            </tr>

            <tr>
            <td>底片数量 <label style="color:red" required>*</label></td>
            <td><input name="count"  value="<?php echo $row['count'];?>"></td>
            <td>拍照时长 <label style="color:red" required>*</label></td>
            <td><input name="time"  value="<?php echo $row['time'];?>"></td>
            </tr>

            <tr>
            <td>交收时间 <label style="color:red">*</label></td>
            <td><input name="getTime"  value="<?php echo $row['getTime'];?>" required>
               </td>
            <td>是否含回执 <label style="color:red" required>*</label></td>
            <td><input name="pg"  value="<?php echo $row['pg'];?>"></td>
            </tr>
            <tr>
            <td colspan="4" style="border-top:1px solid black">操作</td>
            </tr><tr>
            <td colspan="4"><input style="width:5rem" type="submit" value="更新" class="btn btn-primary"></input>
            <a href="products.php?name=<?php echo $_REQUEST['adminname'] ?>" style="height:2rem;display:inline-block;width:5rem" class="btn btn-danger">返回</a>
            <input  name="adminname" value="<?php echo $_REQUEST['adminname'] ?>" hidden></td>
            </tr>
            
            </tbody>
         </table>
     </form>
     </article>
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

