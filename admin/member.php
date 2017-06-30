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
  <TD style="PADDING-LEFT: 20px; FONT-WEIGHT: bold; COLOR: #ffffff" align=left background=images/title_bg2.jpg>当前位置: 会员管理</TD></TR>
</TABLE>
<table width=80% border=0 cellpadding=0 cellspacing=0 align=center><tr><td align=center>
<form action='' method=post>
搜索：&nbsp;
会员名<input type=text name=username id=username <?php if(!empty($_REQUEST['username'])){?>value=<?php echo $_REQUEST['username'];?><?php }?>>
会员昵称<input type=text name=nickname id=nickname <?php if(!empty($_REQUEST['nickname'])){?>value=<?php echo $_REQUEST['nickname'];?><?php }?>>
<input type=submit name=submit value=查询>
</form></td></tr></table>
<?php
$couple = array("序号"=>"id", "会员名"=>"username", "会员昵称"=>"nickname", "注册时间"=>"registertime");
$keyword = array("username"=>$_REQUEST['username'], "nickname"=>$_REQUEST['nickname']);
$w3cview->page("member", "id", $couple, 10, $_GET['page'], $_POST['delid'], 0, 0, $_SESSION['editdel'], $keyword);
?>
</BODY>
</HTML>