<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$couple = array("title"=>$_POST['title'], "newsclass"=>$_POST['newsclass'], "keywords"=>$_POST['keywords'], "description"=>$_POST['description'], "image"=>$_POST['image'], "note"=>$_POST['note']);
if($w3cview->edit("news", $couple, "id='".$_POST['id']."'")) echo "<script>alert('信息修改成功');location='news.php';</script>";
else echo "<script>alert('信息修改失败');location='editnews.php?id=".$_POST['id']."';</script>";
?>