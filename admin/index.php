<?php
require_once('config.php');
require_once('sessionuser.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Frameset//EN">
<HTML>
<HEAD>
<TITLE>W3CVIEW视野CMS系统</TITLE>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="css/admin.css" type="text/css" rel="stylesheet">
<style type="text/css">
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
</style>
</HEAD>
<FRAMESET border=0 frameSpacing=0 rows="60, *" frameBorder=0>
<FRAME name=header src="header.php" frameBorder=0 noResize scrolling=no>
<FRAMESET cols="170, *">
<FRAME name=menu src="left.php" frameBorder=0 noResize>
<FRAME name=main src="main.php" frameBorder=0 noResize scrolling=yes>
</FRAMESET>
</FRAMESET>
<noframes>
</noframes>
</HTML>
