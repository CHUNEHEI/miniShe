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
              <li><a href="#">修改密码</a>
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
       <input name="id" type="text" placeholder="查找订单ID" style="text-indent:5px;margin-right:1rem;">
       <input name="name" type="text" placeholder="查找订单名称" style="text-indent:5px;margin-right:1rem;">
       <input name="type" type="text" placeholder="查找订单类型" style="text-indent:5px;margin-right:1rem;">
       <input hidden type="submit"><a href="orders.php?name=<?php echo $name; ?>" >返回</a></form>
       
    </div>
       <table style="text-align:center" class="table table-striped">
        
        <thead>
          <tr>
            <th>id</th>
            <th>名称</th>
            <th>类型</th>
            <th>原价</th>
            <th>价格</th>
						<th>折扣</th>
            <th>底片数量</th>
            <th>拍照时长</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $pid = $_REQUEST['id'] ;
          $pname = $_REQUEST['name'] ;
          $type = $_REQUEST['type'] ;
          $sql = "select * from orders where type like '%".$type."%' and name like '%".$pname."%' and Id like '%".$pid."%' order by Id";
          
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
          <td><?php echo $row["name"]; ?></td>
          <td><?php echo $row['type'] ?></td>
          <td><?php echo $row['exPrice'] ?></td>
          <td><?php echo $row["price"]; ?></td>
          <td><?php echo $row['discount'] ?></td>
          <td><?php echo $row['count'] ?></td>
          <td><?php echo $row['time'] ?></td>
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