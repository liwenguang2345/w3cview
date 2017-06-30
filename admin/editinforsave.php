<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$couple = array("title"=>$_POST['title'], "note"=>$_POST['note']);
if($w3cview->edit("infor", $couple, "id='".$_POST['id']."'")) echo "<script>alert('信息修改成功');location='infor.php';</script>";
else echo "<script>alert('信息修改失败');location='editinfor.php?id=".$_POST['id']."';</script>";
?>