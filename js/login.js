function confirm(){
          var confirmPsd=document.getElementById("rg_confirmPsd");
          var password=document.getElementById("rg_password");
          if(confirmPsd.value!=password.value){
            document.getElementById("para").style.display="block";
          }
          else{document.getElementById("para").style.display="none";
        }
};
    function isNull(){
              var pattern=/^\d{11}$/;
              var userName=document.getElementById("rg_userName");
              var password=document.getElementById("rg_password");
              var phone=document.getElementById("rg_phone");
              if(phone.value==""|| userName.value==""){
                document.getElementById("para1").style.display="block";
                document.getElementById("para2").style.display="none";
              }
              else if(!phone.value.match(pattern)){ 
                document.getElementById("para2").style.display="block";
                document.getElementById("para1").style.display="none";
              }
              else if(password.value==""){document.getElementById("para3").style.display="block";
               document.getElementById("para1").style.display="none";
              }
              else{
                document.getElementById("para1").style.display="none";
                document.getElementById("para2").style.display="none";
                document.getElementById("para3").style.display="none";
                }
            }
            
   function getCode(){
            var chars=[];
            for(let u=48;u<=57;u++){
            chars.push(String.fromCharCode(u));
            }
            for(let u=65;u<=90;u++){
            chars.push(String.fromCharCode(u));
            }
            for(let u=97;u<=122;u++){
            chars.push(String.fromCharCode(u));
            }
            //console.log(chars[a]);
            var code=[];
            for(var i=0;i<4;i++){
              var r=chars[Math.floor(Math.random()*61)];//parseInt
              code[i]=r;
            }
            document.getElementById("code_span").innerText=code.join("");
     }

    function valida() {
          var str=document.getElementById("rg_code").value;
          var code=document.getElementById("code_span").innerText;
          if(str.toString().toLowerCase()!=code.toString().toLowerCase()){
            alert("验证码不正确");return false;
          }else {
          return true;
            }
      }
         
            
                       
 var btn= document.getElementById("loginBtn");
 btn.onclick=query;
  function query(){ 
      var userName=document.getElementById("userName").value;
      var pwd=document.getElementById("password").value;
      var adminBtn=document.getElementById("admin");
      var src=adminBtn.checked ? './admin/page/adminLogin.php':'login.php';
    /*   debugger; */
      $.ajax({
        type:'get',
        async:'true',
        url:'./'+src+'?userName='+userName+'&pwd='+pwd,
        //若服务器有规定接口函数则不可以修改
        success:function(data){
          //alert(data);  
          console.log(data);
          switch(parseInt(data).toString()){
            case '-2':alert("password require");
              break;      
            case '-1':alert("userName require");
              break;
            case '0':alert("账户或密码错误");
              break;
            case '1': window.open("index0.html?name="+data.slice(1),'_self');
            break;
            case '2': window.open("./admin/index.html?name="+data.slice(1),'_self');
            break;
          }
        },
        error:function(){
          alert("fail");
        }
        });
     }

var btn1= document.getElementById("regBtn");
btn1.onclick=query1;
function query1() { 
var flag=valida();

if(flag){
    var userName1=document.getElementById("rg_userName").value;
    var phone=document.getElementById("rg_phone").value;
    var pwd1=document.getElementById("rg_password").value;
    $.ajax({
      type:'get',
      async:'true',
      url:'./register.php?phone='+phone+'&userName='+userName1+'&pwd='+pwd1,
      //若服务器有规定接口函数则不可以修改
      success:function(data){
         if(parseFloat(data)==2){
           alert("注册成功");
           window.open('login.html','_self');
         }else if(parseFloat(data)==1){
           alert("注册失败，请稍后再试");
         }else{
           alert(data.toString().slice(1));
         }
      },
      error:function(){
        alert("fail");
      }
    })
}
}
      /* function(){
        var userName=document.getElementById("userName").value;
        var pwd=document.getElementById("password").value;
        alert(pwd);
          var xhr=null;
          //浏览器兼容
          if(window.XMLHttpRequest){
            xhr=new XMLHttpRequest();
          }else{
            xhr=new ActiveXObject("Microsoft.XMLHttp");
          }
          //需要./才可以跳到当前目录
          var url='./login.php?userName='+userName+'&pwd='+pwd;
          xhr.open('get',url,true);
          //事情完成后做什么
          xhr.onreadystatechange=function(){
              if(xhr.readyState==4){
                if(xhr.status==200){
                  var data=xhr.responseText;
                  alert(data);
                  
                  //responseText 检查PHP参数是否有错
                }
              }
           
          }
          xhr.send(null);
      */
      