var userName=showSearch()[3];
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

$("#uploadPic").on("click",function(){
  $.ajax({
    url:"updateStatus.php",
    type:"post",
    data:{status:1,userName:userName},
    success:function(data){
      alert(data)
      initPics()
    },
    error:function(){
      alert("系统繁忙，稍后再试！")
    }
  })
})
function initPics(){
  console.log(userName)
   $.ajax({
     url:"showAlbum.php?username="+userName,
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
$("ul.picUl").empty()
var json=info;
// console.log(info)
   var len=json.details.length;
   for(var j=0;j<len;j++) {
     if(json.details[j].src==""||json.details[j].src==null){
      var html="<li style='display:block;margin:0 auto'><h3>暂无图片</h3></li>";
      $("ul.picUl").append(html);
      return;
     }else{
      var html="<li class='pic'>"+
      "<img src='../"+json.details[j].src+"' ></li>";
      $("ul.picUl").append(html);  
     }
   }
   if(json.details[0].status==0){
    $("#status").text("未上传")
  }else{
    $("#status").text("已上传")
  }
 }