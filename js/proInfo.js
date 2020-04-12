var eName=window.location.search.split("&");
$("#publish").on("click",function(){
  var content=$("#makeComment").val(),
      username=$($("#ul>li>a[href]")[0]).text(),
      createTime=getNowFormat();
      // console.log(createTime);
      if(content==""||content==null){
        alert("发布评论内容不能为空！");
      }else{
        $.ajax({
          type:"post",
          url:'comment/publish.php',
          data:{
            'createTime':createTime,
            'content':content,
            'userName':username
        },
          success:function(data){
            alert(data);
            getCommentData();
          }
        })
      }
});
(function query(){ 
  $.ajax({
    type:'get',
    async:'true',
    url:'./proInfo.php?'+eName[1],
   /*  dataType:'jsonp',
    jsonp:'cb', 
    jsonpCallback:"callback", */
    //若服务器有规定接口函数则不可以修改
    success:function(data){
      cb(data);
    }     
    });
 })();
 function cb(data){
  document.querySelector("#price").innerHTML=data.price;
  var discount=document.querySelector("#discount");
  discount.innerHTML=data.discount;
  discount.parentNode.nextElementSibling.firstElementChild.innerHTML=data.ex_price;
  var title=document.querySelector(".title-detail");
  title.title=data.name+"  --Mini摄出品";
  title.innerHTML=data.name+"   <em style='font-size:1rem'>- -Mini摄出品</em>";
/*      document.getElementById */
  var tdContent=document.getElementsByClassName("col-lg-4");
  tdContent[0].innerHTML=data.name;tdContent[1].innerHTML=data.type;
  tdContent[2].innerHTML=data.time;tdContent[3].innerHTML=data.details;
  tdContent[4].innerHTML=data.count;tdContent[6].innerHTML=data.getTime;
}
/* select js生成 */
var categories=[
  {"id":10,"name":"广州市","children":
     [{"id":101,"name":"海珠区", "children":
              [{"id":1011, "name":"昌岗分店"},{"id":1012,"name":"广州塔分店"}]
      },
      {"id":102,"name":"荔湾区","children":
              [{"id":1021,"name":"上下九分店"}]
      }]
  },
  {"id":20,"name":"佛山市","children":
      [{"id":201, "name":"南海区","children":
              [{"id":2011,"name":"万达广场分店"},{"id":2012,"name":"千灯湖分店"}]
        }]
  }
]
var div=document.getElementById("category");
function createSelect(arr){ //传入对象
   var select=document.createElement("select");
   //select.appendChild(new Option("-请选择-",-1));
   select.add(new Option("-请选择",-1)); //第一个开头选项-请选择-
   for(var i=0;i<arr.length;i++){  //遍历对象数组
     //select.appendChild(new Option(this.name,this.id));
     select.appendChild(new Option(arr[i].name,arr[i].id));
   }
   select.onchange=function(){
        while(this!=div.lastChild){  //判断该select是否为div的最后一个元素
          //如果不是则移除最后一个，直至this为最后一个元素
          div.removeChild(div.lastChild);  //避免重复添加select元素
        }
        var i=this.selectedIndex-1; //因为有-请选择-,所以所有select的选项下标-1
        if(i>=0&&arr[i].children!=undefined){
            createSelect(arr[i].children)  //利用创建select函数，为children创建一个select
      }
   }
   div.appendChild(select);
}
createSelect(categories);

function　getCommentData(){
  $.ajax({
    type:'get',
    async:'true',
    url:'comment/show.php',
    success:function (data) { 
      addToCommentArea(data);
     },
    error:function(error){

    }
  })
}

function formatDateTime(time) { 
    var year=time.substring(0,4),
        month=time.substring(4,6),
        day=time.substring(6,8),
        hour=time.substring(8,10),
        min=time.substring(10,12),
        seconds=time.substring(12,14),
        date=[year,month,day].join(".")
        time=[hour,min,seconds].join(":");
    return [date,time];
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
function addToCommentArea(comment){
  // console.log(comment)
   $("#total").text(comment.row);
   var len=comment.details.length;
   $('#commentArea').empty();
   for(var i=0;i<len;i++){
     var createTime=comment.details[i].createTime,
          date=formatDateTime(createTime)[0],
          time=formatDateTime(createTime)[1],
          html,delBtn;
          var username=$($("#ul>li>a[href]")[0]).text()
    if(username==comment.details[i].username){
        delBtn="<a onclick=confirmDel(" +createTime+
        ") style='font-size:14px;margin-left:5px;'>删除</a>";
    }else{
        delBtn="";
    }
       html="<li class='comments'>"+
            "<div class='comment'>"+
            "<p>"+comment.details[i].content+"</p>"+
            "<span>"+comment.details[i].username+
            "</span> -- <span>"+date+" "+time+"</span> "+delBtn+" </div></li>";
     $('#commentArea').append(html);
   }
   
}
getCommentData();
function confirmDel(ct){
  if(confirm("确定删除该评论吗？")){
    $.ajax({
      type:"post",
      url:'comment/delete.php',
      data:{'ct':ct},
      success:function(data){
        alert(data);
        getCommentData();
      }
    })
}
}



