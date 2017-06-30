<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$couple = array("title"=>$_POST['title'],"parentid"=>$_POST['parentid'],"key"=>$_POST['key'],"url"=>$_POST['url']);
if($w3cview->edit("menu", $couple, "id='".$_POST['id']."'")) echo "<script>alert('菜单修改成功');location='menu.php';</script>";
else echo "<script>alert('菜单修改失败');location='menu.php';</script>";
?>