<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$couple = array("title"=>$_POST['title']);
if($w3cview->edit("newsclass", $couple, "id='".$_POST['id']."'")) echo "<script>alert('信息类别修改成功');location='newsclass.php';</script>";
else echo "<script>alert('信息类别修改失败');location='editnewsclass.php?id=".$_POST['id']."';</script>";
?>