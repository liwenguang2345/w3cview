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
<BODY onload="show(0)">
<script language='JavaScript'>
function chk(theform)
{
 if (theform.title.value == "")
  {
    alert('请输入类别名称。');
    theform.title.focus();
    return (false);
  }
}
function getXMLHTTP()
{
	var xmlhttp;
	try{ xmlhttp=new XMLHttpRequest(); }
	catch(e){}
	
	try{ xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); }
	catch(e){}
	
	try{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
	catch(e){}
	
	return xmlhttp;
}
function send()
{	
	if(xmlhttp.readyState==4){
		document.getElementById("newsclass").innerHTML=decodeURI(xmlhttp.responseText);
	}
}
function show(parent)
{
	xmlhttp=getXMLHTTP();
	xmlhttp.onreadystatechange=send;
	xmlhttp.open("get","selectnewsclass.php?parent="+parent,true);
	xmlhttp.send(null);
}
</script>
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
  <TR height=22>
  <TD style="PADDING-LEFT: 20px; FONT-WEIGHT: bold; COLOR: #ffffff" 
    align=left background=images/title_bg2.jpg>当前位置: 添加栏目</TD></TR>
</TABLE>
<form method='post' action='addnewsclasssave.php' name='myform' onsubmit="return chk(this);">  
  <TABLE cellSpacing=0 cellPadding=2 width="80%" align=center border=0>
    <TR>
      <TD width="10%" align=center>父类：</TD>
      <TD style="COLOR: #880000"><span id="newsclass"></span></TD>
    </TR>
    <TR>
      <TD align=center>类别名称：</TD>
      <TD style="COLOR: #880000"><input type="text" name="title" id="title"></TD>
    </TR>
    <TR>
      <TD align=center>&nbsp;</TD>
      <TD style="COLOR: #880000"><input  type='submit' name='Submit' value=' 添 加 ' style='cursor:hand;'>
        &nbsp;
      <input name='Cancel' type='reset' id='Cancel' value=' 取 消 ' style='cursor:hand;'></TD>
    </TR>
  </TABLE>
</form>
</BODY>
</HTML>