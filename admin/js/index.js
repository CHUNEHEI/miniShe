var first= document.querySelector(".sName");
(function query(){ 
  
  var userName=location.search.slice(1).split("=")[1];
  $.ajax({
    type:'get',
    async:'true',
    url:'./page/ushow.php?userName='+userName,
    //若服务器有规定接口函数则不可以修改
    success:function(data){
      //alert(data);  
      // console.log(data);
      
      if(parseInt(data).toString()==2){
          first.href="index.html?userName="+userName,
          first.innerText=userName;
          var a1= document.querySelector(".child:first-child>a:first-child");
          var a2= document.querySelector(".child:nth-child(1)>a:nth-child(2)");
          var a5= document.querySelector(".child:nth-child(1)>a:nth-child(3)");
          var a6= document.querySelector(".child:nth-child(1)>a:nth-child(4)");
          var a7= document.querySelector(".child:nth-child(1)>a:nth-child(5)");
          var a3= document.querySelector("li:last-child>.child>a:first-child");
          var a4= document.querySelector("li:last-child>.child>a:last-child");
          a4.parentElement.parentElement.children.length;
          a1.href="page/products/products.php?name="+userName;
          a2.href="page/orders/orders.php?name="+userName;
          a3.href="page/admins/admins.php?name="+userName;
          a4.href="page/users/users.php?name="+userName;
          a6.href="page/advertisement/advertisement.php?name="+userName;
          a5.href="page/comment/comment.php?name="+userName;
          a7.href="page/download/download.php?name="+userName;
          document.getElementById("updatePsw").href="page/admins/admins.php?name="+userName;
        }else{ first.innerHTML='请先登录';first.href="../login.html" }
    },
    error:function(){
      alert("fail");
    }
    });
 })();

(function(){
  
  var pLi=document.querySelectorAll(".parent>li");
  for(var i=0,len=pLi.length;i<len;i++){
    pLi[i].onclick=function(){
      if(this.firstElementChild.style.display=="block"){
         this.firstElementChild.style.display="none";
      }else{ this.firstElementChild.style.display="block";}
    }
  }
})()