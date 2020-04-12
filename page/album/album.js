 //  封装事件
 var arr1=[],
     uploadBtn=document.getElementById("upload");
(function(){
var oBox=document.getElementById("obox");
oBox.ondragenter=eventFun;
oBox.ondragleave=eventFun;
oBox.ondragover=eventFun;
oBox.ondrop=eventFun;
})()

function eventFun(e){
 e.preventDefault();
 switch(e.type){
   case 'dragenter':
     this.innerHTML="请释放鼠标";
   break;
   case 'drop':  
   e.preventDefault();
     var aFiles=e.dataTransfer.files;
     [].forEach.call(aFiles,function(current,index,arr){
       var filesRead=new FileReader();
       arr1.push(current);
       filesRead.readAsDataURL(current);
       filesRead.onload=onloadEvt;
     });
     break; 
   case 'dragleave':  this.innerHTML="请拖到此处"; break;; 
 }
}

function onloadEvt() { 
 var ali=document.createElement('li');
 ali.style='list-style:none;width:100px;display:inline-block'
 ali.innerHTML="<img src='"+this.result+"' width='100px'>";
 document.getElementById("filesList").appendChild(ali);
}


uploadBtn.onclick=function(e){
  if(arr1.length>10){
      alert("上传不能超过十张图片，请重新选择。")
  }else if(arr1.length==0){
    alert("请选择图片。")
  }else{
    arr1.forEach(function(current){
      var url='upload.php';
      var ct=getNowFormat();
      var formData=new FormData();
      formData.append('file',current);
      formData.append('username',"tom");
      formData.append('ct',ct);
      // console.log(formData.get("ct"))
        $.ajax({
          url:url,
          type:'post',
          cache:false,
          data:formData,
          processData:false,
          contentType:false,
          success:function(data){
            if(data=="本文件已存在"){
              alert(data);
            }else {
              alert(data);
            }
          },
          error:function(err){
            console.log(err)
          }
        });
      });
    arr1=[];
    $("#filesList").empty();
    }
 }

 function getNowFormat(){
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
  // dateTime=year
      return [year,month,day,hour,min,seconds].join("");
}