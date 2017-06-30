<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$couple = array("timer"=>date("Y-m-d"));
if($w3cview->edit($_GET['table'], $couple, $_GET['key']."='".$_GET['id']."'")) echo "<script>alert('信息更新成功');location='".$_GET['table'].".php';</script>";
else echo "<script>alert('信息更新失败');location='".$_GET['table'].".php';</script>";
?>