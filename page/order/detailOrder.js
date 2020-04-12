(function detailUtil(){
  var url="queryOrder.php?",
      search=window.location.search.slice(1);
 
  $.get(url+search,function(data){
    console.log(data)
    addDetailInfo(data);
  })  
})();

$("#back").on("click",function(){
  window.history.back()
})
function addDetailInfo(order){
  var status=judgeStatus(order.details[0].status),
      date=formatDateTime(order.details[0].date),
      createtime=formatDateTime(order.details[0].createtime),
      updatetime=formatDateTime(order.details[0].updatetime);
  $("#orderNo").text(order.details[0].Id);
  $("#productName").text(order.details[0].name);
  $("#shop").text(order.details[0].shop);
  $("#price").text(order.details[0].price);
  $("#date").text(date[0]);
  $("#time").text(order.details[0].time);
  $("#phone").text(order.details[0].phone);
  $("#address").text(order.details[0].address);
  $("#createTime").text(createtime[0]+" "+createtime[1]);
  $("#updateTime").text(updatetime);
  $("#status").text(status);
}
function judgeStatus(status){
  if(status==1){
    return "订单已完成"
  }else if(status==2){
    return "订单已取消"
  }else if(status==0){
    return "未处理"
  }
}
function formatDateTime(time) {
  if(time==""||time==null){
       return "--"
  }else{
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
            date=year+"年"+month+"月"+day+"日"
            time="";
      }
      return [date,time];
    }
 
}