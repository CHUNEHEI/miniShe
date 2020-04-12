var col4=document.getElementsByClassName("col-lg-4"),
    editBtn=$("#editBtn"),
    myCoupon=document.getElementById("myCoupon"),
    editDiv=document.getElementById("btnDiv");
editDiv.addEventListener("click",function (e) { 
    var _e=e;
    editHandler(_e)
 },false);
 myCoupon.addEventListener("click",popupModal,false);
cancelRe();
function showSearch(){
  var keyName=location.search.slice(1).split("&");
  arr=[];
  for(var i=0,len=keyName.length;i<len;i++){
    for(var j=0;j<2;j++){
     arr.push(keyName[i].split("=")[j]);
    }
  }
  return arr;
}
function setHeader(data,first,centerLi){
  if(parseInt(data).toString()==1){
    first.href="../index0.html?userName="+arr[1];
    centerLi[0].href="userInfo.html?userName="+arr[1];
    centerLi[1].href="myOrder.html?userName="+arr[1];
    first.innerHTML=data.slice(1);
    var input= document.getElementById('uname');
    input.value=data.slice(1);
  }else{first.innerHTML='请先登录';first.href="../login.html" }
  var center= document.querySelector("li:nth-child(2)>a");
  center.onmousemove=function(){
    this.parentNode.lastChild.style="display:block";
  }
  document.getElementById("center").onmouseleave=function(){
    this.parentNode.lastChild.style="display:none";
  } 
}
function query(){ 
    var first= document.querySelector("li>a:last-child");
    var centerLi=document.querySelectorAll("#center>li>a");
    var arr=showSearch();
   // console.log(arr);
    $.ajax({
      type:'get',
      async:'true',
      url:'../ushow.php?userName='+arr[1],
      //若服务器有规定接口函数则不可以修改
      success:function(data){
            setHeader(data,first,centerLi);
      },
      error:function(){
        alert("系统繁忙");
      }
      });
   }

function editHandler(e){
  var arr=[];
  switch(e.target.id){
       case "editBtn" :  
           if( editBtn.text()=="确认"){
            editBtn.text("修改");
             for(var i=0,len=col4.length;i<len;i++){
               col4[i].firstChild.setAttribute("readonly","readonly");
              //  arr.push(col4[i].firstChild.value);
             }
            
            refresh();
             
           }else{ 
           for(var i=0,len=col4.length;i<len;i++){
               col4[i].firstChild.removeAttribute("readonly");
           }
           col4[0].firstChild.focus();
           editBtn.text("确认");
         }; 
       break;   
       case "cancelBtn" : 
           editBtn.text("修改");
           for(var i=0,len=col4.length;i<len;i++){
             col4[i].firstChild.setAttribute("readonly","readonly");
           };
         cancelRe();
       break;
   }
}
 var id=document.getElementById("getId");
 function cancelRe(){
     var arr=showSearch();
     $.ajax({
       type:'get',
       url:'user.php?name='+arr[1],
       success:function(data){
         $("#username").text(data.username);
         $("#realname").val(data.realname);
         $("#pwd").val(data.pwd);
         $("#confirmPwd").val(data.pwd);
         $("#phone").val(data.phone);
         $("#email").val(data.email);
         $("#address").val(data.address);
         $("#breakTimes").text(data.breakTimes);
         id.value=data.id;
        //  console.log(data.breakTimes)
        
       },
       error:function(data){
         console.log(data.responseText);
       }
     })
   }

 function refresh(){
   if($("#pwd").val()!==$("#confirmPwd").val()){
     alert("确认密码不一致，请重新设置")
     cancelRe()
   }else{
      $.ajax({
        type:'post',
        url:'edituser.php',
        data:{
          'username':$("#username").text(),
          'realname':$("#realname").val(),
          'pwd':$("#pwd").val(),
          'phone':$("#phone").val(),
          'email':$("#email").val(),
          'address':$("#address").val()
      },
        success:function(data){
          // console.log(data)
          alert("修改成功");
        },
        error:function(data){
          alert("修改失败");
        }
      })
  }
}

function popupModal(){
  var name=$("#username").text();
  $.get("usertick.php?userName="+name,function(data){
    if(data==null||data==""){
      var html= "<tr><td>"+
      "<span colspan='4'>暂无数据</span>"+
      "</td></tr>";
      $("#couponTable").append();
    }else{
      for(row of data){
          var html="<tr>"+
          "<td>"+
          "<span>"+row.tickName
          +"</span>"+
          "</td><td>"+
          "<span>"+row.tickExpried+"</span>前</td>"+
          "</tr>";
          $("#couponTable").append(html);
      }
    }
      $('#myModal').modal('show')
  })
}
