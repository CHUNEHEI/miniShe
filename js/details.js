(function query(){ 
  showSearch();
  var type;
  
  if(arr[3]){
    switch(arr[3]){
      case 'ysz': type='艺术照';break;
      case 'zjz': type='证件照';break;
    }
  }
  $.ajax({
    type:'get',
    async:'true',
    url:'./details.php?type='+type,
    //若服务器有规定接口函数则不可以修改
    success:function(data){
      var data=data.split(' ');
      var arr1=[];
      for(var i=0,len=data.length-1;i<len;i++){
        
          arr1.push(data[i].split('+'));
          create(arr1[i])
          
      }//console.log(arr1[2][0]);
      document.getElementById("arti-title").innerHTML=arr1[0][1];
       
    },
    error:function(){
      alert("fail");
    }
    });
 })()

 function create(arr){ 
  var label=document.createElement("label");
  label.innerText=arr[0];
  var div=document.createElement("div");
  div.className="intro";
//for(var i=0;i<3;i++){
var div4=document.createElement("div");
var div5=document.createElement("div");
var div6=document.createElement("div");
var div7=document.createElement("div");
var div8=document.createElement("div");
var btn=document.createElement("button");
/* var label1=document.createElement("label");
label1.innerText=arr[1];
div4.appendChild(label1); */
if(arr[2].toString().indexOf("；")!==-1){
  var key=arr[2].split("；")
  div4.innerHTML="<label>"+key[0].split("：")[0]+"：</label>"+key[0].split("：")[1];
  div5.innerHTML="<label>"+key[1].split("：")[0]+"：</label>"+key[1].split("：")[1];
}else{ 
  div4.innerHTML="<label>内容：</label>"+arr[2];
  div5.innerHTML="<label>拍摄时长：</label>"+arr[5];
}
div6.innerHTML="<label>价格：</label>"+arr[3]+"元";
div7.innerHTML="<label>描述：</label>"+arr[7];
div8.style.width="300px";
if(parseInt(arr[4])=='NaN'){
  div8.innerHTML="<label>副本数量：</label>"+arr[4];
}else{div8.innerHTML="<label>底片数量：</label>"+arr[4];}
btn.innerText="预约";
btn.className="btnt";
btn.name=arr[6]
btn.onclick=function(){
  window.open("proInfo.html?"+location.search.slice(1).split("&")[0]+"&eName="+this.name,'_self');
}
var blocked=document.createDocumentFragment();
blocked.appendChild(div4);
blocked.appendChild(div5);
blocked.appendChild(div6);
blocked.appendChild(div7);
blocked.appendChild(div8);
blocked.appendChild(btn);
div.appendChild(blocked);
//}
  var block=document.createDocumentFragment();
  block.appendChild(label);
  block.appendChild(div);

  var div1=document.createElement("div");
  div1.className="list-div";
  div1.appendChild(block);

  var block1=document.createDocumentFragment();
 
  div2=document.createElement("div");
  div2.className="contentDiv";
  div2.style="float:left";
  var img=document.createElement("img");
  img.src="../images/night.jpg";img.style="float:left;width:240px;height:200px;"
  block1.appendChild(img);
  block1.appendChild(div2);
  div2.appendChild(div1);
  

  div3=document.createElement("div");
  div3.className="model_info";
  div3.appendChild(block1);
  var ul=document.createElement("ul");
  var li=document.createElement("li");
  li.className="list-2-0";
 
  li.appendChild(div3);
  
  document.getElementsByClassName('changeList')[0].appendChild(li);

  }

