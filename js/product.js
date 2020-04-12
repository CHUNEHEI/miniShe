
var btn1=document.getElementById("list-1");
var btn2=document.getElementById("list-2");
var li=document.getElementsByName("list");
var listDiv=document.getElementsByName("list-div");
var listDiv1=document.getElementsByName("list-div1");
var img=document.querySelectorAll(".model_info img");
window.onload=function(){
 document.getElementById("changeList").style.height=Math.ceil(li.length/3)*li[0].offsetHeight;
}
btn1.onclick=function(){
 //console.log(Math.ceil(li.length/3)*li[0].offsetHeight);
 document.getElementById("changeList").style.height=Math.ceil(li.length/3)*li[0].offsetHeight;
 //配合滚动条的changeList高度，否则当list-1-0时，changeList高度为0
 //if(li[0].className=="list-2-0"){
   if(li[0].classList.contains("list-2-0")){
     btn1.style.backgroundPosition="0px -34px";
     btn2.style.backgroundPosition="-34px -34px";
 for(let i=0;i<li.length;i++){
   li[i].classList.add("list-1-0");
   li[i].classList.remove("list-2-0");
    }
    for(let i=0;i<listDiv.length;i++){
     listDiv[i].classList.add("square-div");
     listDiv[i].classList.remove("nothing");
     listDiv1[i].classList.add("nothing");
     img[i].classList.remove("img");
    }
}
}
btn2.onclick=function(){
 document.getElementById("changeList").style.height=(li.length-1)*li[0].offsetHeight;//配合滚动条的changeList高度
 //if(li[0].className=="list-2-0"){
   if(li[0].classList.contains("list-1-0")){
     btn1.style.backgroundPosition="0px 0px";
     btn2.style.backgroundPosition="-34px -2px";
  for(let i=0;i<li.length;i++){
   li[i].classList.add("list-2-0");
   li[i].classList.remove("list-1-0");
  }
  for(let i=0;i<listDiv.length;i++){
   listDiv[i].classList.remove("square-div");
   listDiv[i].classList.add("nothing");
   listDiv1[i].classList.remove("nothing");
   img[i].classList.add("img");
    }
    console.log(listDiv1[0]);
 }
}


var a=document.querySelectorAll(".cList a");
//console.log();
for(var i=0;i<a.length;i++){
   var type=a[i].previousElementSibling.id
   /* if(type=='zjz'){
     type="证件照";
   }else if(type=='ysz'){
     type="艺术照";
   } */
   a[i].href="./page/details.html?name="+location.search.slice(1).split("=")[1]+"&type="+type;
}

var details=document.querySelectorAll(".intro>button.btn");
for(let i=0,len=details.length;i<len;i++){
 // console.log(details[1]);
  details[i].onclick=function(){
  console.log(location.search.slice(1).split("&")[0])
     window.open("page/proInfo.html?"+location.search.slice(1).split("&")[0]+"&eName="+this.name,'_self');
  }
}
 
