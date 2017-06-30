<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if($w3cview->delete($_GET['table'], $_GET['key']."='".$_GET['id']."'")) echo "<script>alert('信息删除成功');location='".$_GET['table'].".php';</script>";
else echo "<script>alert('信息删除失败');location='".$_GET['table'].".php';</script>";
?>