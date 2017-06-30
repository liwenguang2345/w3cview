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
<script language='JavaScript'>
function chk(theform)
{
 if (theform.title.value == "")
  {
    alert('请输入信息名称。');
    theform.title.focus();
    return (false);
  }
}
</script>
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
  <TR height=22>
  <TD style="PADDING-LEFT: 20px; FONT-WEIGHT: bold; COLOR: #ffffff" 
    align=left background=images/title_bg2.jpg>当前位置: 添加关注回复消息</TD></TR>
</TABLE>
<form method='post' action='addmessagesave.php' name='myform' onsubmit="return chk(this);">  
  <TABLE cellSpacing=0 cellPadding=2 width="80%" align=center border=0>
    <TR>
      <TD align=center>名称：</TD>
      <TD style="COLOR: #880000"><input name="title" type="text" id="title" size="50"></TD>
    </TR>
    <TR>
      <TD align=center>链接：</TD>
      <TD style="COLOR: #880000"><input name="url" type="text" id="url" size="50"></TD>
    </TR>
    <TR>
      <TD align=center>图片：</TD>
      <TD style="COLOR: #880000">
      <input name="picurl" id="picurl" style='width:300px;'>
    <iframe name=I1 frameborder=0 width=350 height=40 scrolling=no src="uploadfile.php?input=picurl"></iframe>
    </TD>
    </TR>
     <TR>
      <TD align=center>描述：</TD>
      <TD style="COLOR: #880000"><textarea name="description" cols="100" rows="10" id="description"></textarea></TD>
    </TR>
    <TR>
      <TD colspan="2" align=center><input  type='submit' name='Submit' value=' 添 加 ' style='cursor:hand;'>
        &nbsp;
      <input name='Cancel' type='reset' id='Cancel' value=' 取 消 ' style='cursor:hand;'></TD>
    </TR>
  </TABLE>
</form>
</BODY>
</HTML>