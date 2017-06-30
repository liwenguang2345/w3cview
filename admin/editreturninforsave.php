<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$couple = array("keyword"=>$_POST['keyword'], "title"=>$_POST['title'], "url"=>$_POST['url'], "description"=>$_POST['description'], "picurl"=>$_POST['picurl']);
if($w3cview->edit("returninfor", $couple, "id='".$_POST['id']."'")) echo "<script>alert('信息修改成功');location='returninfor.php';</script>";
else echo "<script>alert('信息修改失败');location='editreturninfor.php?id=".$_POST['id']."';</script>";
?>