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
  <TD style="PADDING-LEFT: 20px; FONT-WEIGHT: bold; COLOR: #ffffff" 
    align=left background=images/title_bg2.jpg>当前位置: 模板管理</TD></TR>
</TABLE>
<?php
echo "<table cellspacing=1 cellpadding=0 width=100% border=0 bgcolor=#0066FF><tr><td align=center height=25 bgcolor=#FFFFFF>文件名</td><td align=center bgcolor=#FFFFFF>编辑</td></tr>";
$dir = dir("../template");
while($filename = $dir->read()){
   if (substr_count($filename, ".html") > 0){
	   echo "<tr><td align=center height=25 bgcolor=#FFFFFF>" . $filename . "</td><td align=center bgcolor=#FFFFFF><a href=edittemplate.php?name=" . str_replace(".html", "", $filename) . ">[修改]</a> <a href=deltemplate.php?name=" . str_replace(".html", "", $filename) . ">[删除]</a></td></tr>";
   }
}
echo "</table>";
?>
</BODY>
</HTML>