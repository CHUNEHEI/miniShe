
function delPro(elem,name) {
  
  var id= elem.getAttribute("data-uname");
  if(confirm("Are U sure delete this information ?")){
  $.post("./delPro.php",{
    pid:id,
  },function(data,status){
    if (data == 1) {
      alert("删除成功");
    }else{alert("删除失败");console.log(data)}
    //sleep(300);
    location.href="./products.php?name="+name;
  });
 }
}
function sleep(n) { //n表示的毫秒数
     var start = new Date().getTime();
     while (true) if (new Date().getTime() - start > n) break;
 }
/* $.ajax({
  type: 'POST',
  url: url,
  data: data,
  success: success,
  dataType: dataType
});
 */