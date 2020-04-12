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
        <h1 style="font-weight:800;color:#4682b4;padding-bottom:0.6rem;">管理员信息管理</h1>
      </div>
     <!-- <div><form action="searchResult.php" style="text-align:center">
       <input hidden name="adminname" value="<?php
           $name=$_REQUEST['name'] ;
           echo $name;
         ?>">
       <input name="id" type="text" placeholder="查找管理员ID" style="text-indent:5px;margin-right:1rem;">
       <input name="name" type="text" placeholder="查找管理员名称" style="text-indent:5px;margin-right:1rem;">
       <input hidden type="submit"></form>
       
    </div> -->
       <table style="border:1px solid darkgray;width:80%;margin:2rem auto;text-align:center" class="table table-striped">
        
        <thead>
          <tr>
            <th>id</th>
            <th>名称</th>
            <th>密码</th>
          
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          <?php
           /*    $keywords = $_REQUEST['kw'] ;
          $sql = "SELECT * FROM products where name like '%".$keywords.'%'; */
          $name=$_REQUEST['name'];
           $sql = "select * from admins where adminname='".$name."'";
         
          $result = mysqli_query($conn,$sql);
        
          if (mysqli_num_rows($result )>0) {
            // 输出每行数据
           // while($row = mysqli_fetch_assoc($result)) { 
               $row = mysqli_fetch_assoc($result); 
              ?>

         <tr>
          <td><?php echo $row["Id"]; ?></td>
          <td id="aaaa"><?php echo $row["adminname"]; ?></td>
          <td><?php echo $row['pwd'] ?></td>
      
          <td>
            <a href="editAdm.php?adminname=<?php
           $name=$_REQUEST['name'] ;
           echo $name;
         ?>&aid=<?php echo $row['Id']?>" id="edit" class="btn btn-primary">编辑</a>
            <!-- 按钮触发模态框 -->
            <button data-uname="<?php echo $row['Id']?>" id="delBtn" onclick="delAdm(this,'<?php echo $name ?>')" class="btn btn-danger"  data-toggle="modal"  data-target="#myModal">删除</button>
            

          </td>
         </tr>
              <?php
            //    }
              } else {
                echo "共找到 0 结果";
              }
              $conn->close();
              ?>
        </tbody>
     </table>
     <!-- 
     <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog" style="width:400px">
               <div class="modal-content">
                  <div class="modal-header"  style="border:none">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" style="color: #df3320;font-weight:700" id="myModalLabel">提示</h4>
                  </div>
                  <div class="modal-body">Are U sure delete this information ?</div>
                  <div class="modal-footer" style="border:none">
                      <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                      <button type="button" id="del" onclick="" class="btn btn-danger">DELETE
                      </button>
                  </div>
                </div>
               </div>
      </div>
 -->
    </article>
  <footer style="position:absolute;bottom:0">

  </footer>
  <script src="../../../lib/jquery-3.2.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 

<script>
  
  (function query(){ 
  var first= document.querySelector(".sName");
  var userName=location.search.slice(1).split("=")[1];
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
  
   function delAdm(elem,name) {
  
        var id= elem.getAttribute("data-uname");
        
        if(confirm("Are U sure delete this information ?")){
        $.post("./delAdm.php",{
          aid:id,
        },function(data,status){
          if (data == 1) {
            alert("删除成功");
          }else{alert("删除失败");console.log(data)}
          location.href="./admins.php?name="+name;
        });
      }
 }

</script>
</body>
</html>