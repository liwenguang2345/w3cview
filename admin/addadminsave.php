<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$couple = array("username"=>$_POST['username'], "password"=>md5($_POST['password']), "super"=>$_POST['super'], "regtime"=>date("Y-m-d"), "loginnum"=>'1', "logintime"=>date("Y-m-d"), "loginip"=>$_SERVER['REMOTE_ADDR']);
if($w3cview->add("admin", $couple)) echo "<script>alert('用户添加成功');location='admin.php';</script>";
else echo "<script>alert('用户添加失败');location='admin.php';</script>";
?>
</body>
</html>