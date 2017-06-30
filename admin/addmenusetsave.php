<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$couple = array("parent"=>$_POST['parent'], "title"=>$_POST['title'], "url"=>$_POST['url'], "sorts"=>$_POST['sorts']);
if($w3cview->add("menuset", $couple)) echo "<script>alert('栏目添加成功');location='addmenuset.php';</script>";
else echo "<script>alert('栏目添加失败');location='addmenuset.php';</script>";
?>
</body>
</html>