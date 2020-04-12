var query=window.location.search;
query=query.slice(1).split("&");
var param={};
param['userName']=query[0].split("=")[1]
param['eName']=query[1].split("=")[1]

$("#bookFormBtn").on('click',function(){
  if($("#bookFormBtn").is(".active")){
    crOrd()
  }else{
     return false
  }
});

$("#orderForm").on('change',"#category,.qfdate,.sjb",changeBtnStatus);

function crOrd(){
    var category=document.getElementById("category");
    var located=category.lastElementChild.value;
    switch(located){
      case "1011": var located='昌岗分店';break;
      case "1012":  var located='广州塔分店';break;
      case "1021":  var located='上下九分店';break;
      case "2011":  var located='万达广场分店';break;
      case "2012": var located='千灯湖分店';break;
    }  
    var time =document.querySelector(".sjb").value;
    var date=document.querySelector(".qfdate").value;
    var now=new Date();
    var nowY=now.getFullYear().toString();
    var nowM=(function(){
      var month=now.getMonth()+1;
      if(month<10){
        month="0"+month;
      }
      return month;
    })()
    var nowD=(function(){
      var day=now.getDate();
      if(day<10){
        day="0"+day;
      }
      return day;
    })()
    now=nowY+nowM+nowD;
    if(date!==""){
      date=date.split("-");
      var year=date[0];var mon=date[1];var day=date[2];
      if(mon<10){
        if(day<10){
          date=year+"0"+mon+"0"+day;
        }else{
          date=year+"0"+mon+day;
        }
      }else{
        if(day<10){
          date=year+mon+"0"+day;
        }else{
          date=year+mon+day;
        }
      }
    }else{
      date=0
    }
    
    if(date<now){
        alert("预约日期必须大于当前日期！");
        return ;
    }else{
        param['price']=$("#price").html();
        param['name']=$(".table tr td").html();
        param['date']=date;
        param['time']=time;
        param['located']=located;
        // console.log(param)
        queryOrderInfo();
  }
}

function changeBtnStatus(){
  var located=category.lastElementChild.value;
  if($(".qfdate").val()!==""&&$(".sjb").val()!=="-请选择时间-"&&located>1000){
        $("#bookFormBtn").addClass("active");
  }
}

(function queryUserInfo(){
  $.ajax({
    type:'get',
    async:'true',
    url:'../page/userCenter/user.php',
    data:{
      'name':param['userName']
    },
      //若服务器有规定接口函数则不可以修改
    success:function(data){
      param['realname']=data.realname;
      param['phone']=data.phone;
      param['address']=data.address;
    }
    
  })
})()
/* 
   1、检查当天地点和日期和时间有没有超过10个人  ×
   2、读取该用户是否重复订单 ×
   3、写入php数据库  
*/
function queryOrderInfo(){
  if(param.address==""||param.realname==""){
    alert("请完善个人信息后再进行预约。")
    setTimeout(function(){
        window.location.href="userInfo.html?userName="+param.userName;
    });
  }else{
      $.ajax({
        type:'post',
        async:'true',
        url:'./queryInfo.php',
        data:param,
          //若服务器有规定接口函数则不可以修改
        success:function(data){
          switch(data){
            case "1": alert("您已有该订单，如果需要修改预约时间，请在我的订单进行操作");break;
            case "2": alert("该时间段已超过预约人数，请选择其他时间段预约");break;
            case "3": 
            alert("成功预约,确认后跳转到首页")
            setTimeout(function(){
              window.location.href="../index0.html?userName="+param.userName;
            });
            break;
            case "4": alert("预约失败，稍后重试")
          }
        },
        error:function(error){
          console.log (error)
        }
    
  })
  } 
}
