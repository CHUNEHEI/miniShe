<?php
session_start();
include '../conn/conn.php';
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>搜索</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../css/index.css" />
  <link rel="stylesheet" type="text/css" href="../css/details.css" />
  </script>
 </head>
 <body>
   <div id="fixed">
    <div id="nav">
        <ul id="ul">
            <li>欢迎 [ <a id="userName"><?php echo $_REQUEST['uname'] ?></a> ]
            </li>
            <li><a id="centerNav">个人中心</a><ul id="center" style="display: none">
            <li><a id="userCenter">个人信息</a></li><li><a id="order">我的订单</a></li>
            </ul></li>
            <li><a href="javascript:location.replace('../login.html');">退出</a></li>        
        </ul>
        <form style="float:right;" action="search.php"><input hidden id="uname" name="uname">
                <input id="search" style="color: gray" placeholder="搜一搜要拍啥子..." name="kw" type="search">
              <input id="submit" hidden type="submit">
        </form>
</div>
</div>
<article id="article" style="padding-top:1rem;">
  <div class="tit-box" >
  <h1  style="font-size:1.5rem;width:20rem">"<?php echo $_REQUEST['kw'] ?>"的搜索结果</h1>
  <a class="btn" onclick="history.back(1)"> 返回 </a>
  </div>
<?php

if (isset($_REQUEST['kw'])) {
  $keywords = $_REQUEST['kw'];
//包含关键词，进行搜索
$sql = "select * from products where name like '%".$keywords."%'";
$result = $conn->query($sql);
if($result->num_rows>0){
  while($row = $result->fetch_assoc()) {
    //while($row = mysqli_fetch_assoc($result)
    //echo "<li class='search'><a style = 'font-size:19px' href='/goods.php?id=".$row['id']."'><div class='searchd'><img  src='".$row['picture']."' width='200px'></div>".$row['goods_name'].'<br>'.$row['price']."</a></li>";
   /*  if (isset($_REQUEST['uid'])) {
        echo $row['name']."+". $row['type']."+".$row['details']."+".$row['price']
        ."+".$row['count']."+".$row['time']."+".$row['eName']."+".$row['pg'].
        $row['icon']." ";
    }else { */
      /* echo $row['name']."+". $row['type']."+".$row['details']."+".$row['price']
        ."+".$row['count']."+".$row['time']."+".$row['eName']."+".$row['pg'].
        $row['icon']." ";
    } */
   ?>
   
<div>
<ul class="changeList">
    <li class="list-2-0">
      <div class="model_info">
        <img src="../images/night.jpg" style="float: left; width: 240px; height: 200px;">
        <div class="contentDiv" style="float: left;">
          <div class="list-div">
            <label><?php echo $row['name'] ?></label>
            <div class="intro" style="width:415px">
              <div>
              <label>类型：</label> <?php echo $row['type'] ?></div>
              <div><label>大小：</label><?php echo $row['name'] ?></div>
              <div><label>价格：</label><?php echo $row['price'] ?></div>
              <div><label>描述：</label><?php echo $row['pg'] ?></div>
              <div style="width: 300px;">
                <label>底片数量：</label><?php echo $row['count'] ?></div>
                <button  class="btnt" name="sfz"
                onclick="javascript:window.open('proInfo.html?'+location.search.slice(1).split('&')[0]+'&eName=<?php echo $row['eName'];?>','_self');" 
               
                >预约</button>
              </div>
            </div>
          </div>
        </div>
      </li>
  </div>
   <?php
    /* $uName=$_REQUEST['uname'];
    $url  =  "./proInfo.html?name=".$uName."&eName=".$row['eName'] ; 
    echo " <script   language = 'javascript' 
    type = 'text/javascript' > "; 
    echo " window.location.href = '$url' "; 
    echo " </script > ";  */
  }
  
}else{
  echo "没有搜索到关于：<em style='color:grey'>".$keywords."</em>";
}
}else {
  //不包含关键词，显示全部商品
  echo "all goods";
}
 ?>
</ul>
</div>
<div id="main-footer">
    <p>
        | 摄影 | 用户服务协议 | 隐私政策 | 账号找回 | 联系我们 |
        <br><br>
        2018 © 摄影界  | 个人所有 | 广东金融学院 |
        <br>
        中国互联网举报中心 |  违法和不良信息举报：020-8888 8888 | 举报邮箱：jubao@minishe.com
      
        
    
    </p>
</div>
<script src="../lib/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<<script>
             $("#userName").attr("href","http://chuenhei.com.cn:8000/index0.html?userName="+$("#userName").text());
             $("#userCenter").attr("href","http://chuenhei.com.cn:8000/page/userCenter/userInfo.html?userName="+$("#userName").text());
             $("#order").attr("href","http://chuenhei.com.cn:8000/page/order/order.html?userName="+$("#userName").text());   
  
             $("#centerNav").on("mousemove",function(){
              this.parentNode.lastChild.style="display:block";
            })
            $("#center").on("mouseleave",function(){
              this.parentNode.lastChild.style="display:none";
            })
</script>
 </body>
</html>