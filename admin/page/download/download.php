<?php
include '../../conn/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- name=keywords搜索关键字 description广告商 -->
  <title>Mini摄--预约拍照平台</title>
  <link rel="stylesheet" type="text/css" href="userPics.css" />
</head>
<body>

  <article id="albums">
     <div class="headTitle">
        <h1>用户相册</h1>
         
        <div class="line"></div>
     </div>
     <div style="text-align: center">
       <ul class="albumUl">
       <?php
           /*    $keywords = $_REQUEST['kw'] ;
          $sql = "SELECT username FROM products where name like '%".$keywords.'%'; */
           $sql = "select distinct username from userAlbum ";
           
          $result = mysqli_query($conn,$sql);
          $name=$_REQUEST['name'];
          if (mysqli_num_rows ( $result )>0) {
            // 输出每行数据
            while($row = mysqli_fetch_assoc($result)) {
        ?>
        <?php
        echo '<li class="albumDoc">
           <a href="userPics.php?name='.$name.'&username='.$row["username"].'"><div class="myAlbum" id="myUpload"></div>
            <span><b>'.$row["username"].'</b></span></a>
         </li>'
        ?>
         <?php
                }
              } 
          ?>
       </ul>
       <div class="btn btn-danger" style="text-align: center;margin-top:100px;background: darkred">
          <a id="back" style="text-decoration: none;color: white" >返回首页</a></div>
     </div>

  </article>  
  <script src="../../../lib/jquery-3.2.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script>
  $('#back').attr("href","../../index?name=cat");
  </script>
 </body>
 </html>
