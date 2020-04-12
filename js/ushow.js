    var input= document.getElementById('uname');
    input.value=location.search.slice(1).split("=")[1];
  
    var first= document.querySelector("li>a:last-child");
    /* 
        if(location.search.slice(1).split("=")[1]){
          first.href="javascript:;"
          first.innerHTML=location.search.slice(1).split("=")[1];
        }else{ first.innerHTML='请先登录';first.href="login.html" }
        var center= document.querySelector("li:nth-child(2)>a");
        console.log(center);
        center.onmousemove=function(){
          this.parentNode.lastChild.style="display:block";
        }
        document.getElementById("center").onmouseleave=function(){
          this.parentNode.lastChild.style="display:none";
        }
    */
    (function query(){
      var userName,
          centerLi=document.querySelectorAll("#center>li>a"); 
      if(location.search.slice(1).split("&").length==0){
        userName=location.search.slice(1).split("=")[1];
        console.log(1)
      }else{
        userName=location.search.slice(1).split("&")[0];
        userName=userName.split("=")[1]
        console.log(userName)
      }
      $.ajax({
        type:'get',
        async:'true',
        url:'http://chuenhei.com.cn:8000/page/ushow.php?userName='+userName,
        //若服务器有规定接口函数则不可以修改
        success:function(data){
          //alert(data);  
          //console.log(data);
          if(parseInt(data).toString()==1){
              $("#uname").val(userName)
              first.href="http://chuenhei.com.cn:8000/index0.html?userName="+userName,
              centerLi[0].href="http://chuenhei.com.cn:8000/page/userCenter/userInfo.html?userName="+userName;
              centerLi[1].href="http://chuenhei.com.cn:8000/page/order/order.html?userName="+userName;
              first.innerHTML=userName;
            }else{ first.innerHTML='请先登录';first.href="login.html" }
            var center= document.querySelector("li:nth-child(2)>a");
            center.onmousemove=function(){
              this.parentNode.lastChild.style="display:block";
            }
            document.getElementById("center").onmouseleave=function(){
              this.parentNode.lastChild.style="display:none";
            }
        
          
        },
        error:function(){
          alert("重试");
        }
        });
     })()
