<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$couple = array("title"=>$_POST['title'],"parentid"=>$_POST['parentid'],"key"=>$_POST['key'],"url"=>$_POST['url']);
if($w3cview->add("menu", $couple)) echo "<script>alert('菜单添加成功');location='addmenu.php';</script>";
else echo "<script>alert('商家添加失败');location='addmenu.php';</script>";
?>
</body>
</html>