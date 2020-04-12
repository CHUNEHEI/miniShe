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
  <title>Mini摄后台管理系统</title> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="userPics.css" />  

  
</head>
<body>
  <article id="albums">
     <div class="headTitle">
        <span>用户冲印相册</span>
        <div class="line"></div>
     </div>
     <div>
       <ul class="picUl">
        <li class="pic">
            <img src="../../../images/DSC_0088.JPG">
        </li>
       </ul>
     </div>
     <div class="infoDiv">
       <span class="text-danger">*冲印完毕请修改状态</span>
       <form >
       <table class="infotable table table-bordered">
          <tr>
              <td><b>创建时间:</b></td>
              <td><b>冲印状态:</b></td>
          </tr>
            <tr>
              <td>2019.01.02</td>
              <td id="status">未冲印</td>
            </tr>
       </table>
       </form>
     </div>
     <div class="btnDiv">
      <a><div id="uploadPic" class="btn btn-success">
      确认已冲印
      </div></a>
      <a href="download.php?name=<?php echo $_REQUEST['name'];?>"><div id="uploadPic" class="btn btn-danger">
          返回上一页
          </div></a>
     </div>
     
  </article>  

  <script src="../../../lib/jquery-3.2.1.min.js"></script>
  <script src="../../../lib/bootstrap.min.js"></script>
  <script src="userPics.js"></script>
 </body>
 </html>
