<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$couple = array("password"=>md5($_POST['password']));
if($w3cview->edit("admin", $couple, "username='".$_SESSION['username']."'")) echo "<script>alert('密码修改成功');location='editadmin.php';</script>";
else echo "<script>alert('密码修改失败');location='editadmin.php';</script>";
?>