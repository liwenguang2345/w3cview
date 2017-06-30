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
  <TD style="PADDING-LEFT: 20px; FONT-WEIGHT: bold; COLOR: #ffffff" align=left background=images/title_bg2.jpg>当前位置: 自定义菜单管理</TD></TR>
</TABLE>
<table width=80% border=0 cellpadding=0 cellspacing=0 align=center><tr><td align=center>
<form action='' method=post>
搜索：&nbsp;
<input name="keyword" type="text">
<input type=submit name=submit value=查询>
</form></td></tr></table>
<?php
$couple = array("序号"=>"id", "上级菜单"=>"parentid.menu.id.title", "菜单名称"=>"title");
$keyword = array("title"=>$_REQUEST['keyword']);
$w3cview->page("menu", "id", $couple, 10, $_GET['page'], $_POST['delid'], 0, $_SESSION['editdel'], $_SESSION['editdel'], $keyword, "添加菜单");
?>
</BODY>
</HTML>