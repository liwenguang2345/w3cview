<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$couple = array("title"=>$_POST['title'], "url"=>$_POST['url'], "description"=>$_POST['description'], "picurl"=>$_POST['picurl'], "timer"=>date("Y-m-d H:i:s"));
if($w3cview->add("message", $couple)) echo "<script>alert('信息添加成功');location='addmessage.php';</script>";
else echo "<script>alert('信息添加失败');location='addmessage.php';</script>";
?>
</body>
</html>