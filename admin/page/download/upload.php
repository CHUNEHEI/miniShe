<?php
  require('../../conn/conn.php'); 
  // error_reporting(0);
  $username=$_POST['username'];
  $createTime=$_POST['ct'];
  if($username==""||$username==NULL){
    echo "请先进行登录！";
  }else{
    if(is_uploaded_file($_FILES['file']['tmp_name'])){ 
      $upfile=$_FILES["file"]; 
       //获取数组里面的值 
      $name=$upfile["name"];//上传文件的文件名 
      $type=$upfile["type"];//上传文件的类型 
      $size=$upfile["size"];//上传文件的大小 
      $tmp_name=$upfile["tmp_name"];//上传文件的临时存放路径 
      //判断是否为图片 
      switch ($type){ 
        case 'image/pjpeg':$okType=true; 
        break; 
        case 'image/jpeg':$okType=true; 
        break; 
        case 'image/gif':$okType=true; 
        break; 
        case 'image/png':$okType=true; 
        break; 
    } 
      
    if($okType){ 
      /** 
       * 0:文件上传成功<br/> 
       * 1：超过了文件大小，在php.ini文件中设置<br/> 
       * 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/> 
       * 3：文件只有部分被上传<br/> 
       * 4：没有文件被上传<br/> 
       * 5：上传文件大小为0 
       */
      $error=$upfile["error"];//上传后系统返回的值 
      // echo "================<br/>"; 
      // echo "上传文件名称是：".$name."<br/>"; 
      // echo "上传文件类型是：".$type."<br/>"; 
      // echo "上传文件大小是：".$size."<br/>"; 
      // echo "上传后系统返回的值是：".$error."<br/>"; 
      // echo "上传文件的临时存放路径是：".$tmp_name."<br/>"; 
      
      // echo "开始移动上传文件<br/>"; 
      $dir="../../images/album/".$username."/";
      if(!is_dir($dir)){
        mkdir($dir,777);
      }
    //把上传的临时文件移动到upload目录下面(upload是在根目录下已经创建好的！！！) 
      move_uploaded_file($tmp_name,$dir.$name); 
      $destination=$dir.$name; 
      if($error==0){ 
        $sql = "SELECT * FROM useralbum where src='$destination'";
        $result = mysqli_query($conn,$sql);
        // $row = mysqli_fetch_assoc($result0);
        $row = mysqli_fetch_row($result); //抓取一行
          if($row===null){ //未查询到任何记录
            $sql = "INSERT INTO useralbum VALUES(0,'$username','$createTime','$destination',0,'UPLOAD')";
            $result = mysqli_query($conn,$sql);
            if($result===false){	//INSERT执行失败
              echo "写入数据库失败";
            }else {	//INSERT执行成功
              echo "图片".$name."成功上传";
            }
          }else {  //查询到一行记录
            echo "图片".$name."已存在";
          }
      }elseif ($error==1){ 
      echo "超过了文件大小，在php.ini文件中设置"; 
      }elseif ($error==2){ 
      echo "超过了文件的大小MAX_FILE_SIZE选项指定的值"; 
      }elseif ($error==3){ 
      echo "文件只有部分被上传"; 
      }elseif ($error==4){ 
      echo "没有文件被上传"; 
      }else{ 
      echo "上传文件大小为0"; 
      } 
    }else{ 
      echo "请上传jpg,gif,png等格式的图片！"; 
    } 
    } 
  }
?> 