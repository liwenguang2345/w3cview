<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$couple = array("title"=>$_POST['title'], "parent"=>$_POST['newsclass'], "timer"=>date("Y-m-d"));
if($w3cview->add("newsclass", $couple)) echo "<script>alert('信息类别添加成功');location='addnewsclass.php';</script>";
else echo "<script>alert('信息类别添加失败');location='addnewsclass.php';</script>";
?>
</body>
</html>