<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$couple = array("parent"=>$_POST['parent'], "title"=>$_POST['title'], "url"=>$_POST['url'], "sorts"=>$_POST['sorts']);
if($w3cview->edit("menuset", $couple, "id='".$_POST['id']."'")) echo "<script>alert('栏目修改成功');location='menuset.php';</script>";
else echo "<script>alert('栏目修改失败');location='editmenuset.php?id=".$_POST['id']."';</script>";
?>