<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="css/admin.css" type="text/css" rel="stylesheet">
<style type="text/css">
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
</style>
</HEAD>
<BODY>
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
  <TR height=22>
  <TD style="PADDING-LEFT: 20px; FONT-WEIGHT: bold; COLOR: #ffffff" align=left background=images/title_bg2.jpg>当前位置: 用户管理</TD></TR>
</TABLE>
<?php
$couple = array("序号"=>"id", "用户名"=>"username", "用户类型"=>"super.普通管理员|超级管理员");
$w3cview->page("admin", "id", $couple, 10, $_GET['page'], $_POST['delid'], 0, 0, $_SESSION['editdel'], "", $_SESSION['super']=="1"?"添加管理员":"");
?>
</BODY>
</HTML>