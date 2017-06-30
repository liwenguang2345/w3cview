<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$fielname = $_GET['name'] . ".html";
@unlink("../template/" . $fielname);
echo "<script>alert('模板文件删除成功');location='template.php';</script>";
?>