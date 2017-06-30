<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$fielname = $_POST['filename'] . ".html";
$note = $_POST['note'];
$note = str_replace('\"', '"', $note);
$note = str_replace("\'", "'", $note);
file_put_contents("../template/" . $fielname, $note);
echo "<script>alert('模板文件添加成功');location='addtemplate.php';</script>";
?>
