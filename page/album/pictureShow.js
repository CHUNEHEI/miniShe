$("#cancelMake").on("click",function(){
  $.ajax({
    url:"cancelAlbum.php",
    type:"post",
    data:{username:"tom"},
    success:function(data){
      $("ul.picUl").empty();
    },
    error:function(){
      alert("系统繁忙，稍后再试！")
    }
  })
})
function initPics(){
   $.ajax({
     url:"showAlbum.php?username=tom",
     type:"get",
     success:function(data){
        addToPicUl(data);
     },
     error:function(){
       alert("系统繁忙，稍后再试！")
     }
   })
}
initPics();
function addToPicUl(info) { 
var json=info;
// console.log(info)
   var len=json.details.length;
   for(var j=0;j<len;j++) {
      var html="<li class='pic'>"+
      "<img src='"+json.details[j].src+"'></li>";
      $("ul.picUl").append(html);
   }
   if(json.details[0].status==0){
    $("#status").text("未上传")
  }else{
    $("#status").text("已上传")
  }
 }