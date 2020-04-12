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
  var userName=showSearch();
  userName=userName[1];
     
(function(){
  $("#back").attr("href","../../index0.html?name="+userName);
  orderUtil();
})()

function orderUtil(){
  var url="queryOrder.php?",
      search="username=tom";
  $.get(url+search,function(data){
    appendTable(data);
  })  
}

function addBlockOrTimes(isBlock,breakTimes){
  $.ajax({
    url:'queryBreakTimes.php',
    type:'post',
    data:{
      'username':userName,
      'isBlock':isBlock,
      'breakTimes':breakTimes
    }
  })
}
function userCredit(param) { 
  var url="queryBreakTimes.php",
      breakTimes;
  $.get(url+"?username="+userName,function(data){
    if(data==3){
      if(confirm("你已违规取消订单3次，若继续操作将被列入黑名单！")){
        addBlockOrTimes(true,data)
        delOrder(param);
      }
    }else{
      if(confirm("你已违规取消订单"+data+"次，是否继续操作？")){
        addBlockOrTimes(false,data+1)      
        delOrder(param);
      }
    }
    ;
  }) 
}
function appendTable(order){
  var html,status;
  // console.log(order)
  if(order==404){
    html="<tr><td colspan='7'>暂无数据</td></tr>"
  }else{
    var len=order.details.length,
        disable="disabled";
    for(var i=0;i<len;i++){
      status=order.details[i].status;
      if(status==0){
        disable="";
        status="未处理";
      }else if(status==1){
        status="订单已完成"
      }else if(status==2){
        status="订单已取消"
      }
    html=
    "<tr>"+
        "<td><input type='radio' "+disable+" name='check' value='"+order.details[i].Id+"'></td>"+
        "<td><a style='color:rgb(43, 144, 226)' href='orderInfo.html?userName="+userName+"&Id="+order.details[i].Id+"'>"+order.details[i].Id+"</a></td>"+
        "<td>"+order.details[i].name+"</td>"+
        "<td>"+formatDateTime(order.details[i].date)[0]+"</td>"+
        "<td>"+order.details[i].time+"</td>"+
        "<td>"+order.details[i].shop+"</td>"+
        "<td>"+status+"</td></tr>";
    $("#orderTable tbody").append(html);
    }
  }
}

$("#cancel").on("click",function(){
  var param=$("#orderForm").serializeArray(),
      now=getNowFormat(0);

  if(param.length==0){
    alert("请选择订单");
    return
  }
  if(now-20190101<1){
    userCredit(param);
  }else{
    delOrder(param);
  }
})
function delOrder(param){
   var orderId=param[0].value;
  //  console.log(orderId)
   var url="deleteOrder.php";
   $.post(url,{id:orderId},function(data){
    if(data=="撤单成功"){
      $("#orderTable tbody").empty()
      orderUtil();
      // alert(data);
      // setTimeout(function(){
        
      // });
    }else{
      alert(data)
    }
  })  
}

function formatDateTime(time) {
  if(time.length>8){ 
  var year=time.substring(0,4),
      month=time.substring(4,6),
      day=time.substring(6,8),
      hour=time.substring(8,10),
      min=time.substring(10,12),
      seconds=time.substring(12,14),
      date=[year,month,day].join(".")
      time=[hour,min,seconds].join(":");
  }else{
    var year=time.substring(0,4),
        month=time.substring(4,6),
        day=time.substring(6,8),
        hour=time.substring(8,10),
        date=[year,month,day].join(".")
        time="";
  }
  return [date,time];
}
function getNowFormat(type){
  var date=new Date();
      year=date.getFullYear(),
      month=ts(date.getMonth()+1),
      day=ts(date.getDate()),
      hour=ts(date.getHours()),
      min=ts(date.getMinutes()),
      seconds=ts(date.getSeconds());
      function ts(s){
        if(s<10){
          s="0"+s;
          return s;
        }else{
          return s;
        }
      }
      if(type=0){
        return [year,month,day].join("");
      }else if(type=1){
        return [year,month,day,hour,min,seconds].join("");
      }
  // dateTime=year
     
}