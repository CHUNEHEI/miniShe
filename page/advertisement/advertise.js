var pageData;
(function (){
  var location=window.location.search.slice(1);
  var advId=1;
  $("#getBtn").on("click",getTick);
  $.ajax({
    type:"get",
    url:"advertise.php?advId="+advId,
    success:function(data){
      pageData=data;
      showAdvInfo(pageData);
    },
    error:function(err){
      alert("系统繁忙！")
    }
  })

})()
function showAdvInfo(info){
   $("#activityName").text(info.activityName);
   $("#tickName").text(info.tickName);
   $("#expried").text(info.expried);
   $("#tickExpried").text(info.tickExpried);
   $("#getBtn").attr("data-total",info.totalTick);
}
function getTick(){
  var total=$("#getBtn").attr("data-total");
  if(total==30){
    $.ajax({
      type:"post",
      url:"addTick.php",
      data:{
        userName:"tom",
        tickName:pageData.tickName,
        tickExpried:pageData.tickExpried
      },
      success:function(data){
        alert(data);
      },
      error:function(err){
        alert("系统繁忙！")
      }
    })
  }else{
    alert("名额已满，欢迎下次参与")
  }
 
}