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
<script> 
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
  <TD style="PADDING-LEFT: 20px; FONT-WEIGHT: bold; COLOR: #ffffff" align=left background=images/title_bg2.jpg>当前位置: 信息管理</TD></TR>
</TABLE>
<table width=80% border=0 cellpadding=0 cellspacing=0 align=center><tr><td align=center>
<form action='' method=post>
搜索：&nbsp;
信息类别
<span id="newsclass"></span>
标题<input type=text name=keyword id=keyword <?php if(!empty($_REQUEST['keyword'])){?>value=<?php echo $_REQUEST['keyword'];?><?php }?>><input type=submit name=submit value=查询>
</form></td></tr></table>
<?php
$couple = array("序号"=>"id", "信息类别"=>"newsclass.newsclass.id.title", "标题"=>"title", "发布时间"=>"timer");
$keyword = array("newsclass"=>$_REQUEST['newsclass'],"title"=>$_REQUEST['keyword']);
$w3cview->page("news", "id", $couple, 10, $_GET['page'], $_POST['delid'], 1, 1, 1, $keyword, "添加信息");
?>
</BODY>
</HTML>