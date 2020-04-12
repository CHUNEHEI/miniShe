<?php
include '../../conn/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mini摄后台管理系统</title> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../../css/index.css" />  
  <link rel="stylesheet" type="text/css" href="../../css/products.css" /> 
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
<article >
    
      <div style="text-align:center;margin-bottom:1rem;">
        <h1 style="font-weight:800;color:#4682b4;padding-bottom:0.6rem;">订单信息管理</h1>
      
     </div>
     <div><form action="searchResult.php" style="margin:0 auto;text-align:center;width:80%">
        <input hidden name="adminname" value="<?php 
              $name=$_REQUEST['adminname'];
              echo $name;
        ?>">
        查看订单状态：<select   style="height:1.5rem;width:10rem;margin-right:1rem;" name="status">
         <option select>全部</option>
         <option >待处理</option>
         <option >已完成</option>
         <option >已取消</option>
       </select>
       <input name="id" type="text" placeholder="查找订单编号" style="text-indent:5px;margin-right:1rem;">
       <input name="name" type="text" placeholder="查找订单名称" style="text-indent:5px;margin-right:1rem;">
       <input name="shop" type="text" placeholder="查找订单门店" style="text-indent:5px;margin-right:1rem;">
      
       <input hidden type="submit"><a href="orders.php?name=<?php echo $name; ?>" >返回</a></form>
       
    </div>
       <table style="text-align:center" class="table table-striped">
        
        <thead>
          <tr>
          <th>id</th>
          <th>订单编号</th>
            <th>用户姓名</th>
            <th>用户名</th>
            <th>手机</th>
            <th>地址</th>
						<th>门店</th>
            <th>预约日期</th>
            <th>预约时间</th>
            <th>产品名称</th>
            <th>产品字段</th>
            <th>价格</th>
            <th>状态</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $pid = $_REQUEST['id'] ;
          $pname = $_REQUEST['name'] ;
          $shop = $_REQUEST['shop'] ;
          $status = $_REQUEST['status'] ;
          if($status=="已完成"){$statusFlag="1";}
            else if($status=="已取消"){$statusFlag="2";}
            else if($status=="待处理"){$statusFlag="0";}
            else{$statusFlag="";}
          $sql = "select * from orders where shop like '%".$shop."%' and name like '%".$pname."%' and createtime like '%".$pid."%'and status like '%".$statusFlag."%' order by Id";
          
          $result = mysqli_query($conn,$sql);
          /* if (!$result) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();//检验错误
            } */
          if (mysqli_num_rows($result )>0) {
            // 输出每行数据
            while($row = mysqli_fetch_assoc($result)) {
              ?>

         <tr>
         <td><?php echo $row["Id"]; ?></td>
         <td><?php echo $row["createtime"]; ?></td>
          <td><?php echo $row["realname"]; ?></td>
          <td><?php echo $row["userName"]; ?></td>
          <td><?php echo $row['phone'] ?></td>
          <td><?php echo $row['address'] ?></td>
          <td><?php echo $row["shop"]; ?></td>
          <td><?php echo $row['date'] ?></td>
          <td><?php echo $row['time'] ?></td>
          <td><?php echo $row['name'] ?></td>
          <td><?php echo $row["eName"]; ?></td>
          <td><?php echo $row["price"]; ?></td>
          <td><?php if($row['status']=="1"){echo "已处理";}
            else if($row['status']=="2"){echo "已取消";}
            else{echo "待处理";}?></td>
          <td>
          <a href="editOrd.php?adminname=<?php
           $name=$_REQUEST['name'] ;
           echo $name;
         ?>&pid=<?php echo $row['Id']?>" class="btn btn-primary">编辑</a>
            <!-- 按钮触发模态框 -->
            <button data-uname="<?php echo $row['Id']?>" id="delBtn" data-toggle="modal"  data-target="#myModal"
            onclick="delOrd(this,'<?php echo $name ?>')" class="btn btn-danger" >删除</button>

            </div>

          </td>
         </tr>
              <?php
                }
              } else {  ?> <tr><td colspan="8"><?php
                echo "共找到 0 结果";
              }
              $conn->close();
              ?></td></tr>
        </tbody>
  </table>
      
    </article>
  <footer>

  </footer>
  <script src="../../../lib/jquery-3.2.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script>
  
  (function query(){ 
  var first= document.querySelector(".sName");
  var userName=location.search.slice(1).split("&")[0];
  userName=userName.split('=')[1];
  /* console.log(userName) */
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
   <script>
    
    function delPro(elem,name) {
      
      var id= elem.getAttribute("data-uname");
      if(confirm("Are U sure delete this information ?")){
      $.post("./delOrd.php",{
        oid:id,
      },function(data,status){
        if (data == 1) {
          alert("删除成功");
        }else{alert("删除失败");console.log(data)}
        location.href="./orders.php?name="+name;
      });
     }
    }
      </script>
</body>
</html>