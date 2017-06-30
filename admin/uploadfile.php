<form style="padding-left:0px;padding-top:8px;margin-left:0px; margin-top:0px;" action="uploadfile.php?save=ok&input=<?php echo $_GET['input'];?>" method="post" enctype="multipart/form-data">
  <input type="file" name="image"><input type="submit" value="上传">
  </form>
<?php
 if ($_GET['save'] == "ok")
 {
     $filename = $_FILES['image']['name'];   //获取上传文件名
     $filetype = substr($filename, strrpos($filename, "."), strlen($filename) - strrpos($filename, "."));             //获取文件扩展名
	 $filename = date("Ymdhms").$filetype;
	 $filesize = $_FILES['image']['size'];   //获取文件大小
     //上传文件
     move_uploaded_file($filesize = $_FILES['image']['tmp_name'], "../upload/" . $filename);
	 echo "<script language=javascript>parent.document.myform." . $_GET['input'] . ".value='" . "/upload/" . $filename . "';</script>";
  }?>


