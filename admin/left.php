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
<SCRIPT language=javascript>
function expand(el)
{
	if (document.getElementById("child" + el).style.display == 'none') document.getElementById("child" + el).style.display = 'block';
	else document.getElementById("child" + el).style.display = 'none';
	return;
}
</SCRIPT>
</HEAD>
<BODY>
<TABLE height="100%" cellSpacing=0 cellPadding=0 width=170 
background=images/menu_bg.jpg border=0>
  <TR>
    <TD vAlign=top align=middle>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TR>
          <TD height=10></TD></TR></TABLE>

      <?php if ($_SESSION['super'] == "1"){?>
      <!--系统设置-->
      <TABLE cellSpacing=0 cellPadding=0 width=150 border=0>
        
        <TR height=22>
          <TD style="PADDING-LEFT: 30px" background=images/menu_bt.jpg><A class=menuParent onclick=expand("a") href="javascript:void(0);">系统设置</A></TD></TR>
        <TR height=4>
          <TD></TD></TR></TABLE>
      <TABLE id="childa" style="DISPLAY: none" cellSpacing=0 cellPadding=0 
      width=150 border=0>
        <TR height=20>
          <TD align=middle width=30><IMG height=9 src="images/menu_icon.gif" width=9></TD>
          <TD><A class=menuChild href="system_mysql.php" target=main>系统设置</A></TD></TR>
        <TR height=4>
          <TD colSpan=2></TD></TR></TABLE>
          
      
      <!--模板管理--> 
      <TABLE cellSpacing=0 cellPadding=0 width=150 border=0>
        <TR height=22>
          <TD style="PADDING-LEFT: 30px" background=images/menu_bt.jpg><A class=menuParent onclick=expand("b") href="javascript:void(0);">模板管理</A></TD></TR>
        <TR height=4>
          <TD></TD></TR></TABLE>
      <TABLE id="childb" style="DISPLAY: none" cellSpacing=0 cellPadding=0 
      width=150 border=0>
        <TR height=20>
          <TD align=middle width=30><IMG height=9 src="images/menu_icon.gif" width=9></TD>
          <TD><A class=menuChild href="addtemplate.php" target=main>添加模板</A></TD></TR>
        <TR height=20>
          <TD align=middle width=30><IMG height=9 src="images/menu_icon.gif" width=9></TD>
          <TD><A class=menuChild href="template.php" target=main>模板管理</A></TD></TR>
        <TR height=20>
          <TD align=middle width=30><IMG height=9 src="images/menu_icon.gif" width=9></TD>
          <TD><A class=menuChild href="unzip.php" target=main>导入ZIP压缩包</A></TD></TR>
        <TR height=4>
          <TD colSpan=2></TD></TR></TABLE>
          
          
      <!--站点设置-->     
      <TABLE cellSpacing=0 cellPadding=0 width=150 border=0>
        <TR height=22>
          <TD style="PADDING-LEFT: 30px" background=images/menu_bt.jpg><A class=menuParent onclick=expand("c") href="javascript:void(0);">站点设置</A></TD></TR>
        <TR height=4>
          <TD></TD></TR></TABLE>
      <TABLE id="childc" style="DISPLAY: none" cellSpacing=0 cellPadding=0 
      width=150 border=0>
        <TR height=20>
          <TD align=middle width=30><IMG height=9 src="images/menu_icon.gif" width=9></TD>
          <TD><A class=menuChild href="siteset.php" target=main>站点设置</A></TD></TR>
        <TR height=20>
          <TD align=middle width=30><IMG height=9 src="images/menu_icon.gif" width=9></TD>
          <TD><A class=menuChild href="menuset.php" target=main>前台栏目管理</A></TD></TR>
        <TR height=4>
          <TD colSpan=2></TD></TR></TABLE>
      
      <!--微信设置-->     
      <TABLE cellSpacing=0 cellPadding=0 width=150 border=0>
        <TR height=22>
          <TD style="PADDING-LEFT: 30px" background=images/menu_bt.jpg><A class=menuParent onclick=expand("d") href="javascript:void(0);">微信设置</A></TD></TR>
        <TR height=4>
          <TD></TD></TR></TABLE>
      <TABLE id="childd" style="DISPLAY: none" cellSpacing=0 cellPadding=0 
      width=150 border=0>
        <TR height=20>
          <TD align=middle width=30><IMG height=9 src="images/menu_icon.gif" width=9></TD>
          <TD><A class=menuChild href="message.php" target=main>关注回复管理</A></TD></TR>
        <TR height=20>
          <TD align=middle width=30><IMG height=9 src="images/menu_icon.gif" width=9></TD>
          <TD><A class=menuChild href="returninfor.php" target=main>自动回复管理</A></TD></TR>
        <TR height=20>
          <TD align=middle width=30><IMG height=9 src="images/menu_icon.gif" width=9></TD>
          <TD><A class=menuChild href="menu.php" target=main>自定义菜单管理</A></TD></TR>
        <TR height=20>
          <TD align=middle width=30><IMG height=9 src="images/menu_icon.gif" width=9></TD>
          <TD><A class=menuChild href="createmenu.php" target=main>生成自定义菜单</A></TD></TR>
        <TR height=4>
          <TD colSpan=2></TD></TR></TABLE>
          
          
      <!--管理员管理-->
	<TABLE cellSpacing=0 cellPadding=0 width=150 border=0>
        <TR height=22>
          <TD style="PADDING-LEFT: 30px" background=images/menu_bt.jpg><A class=menuParent onclick=expand("e") href="javascript:void(0);">管理员管理</A></TD>
        </TR>
        <TR height=4>
          <TD></TD>
        </TR>
      </TABLE>
      <TABLE id="childe" style="DISPLAY: none" cellSpacing=0 cellPadding=0 
      width=150 border=0>
        <TR height=20>
          <TD align=middle width=30><IMG height=9 src="images/menu_icon.gif" width=9></TD>
          <TD><A class=menuChild href="admin.php" target=main>管理管理员</A></TD></TR>
        <TR height=4>
          <TD colSpan=2></TD></TR></TABLE>
          
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TR>
          <TD height=10></TD></TR></TABLE>
              
      <?php }?>    

<?php
$w3cview->navigate();
?>
      
      </TD>
    <TD width=1 bgColor=#d1e6f7></TD></TR></TABLE></BODY></HTML>
