<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$couple = array("title"=>$_POST['title'], "newsclass"=>$_POST['newsclass'], "keywords"=>$_POST['keywords'], "description"=>$_POST['description'], "image"=>$_POST['image'], "note"=>$_POST['note'], "timer"=>date("Y-m-d"));
if($w3cview->add("news", $couple)) echo "<script>alert('信息添加成功');location='addnews.php';</script>";
else echo "<script>alert('信息添加失败');location='addnews.php';</script>";
?>
</body>
</html>