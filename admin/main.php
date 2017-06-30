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
<TABLE cellSpacing=0 cellPadding=0 width="90%" align=center border=0>
  <TR height=100>
    <TD align=middle width=100><IMG height=100 src="images/admin_p.gif" 
      width=90></TD>
    <TD width=60>&nbsp;</TD>
    <TD>
      <TABLE height=100 cellSpacing=0 cellPadding=0 width="100%" border=0>
        
        <TR>
          <TD>当前时间 <script language="JavaScript" src="images/date.js"></script></TD></TR>
        <TR>
          <TD style="FONT-WEIGHT: bold; FONT-SIZE: 16px"><?php echo $_SESSION['username'];?></TD></TR>
        <TR>
          <TD>欢迎进入网站管理中心！</TD></TR></TABLE></TD></TR>
  <TR>
    <TD colSpan=3 height=10></TD></TR></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width="95%" align=center border=0>
  <TR height=20>
    <TD></TD></TR>
  <TR height=22>
  <TD style="PADDING-LEFT: 20px; FONT-WEIGHT: bold; COLOR: #ffffff" 
    align=left background=images/title_bg2.jpg>您的相关信息</TD></TR>
  <TR bgColor=#ecf4fc height=12>
    <TD></TD></TR>
  <TR height=20>
    <TD></TD></TR></TABLE>
<TABLE cellSpacing=0 cellPadding=2 width="95%" align=center border=0>
  <TR>
    <TD align=right width=100>登陆帐号：</TD>
    <TD style="COLOR: #880000"><?php echo $_SESSION['username'];?></TD></TR>
  <TR>
    <TD align=right>管理员级别：</TD>
    <TD style="COLOR: #880000"><?php if($_SESSION['super'] == "1"){?>超级管理员<?php }else{?>普通管理员<?php }?></TD></TR>
  <TR>
    <TD align=right>注册时间：</TD>
    <TD style="COLOR: #880000"><?php echo $_SESSION['regtime'];?></TD></TR>
  <TR>
    <TD align=right>登陆次数：</TD>
    <TD style="COLOR: #880000"><?php echo $_SESSION['loginnum'];?></TD></TR>
  <TR>
    <TD align=right>登录时间：</TD>
    <TD style="COLOR: #880000"><?php echo $_SESSION['logintime'];?></TD></TR>
  <TR>
    <TD align=right>IP地址：</TD>
    <TD style="COLOR: #880000"><?php echo $_SESSION['loginip'];?></TD></TR>
  <TR>
    <TD align=right>网站开发QQ：</TD>
    <TD style="COLOR: #880000">120753561</TD></TR>
  <TR>
    <TD align=right>版权所有：</TD>
    <TD style="COLOR: #880000"><a href="http://www.w3cview.com" target="_blank">W3CVIEW视野CMS系统</a></TD></TR></TABLE>
</BODY>
</HTML>