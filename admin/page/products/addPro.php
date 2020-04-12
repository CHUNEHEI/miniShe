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
     <form action="add.php" method="POST">
     <table style="text-align:center;" border="1" class="table table-striped">
            <thead>
              <tr><th style="color:#4682b4;font-size:2rem;padding:1rem 0" colspan="4">
              新增商品信息
              </th></tr>
            </thead>
            <tbody>
            <!-- <tr><td colspan="4"><td></tr> -->
            <tr>
            <td>id <label style="color:red">*</label></td>
            <td><input  class="num"  name="Id" placeholder="如:0，必须按照顺序" required></td>
            <td>名称 <label style="color:red">*</label></td>
            <td><input name="name" placeholder="如:身份证" required></td>
            </tr>

            <tr>
            <td>别名 <label style="color:red">*</label></td>
            <td><input name="eName" placeholder="如:sfz" required></td>
            <td>图片</td>
            <td><a style="width:100px;display:inline-block;position:relative;
            background:#aeb4a7;color:white;border-radius:1rem;height:2rem;line-height:2rem;
            border:none;cursor:pointer"><input name="icons" placeholder="上传文件" type="file" 
            name="icon">上传文件</></td>
            </tr>

            <tr>
            <td>类型 <label style="color:red">*</label></td>
            <td><select name="type" required>
               <option>-请选择-</option>  <option>证件照</option>   <option>艺术照</option> 
            <select></td>
            <td>详情</td>
            <td><input name="details" placeholder="如:背景色：红色；大小：26mm×32mm"></td>
            </tr>

            <tr>
            <td>描述</td>
            <td><input name="description" placeholder="如:无"></td>
            <td>原价 <label style="color:red">*</label></td>
            <td><input class="num" name="exPrice" placeholder="如:35，必须为数字" required></td>
            </tr>

            <tr>
            <td>价格 <label style="color:red">*</label></td>
            <td><input class="num" name="price" placeholder="如:30，必须为数字" required></td>
            <td>折扣 <label style="color:red">*</label></td>
						<td><input name="discount" placeholder="如:无折扣" required></td>
            </tr>

            <tr>
            <td>底片数量 <label style="color:red" required>*</label></td>
            <td><input name="count" placeholder="如:8张(不含电子照)"></td>
            <td>拍照时长 <label style="color:red" required>*</label></td>
            <td><input name="time" placeholder="如:3分钟内"></td>
            </tr>

            <tr>
            <td>交收时间 <label style="color:red">*</label></td>
            <td><select name="getTime" required>
               <option>-请选择-</option>  <option>立即交收</option>   <option>7个工作日</option> 
            <select></td>
            <td>是否含回执 <label style="color:red" required>*</label></td>
            <td><input name="pg" placeholder="如:不含回执"></td>
            </tr>
            <tr>
            <td colspan="4" style="border-top:1px solid black">操作</td>
            </tr><tr>
            <td colspan="4"><input style="width:5rem" type="submit" value="新增" class="btn btn-primary"></input>
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
   var sel=document.querySelectorAll('select');
   for(let i=0,len=sel.length;i<len;i++){
     sel[i].onchange=function(){
        if(sel[i].value=="-请选择-"){
        alert("该项目请必填写");
        this.focus();
      }
     }
   }   
  })();
   
  
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

</body>
</html>

